<?php
// OpenCart Extension Uninstaller
// This file is executed during extension uninstallation

// Remove extension from database
$this->db->query("DELETE FROM `" . DB_PREFIX . "extension` WHERE `type` = 'module' AND `code` = 'oc_filter'");

// Remove settings
$this->db->query("DELETE FROM `" . DB_PREFIX . "setting` WHERE `code` = 'module_oc_filter'");

// Drop cache table
$this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "oc_filter_cache`");
?>