<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tickets extends CIF_Controller {

    public $layout = 'full';
    public $module = 'tickets';
    public $model = 'tickets_model';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
        $this->permission();
    }

    public function index($offset = 0) {
        $this->{$this->model}->custom_select = 'tickets.*, users.username';
        $this->{$this->model}->joins = array(
            'users' => array('users.user_id = tickets.user_id', 'inner')
        );
        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->join('users', 'users.user_id = tickets.user_id')
                        ->where('parent_id', '0')
                        ->get('tickets')
                        ->row()->count;

        //Pagination
        $this->load->library('pagination');
        config('pagination_limit', 10);
        $config['total_rows'] = $count;
        $config['base_url'] = site_url('admin/tickets/index');
        $config['per_page'] = config('pagination_limit');
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);

        $this->db->order_by('last_reply', 'DESC');
        $data['items'] = $this->db
                ->join('users', 'users.user_id = tickets.user_id')
                ->join('categories', 'categories.category_id = tickets.category_id')
                ->select('tickets.*, users.username, categories.title as category')
                ->where('parent_id', '0')
                ->get('tickets')
                ->result();
        $this->load->view($this->module . '/index', $data);
    }

    public function opened($offset = 0) {
        $this->{$this->model}->custom_select = 'tickets.*, users.username';
        $this->{$this->model}->joins = array(
            'users' => array('users.user_id = tickets.user_id', 'inner')
        );
        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->join('users', 'users.user_id = tickets.user_id')
                        ->where('parent_id', '0')
                        ->where('tickets.status', 'open')
                        ->get('tickets')
                        ->row()->count;

        //Pagination
        $this->load->library('pagination');
        config('pagination_limit', 10);
        $config['total_rows'] = $count;
        $config['base_url'] = site_url('admin/tickets/index');
        $config['per_page'] = config('pagination_limit');
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);

        $this->db->order_by('last_reply', 'DESC');
        $data['items'] = $this->db
                ->join('users', 'users.user_id = tickets.user_id')
                ->join('categories', 'categories.category_id = tickets.category_id')
                ->select('tickets.*, users.username, categories.title as category')
                ->where('parent_id', '0')
                ->where('tickets.status', 'open')
                ->get('tickets')
                ->result();
        $this->load->view($this->module . '/index', $data);
    }

    public function closed($offset = 0) {
        $this->{$this->model}->custom_select = 'tickets.*, users.username';
        $this->{$this->model}->joins = array(
            'users' => array('users.user_id = tickets.user_id', 'inner')
        );
        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->join('users', 'users.user_id = tickets.user_id')
                        ->where('parent_id', '0')
                        ->where('tickets.status', 'closed')
                        ->get('tickets')
                        ->row()->count;

        //Pagination
        $this->load->library('pagination');
        config('pagination_limit', 10);
        $config['total_rows'] = $count;
        $config['base_url'] = site_url('admin/tickets/index');
        $config['per_page'] = config('pagination_limit');
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);

        $this->db->order_by('last_reply', 'DESC');
        $data['items'] = $this->db
                ->join('users', 'users.user_id = tickets.user_id')
                ->join('categories', 'categories.category_id = tickets.category_id')
                ->select('tickets.*, users.username, categories.title as category')
                ->where('parent_id', '0')
                ->where('tickets.status', 'closed')
                ->get('tickets')
                ->result();
        $this->load->view($this->module . '/index', $data);
    }

    public function manage($id = null) {
        $data['items'] = [];

        if ($id) {
            $this->{$this->model}->{$this->_primary_key} = $id;
            $data['item'] = $this->db
                    ->join('users', 'users.user_id = tickets.user_id')
                    ->select('tickets.*, users.image, users.email, users.username, users.user_id')
                    ->where('ticket_id', $id)
                    ->get('tickets')
                    ->row();
            if (!$data['item'])
                show_404();

            $data['items'] = array_merge($this->db
                            ->select('tickets.*, users.username, users.email, users.image')
                            ->order_by('tickets.created', 'asc')
                            ->where('tickets.parent_id !=', '0')
                            ->where('tickets.ticket_id', $id)
                            ->join('users', 'users.user_id = tickets.user_id', 'left')
                            ->get('tickets')
                            ->result(), $this->db
                            ->select('tickets.*, users.username, users.email, users.image')
                            ->order_by('tickets.created', 'asc')
                            ->where('tickets.parent_id', $id)
                            ->join('users', 'users.user_id = tickets.user_id', 'left')
                            ->get('tickets')
                            ->result());
        }

        $this->data['user'] = $this->db->where('user_id', $data['item']->user_id)->get('users')->row();
        $this->load->library("form_validation");
        $this->form_validation->set_rules('message', 'message', 'trim|required');
        $this->form_validation->set_rules('note', 'Note', 'trim');
        $this->form_validation->set_rules('attachment', 'attachment', 'trim|callback_attachment[$id]');


        if ($this->form_validation->run() == FALSE)
            $this->load->view($this->module . '/manage', $data);
        else {
            $this->db->where('ticket_id', $id)->update('tickets', [
            'status' => $this->input->post('status'),
            'priority' => $this->input->post('priority'),
            'last_reply' => date('Y-m-d H:i:s')
            ]);
            $data = [
                'message' => $this->input->post('message'),
                'note' => $this->input->post('note'),
                'user_id' => session('user_id'),
                'parent_id' => $id,
                'created' => date('Y-m-d H:i:s'),
                'attachment' => $this->attachment,
            ];

            $this->data['success'] = true;
            $this->db->insert('tickets', $data);
            $data['kkk'] = $this->db
                    ->join('users', 'users.user_id = tickets.user_id')
                    ->select('tickets.*, users.image, users.email, users.username, users.user_id')
                    ->where('ticket_id', $id)
                    ->get('tickets')
                    ->row();
            $this->load->library('email');
            $this->email->from(config('webmaster_email'), config('title'));
            $this->email->to($this->data['user']->email);
            $this->email->subject('New reply on ticket #' . $id);
            $this->email->message($this->load->view('tickets/email', $data, true));

            $this->email->send();
            $this->email->clear();
            redirect('admin/' . $this->module);
        }
    }

    public function attachment($id) {

        $config['upload_path'] = './cdn/tickets/';
        $config['allowed_types'] = 'jpg|png|jpeg|zip';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('attachment')) {
            
        } else {
            $data = $this->upload->data();
            if ($data['file_name'])
                $this->attachment = $data['file_name'];
        }
        return true;
    }

    public function delete($id = null) {
        if (!$id)
            show_404();
        $this->{$this->model}->{$this->_primary_key} = $id;
        $data['item'] = $this->{$this->model}->get();
        if (!$data['item'])
            show_404();
        $this->{$this->model}->delete();
        $this->db->where("parent_id", $id)->delete("tickets");

        redirect('admin/tickets/index');
    }

}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */