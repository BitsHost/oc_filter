<?php
class ModelExtensionModuleOcFilter extends Model {
    public function install() {
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
    }

    public function uninstall() {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "oc_filter_cache`");
    }
}