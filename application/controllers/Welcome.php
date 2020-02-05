<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('cat_model');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	function cat_data(){
		$data=$this->cat_model->get_category_data();
		echo json_encode($data);
	}


	/* for insert categoery */
	function insert_cat(){
		$data=$this->cat_model->insert_category();
		echo json_encode($data);
	}

	/* for update category data --- */
	function update_cat($cat_id){
		$data=$this->cat_model->update_category_data($cat_id);
		echo json_encode($data);

	}

	/* for delete operations */
	function delete_cat($cat_id){
		$data=$this->cat_model->remove_cat_data($cat_id);
		echo json_encode($data);
	}
}
