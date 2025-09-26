<?php
class ControllerExtensionModuleOcFilter extends Controller {
    public function index() {
        $this->load->language('extension/module/oc_filter');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
            $this->model_setting_setting->editSetting('module_oc_filter', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/oc_filter', 'user_token=' . $this->session->data['user_token'], true));
        }

        $data['fields'] = isset($this->request->post['module_oc_filter_fields']) ? $this->request->post['module_oc_filter_fields'] : $this->config->get('module_oc_filter_fields');
        if (!$data['fields']) $data['fields'] = ['meta_keyword', 'attribute'];
        $data['action'] = $this->url->link('extension/module/oc_filter', 'user_token=' . $this->session->data['user_token'], true);

        $this->response->setOutput($this->load->view('extension/module/oc_filter', $data));
    }

    public function install() {
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('module_oc_filter', [
            'module_oc_filter_status' => 1,
            'module_oc_filter_fields' => ['meta_keyword', 'attribute']
        ]);
    }

    public function uninstall() {
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('module_oc_filter');
    }
}