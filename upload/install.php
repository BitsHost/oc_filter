<?php
// OpenCart Extension Installer
// This file is executed during extension installation

// Register extension in database
$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "extension` SET `type` = 'module', `code` = 'oc_filter'");

// Create filter cache table if it doesn't exist
$this->db->query("
    CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "oc_filter_cache` (
        `cache_id` int(11) NOT NULL AUTO_INCREMENT,
        `category_id` int(11) NOT NULL,
        `filter_type` varchar(50) NOT NULL,
        `filter_data` text NOT NULL,
        `date_added` datetime NOT NULL,
        PRIMARY KEY (`cache_id`),
        KEY `category_filter` (`category_id`, `filter_type`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

// Set default configuration
$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_status', 
    `value` = '1'
");

$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_price', 
    `value` = '1'
");

$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_brand', 
    `value` = '1'
");

$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_attributes', 
    `value` = '1'
");

$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_metakeywords', 
    `value` = '1'
");

$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_max_keywords', 
    `value` = '20'
");
?>