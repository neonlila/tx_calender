<?php

namespace Neon\TxCalender\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;

class EventRepository extends Repository {
    
    protected $defaultOrderings = ['startDate' => QueryInterface::ORDER_ASCENDING];

    /**
     * @param array<int> $categoryIds
     */
    public function findByFilter(?\DateTime $startDate = null, ?\DateTime $endDate = null, array $categoryIds = []): array
    {
        $query = $this->createQuery();
        $constraints = [];

        if ($startDate !== null) {
            $constraints[] = $query->greaterThanOrEqual('startDate', $startDate);
        }
        if ($endDate !== null) {
            $constraints[] = $query->lessThanOrEqual('endDate', $endDate);
        }

        if (!empty($categoryIds)) {
            $categoryConstraints = [];
            foreach ($categoryIds as $catId) {
                $categoryConstraints[] = $query->contains('categories', $catId);
            }
            // Match any selected category (OR relation)
            $constraints[] = $query->or(...$categoryConstraints);
        }

        if ($constraints !== []) {
            $query->matching($query->and(...$constraints));
        }

        return $query->execute()->toArray();
    }
}