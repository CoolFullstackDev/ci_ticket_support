<?php

class Knowledge_base extends CIF_Controller {

    public $layout = 'full';
    public $module = 'knowledge_base';
    public $model = 'Categories_model';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
    }

    public function index() {  
        $data['categories'] = $this->db
                ->get('categories')
                ->result();

        $data['faqs'] = $this->db
                ->order_by('faq_id', 'desc')
                ->limit('16')
                ->get('faqs')
                ->result();


        $this->load->view($this->module, $data);
    }

}
