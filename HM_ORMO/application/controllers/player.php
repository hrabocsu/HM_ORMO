<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                  JÁTÉKOSOKKAT KAPCSOLATOS INTERAKCIÓKAT KISZOLGÁLÓ NYILVÁNOS VEZÉRLŐ OSZTÁLY                    //
// --------------------------------------------------------------------------------------------------------------- //

CLASS Player EXTENDS MY_Controller
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
        parent::__construct("Player_Model");
	}

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		get_club			 	     			   										   //
	//	Leírás:		  		Adott azonosítószámú játékos csapatának kiírása kiírására szolgáló eljárás		   //
	//	Láthatóság:   		Nyilvános												   						   //
	//	Argumentumok: 		Egész[játékos azonosítószáma]		 			 		   						   //
	//	Visszatérési típus: Nincs								 		 			   						   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION get_club($player_id)
	{
		/*************************************************************************************
		*  A aktuális lépéséhez tartozó értékek átalakítása JSON formába, majd azok kiírása  *
		*************************************************************************************/
		ECHO $this->Player_Model->get_club($player_id);
	}
}
/* End of file player.php */
/* Location: ./application/controllers/player.php */