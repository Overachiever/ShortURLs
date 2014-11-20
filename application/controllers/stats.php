<?php
/**
 * Created by PhpStorm.
 * User: sjohnson
 * Date: 11/18/2014
 * Time: 9:43 PM
 */

class Stats extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('redirects_model');
    }

    public function index()
    {
        $this->body['content'] = '';

        if($stats = $this->redirects_model->newly_created_links())
        {
            $this->body['content'] .= $this->load->view('stat_table', array('name' => 'Most Recently Created', 'stats' => $stats), true);
        }

        if($stats = $this->redirects_model->redirects_by_date(date('Y-m-d')))
        {
            $this->body['content'] .= $this->load->view('stat_table', array('name' => 'Today\'s Most Popular Links', 'stats' => $stats), true);
        }

        if($stats = $this->redirects_model->redirects_by_date())
        {
            $this->body['content'] .= $this->load->view('stat_table', array('name' => 'All Time Most Popular Links', 'stats' => $stats), true);
        }

        $this->load->template('stats', $this->data());
    }
} 