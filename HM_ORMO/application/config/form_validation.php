<?php
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                CODEIGNITER ŰRLAPELLENŐRZŐ KÖNYVTÁRÁNAK KONFIGURÁCIÓJA A MEGADOTT FÜGGVÉNYEKHEZ                  //
// --------------------------------------------------------------------------------------------------------------- //

$config = ARRAY(
	////////////////////////////////////////////////////////////////////////////
	//  Csapat létrehozásánál/módosításánál alkalmazott validációs szabályok  //
	////////////////////////////////////////////////////////////////////////////
	"club/add_update" => ARRAY(
		/***************************************
		*  Csapat nevére vonatkozó megkötések  *
		***************************************/
		ARRAY("field" => "cname",
			  "label" => "CSAPAT NEVE",
			  "rules" => "trim|required|max_length[64]|unique_check"),
		/*******************************************
		*  Alapítási dátumra vonatkozó megkötések  *
		*******************************************/
		ARRAY("field" => "foundation",
			  "label" => "ALAPÍTÁS DÁTUMA",
			  "rules" => "trim|required|max_length[10]")),
			  
	///////////////////////////////////////////////////////////////////////////
	//  Játékos felvételénél/módosításánál alkalmazott validációs szabályok  //
	///////////////////////////////////////////////////////////////////////////
	"player/add_update" => ARRAY(
		/****************************************
		*  Játékos nevére vonatkozó megkötések  *
		****************************************/
		ARRAY("field" => "pname",
			  "label" => "JÁTÉKOS NEVE",
			  "rules" => "trim|required|max_length[64]"),
		/***********************************************
		*  Játékos nemzetiségére vonatkozó megkötések  *
		***********************************************/
		ARRAY("field" => "nationality",
			  "label" => "NEMZETISÉG",
			  "rules" => "trim|required|max_length[64]"),
		/***********************************
		*  Életkorra vonatkozó megkötések  *
		***********************************/
		ARRAY("field" => "age",
			  "label" => "ÉLETKOR",
			  "rules" => "trim|required|numeric|less_than[61]|greater_than[9]"),
		/**********************************
		*  Csapatra vonatkozó megkötések  *
		**********************************/
		ARRAY("field" => "club",
			  "label" => "CSAPAT",
			  "rules" => "trim|required")),
			  
	/////////////////////////////////////////////////////////////////////////////
	//  Átigazolás megadásánál/módosításánál alkalmazott validációs szabályok  //
	/////////////////////////////////////////////////////////////////////////////
	"transfer/add_update" => ARRAY(
		/***********************************
		*  Játékosra vonatkozó megkötések  *
		***********************************/
		ARRAY("field" => "player",
			  "label" => "JÁTÉKOS",
			  "rules" => "trim|required|numeric"),
		/***************************************
		*  Régi csapatra vonatkozó megkötések  *
		***************************************/
		ARRAY("field" => "fromclub",
			  "label" => "RÉGI CSAPAT",
			  "rules" => "trim|required|not_equal[toclub]"),
		/*************************************
		*  Új csapatra vonatkozó megkötések  *
		*************************************/
		ARRAY("field" => "toclub",
			  "label" => "ÚJ CSAPAT",
			  "rules" => "trim|required|not_equal[fromclub]"),
		/**********************************
		*  Összegre vonatkozó megkötések  *
		**********************************/
		ARRAY("field" => "amount",
			  "label" => "ÖSSZEG",
			  "rules" => "trim|required|numeric|less_than[100000001]|greater_than[999]"),
		/*********************************
		*  Dátumra vonatkozó megkötések  *
		*********************************/
		ARRAY("field" => "tdate",
			  "label" => "DÁTUM",
			  "rules" => "trim|required|max_length[10]")));

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */