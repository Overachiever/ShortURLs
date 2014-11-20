<?php
/**
 * Created by PhpStorm.
 * User: sjohnson
 * Date: 11/18/2014
 * Time: 9:32 PM
 */

class MY_Controller extends CI_Controller
{
    protected $header = array();
    protected $body = array();
    protected $footer = array();

    public function __construct()
    {
        parent::__construct();

        /*configure some default values for template variables*/
        $this->header = array(
            'messages' => array(
                'danger' => array(),
                'success' => array(),
                'info' => array()
            ),
            'links' => $this->generate_navigation()
        );

        $this->footer['scripts'] = array();

        /*convert flashdata to messages*/
        if($this->session->flashdata('success'))
        {
            $this->add_message($this->session->flashdata('success'), 'success');
        }

        if($this->session->flashdata('error'))
        {
            $this->add_message($this->session->flashdata('error'));
        }
    }

    /**
     * Builds template variables for core/MY_Loader.php
     *
     * @return array
     */
    protected function data()
    {
        return array('header' => $this->header, 'body' => $this->body, 'footer' => $this->footer);
    }

    /*add danger, warning, info, success messages*/
    protected function add_message($message, $type = 'danger')
    {
        array_push($this->header['messages'][$type], $message);
    }

    /*add javascript includes to footer*/
    protected function add_script($script)
    {
        array_push($this->footer['scripts'], $script);
    }

    /**
     * Builds site navigation array
     *
     * @return array
     */
    private function generate_navigation()
    {
        $navigation = array(
            array('label' => 'Create Links', 'url' => site_url()),
            array('label' => 'Stats', 'url' => site_url('stats')),
        );
        
        foreach($navigation as &$nav)
        {
            if(strpos($nav['url'], current_url()) !== false)
            {
                $nav['class'] = 'active';
                break;
            }
        }
        
        return $navigation;
    }
}