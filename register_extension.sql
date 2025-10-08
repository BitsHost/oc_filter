-- Register OC Filter Extension in OpenCart Database
-- Run this SQL query in your database if the module doesn't appear in Extensions > Modules

-- Register the extension (replace 'oc_' with your database prefix if different)
INSERT IGNORE INTO `oc_extension` SET `type` = 'module', `code` = 'oc_filter';

-- Set default configuration values
INSERT IGNORE INTO `oc_setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_status', 
    `value` = '1';

INSERT IGNORE INTO `oc_setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_price', 
    `value` = '1';

INSERT IGNORE INTO `oc_setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_brand', 
    `value` = '1';

INSERT IGNORE INTO `oc_setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_attributes', 
    `value` = '1';

INSERT IGNORE INTO `oc_setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_metakeywords', 
    `value` = '1';

INSERT IGNORE INTO `oc_setting` SET 
    `store_id` = '0', 
    `code` = 'module_oc_filter', 
    `key` = 'module_oc_filter_max_keywords', 
    `value` = '20';