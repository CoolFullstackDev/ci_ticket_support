<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Knowledge_base extends CIF_Controller {

    public $layout = 'full';
    public $module = 'knowledge_base';
    public $model = 'Faqs_model';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
        $this->permission();
    }

     public function index($offset = 0){
        $this->{$this->model}->custom_select = 'faqs.*, categories.title as category';
        $this->{$this->model}->joins = array(
            'categories' => array('categories.category_id = faqs.category_id', 'inner')
        );
        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->join('categories', 'categories.category_id = faqs.category_id', 'inner')
                        ->get('faqs')
                        ->row()->count;

      //Pagination
        $this->load->library('pagination');
        config('pagination_limit', 15);
        $config['total_rows'] = $count;
        $config['base_url'] = site_url('admin/knowledge_base/index');
        $config['per_page'] = config('pagination_limit');
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);
        $this->db->order_by('faq_id', 'DESC');
        $data['items'] = $this->db
                        ->join('categories', 'categories.category_id = faqs.category_id')
                        ->select('faqs.*, categories.title as category')
                        ->get('faqs')->result();
        $this->load->view($this->module . '/index', $data);
    }

    public function manage($id = FALSE) {
        $data = array();

        if ($id) {
            $this->{$this->model}->{$this->_primary_key} = $id;
            $data['item'] = $this->{$this->model}->get();
            if (!$data['item'])
                show_404();
        } else {
            $data['item'] = new Std();
            $this->{$this->model}->created = date('Y-m-d H:i:s');
        }
        $this->load->library("form_validation");
        $this->form_validation->set_rules('question', 'Question', 'trim|required');
        $this->form_validation->set_rules('answer', 'Answer', 'trim|required');
        $this->form_validation->set_rules('category_id', 'Category', 'trim');


        if ($this->form_validation->run() == FALSE)
            $this->load->view($this->module . '/manage', $data);

        else {
            $this->{$this->model}->question = $this->input->post('question');
            $this->{$this->model}->answer = $this->input->post('answer', false);
            $this->{$this->model}->category_id = $this->input->post('category_id');
            $this->{$this->model}->save();
            redirect('admin/' . $this->module);
        }
    }

    public function delete($id = false) {
        if (!$id)
            show_404();
        $this->{$this->model}->{$this->_primary_key} = $id;
        $data['item'] = $this->{$this->model}->get();
        if (!$data['item'])
            show_404();
        $this->{$this->model}->delete();
        redirect('admin/' . $this->module);
    }

    

}
