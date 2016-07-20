<?php

class Blog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_db');
        $this->load->helper('form');
    }

    function index($start = 0)
    {
        $data['posts'] = $this->m_db->get_posts(5, $start);

        //pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'blog/index/';
        $config['total_rows'] = $this->m_db->get_post_count();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        //paination

        $class_name = array(
            'home_class' => 'current',
            'login_class' => '',
            'register_class' => ''
        );
        $this->load->view('header', $class_name);
        $this->load->view('v_search', $data);
        $this->load->view('v_home', $data);
        $this->load->view('footer');
    }
    function search()
    {
        $class_name = array(
            'home_class' => 'current',
            'login_class' => '',
            'register_class' => '',
        );

        $data['query'] = $this->m_db->get_search();
        $this->load->view('header', $class_name);
        $this->load->view('v_result_search', $data);
        $this->load->view('footer');

    }

    function post($post_id)
    {
        $this->load->model('m_comment');
        $data['comments'] = $this->m_comment->get_comment($post_id);
        $data['post'] = $this->m_db->get_post($post_id);
        $class_name = array(
            'home_class' => 'current',
            'login_class' => '',
            'register_class' => '',
        );
        $this->load->view('header', $class_name);
        $this->load->view('v_single_post', $data);
        $this->load->view('footer');
    }

    function new_post()
    {
        if (!$this->check_permissions('author')) {
            redirect(base_url() . 'users/login');
        }

        if ($this->input->post()) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048'; //KB
            $config['max_width'] = '1024'; //px
            $config['max_height'] = '768'; //px

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                $file_name = "";
            }else{
                $upload_data = $this->upload->data();
                $file_name =   $upload_data['file_name'];
            }

            $data = array(
                'post_title' => $this->input->post('post_title'),
                'post' => $this->input->post('post'),
                'user_id' => $this->input->post('user_id'),
                'userfile' => $file_name,
                'active' => 1,
            );

            $this->m_db->insert_post($data);
            redirect(base_url() . 'blog/');
        } else {
            $class_name = array(
                'home_class' => 'current',
                'login_class' => '',
                'register_class' => '',
            );
            $this->load->view('header', $class_name);
            $this->load->view('v_new_post');
            $this->load->view('footer');
        }
    }

    function editpost($post_id)
    {
        if (!$this->check_permissions('author'))
        {
            redirect(base_url() . 'users/login');
        }
        $data['success'] = 0;
        $data['error'] = "";
        if ($this->input->post()) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048'; //KB
            $config['max_width'] = '1024'; //px
            $config['max_height'] = '768'; //px

            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('userfile')) {
                $data['error'] = array('error' => $this->upload->display_errors());
                $file_name = "";
            }else{
                $upload_data = $this->upload->data();
                $file_name =   $upload_data['file_name'];
            }

            $data = array(
                'post_title' => $this->input->post('post_title'),
                'post' => $this->input->post('post'),
                'userfile' => $file_name,
                'active' => 1
            );

            $this->m_db->update_post($post_id, $data);
            $data['success'] = 1;
        }
        $data['post'] = $this->m_db->get_post($post_id);

        $class_name = array(
            'home_class' => 'current',
            'login_class' => '',
            'register_class' => ''
        );
        $this->load->view('header', $class_name);
        $this->load->view('v_edit_post', $data);
        $this->load->view('footer');
    }

//    function upload_file() {
//
//
//        if (!$this->upload->do_upload()) {//If there is error when uploading file
//            $error = array('error' => $this->upload->display_errors());
//            $this->load->view('header', $class_name);
//            $this->load->view('v_upload_form', $error);
//            $this->load->view('footer');
//        } else {
//            $data = array('upload_data' => $this->upload->data());
//            $this->load->view('header', $class_name);
//            $this->load->view('v_upload_success', $data);
//            $this->load->view('footer');
//        }
//    }

    function deletepost($post_id)
    {
        if (!$this->check_permissions('author'))
        {
            redirect(base_url() . 'users/login');
        }
        $this->m_db->delete_post($post_id);
        redirect(base_url() . 'blog/');
    }

    function check_permissions($required)
    {
        $user_type = $this->session->userdata('user_type');
        if ($required == 'user')
        {
            if ($user_type) {
                return TRUE;
            }
        } elseif ($required == 'author')
        {
            if ($user_type == 'author' || $user_type == 'admin')
            {
                return TRUE;
            }
        } elseif ($required == 'admin')
        {
            if ($user_type == 'admin') {
                return TRUE;
            }
        }
    }
}