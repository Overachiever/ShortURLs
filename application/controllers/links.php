<?php
/**
 * Created by PhpStorm.
 * User: sjohnson
 * Date: 11/18/2014
 * Time: 9:43 PM
 */

class Links extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('links_model');
    }

    public function index($urlCode = '')
    {
        //shortcode was provided, redirect if valid
        if($urlCode)
        {
            $link = $this->validate_url_code($urlCode);

            $this->load->model('redirects_model');

            $this->redirects_model->create(array('link_id' => $link->link_id));

            redirect($link->url);
        }

        $this->body['url'] = $this->input->post() ? $this->input->post('url') : '';

        //handle new link form submission
        if($this->input->post())
        {
            $result = $this->links_model->create(array('url' => $this->body['url']));

            if(!empty($result))
            {
                $this->session->set_flashdata('success', 'Congratulations!  Your short URL was generated!');
                redirect('view/' . $result->url_code);
            }
        }
        
        $this->load->template('create_links', $this->data());
    }

    public function view($urlCode = '')
    {
        $link = $this->validate_url_code($urlCode);

        $link->new_url = site_url($link->url_code);

        $this->body['link'] = $link;

        $this->load->template('link', $this->data());
    }

    private function validate_url_code($urlCode)
    {
        //redirect to main form if the code is empty or not found
        if(empty($urlCode) || !$link = $this->links_model->get_by('url_code', $urlCode))
        {
            $this->session->set_flashdata('error', 'Invalid url code.');
            redirect('/');
        }

        return $link;
    }
} 