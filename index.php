/**
 * Entry point for the oc_filter application.
 * 
 * This file initializes the PHP environment and handles incoming requests.
 *
 * @package oc_filter
 */
<?php
class ControllerExtensionModuleFilterByMetadata extends Controller {
    public function index() {
        $this->load->language('extension/module/filter_by_metadata');
        $this->document->setTitle($this->language->get('heading_title'));

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_filter_by_metadata', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module'));
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['action'] = $this->url->link('extension/module/filter_by_metadata', 'user_token=' . $this->session->data['user_token']);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');

        $this->response->setOutput($this->load->view('extension/module/filter_by_metadata', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/filter_by_metadata')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}
