<?php

class Home extends CIF_Controller {

    public $layout = 'full';
    public $module = 'home';
    public $model = 'Faqs_model';

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

    public function search($offset = 0) {
        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->like('question', $this->input->get('question'), 'both')
                        ->get('faqs')
                        ->row()->count;
        $this->data['count'] = $count;
        // PAGINATION
        config('pagination_limit', 12);
        $this->load->library('pagination');
        $config['base_url'] = site_url('home/search/');
        $config['total_rows'] = $count;
        $config['per_page'] = config('pagination_limit');
        $config['reuse_query_string'] = TRUE;
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);
        $this->data['items'] = $this->db
                ->like('question', $this->input->get('question'), 'both')
                ->get('faqs')
                ->result();
        $this->load->view('search', $this->data);
    }

    public function contact() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        $data['success'] = false;

        if ($this->form_validation->run() == TRUE) {
            @mail(config('webmaster_email'), config('title') - $_POST[subject], ""
                            . "Full Name: $_POST[name]\n"
                            . "Email: $_POST[email]\n"
                            . "Message: $_POST[message]\n"
                            . "");
            $data['success'] = true;
        }
        $this->load->view('contact', $data);
    }

}
