<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends MY_Controller
{
    public function index()
    {
        $this->load->library('pagination');
        
        // CodeIgniter pagination customization
        $config['attributes'] = array('class' => 'page-link');
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['first_link'] = '<span aria-hidden="true"><i class="fa fa-angle-double-left"></i></span>';
        $config['last_link'] = '<span aria-hidden="true"><i class="fa fa-angle-double-right"></i></span>';
        $config['next_link'] = '<span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        // Load the model
        $this->load->model('blog_model', 'blog');

        $count = $this->blog->countBlog();

        $config = array();
        $config["base_url"] = base_url('blog'); // If you using index.php then simple add index.php to base_url (base_url('index.php/blog'))
        $config['total_rows'] = $count;
        $config['per_page'] = 10;
        $config["uri_segment"] = 2;
        $config['enable_query_strings'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $page = ($this->input->get('per_page', true)) ? $this->input->get('per_page', true) : 0;
        $to = $page + $this->pagination->per_page;

        if ($to > $count) {
            $to = $count;
        }

        $data['posts'] = $this->blog->getBlog($config["per_page"], $page);
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;', $str_links);
        $data['pagermessage'] = $page . ' to ' . $to . ' from ' . $count . ' results';
        $data['count'] = $count;

        $this->load->view('blog', $data);
    }
}