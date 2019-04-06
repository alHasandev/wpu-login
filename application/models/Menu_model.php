<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getMenu($id = null)
    {
        if ($id != null) {

            // set condition to get spesific data
            $this->db->where(['id' => $id]);

            // get single data
            $dataMenu = $this->db->get('user_menu')->row_array();
        } else {

            // get multiple result
            $dataMenu = $this->db->get('user_menu')->result_array();
        }

        return $dataMenu;
    }

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`  
                ";

        return $this->db->query($query)->result_array();
    }

    public function getRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function edit($table, $data, $id)
    {
        $this->db->set($data);
        $this->db->where($id);
        return $this->db->update($table);
    }

    public function delete($table, $id)
    {
        return $this->db->delete($table, $id);
    }
}
