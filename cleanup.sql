-- Complete OC Filter Extension Cleanup
-- Run this SQL to completely remove the extension before reinstalling

-- Remove extension registration
DELETE FROM `oc_extension` WHERE `code` = 'oc_filter';

-- Remove all module settings
DELETE FROM `oc_setting` WHERE `code` = 'module_oc_filter';

-- Remove cache table
DROP TABLE IF EXISTS `oc_filter_cache`;

-- Optional: Remove any layout assignments (if manually added)
DELETE FROM `oc_layout_module` WHERE `code` LIKE '%oc_filter%';