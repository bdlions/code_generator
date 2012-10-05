<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->library('ion_auth');        
        $this->load->helper('file');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $base = base_url();
        $css =
                "<link rel='stylesheet' href='{$base}jstree_resource/design.css' />" .
                "<link rel='stylesheet' href='{$base}jstree_resource/menu_style.css' />" .
                "<link rel='stylesheet' type='text/css' href='{$base}css/jquery-ui.css'/>" .
                "<link type='text/css' rel='stylesheet' href='{$base}jstree_resource/_docs/syntax/!style.css'/>";

        $js = "<script type=\"text/javascript\" src=\"{$base}js/jquery.min.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/parse_feature_xml.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/feature.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/parameter.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/code_process.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_lib/jquery.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_lib/jquery.cookie.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_lib/jquery.hotkeys.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/jquery.jstree.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}js/jquery-ui.min.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_docs/syntax/!script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/custom_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/manage_variables.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/common.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/parameter_table.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/manage_action.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/variable.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/logical_connector_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/arithmetic_operator_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/menu_item_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}js/jquery.blockUI.js\" ></script>" ;
                        
        

        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('title', 'Welcome');
        //$this->template->set('main_content', 'test');
        $this->template->set('main_content', 'welcome_message');
        $this->template->set('menu_bar', 'design/menu_bar');
        $this->template->set('left_side_bar', 'design/code_process/left_side_bar');

        $this->load->library('xmlperser');
        $fObjectArray = $this->xmlperser->readXML();

        //$this->load->model('language_process_model');
        $custom_variables = $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->get_project_variables()->result();

        $this->template->set('custom_variables', $custom_variables);

        $this->template->set('fObjectArray', $fObjectArray);
        $this->template->load("default_template", 'welcome_message');
        //$this->template->load("default_template", 'test');
    }
    
    function load_project($project_id)
    {
        if (!$this->ion_auth_model->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->session->set_userdata('project_id', $project_id);
        $base = base_url();
        $css =
                "<link rel='stylesheet' href='{$base}jstree_resource/design.css' />" .
                "<link rel='stylesheet' href='{$base}jstree_resource/menu_style.css' />" .
                "<link rel='stylesheet' type='text/css' href='{$base}css/jquery-ui.css'/>" .
                "<link type='text/css' rel='stylesheet' href='{$base}jstree_resource/_docs/syntax/!style.css'/>";

        $js = "<script type=\"text/javascript\" src=\"{$base}js/jquery.min.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/parse_feature_xml.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/feature.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/parameter.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/code_process.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_lib/jquery.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_lib/jquery.cookie.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_lib/jquery.hotkeys.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/jquery.jstree.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}js/jquery-ui.min.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/_docs/syntax/!script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/custom_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/manage_variables.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/common.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/parameter_table.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/manage_action.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}script/variable.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/logical_connector_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/arithmetic_operator_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}jstree_resource/menu_item_script.js\"></script>" .
                "<script type=\"text/javascript\" src=\"{$base}js/jquery.blockUI.js\" ></script>" .
        

        $this->template->set('css', $css);
        $this->template->set('js', $js);
        $this->template->set('title', 'Welcome');
        //$this->template->set('main_content', 'test');
        $this->template->set('main_content', 'welcome_message');
        $this->template->set('menu_bar', 'design/menu_bar');
        $this->template->set('left_side_bar', 'design/code_process/left_side_bar');

        $this->load->library('xmlperser');
        $fObjectArray = $this->xmlperser->readXML();

        //$this->load->model('language_process_model');
        $custom_variables = $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->get_project_variables()->result();

        $this->template->set('custom_variables', $custom_variables);

        $this->template->set('fObjectArray', $fObjectArray);
        
        $selected_project = $this->ion_auth->where('project_info.project_id',$project_id)->projects()->result();
        $this->data['selected_project'] = $selected_project[0];
        
        $user_projects = $this->ion_auth->where('users.id',$this->session->userdata('user_id'))->projects()->result();
        $user_project_name_list = "";
        $user_project_id_list = "";
        foreach ($user_projects as $user_project):
           $user_project_name_list = $user_project_name_list.$user_project->project_name.",";
            $user_project_id_list = $user_project_id_list.$user_project->project_id.",";
        endforeach;
        $this->data['user_project_name_list'] = $user_project_name_list;
        $this->data['user_project_id_list'] = $user_project_id_list;
        
        $this->data['base_url'] = base_url();
        
        //replacing project_content_backup by project_content
        $data = array(
                'project_content_backup' => $selected_project[0]->project_content
        );
        $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data);
        
        $this->template->load("default_template", 'welcome_message', $this->data);
    }
    
    function save_project_configuration_file()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $project_id= $this->session->userdata('project_id');
        $project_configuration = $this->input->post('file_content');
        $file_path = "./xml/".$project_id.".xml";
        //echo $file_path;
        if ( ! write_file($file_path, $project_configuration))
        {
            echo 'Unable to write the file';
        }
        else
        {
            $redirect_path = "welcome/load_project/".$project_id;
            redirect($redirect_path, 'refresh'); 
        }
    }
    
    function upload_configuration_file()
    {
        
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $project_id = $this->session->userdata('project_id'); 
        $config['upload_path'] = './xml/';
        $config['allowed_types'] = 'xml';
        $config['max_size'] = '5000';
        $config['file_name'] = $project_id. ".xml";
        $config['overwrite'] = TRUE;
        
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->data['error'] = $error;
            $this->template->set('menu_bar', 'design/configuration_menubar');
            $this->template->load("default_template", 'program/upload_configuration_file', $this->data);
            //$this->load->view('program/upload_configuration_file', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $redirect_path = "welcome/load_project/".$project_id;
            redirect($redirect_path, 'refresh');
        }

    }
    
    function upload_project()
    {
        
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $project_id = $this->session->userdata('project_id'); 
        $config['upload_path'] = './project/';
        $config['allowed_types'] = 'txt';
        $config['max_size'] = '5000';
        $config['file_name'] = $project_id. ".txt";
        $config['overwrite'] = TRUE;
        
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->data['error'] = $error;
            $this->template->set('menu_bar', 'design/configuration_menubar');
            $this->template->load("default_template", 'program/upload_project', $this->data);
            //$this->load->view('program/upload_configuration_file', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $project_content = read_file('./project/'.$this->session->userdata('project_id').'.txt');
            if($project_content != false){
                $data = array(
                    'project_content' => $project_content,
                    'project_content_backup' => $project_content
                );
                $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data);
            }
            $redirect_path = "welcome/load_project/".$project_id;
            redirect($redirect_path, 'refresh');
        }

    }
    
    /*
     * This controller is called when user presses save button from variable creation pop up dialog
     * This method calls ion_auth model to create a new variable
     */
    function create_variable()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $variable_name = $_POST['add_variable_name'];
        $variable_type = $_POST['add_variable_type_selection_combo'];
        $variable_value = "";
        if($variable_type == 'BOOLEAN')
        {
            $variable_value = $_POST['add_variable_value_selection_combo'];
        }
        else if($variable_type == 'NUMBER')
        {
            $variable_value = $_POST['add_variable_value'];
        }
        
        $additional_variable_data = array(
            'variable_name' => $variable_name,
            'variable_type' => $variable_type,
            'variable_value' => $variable_value,
        );
        $additional_project_data = array(
            'project_id' => $this->session->userdata('project_id'),
        );
        $this->ion_auth->create_variable($additional_variable_data, $additional_project_data);
        
        if(isset($_POST['project_left_panel_content_backup']) && $_POST['project_left_panel_content_backup'] != "")
        {
            $project_left_panel_content_backup = $_POST['project_left_panel_content_backup'];
            $data = array(
                'project_content_backup' => $project_left_panel_content_backup
            );
            $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data);

        }
        
        //loading the project
        $redirect_path = "welcome/load_project/".$this->session->userdata('project_id');
        redirect($redirect_path, 'refresh');
    }
    
    /*function create_variable()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->data['title'] = "Create Variable";

        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('variable_name', 'Variable Name', 'required|xss_clean|alpha_numeric');
        $this->form_validation->set_rules('variable_value', 'Variable Value', 'required|xss_clean');
        
        if ($this->form_validation->run() == true)
        {
            $additional_data = array('variable_name' => $this->input->post('variable_name'),
                'variable_type' => $this->input->post('variable_type'),
                'variable_value' => $this->input->post('variable_value'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->create_variable($additional_data))
        { 
            ////check to see if we are creating the project            
            //redirect them back to the admin page
            
            $this->session->set_flashdata('message', "Variable Created");
            $redirect_path = "welcome/load_project/".$this->session->userdata('project_id');
            redirect($redirect_path, 'refresh');

        }
        else
        { //display the create user form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['variable_name'] = array('name' => 'variable_name',
                'id' => 'variable_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('variable_name'),
            );
            $this->data['variable_value'] = array('name' => 'variable_value',
                'id' => 'variable_value',
                'type' => 'text',
                'value' => $this->form_validation->set_value('variable_value'),
            );
            
            $this->data['variable_type'] = array();
            $this->data['variable_type']['BOOLEAN'] = 'BOOLEAN';
            $this->data['variable_type']['NUMBER'] = 'NUMBER'; 

            $base = base_url();
            $css = "<link rel='stylesheet' href='{$base}css/form_design.css' />" ;
            $this->template->set('css', $css);
            //$this->template->set('main_content', "auth/create_user");
            $this->template->load("default_template", 'auth/create_variable', $this->data);

            //$this->load->view('auth/create_user', $this->data);
        }
    }*/
    
    /*
     * creating a new project
     */
    function create_project()
    {
        $this->data['title'] = "Create Project";
        //authentication checking
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }

        //validate form input
        $this->form_validation->set_rules('project_name', 'Project Name', 'required|xss_clean');
        //retrieving project name
        if ($this->form_validation->run() == true)
        {
            $duplicate_project_name = false;
            $user_projects = $this->ion_auth->where('users.id',$this->session->userdata('user_id'))->projects()->result();
            foreach ($user_projects as $user_project):
                if($this->input->post('project_name') == $user_project->project_name)
                {
                    $duplicate_project_name = true;
                }
            endforeach;
            if($duplicate_project_name == true)
            {
                $this->data['message'] = "Project name already exists. Please use different project name.";

                $this->data['project_name'] = array('name' => 'project_name',
                    'id' => 'project_name',
                    'type' => 'text',
                    'value' => $this->input->post('project_name'),
                );

                $base = base_url();
               $css = "<link rel='stylesheet' href='{$base}css/form_design.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />"."<link rel='stylesheet' href='{$base}jstree_resource/menu_style.css' />";
                $this->template->set('css', $css);
                $this->template->set('menu_bar', 'design/menu_bar_member_demo');
                $this->template->set('main_content', "auth/create_user");
                $this->template->load("default_template", 'auth/create_project', $this->data);
                return;
            }
            else
            {
                $additional_data = array('project_name' => $this->input->post('project_name'),
                    'project_content' => '<li class="ui-widget-content" id="0">Click here to edit block</li>',
                    'project_content_backup' => '<li class="ui-widget-content" id="0">Click here to edit block</li>',
                );
            }
            
        }
        //creating the project
        if ($this->form_validation->run() == true && ($project_id = $this->ion_auth->create_project($additional_data)))
        { 
            $configuration_file_path = "./xml/features.xml";
            $project_configuration = "";
            if (file_exists($configuration_file_path)) {
                $project_configuration = file_get_contents($configuration_file_path);                
            }
            //storing feature xml file for this project
            $file_path = "./xml/".$project_id.".xml";
            if ( ! write_file($file_path, $project_configuration))
            {
                echo 'Unable to write the file';
            }
            $this->session->set_flashdata('message', "Project Created");
            
            //loading the project after project creation
            $redirect_path = "welcome/load_project/".$project_id;
            redirect($redirect_path, 'refresh');

        }
        else
        { 
            //display the create project form
            //set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['project_name'] = array('name' => 'project_name',
                'id' => 'project_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('project_name'),
            );

            $base = base_url();
            $css = "<link rel='stylesheet' href='{$base}css/form_design.css' />"."<link rel='stylesheet' href='{$base}css/bluedream.css' />"."<link rel='stylesheet' href='{$base}jstree_resource/menu_style.css' />";
            $this->template->set('css', $css);
            $this->template->set('menu_bar', 'design/menu_bar_member_demo');
            $this->template->set('main_content', "auth/create_user");
            $this->template->load("default_template", 'auth/create_project', $this->data);
        }
    }
    
    function pre_load_project()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        if(isset($_POST['button_pre_load_project_ok']))
        {
            if(isset($_POST['pre_load_project_left_panel_content']) && $_POST['pre_load_project_left_panel_content'] != "")
            {
                $project_left_panel_content = $_POST['pre_load_project_left_panel_content'];
                $data = array(
                    'project_content_backup' => $project_left_panel_content,
                    'project_content' => $project_left_panel_content
                );
                $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data);
            }
        }
        redirect("auth", 'refresh');
    }
    
    function save_as_project()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        //saving current project left panel backup
        /*if(isset($_POST['save_as_project_left_panel_content']) && $_POST['save_as_project_left_panel_content'] != "")
        {
            $project_left_panel_content_backup = $_POST['save_as_project_left_panel_content'];
            $data = array(
                'project_content_backup' => $project_left_panel_content_backup
            );
            $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data);

        }*/
        
        //creating a new project using current project left panel content
        $additional_data = array('project_name' => $this->input->post('save_as_project_project_name'),
            'project_content' => $_POST['save_as_project_left_panel_content'],
            'project_content_backup' => $_POST['save_as_project_left_panel_content'],
        );
        $new_project_id = $this->ion_auth->create_project($additional_data);
        //creating feature xml file for this newly created project
        $project_id = $this->session->userdata('project_id');
        $file_path = "./xml/".$project_id.".xml";
        if (file_exists($file_path)) {
            $content = file_get_contents($file_path);
            $new_file_path = "./xml/".$new_project_id.".xml";
            if ( ! write_file($new_file_path, $content))
            {
                echo 'Unable to write the file';
            }
        }    
        //create variable list for this newly created project
        $custom_variables = $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->get_project_variables()->result();
        foreach ($custom_variables as $custom_variable):
            $additional_variable_data = array(
                'variable_name' => $custom_variable->variable_name,
                'variable_type' => $custom_variable->variable_type,
                'variable_value' => $custom_variable->variable_value,
            );
            $additional_project_data = array(
                'project_id' => $new_project_id,
            );
            $this->ion_auth->create_variable($additional_variable_data, $additional_project_data);
        endforeach;
        
        
        //loading the project
        //$redirect_path = "welcome/load_project/".$this->session->userdata('project_id');
        
        //loading save as project
        $redirect_path = "welcome/load_project/".$new_project_id;
        redirect($redirect_path, 'refresh');
    }
    
    function save_as_replace_project()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $replaced_project_name = $_POST['save_as_replace_project_name'];
        $replaced_project_id = $_POST['save_as_replace_project_id'];
        //saving current project left panel backup temporarily
        /*if(isset($_POST['save_as_replace_project_left_panel_content']) && $_POST['save_as_replace_project_left_panel_content'] != "")
        {
            $project_left_panel_content_backup = $_POST['save_as_replace_project_left_panel_content'];
            $data = array(
                'project_content_backup' => $project_left_panel_content_backup
            );
            $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->update_project($data);

        }*/
        //updating project(to be replaced) left panel content
        if(isset($_POST['save_as_replace_project_left_panel_content']) && $_POST['save_as_replace_project_left_panel_content'] != "")
        {
            $project_left_panel_content_backup = $_POST['save_as_replace_project_left_panel_content'];
            $data = array(
                'project_content_backup' => $project_left_panel_content_backup,
                'project_content' => $project_left_panel_content_backup
            );
            $this->ion_auth->where('project_id',$replaced_project_id)->update_project($data);

        }
        //updating project(to be replaced) feature xml
        $project_id = $this->session->userdata('project_id');
        $file_path = "./xml/".$project_id.".xml";
        if (file_exists($file_path)) {
            $content = file_get_contents($file_path);
            $new_file_path = "./xml/".$replaced_project_id.".xml";
            if ( ! write_file($new_file_path, $content))
            {
                echo 'Unable to write the file';
            }
        } 
        //updating project(to be replaced) variable list
        $this->ion_auth->where('project_id',$replaced_project_id)->delete_project_variable_map();
        $custom_variables = $this->ion_auth->where('project_id',$this->session->userdata('project_id'))->get_project_variables()->result();
        foreach ($custom_variables as $custom_variable):
            $additional_variable_data = array(
                'variable_name' => $custom_variable->variable_name,
                'variable_type' => $custom_variable->variable_type,
                'variable_value' => $custom_variable->variable_value,
            );
            $additional_project_data = array(
                'project_id' => $replaced_project_id,
            );
            $this->ion_auth->clone_project_variable($additional_variable_data, $additional_project_data);
        endforeach;
        //loading the project
        //$redirect_path = "welcome/load_project/".$this->session->userdata('project_id');
        
        //loading replaced project
        $redirect_path = "welcome/load_project/".$replaced_project_id;
        redirect($redirect_path, 'refresh');
    }
    function keep_server_alive()
    {
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }
}
