<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cat_model extends CI_Model {

	function get_category_data(){
		$this->db->order_by('cat_id','DESC');
		$data=$this->db->get('tbl_category');
		return $data->result();
	}


	function insert_category(){
		$user_data=$_POST;

		if ($this->db->insert('tbl_category',$user_data)) { 
			return true;
		}else{
			return false;
		}
	}
	
	function update_category_data($cat_id){
		$user_data=$_POST;
		$this->db->where('cat_id',$cat_id);
		if ($this->db->update('tbl_category',$user_data)) { 
			return true;
		}else{
			return false;
		}
	}

	function remove_cat_data($cat_id){
		$this->db->where('cat_id',$cat_id);
		if ($this->db->delete('tbl_category')) { 
			return true;
		}else{
			return false;
		}
	}



}
