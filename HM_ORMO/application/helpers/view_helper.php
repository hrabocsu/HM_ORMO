<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	FÜGGVÉNY NEVE:		generate_view_data		 		     						   			   		   //
//	LEÍRÁS:		  		A megadott nézet megjelenítéséhez szükséges adatok létrehozására szolgáló eljárás  //
//	LÁTHATÓSÁG:   		Nyilvános													   			   		   //
//	ARGUMENTUMOK: 		Sztring[nézet neve]					 				 			   			   	   //
//						Változó[kiegészítõ információ](opcionális)										   //
//						Változó[kiegészítõ információ](opcionális)										   //
//	VISSZATÉRÉSI TÍPUS: Tömb[megjelenítéshez szükséges adatok]	 			 			   			   	   //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
IF(!FUNCTION_EXISTS('generate_view_data'))
{
	FUNCTION generate_view_data($view, $arg_1 = NULL, $arg_2 = NULL)
	{
		/*****************************************************
		*  Referencia ráállítása a függvényt hívó vezérlõre  *
		*****************************************************/
		$CI = GET_INSTANCE();
		/*********************************************
		*  Tömb lefoglalása a kívánt adatok részére  *
		*********************************************/
		$data = ARRAY();
		/**********************************
		*  Elágazás a nézet neve szerint  *
		**********************************/
		SWITCH($view)
		{
			///////////////////////////////////////////////////////////
			//  CSAPAT MEGJELENTÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			///////////////////////////////////////////////////////////
			CASE "pages/club":
				/********************************************************
				*  Kiválasztott csapat azonosítószámának meghatározása  *
				********************************************************/
				$club_id = ISSET($arg_1) ? $arg_1 : $CI->Club_Model->get_first_id();
				/******************************************
				*  Játékosokhoz tartozó modell betöltése  *
				******************************************/
				$CI->load->model("Player_Model");
				/************************************************************************************************
				*  Csapat adatainak és a csapatban játszó játékosok játékosoknak a lekérdezése az adatbázisból  *																		 *
				************************************************************************************************/
				$data["players"] = $CI->Player_Model->select_all($club_id);
				$data["club"] 	 = $CI->Club_Model->select($club_id);
				BREAK;
			
			////////////////////////////////////////////////////////////
			//  JÁTÉKOS MEGJELENTÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			////////////////////////////////////////////////////////////
			CASE "pages/player":
				/*********************************************
				*  Átigazolásokhoz tartozó modell betöltése  *
				*********************************************/
				$CI->load->model("Transfer_Model");
				/******************************************************************************************
				*  Játékos adatainak és átigazolásainak lekérdezése az adatbázisból, valamint a listázás  *
				*  szempontjának ismertetése a nézettel													  *																		 *
				******************************************************************************************/
				$data["transfers"] = $CI->Transfer_Model->select_all("player", $arg_1);
				$data["player"]    = $CI->Player_Model->select($arg_1);
				$data["aspect"]    = "player";
				BREAK;
			
			///////////////////////////////////////////////////////////
			//  CSAPAT MEGJELENTÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			///////////////////////////////////////////////////////////
			CASE "pages/containers/club":
				/*************************************************
				*  Csapat adatainak lekérdezése az adatbázisból  *																		 *
				*************************************************/
				$data["club"] = $CI->Club_Model->select($arg_1);;
				BREAK;
			
			/////////////////////////////////////////////////////////////////
			//  ÁTIGAZOLÁSOK MEGJELENTÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			/////////////////////////////////////////////////////////////////
			CASE "pages/containers/players":
				/************************************************************
				*  Csapat ban játszó játékosok lekérdezése az adatbázisból  *																		 *
				************************************************************/
				$data["players"] = $CI->Player_Model->select_all($arg_1);
				BREAK;
			
			/////////////////////////////////////////////////////////////////
			//  ÁTIGAZOLÁSOK MEGJELENTÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			/////////////////////////////////////////////////////////////////
			CASE "pages/containers/transfers":
				/******************************************************************************************
				*  Csapat átigazolásainak lekérdezése az adatbázisból, valamint a listázás szempontjának  *
				*  és az aktuális csapat azonosítószámának ismertetése a nézettel						  *																		 *
				******************************************************************************************/
				$data["transfers"] = $CI->Transfer_Model->select_all("fromclub", $arg_1);
				$data["aspect"]    = "club";
				$data["club"]	   =  $arg_1;
				BREAK;
			
			//////////////////////////////////////////////////////////////////////////////
			//  ALAPÉRTELMEZETT OLDALMENÜ MEGJELENTÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			//////////////////////////////////////////////////////////////////////////////
			CASE "sidebars/default":
				/**************************************************
				*  Oldalmenü egyedek lekérdezése az adatbázisból  *
				**************************************************/
				$data["values"] = $CI->Club_Model->select_all();
				/***********************************************************
				*  Ha meg van adva a kiválasztott menüelem azonosítószáma  *
				***********************************************************/
				IF(ISSET($arg_1)) $data["selected"] = $arg_1;
				BREAK;
			
			/////////////////////////////////////////////////////////
			//  CSAPAT MÓDOSÍTÁSÁHOZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			/////////////////////////////////////////////////////////
			CASE "dialogs/add_update_club":
				/**************************************
				*  Ha nem módosítunk, akkkor kilépés  *
				**************************************/
				IF(!ISSET($arg_1)) BREAK;
				/*************************************************
				*  Csapat adatainak lekérdezése az adatbázisból  *																		 *
				*************************************************/
				$data["club"] = $CI->Club_Model->select($arg_1);
				BREAK;
				
			//////////////////////////////////////////////////////////
			//  JÁTÉKOS MÓDOSÍTÁSÁHOZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			//////////////////////////////////////////////////////////
			CASE "dialogs/add_update_player":
				/*****************************************
				*  Csapatokhoz tartozó modell betöltése  *
				*****************************************/
				$CI->load->model("Club_Model");
				/*****************************************
				*  Csapatok lekérdezése az adatbázisból  *																		 *
				*****************************************/
				$data["clubs"] = $CI->Club_Model->select_all();
				/**************************************
				*  Ha nem módosítunk, akkkor kilépés  *
				**************************************/
				IF(!ISSET($arg_1)) BREAK;
				/**************************************************
				*  Játékos adatainak lekérdezése az adatbázisból  *																		 *
				**************************************************/
				$data["player"] = $CI->Player_Model->select($arg_1);
				BREAK;
				
			/////////////////////////////////////////////////////////////
			//  ÁTIGAZOLÁS MÓDOSÍTÁSÁHOZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			/////////////////////////////////////////////////////////////
			CASE "dialogs/add_update_transfer":
				/**********************************************************
				*  Csapatokhoz és játékososkhoz tartozó modell betöltése  *
				**********************************************************/
				$CI->load->model("Club_Model");
				$CI->load->model("Player_Model");
				/******************************************************
				*  Csapatok és a játékos lekérdezése az adatbázisból  *																		 *
				******************************************************/
				$data["player"] = $CI->Player_Model->select($arg_2);
				$data["clubs"]  = $CI->Club_Model->select_all();
				/*****************************************************************************
				*  Ha módosítunk, akkor az átigazolás adatainak lekérdezése az adatbázisból  *
				*****************************************************************************/
				IF($arg_1 != "NULL") $data["transfer"] = $CI->Transfer_Model->select($arg_1);
				BREAK;
				
			//////////////////////////////////////////////////////////
			//  ÁTIGAZOLÁS TÖRLÉSÉHEZ SZÜKSÉGES ADATOK LÉTREHOZÁSA  //
			//////////////////////////////////////////////////////////
			CASE "dialogs/delete":
				/*****************************************************************************
				*   Törlést végzõ vezérlõ, törölni kívánt egyed azonosítószámának felvétele  *
				*****************************************************************************/
				$data["controller"] = $CI->router->fetch_class();
				$data["del_id"]    	= $arg_1;
				$data["player"]    	= $arg_2;
				$data["parent"]    	= ISSET($arg_2) ? "player" : "club";
				BREAK;
		}
		/************************************************************************
		*  Visszatérés a megjelenítéshez szükséges adatokat tartalmazó tömbbel  *
		************************************************************************/
		RETURN $data;
	}
}

/* End of file view_helper.php */
/* Location: ./system/helpers/view_helper.php */