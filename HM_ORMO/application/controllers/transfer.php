<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                 ÁTIGAZOLÁSOKKAL KAPCSOLATOS INTERAKCIÓKAT KISZOLGÁLÓ NYILVÁNOS VEZÉRLŐ OSZTÁLY                  //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Transfer EXTENDS MY_Controller
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
        parent::__construct("Transfer_Model");
	}

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE: 		add_update[felüldefiniált]														   //
	//	LEÍRÁS: 			Átigazolásnak az adatbázisban történő felvételére, vagy egy adott azonosítószámú   //
	//						átigazolásnak az adatbázisban történő módosítására szolgáló általános eljárás	   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[átigazolás azonosítószáma](opcionális)									   //
	//	VISSZATÉRÉSI TÍPUS: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION add_update($id = NULL)
	{
		/*****************************************************
		*  Átigazolás bejegyzése/módosítása az adatbázisban  *
		*****************************************************/
		$success = parent::add_update($id);
		/****************************************************************************************************************************
		*  Ha a bejegyzés sikeres volt (nyilván csak az éppen aktuális átigazolás kell hogy maga után vonja a klubb változását is)  *
		****************************************************************************************************************************/
		IF($success && !(ISSET($id)))
		{
			/********************************************************************
			*  Játékos és új csapata azonosítószámának lekérdezése az űrlapból  *
			********************************************************************/
			$player = $this->input->post("player", TRUE);
			$toclub = $this->input->post("toclub", TRUE);
			/******************************************
			*  Játékosokhoz tartozó modell betöltése  *
			******************************************/
			$this->load->model("Player_Model");
			/****************************************************************
			*  Játékos aktuális csapatának megváltoztatása az adatbázisban  *
			****************************************************************/
			$this->Player_Model->set_club($player, $toclub);
		}
	}
}
/* End of file transfer.php */
/* Location: ./application/controllers/transfer.php */