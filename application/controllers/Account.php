<?php

class Account extends CIF_Controller {

    public $layout = 'full';
    public $model = 'Users_model';
    public $module = 'home';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
    }


    public function register() {
        $this->layout = "ajax";
        $this->data['item'] = new Std();

        $this->load->library('form_validation');
        $this->form_validation->set_message('is_unique', "This email is already registered, <a href=\"javascript:popup_switch('forgot')\">click here</a> to reset your password.");
        $this->form_validation->set_rules('username', 'Fullname', "trim|required");
        $this->form_validation->set_rules('email', 'E-Mail', "trim|required|valid_email|is_unique[users.email]");
        $this->form_validation->set_rules('password', 'Password', "trim|required");
        $this->form_validation->set_rules('password_2', 'Password Confirmation', "trim|required|matches[password]");


        if ($this->form_validation->run() == true) {
            $vars = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'usergroup_id' => '2',
                'status' => 'active',
                'created' => date('Y-m-d H:i:s'),
            ];
            $this->db->insert('users', $vars);
            $vars['user_id'] = $this->db->insert_id();

            foreach ($vars as $vark => $varv)
                session($vark, $varv);
            die(json_encode([
                'error' => false,
                'message' => "success"
            ]));
        }
        else{
           die(json_encode(['error' => true, 'message' => validation_errors()])); 
        }
        return $this->response([]);
    }

    public function login() {
        $this->layout = "ajax";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', "trim|required|valid_email|callback_check_login");
        $this->form_validation->set_rules('password', 'Password', "trim|required");
        if ($this->form_validation->run() == false) {
            die(json_encode(['error' => true, 'message' => validation_errors()]));
        } else {
            die(json_encode([
                'error' => false,
                'message' => "success"
            ]));
        }
        return $this->response($this->data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect();
    }

    // added code by topace
    public function postCURL($_url, $_param){
        
        $postData = '';
        //create name value pairs seperated by &
        foreach($_param as $k => $v) 
        { 
            $postData .= $k . '='.$v.'&'; 
        }
        rtrim($postData, '&');


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, false); 
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

        $output=curl_exec($ch);

        curl_close($ch);

        return $output;
    }

    public function test_login(){
        
        $params = array(
            "email" => 'email@fromsupport.com',
            "password" => 'perfect'
         );
        // $url = '192.168.1.112:8080/codeigniter/blogs/login';
        $url = '192.168.1.112:8080/clientarea/api_login.php';

        $output = $this->postCURL($url, $params);
        $res = json_decode($output);

        print_r($output);
    }
    //////////////////

    public function check_login() {
        $this->form_validation->set_message('check_login', "Your credentials is not valid or you account may be suspended");

        ///// added code by topace
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // send request to remote server
        $params = array(
            "email" => $email,
            "password" => $password
         );
        $url = '192.168.1.112:8080/clientarea/api_login.php';
 
        $output = $this->postCURL($url, $params);
        $res = json_decode($output);
        
        // analyze response from clientside
        if($res->status == "success"){
            $this->data = [
                'username' => $res->username,
                'email' => $res->email,
                'user_id' => $res->user_id,
                'password' => $res->password,
                'firstname' => $res->firstname,
                'lastname' => $res->lastname,
                'image' => $res->image,
                'country_id' => $res->country_id,
            ];

            foreach($this->data as $key => $value)
                session($key, $value);
            
            return true;
        } else {
            return false;
        }
        //////////////////

        // if ($user = $this->db
        //         ->where('email', $this->input->post('email'))
        //         ->where('password', md5($this->input->post('password')))
        //         ->where('status','active')
        //         ->get('users')
        //         ->row()
        // ) {
        //     $this->data = [
        //         'usename' => $user->username,
        //         'email' => $user->email,
        //         'user_id' => $user->user_id,
        //         'password' => $user->password
        //     ];

        //     foreach ($this->data as $vark => $varv)
        //         session($vark, $varv);
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function forgot() {
        $this->layout = 'ajax';
        $this->load->library('form_validation');
        $this->form_validation->set_message('check', 'Invalid Login' . "error");
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check');
        if ($this->form_validation->run() == FALSE) {
            die(json_encode(['error' => true, 'message' => validation_errors()]));
        } else {
            $data['pass'] = $this->generate_password();
            $data['user'] = $this->user;
            $this->db->where('email', $this->input->post('email'))
                    ->update('users', array(
                        'password' => md5($data['pass'])
            ));
            $message = $this->load->view('login/reset_password_email', $data, TRUE);

            $this->load->library('email');
            $this->email->from('noreply@elmanawy.info', config('title'));
            $this->email->to($data['user']->email);
            $this->email->subject('Password resetting');
            $this->email->message($message);
            $this->email->send();
            die(json_encode([
                'error' => false,
                'message' => "success"
            ]));
        }
    }

    private function generate_password() {
        return substr(md5(time()), 0, 6);
    }

    public function check() {
        $username = $this->input->post('email');
        if ($this->input->post('password'))
            $this->db->where('password', md5($this->input->post('password')));

        $this->user = $this->db
                ->where("(`email` = '$username')")
                ->get('users')
                ->row();

        if (!$this->user) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
