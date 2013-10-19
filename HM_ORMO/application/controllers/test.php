<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                			 	  EGYSÉGTESZTELÉSRE SZOLGÁLÓ NYILVÁNOS VEZÉRLŐ OSZTÁLY 			                   //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Test EXTENDS CI_Controller
{
	PUBLIC FUNCTION __construct() 
	{
        parent::__construct();
		/***********************************
		*  Egységteszt könyvtár betöltése  *
		***********************************/
		$this->load->library("unit_test");
	}

	PUBLIC FUNCTION select()
	{
		$this->load->model("Club_Model");
		$test = (ARRAY)$this->Club_Model->select(1);
		$expected = ARRAY("cid" => 1, "cname" => "Juventus", "foundation" => "1897-11-01");
		ECHO $this->unit->run($test, $expected, "Global: select");
	}
	
	PUBLIC FUNCTION get_first_id()
	{
		$this->load->model("Club_Model");
		$test = $this->Club_Model->get_first_id(1);
		$expected = 3;
		ECHO $this->unit->run($test, $expected, "Global: get_first_id");
	}
		
	PUBLIC FUNCTION insert_update_delete()
	{
		$this->load->model("Club_Model");
		$expected = ARRAY("cid" => 999, "cname" => "Real Madrid", "foundation" => "1900-11-11");
		$id = $this->Club_Model->insert($expected);
		$test = (ARRAY)$this->Club_Model->select($id);
		ECHO $this->unit->run($test, $expected, "Global: insert");
		$expected = ARRAY("cid" => 9999, "cname" => "FC Barcelona", "foundation" => "1899-01-01");
		$this->Club_Model->update(999, $expected);
		$test = (ARRAY)$this->Club_Model->select(9999);
		ECHO $this->unit->run($test, $expected, "Global: update");
		$this->Club_Model->delete(9999);
		$test = $this->Club_Model->select(9999);
		ECHO $this->unit->run($test, NULL, "Global: delete");
	}	
	
	PUBLIC FUNCTION count_by_id_and_name()
	{
		$this->load->model("Club_Model");
		$expected = 0;
		$test = $this->Club_Model->count_by_id_and_name(1, "Real Madrid");
		ECHO $this->unit->run($test, $expected, "Global: count_by_id_and_name");
		$expected = 0;
		$test = $this->Club_Model->count_by_id_and_name(1, "Juventus");
		ECHO $this->unit->run($test, $expected, "Global: count_by_id_and_name");
		$expected = 1;
		$test = $this->Club_Model->count_by_id_and_name(2, "Juventus");
		ECHO $this->unit->run($test, $expected, "Global: count_by_id_and_name");
	}
	
	PUBLIC FUNCTION get_club()
	{
		$this->load->model("Player_Model");
		$expected = 2;
		$test = $this->Player_Model->get_club(77);
		ECHO $this->unit->run($test, $expected, "Player_Model: get_club");
	}
	
	PUBLIC FUNCTION get_name()
	{
		$this->load->model("Player_Model");
		$expected = "Ryan Giggs";
		$test = $this->Player_Model->get_name(61);
		ECHO $this->unit->run($test, $expected, "Player_Model: get_name");
	}
	
	PUBLIC FUNCTION set_club()
	{
		$this->load->model("Player_Model");
		$expected = 3;
		$this->Player_Model->set_club(3, 3);
		$test = $this->Player_Model->get_club(3);
		ECHO $this->unit->run($test, $expected, "Player_Model: set_club");
		$this->Player_Model->set_club(3, 1);
	}
	
}
/* End of file test.php */
/* Location: ./application/controllers/test.php */