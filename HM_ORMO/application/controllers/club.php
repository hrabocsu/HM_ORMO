<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                FOCICSAPATOKKAL KAPCSOLATOS INTERAKCIÓKAT KISZOLGÁLÓ NYILVÁNOS VEZÉRLŐ OSZTÁLY                   //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Club EXTENDS MY_Controller
{
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:      __construct																		   //
	//	Leírás: 			Konstrukciós művelet															   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Nincs																			   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION __construct() 
	{
		/***********************************************************************************************
		*  Szülőosztály konstruktorának meghívása a vezérlőhöz tartozó alapértelmezett modell nevével  *
		***********************************************************************************************/
        parent::__construct("Club_Model");
	}

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		index									  										   //
	//	LEÍRÁS:		  		Kezdőlap megjelenítésére szolgáló eljárás										   //
	//	LÁTHATÓSÁG:   		Nyilvános							  											   //
	//	ARGUMENTUMOK: 		Nincs																			   //
	//	VISSZATÉRÉSI TÍPUS: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION index()
	{
		/*******************************************************************
		*  Laphoz és oldalmenühöz tartozó adatok létrehozása(view_helper)  *
		*******************************************************************/
		$data 		  = generate_view_data("pages/club");
		$sidebar_data = generate_view_data("sidebars/default");
		/******************************************************
		*  Megfelelő fejléc és oldalmenü hozzáadása a laphoz  *
		******************************************************/
		$this->set_template_part("sidebar", "sidebars/default", $sidebar_data);
		$this->set_template_part("header",  "headers/club");
		/**********************************
		*  Lap megjelenítése a sablonban  *
		**********************************/
		$this->display_template("pages/club", $data);
	}
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		select_all								  										   //
	//	LEÍRÁS:		  		Focicsapatok kiírására szolgáló eljárás											   //
	//	LÁTHATÓSÁG:   		Nyilvános							  											   //
	//	ARGUMENTUMOK: 		Nincs																			   //
	//	VISSZATÉRÉSI TÍPUS: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION select_all()
	{
		ECHO JSON_ENCODE($this->Club_Model->select_all());
	}
}
/* End of file club.php */
/* Location: ./application/controllers/club.php */