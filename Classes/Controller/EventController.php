<?php

namespace Neon\TxCalender\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Neon\TxCalender\Domain\Repository\EventRepository;

class EventController extends ActionController {
    public function __construct(
        private readonly EventRepository $eventRepository,
        private readonly ConnectionPool $connectionPool
    ) {}

   public function listAction(): ResponseInterface {
        // Query sys_category directly via QueryBuilder
        $queryBuilder = $this->connectionPool->getQueryBuilderForTable('sys_category');
        $categories = $queryBuilder
            ->select('uid', 'title')
            ->from('sys_category')
            ->where(
                $queryBuilder->expr()->eq('sys_language_uid', 0)
            )
            ->orderBy('title', 'ASC')
            ->executeQuery()
            ->fetchAllAssociative();

        $this->view->assign('categories', $categories);
        return $this->htmlResponse();
    }

    /**
     * @param array<int> $categories
     */
    public function filterAction(?string $startDate = null, ?string $endDate = null, array $categories = []): ResponseInterface
    {
        $start = $startDate ? new \DateTime($startDate) : null;
        $end = $endDate ? new \DateTime($endDate) : null;

        $categoryIds = array_map('intval', array_filter($categories));

        $events = $this->eventRepository->findByFilter($start, $end, $categoryIds);

        $data = array_map(static function ($event) {
            return [
                'uid' => $event->getUid(),
                'title' => $event->getTitle(),
                'startDate' => $event->getStartDate()?->format('d.m.Y H:i'),
                'startDateIso' => $event->getStartDate()?->format('c'),
            ];
        }, $events);

        return new JsonResponse([
            'success' => true,
            'count' => count($data),
            'events' => $data,
        ]);
    }


    public function exportIcalAction(int $event): ResponseInterface {
        // Generate iCal payload string
        $icsContent = "BEGIN:VCALENDAR\nVERSION:2.0\nPRODID:-//TYPO3//EventCal//EN\nEND:VCALENDAR";

        return $this->responseFactory
            ->createResponse()
            ->withHeader('Content-Type', 'text/calendar; charset=utf-8')
            ->withHeader('Content-Disposition', 'attachment; filename="event.ics"')
            ->withBody($this->streamFactory->createStream($icsContent));
    }
}