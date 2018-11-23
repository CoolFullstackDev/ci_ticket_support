<?php

// script, homepage meta tags
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CIF_Controller {

    public $layout = 'full';
    public $module = "settings";
    public $image_file = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('settings_model');
        $this->lang->load('settings');
        $this->output->enable_profiler(FALSE);
        $this->permission();
    }

    public function index() {
        $this->load->library("form_validation");
        $config['upload_path'] = './cdn/about/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $this->load->library('upload', $config);
        $data['item'] = new stdClass();
        foreach ($this->settings_model->get() as $setting) {
            $data['item']->{ $setting->key } = $setting->value;
            $this->form_validation->set_rules('setting[' . $setting->key . ']', 'lang:settings_' . $setting->key, "trim");
        }
        $this->form_validation->set_rules('logo', 'Logo', "callback_logo");
        $this->form_validation->set_rules('favicon', 'Favicon', "callback_favicon");

        if ($this->form_validation->run() == false) {
            $this->load->view("settings/manage", $data);
        } else {
            foreach ($this->input->post('setting') as $key => $value) {
                $this->settings_model->key = $key;
                $this->settings_model->value = $value;
                $this->settings_model->save();
            }
            redirect("admin/settings");
        }
    }

    public function logo($var) {

        if ($this->upload->do_upload('logo')) {
            $data = $this->upload->data();
            if ($data['file_name']) {
                $this->settings_model->key = 'logo';
                $this->settings_model->value = $data['file_name'];
                $this->settings_model->save();
            }
        }
        return true;
    }

    public function favicon($var) {

        if ($this->upload->do_upload('favicon')) {
            $data = $this->upload->data();
            if ($data['file_name']) {
                $this->settings_model->key = 'favicon';
                $this->settings_model->value = $data['file_name'];
                $this->settings_model->save();
            }
        }
        return true;
    }

}
