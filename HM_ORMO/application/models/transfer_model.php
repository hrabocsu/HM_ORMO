<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//   ÁTIGAZOLÁSOKAT TARTALMAZÓ ADATTÁBLÁN VÉGREHAJTANDÓ SQL LEKÉRDEZÉSEKET IMPLEMENTÁLÓ NYILVÁNOS MODELL OSZTÁLY   //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Transfer_Model EXTENDS MY_Model 
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
		/*******************************************
		*  Szülőosztály konstruktorának meghívása  *
		*******************************************/
        parent::__construct();
		/******************************************
		*  A modellspecifikus értékek beállítása  *
		******************************************/
		$this->set_table("TRANSFER");
		$this->set_id_column("TID");
		$this->set_name_column("TDATE");
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		select_all[felüldefiniált]														   //
	//	Leírás: 			A megadott azonosítószámú egyedhez tartozó összes átigazolásnak az adatbázisból	   //
	//						való lekérdezésére szolgáló eljárás												   //
	//	Láthatóság: 		Nyilvános																		   //
	//				 		Sztring[listázási szempont]														   //
	//	Argumentumok: 		Egész[listázási szempont azonosítószáma]										   //
	//	Visszatérési típus: Objektumtömb[átigazolások]														   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION select_all($aspect, $aspect_id)
	{
		/******************************
		*  Szelekciós lista megadása  *
		******************************/
		$columns[0] = "fromclub";
		$columns[1] = "fromclub.cname AS fcname";
		$columns[2] = "toclub";
		$columns[3] = "toclub.cname AS tcname";
		$columns[4] = "player";
		$columns[5] = "player.pname";
		$columns[6] = "amount";
		/*****************************************
		*  Táblakapcsolatok listájának megadása  *
		*****************************************/
		$connections["club fromclub"] = "fromclub = fromclub.cid";
		$connections["club toclub"]   = "toclub = toclub.cid";
		$connections["player"] 		  = "player = player.pid";
		/****************************************
		*  Szűrőfeltételek listájának megadása  *
		****************************************/
		$or_filters["toclub"] = $aspect == "fromclub" ? $aspect_id : NULL;
		$filters[$aspect] 	  = $aspect_id;
		/***************
		*  Lekérdezés  *
		***************/
		RETURN $this->_select_all($columns, $filters, $or_filters, $connections, "DESC");
	}
}
/* End of file transfer_model.php */
/* Location: ./application/models/transfer_model.php */