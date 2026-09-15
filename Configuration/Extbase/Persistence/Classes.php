<?php
declare(strict_types=1);

return [
    \TYPO3\CMS\Extbase\Domain\Model\Category::class => [
        'tableName' => 'sys_category',
    ],
    \Neon\TxCalender\Domain\Model\Event::class => [
        'tableName' => 'tx_txcalender_domain_model_event',
    ],
    \Neon\TxCalender\Domain\Model\EventCategory::class => [
        'tableName' => 'tx_txcalender_domain_model_eventcategory',
    ],
];