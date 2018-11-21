<?php

class Department extends CIF_Controller {

    public $layout = 'full';
    public $module = 'department';
    public $model = 'Faqs_model';

    public function __construct() {
        parent::__construct();
        $this->load->model($this->model);
        $this->_primary_key = $this->{$this->model}->_primary_keys[0];
    }

    public function index($id = null, $offset = 0) {
        $data = array();
        if (!$id)
            show_404();


        $data['cat'] = $this->db
                ->where('category_id', $id)
                ->get('categories')
                ->row();
        config('title', config('title') . ' - ' . $data['cat']->title);


        $count = $this->db
                        ->select("COUNT(*) AS count")
                        ->join('categories', 'categories.category_id = faqs.category_id')
                        ->where('faqs.category_id', $data['cat']->category_id)
                        ->get('faqs')
                        ->row()->count;

        // PAGINATION
        config('pagination_limit', 20);
        $this->load->library('pagination');
        $config['base_url'] = site_url('department/index/' . $id);
        $config['total_rows'] = $count;
        $config['per_page'] = config('pagination_limit');
        $config['reuse_query_string'] = TRUE;
        if ($this->uri->segment(2))
            $this->db->offset = $offset;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->db->limit($config['per_page'], $offset);

        $data['faqs'] = $this->db
                ->join('categories', 'categories.category_id = faqs.category_id')
                ->where('faqs.category_id', $data['cat']->category_id)
                ->get('faqs')
                ->result();

        if (!$data['cat'])
            show_404();

        $this->load->view($this->module, $data);
    }

    public function topic($id) {
        if (!$id)
            show_404();
        if (!$this->db
                        ->where('faq_id', $id)
                        ->get('faqs')->row())
            show_404();

        $data['item'] = $this->db
                        ->join('categories', 'categories.category_id = faqs.category_id')
                        ->select('faqs.*, categories.title as category')
                        ->where('faqs.faq_id', $id)
                        ->get('faqs')->row();
        $this->db->where('faq_id', $data['item']->faq_id)->set("visits", "visits + 1", FALSE)->update('faqs');

        $data['related_items'] = $this->db
                        ->join('categories', 'categories.category_id = faqs.category_id', 'inner')
                        ->select('faqs.*')
                        ->limit('6')
                        ->where('faqs.faq_id !=', $id)
                        ->where('categories.category_id', $data['item']->category_id)
                        ->get('faqs')->result();

        $data['recent_items'] = $this->db
                        ->select('faqs.*')
                        ->limit('6')
                        ->where('faqs.faq_id !=', $id)
                        ->order_by('faq_id', 'desc')
                        ->get('faqs')->result();

        config('question', config('title') . ' - ' . $data['item']->question);

        if (!$data['item'])
            show_404();
        $this->load->view('topic', $data);
    }

}
