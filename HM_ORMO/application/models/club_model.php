<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//     CSAPATOKAT TARTALMAZÓ ADATTÁBLÁN VÉGREHAJTANDÓ SQL LEKÉRDEZÉSEKET IMPLEMENTÁLÓ NYILVÁNOS MODELL OSZTÁLY     //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Club_Model EXTENDS MY_Model 
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
		$this->set_table("CLUB");
		$this->set_id_column("CID");
		$this->set_name_column("CNAME");
	}
}
/* End of file club_model.php */
/* Location: ./application/models/club_model.php */