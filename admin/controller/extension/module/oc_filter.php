<?php
class ControllerExtensionModuleOcFilter extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/oc_filter');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_oc_filter', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        }

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
        );
        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/oc_filter', 'user_token=' . $this->session->data['user_token'], true)
        );

        $data['action'] = $this->url->link('extension/module/oc_filter', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        $data['module_oc_filter_status'] = isset($this->request->post['module_oc_filter_status']) ? $this->request->post['module_oc_filter_status'] : $this->config->get('module_oc_filter_status');
        $data['module_oc_filter_price'] = isset($this->request->post['module_oc_filter_price']) ? $this->request->post['module_oc_filter_price'] : $this->config->get('module_oc_filter_price');
        $data['module_oc_filter_brand'] = isset($this->request->post['module_oc_filter_brand']) ? $this->request->post['module_oc_filter_brand'] : $this->config->get('module_oc_filter_brand');
        $data['module_oc_filter_attributes'] = isset($this->request->post['module_oc_filter_attributes']) ? $this->request->post['module_oc_filter_attributes'] : $this->config->get('module_oc_filter_attributes');
        $data['module_oc_filter_metakeywords'] = isset($this->request->post['module_oc_filter_metakeywords']) ? $this->request->post['module_oc_filter_metakeywords'] : $this->config->get('module_oc_filter_metakeywords');
        $data['module_oc_filter_max_keywords'] = isset($this->request->post['module_oc_filter_max_keywords']) ? $this->request->post['module_oc_filter_max_keywords'] : ($this->config->get('module_oc_filter_max_keywords') ?: 20);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/oc_filter', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/oc_filter')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}