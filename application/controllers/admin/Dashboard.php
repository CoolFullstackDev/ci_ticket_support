<?php

class Dashboard extends CIF_Controller {

    public $layout = 'full';
    public $module = 'dashboard';
    public $model = 'users';

    public function index() {
        $this->permission();
        $data['admins'] = $this->db->where('usergroup_id', '1')->get('users')->num_rows();
        $data['normal_users'] = $this->db->where('usergroup_id', '2')->get('users')->num_rows();
        $data['categories'] = $this->db->get('categories')->num_rows();
        $data['faqs'] = $this->db->get('faqs')->num_rows();
        $data['open_tickets'] = $this->db->where('status', 'open')->get('tickets')->num_rows();
        $data['close_tickets'] = $this->db->where('status', 'closed')->get('tickets')->num_rows();
        $data['tickets'] = $this->db->get('tickets')->num_rows();
        $data['visitors'] = config('visitors');

        $data['tickets_open'] = $this->db
                        ->join('users', 'users.user_id = tickets.user_id', 'inner')
                        ->select('tickets.*, users.username as username')
                        ->where('parent_id', '0')
                        ->where('tickets.status', 'open')
                        ->order_by('last_reply', 'DESC')
                        ->get('tickets')->result();

        $this->load->view($this->module, $data);
    }

}
