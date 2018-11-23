<?php

class Dashboard extends CIF_Controller {

    public $layout = 'full';
    public $module = 'dashboard';
    public $model = 'Users_model';

    public function __construct() {
        parent::__construct();
        if (!session('user_id'))
            show_404();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
    }

    public function index() {
        $user['user_id'] = session('user_id');
        $user['email'] = session('email');
        $user['username'] = session('username');
        $user['password'] = session('password');
        $user['firstname'] = session('firstname');
        $user['lastname'] = session('lastname');
        $user['image'] = session('image');
        $user['country_id'] = session('country_id');

        $data['item'] = $user;
        $this->load->view('dashboard/' . __FUNCTION__, $data);
    }

    public function settings() {

        $data['countries'] = dd2menu('countries', ['country_id' => 'nicename']);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Last name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
//        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
        $this->form_validation->set_rules("image", 'Image', "trim|callback_image[0]");

        $data['success'] = false;

        if ($this->form_validation->run() == TRUE) {
            $this->{$this->model}->user_id = session('user_id');
            $this->{$this->model}->firstname = $this->input->post('firstname');
            $this->{$this->model}->lastname = $this->input->post('lastname');
            $this->{$this->model}->username = $this->input->post('username');
            $this->{$this->model}->gender = $this->input->post('gender');
//            $this->{$this->model}->email = $this->input->post('email');
            $this->{$this->model}->country_id = $this->input->post('country_id');



            if ($this->input->post('password'))
                $this->{$this->model}->password = md5($this->input->post('password'));
            $this->{$this->model}->save();
            $data['success'] = true;
        }
        $data['item'] = $this->db
                        ->where('user_id', session('user_id'))
                        ->select('users.*, countries.nicename as country')
                        ->join('countries', 'users.country_id = countries.country_id', 'left')
                        ->get('users')->row();
        $this->load->view('dashboard/' . __FUNCTION__, $data);
    }

    public function image($var) {
        $config['upload_path'] = './cdn/users/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            
        } else {
            $data = $this->upload->data();
            if ($data['file_name'])
                $this->{$this->model}->image = $data['file_name'];;
        }
        return true;
    }

    public function tickets() {

        $this->data['items'] = $this->db
                ->join('categories', 'categories.category_id = tickets.category_id')
                ->select('tickets.*, categories.title as category')
                ->order_by('tickets.created', 'desc')
                ->where('tickets.user_id', session('user_id'))
                ->where('parent_id', '0')
                ->order_by('last_reply', 'DESC')
                ->get('tickets')
                ->result();
        $this->load->view('dashboard/' . __FUNCTION__, $this->data);
    }

    public function ticket($id = false) {
        $this->load->library('form_validation');
        $this->data['items'] = [];

        if ($id) {
            $this->{$this->model}->{$this->_primary_key} = $id;
            $this->data['item'] = $this->db
                    ->select('tickets.*')
                    ->where('ticket_id', $id)
                    ->where('tickets.user_id', session('user_id'))
                    ->get('tickets')
                    ->row();
            if (!$this->data['item'])
                show_404();
            $this->data['items'] = array_merge($this->db
                            ->select('tickets.*')
                            ->order_by('tickets.created', 'asc')
                            ->where('tickets.parent_id', '0')
                            ->where('tickets.ticket_id', $id)
                            ->get('tickets')
                            ->result(), $this->db
                            ->select('tickets.*')
                            ->order_by('tickets.created', 'asc')
                            ->where('tickets.parent_id', $id)
                            ->get('tickets')
                            ->result());
            if (( $this->data['item']->user_id) != session('user_id'))
                show_404();
        }


        if (!$id)
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');

        $this->form_validation->set_rules('message', 'message', 'trim|required');
        $this->form_validation->set_rules('attachment', 'attachment', 'trim|callback_attachment[$id]');
        if ($this->form_validation->run() == true) {
            $data = [
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message'),
                'user_id' => session('user_id'),
                'created' => date('Y-m-d H:i:s'),
                'last_reply' => date('Y-m-d H:i:s'),
                'category_id' => $this->input->post('category_id'),
                'attachment' => $this->attachment,
            ];
            if ($id)
                $data['parent_id'] = $id;

            if (!$id)
                $data['status'] = 'open';

            $this->data['success'] = true;
            $this->db->insert('tickets', $data);

            if (!$id)
                $id = $this->db->insert_id();


            redirect('dashboard/ticket/' . $id);
        }
        else {
            $this->load->view('dashboard/' . __FUNCTION__, $this->data);
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

    public function important($id) {
        $this->db->where('ticket_id', $id)->update('tickets', [
            'important' => '1'
        ]);
        redirect('dashboard/tickets');
    }

    public function un_important($id) {
        $this->db->where('ticket_id', $id)->update('tickets', [
            'important' => '0'
        ]);
        redirect('dashboard/tickets');
    }

}
