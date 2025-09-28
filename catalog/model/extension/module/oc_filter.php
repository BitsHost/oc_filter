<?php
class ModelExtensionModuleOcFilter extends Model {
    public function getPriceRange($category_id = 0) {
        $sql = "SELECT MIN(p.price) as min, MAX(p.price) as max FROM " . DB_PREFIX . "product p";
        
        if ($category_id) {
            $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
            $sql .= " WHERE p2c.category_id = '" . (int)$category_id . "' AND p.status = '1'";
        } else {
            $sql .= " WHERE p.status = '1'";
        }

        $query = $this->db->query($sql);
        return array('min' => (float)$query->row['min'], 'max' => (float)$query->row['max']);
    }

    public function getBrands($category_id = 0) {
        $sql = "SELECT DISTINCT m.manufacturer_id, m.name FROM " . DB_PREFIX . "manufacturer m";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (m.manufacturer_id = p.manufacturer_id)";
        
        if ($category_id) {
            $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
            $sql .= " WHERE p2c.category_id = '" . (int)$category_id . "' AND p.status = '1'";
        } else {
            $sql .= " WHERE p.status = '1'";
        }
        
        $sql .= " ORDER BY m.name";

        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getAttributes($category_id = 0) {
        $sql = "SELECT DISTINCT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "attribute a";
        $sql .= " LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id)";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_attribute pa ON (a.attribute_id = pa.attribute_id)";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (pa.product_id = p.product_id)";
        
        if ($category_id) {
            $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
            $sql .= " WHERE p2c.category_id = '" . (int)$category_id . "' AND p.status = '1' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        } else {
            $sql .= " WHERE p.status = '1' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        }
        
        $sql .= " ORDER BY ad.name";

        $query = $this->db->query($sql);
        
        $attributes = array();
        foreach ($query->rows as $row) {
            if (!isset($attributes[$row['attribute_id']])) {
                $attributes[$row['attribute_id']] = array(
                    'attribute_id' => $row['attribute_id'],
                    'name' => $row['name'],
                    'values' => array()
                );
            }
            if (!in_array($row['text'], $attributes[$row['attribute_id']]['values'])) {
                $attributes[$row['attribute_id']]['values'][] = $row['text'];
            }
        }
        
        return $attributes;
    }

    public function getMetakeywords($category_id = 0) {
        $sql = "SELECT DISTINCT pd.meta_keyword FROM " . DB_PREFIX . "product_description pd";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (pd.product_id = p.product_id)";
        
        if ($category_id) {
            $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";
            $sql .= " WHERE p2c.category_id = '" . (int)$category_id . "' AND p.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pd.meta_keyword != ''";
        } else {
            $sql .= " WHERE p.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pd.meta_keyword != ''";
        }
        
        $query = $this->db->query($sql);
        
        $keywords = array();
        foreach ($query->rows as $row) {
            $meta_keywords = explode(',', $row['meta_keyword']);
            foreach ($meta_keywords as $keyword) {
                $keyword = trim($keyword);
                if ($keyword && !in_array($keyword, $keywords)) {
                    $keywords[] = $keyword;
                }
            }
        }
        
        sort($keywords);
        return $keywords;
    }
}