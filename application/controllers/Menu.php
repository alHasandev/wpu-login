<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
    }

    public function index()
    {
        // for data views
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        // get all data from table user_menu
        $data['menu'] = $this->menu->getMenu();

        // make rule 
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

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

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
}
