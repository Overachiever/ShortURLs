<?php
/**
 * Created by PhpStorm.
 * User: sjohnson
 * Date: 11/18/2014
 * Time: 9:34 PM
 */

class MY_Loader extends CI_Loader
{
    /**
     * Extended view method to build a page template
     *
     * @param string $template_name
     * @param array $vars
     * @param bool $return
     * @return string
     */
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $validationErrors = validation_errors();
        if(!empty($validationErrors))
        {
            array_push($vars['header']['messages']['danger'], $validationErrors);
        }

        $content  = $this->view('includes/header', $vars['header'], $return);
        $content .= $this->view($template_name, $vars['body'], $return);
        $content .= $this->view('includes/footer', $vars['footer'], $return);

        if ($return)
        {
            return $content;
        }
    }
} 