<?php
defined('TYPO3') || die();

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

// 1. Register the plugin signature
ExtensionUtility::registerPlugin(
    'TxCalender',
    'List',
    'Event Calendar (List)',
    'content-calendar', 
    'plugins'        
);

// 2. Attach FlexForm settings to this plugin (optional, but standard)
$pluginSignature = 'txcalender_list';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:tx_calender/Configuration/FlexForms/EventPlugin.xml'
);