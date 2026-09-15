<?php

return [
    'ctrl' => [
        'title' => 'Event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        // you can use a custom icon
        'iconfile' => 'EXT:core/Resources/Public/Icons/T3icons/content/content-calendar.svg',
    ],
    'columns' => [
        'title' => [
            'label' => 'Title',
            'config' => [
                'type' => 'input',
                'required' => true,
            ],
        ],
        'start_date' => [
            'label' => 'Start Date/Time',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
        'end_date' => [
            'label' => 'End Date/Time',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'is_recurring' => [
            'label' => 'Recurring Event',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
            ],
        ],
        'recurrence_type' => [
            'label' => 'Recurrence',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'None', 'value' => 'none'],
                    ['label' => 'Daily', 'value' => 'daily'],
                    ['label' => 'Weekly', 'value' => 'weekly'],
                    ['label' => 'Monthly', 'value' => 'monthly'],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'title, start_date, end_date, is_recurring, recurrence_type'],
    ],
];

// Make the event table categorizable
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
    'TxCalender',
    'tx_calender_domain_model_event',
    'categories',
    [
        'label' => 'Categories',
    ]
);