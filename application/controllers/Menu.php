<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        is_logged_in();
    }

    public function index()
    {
        // for data views
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // get all data from table user_menu
        $data['menu'] = $this->menu->getMenu();

        // get all data from table user_role
        $data['role'] = $this->menu->getRole();

        // set rule form validation 
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        // if form validation is false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else { // if form validation is true

            // insert new menu to database
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);

            // set flashdata for success insert
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function getDataMenu()
    {
        echo json_encode($this->menu->getMenu($this->input->post('id')));
    }

    public function editMenu()
    {
        // set rule form validation 
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        // if form validation is false
        if ($this->form_validation->run() == false) {
            echo "isi dulu bro";
        } else {
            // set variable id for condition
            $id = [
                'id' => $this->input->post('id')
            ];

            // set data
            $data = [
                'menu' => $this->input->post('menu')
            ];

            // edit data where id = conditional id
            if ($this->menu->edit('user_menu', $data, $id)) {
                // set flashdata for success insert
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success" role="alert">Menu updated successfully!</div>'
                );

                redirect('menu');
            } else {

                // set flashdata for success insert
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">Menu failed to update!</div>'
                );

                redirect('menu');
            }
        }
    }

    public function deleteMenu()
    {

        // set variable id for condition
        $id = [
            'id' => $this->input->post('id')
        ];

        // delete data where id = conditional id
        if ($this->menu->delete('user_menu', $id)) {

            // set flashdata for success insert
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible" role="alert">Menu deleted successfully!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
        } else {

            // set flashdata for success insert
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible" role="alert">Menu failed to deleted!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>'
            );
        }


        // redirect to menu;
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';

        // get data in one row
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // get all sub menu and menu
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->menu->getMenu();

        // set rule form validation
        $this->form_validation->set_rules('title', 'The Title', 'required');
        $this->form_validation->set_rules('menu_id', 'The Menu', 'required');
        $this->form_validation->set_rules('url', 'The URL', 'required');
        $this->form_validation->set_rules('icon', 'The Icon', 'required');

        // if form validation is false
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else { // if form validation is true

            // set data to array for insert new submenu to database
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];

            // insert data array to table submenu
            $this->db->insert('user_sub_menu', $data);

            // set flashdata for success insert
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function access_menu()
    {
        // for data views
        $data['title'] = 'Access Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // get all data from table user_menu
        $data['menu'] = $this->menu->getMenu();

        // get all data from table user_role
        $data['role'] = $this->menu->getRole();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }
}
