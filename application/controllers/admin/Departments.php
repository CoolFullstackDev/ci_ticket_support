<?php

class Departments extends CIF_Controller {

    public $layout = 'full';
    public $module = 'departments';
    public $model = 'Categories_model';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
        $this->permission();
    }

    public function index($offset = 0) {



        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->get('categories')
                        ->row()->count;

        //Pagination
        $this->load->library('pagination');
        config('pagination_limit', 15);
        $config['total_rows'] = $count;
        $config['base_url'] = site_url('admin/departments/index');
        $config['per_page'] = config('pagination_limit');
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);
        $this->db->order_by('title', 'ASC');

        $data['items'] = $this->db
                        ->select('categories.*')->order_by('title')->get('categories')->result();
        $this->load->view($this->module . '/index', $data);
    }

    public function manage($id = null) {
        $data = array();

        if ($id) {
            $this->{$this->model}->{$this->_primary_key} = $id;
            $data['item'] = $this->{$this->model}->get();
            if (!$data['item'])
                show_404();
        } else {
            $data['item'] = new Std();
        }

        $this->load->library("form_validation");
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules("icon", 'Icon', "trim|callback_image[0]");


        if ($this->form_validation->run() == FALSE)
            $this->load->view($this->module . '/manage', $data);

        else {

            $this->{$this->model}->title = $this->input->post('title');
            $this->{$this->model}->description = $this->input->post('description');

            $this->{$this->model}->save();
            redirect('admin/' . $this->module);
        }
    }

    public function delete($id = null) {
        if (!$id)
            show_404();
        $this->{$this->model}->{$this->_primary_key} = $id;
        $data['item'] = $this->{$this->model}->get();

        if (!$data['item'])
            show_404();
        $this->{$this->model}->delete();
        redirect('admin/' . $this->module);
    }

    public function image($var) {
        $config['upload_path'] = './cdn/icons/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('icon')) {
            $data = $this->upload->data();
            if ($data['file_name'])
                $this->{$this->model}->icon = $data['file_name'];
        }
        return true;
    }

}
