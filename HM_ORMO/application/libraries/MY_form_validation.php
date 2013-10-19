<?php  IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                                      ŰRLAP-ELLENŐRZŐ KÖNYVTÁR KITERJESZTÉSE                                     //
// --------------------------------------------------------------------------------------------------------------- //

CLASS MY_Form_validation EXTENDS CI_Form_validation
{
	/**********************************************
	*  Globális változó(alkalmazott modell neve)  *
	**********************************************/
	PROTECTED $model;
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:      __construct																		   //
	//	Leírás: 			Konstrukciós művelet															   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Tömb[szabályok]																	   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION __construct($rules = ARRAY())
	{
		/*******************************************
		*  Szülőosztály konstruktorának meghívása  *
		*******************************************/
		parent:: __construct($rules);
	}
	
// --------------------------------------------------------------------------------------------------------------- //	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		set_model											  							   //
	//	Leírás:		  		Alkalmazandó model beállítására szolgáló eljárás								   //
	//	Láthatóság:   		Nyilvános							  											   //
	//	Argumentumok: 		Sztring[model neve]																   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION set_model($model)
	{
		$this->model = $model;
	}

// --------------------------------------------------------------------------------------------------------------- //	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		unique_check										  							   //
	//	Leírás:		  		Névütközésnek a vizsgálatára szolgáló eljárás									   //
	//	Láthatóság:   		Nyilvános							  											   //
	//	Argumentumok: 		Sztring[egyed neve]																   //
	//	Visszatérési típus: Logikai[név ütközés fennálása]													   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION unique_check($name)
	{
		/**************************************
		*  Alkalmazandó modell meghatározása  *
		***************************************/
		$model = $this->model;
		/**********************************
		*  Alkalmazandó modell betöltése  *
		**********************************/
		$this->CI->load->model($model);
		/****************************************************
		*  Egyed azonosítószámának lekérdezése az űrlapból  *
		****************************************************/
		$id = $this->CI->input->post("e_id", TRUE);
		/*********************************************
		*  Visszatérés a megfelelő logikai értékkel  * 
		*********************************************/
		RETURN ($this->CI->$model->count_by_id_and_name($id, $name) == 0);
	}
	
// --------------------------------------------------------------------------------------------------------------- //	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		not_equal										  								   //
	//	Leírás:		  		2 mező eltérésének a vizsgálatára szolgáló eljárás								   //
	//	Láthatóság:   		Nyilvános							  											   //
	//	Argumentumok: 		Sztring[mező tartalma]															   //
	//						Sztring[összehasonlítandó mező neve]											   //
	//	Visszatérési típus: Logikai[eltérés fennálása]														   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION not_equal($str, $field)
	{
		/***************************************************************
		*  Összehasonlítandó mező tartalmának lekérdezése az űrlapból  *
		***************************************************************/
		$_str = $this->CI->input->post($field, TRUE);
		/*********************************************
		*  Visszatérés a megfelelő logikai értékkel  * 
		*********************************************/
		RETURN ($_str != $str);
	}
}
/* End of file MY_form_validation.php */
/* Location: ./application/libraries/MY_form_validation.php */