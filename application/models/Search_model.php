<?php
class Search_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    function get_search($rid=null)
    {
        $this->db->select('rname');
        $this->db->from('restaurant');

        $this->db->order_by('rid');

        return $this->db->get()->result();
    }
}
