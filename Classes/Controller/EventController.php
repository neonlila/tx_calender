<?php

namespace Neon\TxCalender\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Neon\TxCalender\Domain\Repository\EventRepository;

class EventController extends ActionController {
    public function __construct(
        private readonly EventRepository $eventRepository,
        private readonly CategoryRepository $categoryRepository
    ) {}

    public function listAction(): ResponseInterface
    {
        $categories = $this->categoryRepository->findAll();
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

        // Ensure category IDs are integers
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