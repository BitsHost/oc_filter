<?php
class ControllerExtensionModuleOcFilter extends Controller {
    public function index() {
        $this->load->language('extension/module/oc_filter');
        $this->load->model('extension/module/oc_filter');
        $this->load->model('catalog/category');
        $this->load->model('catalog/product');

        $data['filters'] = array();

        // Get current category
        $category_id = 0;
        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string)$this->request->get['path']);
            $category_id = (int)array_pop($parts);
        }

        // Price filter
        if ($this->config->get('module_oc_filter_price')) {
            $price_range = $this->model_extension_module_oc_filter->getPriceRange($category_id);
            $data['price_min'] = $price_range['min'];
            $data['price_max'] = $price_range['max'];
            $data['filter_price_min'] = isset($this->request->get['price_min']) ? $this->request->get['price_min'] : $price_range['min'];
            $data['filter_price_max'] = isset($this->request->get['price_max']) ? $this->request->get['price_max'] : $price_range['max'];
            $data['show_price_filter'] = true;
        } else {
            $data['show_price_filter'] = false;
        }

        // Brand filter
        if ($this->config->get('module_oc_filter_brand')) {
            $data['brands'] = $this->model_extension_module_oc_filter->getBrands($category_id);
            $data['filter_brands'] = isset($this->request->get['brands']) ? explode(',', $this->request->get['brands']) : array();
            $data['show_brand_filter'] = true;
        } else {
            $data['show_brand_filter'] = false;
        }

        // Attribute filters
        if ($this->config->get('module_oc_filter_attributes')) {
            $data['attributes'] = $this->model_extension_module_oc_filter->getAttributes($category_id);
            $data['filter_attributes'] = isset($this->request->get['attributes']) ? $this->request->get['attributes'] : array();
            $data['show_attribute_filter'] = true;
        } else {
            $data['show_attribute_filter'] = false;
        }

        // Metakeywords filter
        if ($this->config->get('module_oc_filter_metakeywords')) {
            $max_keywords = (int)$this->config->get('module_oc_filter_max_keywords') ?: 20;
            $data['metakeywords'] = array_slice($this->model_extension_module_oc_filter->getMetakeywords($category_id), 0, $max_keywords);
            $data['filter_metakeywords'] = isset($this->request->get['metakeywords']) ? explode(',', $this->request->get['metakeywords']) : array();
            $data['show_metakeywords_filter'] = true;
        } else {
            $data['show_metakeywords_filter'] = false;
        }

        return $this->load->view('extension/module/oc_filter', $data);
    }
}