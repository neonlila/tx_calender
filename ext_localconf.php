<?php

defined('TYPO3') || die();

# use utility and your controller
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use Neon\TxCalender\Controller\EventController;

# configure your plugin | what controller classes should be used - cachable and non-cachable
ExtensionUtility::configurePlugin(
    'TxCalender',
    'List',
    [ EventController::class => 'list, filter, show, exportIcal', ],
    [ EventController::class => 'list, filter', ],
    ExtensionUtility::PLUGIN_TYPE_PLUGIN

);