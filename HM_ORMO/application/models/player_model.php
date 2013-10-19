<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//    JÁTÉKOSOKAT TARTALMAZÓ ADATTÁBLÁN VÉGREHAJTANDÓ SQL LEKÉRDEZÉSEKET IMPLEMENTÁLÓ NYILVÁNOS MODELL OSZTÁLY     //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Player_Model EXTENDS MY_Model 
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
		$this->set_table("PLAYER");
		$this->set_id_column("PID");
		$this->set_name_column("PNAME");
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		select_all[felüldefiniált]														   //
	//	Leírás: 			A megadott azonosítószámú focicsapatban játszó összes játékosnak az adatbázisból   //
	//						való lekérdezésére szolgáló eljárás												   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Egész[focicsapat azonosítószáma]												   //
	//	Visszatérési típus: Objektumtömb[játékosok]															   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION select_all($club)
	{
		RETURN $this->_select_all(NULL, ARRAY("CLUB" => $club));
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		get_club																		   //
	//	LEÍRÁS: 			Adott azonosítószámú játékos csapatának az adatbázisból	való lekérdezésére 		   //
	//						szolgáló eljárás						   		 								   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[játékos azonosítószáma]													   //
	//	VISSZATÉRÉSI TÍPUS: Egész[csapat azonosítószáma]													   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION get_club($player_id)
	{
		RETURN $this->_get("club", ARRAY("pid" => $player_id));
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		get_name																		   //
	//	LEÍRÁS: 			Adott azonosítószámú játékos nevének az adatbázisból való lekérdezésére szolgáló   //
	//						eljárás									   		 								   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[játékos azonosítószáma]													   //
	//	VISSZATÉRÉSI TÍPUS: Egész[játékos neve]																   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION get_name($player_id)
	{
		RETURN $this->_get("pname", ARRAY("pid" => $player_id));
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		set_club																		   //
	//	LEÍRÁS: 			Adott azonosítószámú játékos csapatának az adatbázisból	történő módosítására	   //
	//						szolgáló eljárás						   		 								   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[játékos azonosítószáma]													   //
	//						Egész[csapat azonosítószáma]													   //
	//	VISSZATÉRÉSI TÍPUS: Nincs													   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION set_club($player_id, $club_id)
	{
		RETURN $this->_set("club", $club_id, ARRAY("pid" => $player_id));
	}
}
/* End of file player_model.php */
/* Location: ./application/models/player_model.php */