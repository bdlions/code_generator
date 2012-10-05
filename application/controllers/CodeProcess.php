<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CodeProcess
 *
 * @author Alamgir
 */
class CodeProcess extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->helper('file');
    }

    function action_window_list_generation()
    {
        $this->load->library('xmlperser');
        $fObjectArray = $this->xmlperser->readXML();

        $action_list = "";
        foreach ($fObjectArray as $key => $objectList) {
            if ($key == "action") {
                foreach ($objectList as $customObj) {
                    $displayNatural = $customObj->natural;
                    $searchedPattern = array();
                    $replacementPattern = array();
                    foreach ($customObj->parameters as $param) {
                        $searchedPattern[] = "$" . $param->name;
                        $replacementPattern[] = $param->default;
                    }
                    $displayNatural = str_replace($searchedPattern, $replacementPattern, $displayNatural);
                    $action_list = $action_list."<li class='ui-widget-content'><input type = 'hidden' value='{$key}' name='{$customObj->optionstype}' />{$displayNatural}</li>";
                }
            }
        }
        echo $action_list;
    }

    function save_project_code()
    {
        $status = "false";
        $project_id = $this->session->userdata('project_id');
        if(isset($_POST['code']))
        {
            $project_code = $_POST['code'];
            $file_path = "./code/".$project_id.".txt";
            if ( write_file($file_path, $project_code))
            {
                $status = "true";
            }
        }
        echo $status;
    }
    
    function download_project_code()
    {
        $project_id = $this->session->userdata('project_id');
        $file_path = "./code/".$project_id.".txt";
        if (file_exists($file_path)) {
            $content = file_get_contents($file_path);
            if($content == "")
            {
                return;
            }
            header("Content-Type:text/plain");
            header("Content-Length: " . filesize($file_path));
            header("Content-Disposition: 'attachment'; filename=code.txt");
            echo $content;
        }
    } 
    
    function save_project_left_panel()
    {
        $status = "false";
        $project_id = $this->session->userdata('project_id');
        if(isset($_POST['code']))
        {
            $project_code = $_POST['code'];
            $file_path = "./project/".$project_id.".txt";
            if ( write_file($file_path, $project_code))
            {
                $status = "true";
            }
        }
        echo $status;
    }
    function download_project()
    {
        $project_id = $this->session->userdata('project_id');
        $file_path = "./project/".$project_id.".txt";
        if (file_exists($file_path)) {
            $content = file_get_contents($file_path);
            if($content == "")
            {
                return;
            }
            $file_name = "project_content.txt";
            if(isset($_POST['project_content_file_name']))
            {
                if(strlen($_POST['project_content_file_name']) > 0 ){
                    $file_name = $_POST['project_content_file_name'].".txt";
                    $_POST['project_content_file_name'] = "";
                }
            }
            header("Content-Type:text/plain");
            header("Content-Length: " . filesize($file_path));
            header("Content-Disposition: 'attachment'; filename=".$file_name);
            echo $content;
        }
    }
    
    /*
     *  This controller is called when variable validation id performed
     *  This method calls ion_auth model to check the existance of a variable name
     */
    function check_variable()
    {
        $variable_name = $_POST['variable_name'];
        $project_id = $this->session->userdata('project_id');
        
        $array = array(
            "variable_name" => $variable_name,
            "project_id" => $project_id,
        );
        $var_name_exist = $this->ion_auth->where($array)->check_variable();
        
        echo $var_name_exist;
    }
    
    
}
?>
