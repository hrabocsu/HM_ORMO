<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	F�GGV�NY NEVE:		generate_view_data		 		     						   			   		   //
//	LE�R�S:		  		A megadott n�zet megjelen�t�s�hez sz�ks�ges adatok l�trehoz�s�ra szolg�l� elj�r�s  //
//	L�THAT�S�G:   		Nyilv�nos													   			   		   //
//	ARGUMENTUMOK: 		Sztring[n�zet neve]					 				 			   			   	   //
//						V�ltoz�[kieg�sz�t� inform�ci�](opcion�lis)										   //
//						V�ltoz�[kieg�sz�t� inform�ci�](opcion�lis)										   //
//	VISSZAT�R�SI T�PUS: T�mb[megjelen�t�shez sz�ks�ges adatok]	 			 			   			   	   //
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
IF(!FUNCTION_EXISTS('generate_view_data'))
{
	FUNCTION generate_view_data($view, $arg_1 = NULL, $arg_2 = NULL)
	{
		/*****************************************************
		*  Referencia r��ll�t�sa a f�ggv�nyt h�v� vez�rl�re  *
		*****************************************************/
		$CI = GET_INSTANCE();
		/*********************************************
		*  T�mb lefoglal�sa a k�v�nt adatok r�sz�re  *
		*********************************************/
		$data = ARRAY();
		/**********************************
		*  El�gaz�s a n�zet neve szerint  *
		**********************************/
		SWITCH($view)
		{
			///////////////////////////////////////////////////////////
			//  CSAPAT MEGJELENT�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			///////////////////////////////////////////////////////////
			CASE "pages/club":
				/********************************************************
				*  Kiv�lasztott csapat azonos�t�sz�m�nak meghat�roz�sa  *
				********************************************************/
				$club_id = ISSET($arg_1) ? $arg_1 : $CI->Club_Model->get_first_id();
				/******************************************
				*  J�t�kosokhoz tartoz� modell bet�lt�se  *
				******************************************/
				$CI->load->model("Player_Model");
				/************************************************************************************************
				*  Csapat adatainak �s a csapatban j�tsz� j�t�kosok j�t�kosoknak a lek�rdez�se az adatb�zisb�l  *																		 *
				************************************************************************************************/
				$data["players"] = $CI->Player_Model->select_all($club_id);
				$data["club"] 	 = $CI->Club_Model->select($club_id);
				BREAK;
			
			////////////////////////////////////////////////////////////
			//  J�T�KOS MEGJELENT�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			////////////////////////////////////////////////////////////
			CASE "pages/player":
				/*********************************************
				*  �tigazol�sokhoz tartoz� modell bet�lt�se  *
				*********************************************/
				$CI->load->model("Transfer_Model");
				/******************************************************************************************
				*  J�t�kos adatainak �s �tigazol�sainak lek�rdez�se az adatb�zisb�l, valamint a list�z�s  *
				*  szempontj�nak ismertet�se a n�zettel													  *																		 *
				******************************************************************************************/
				$data["transfers"] = $CI->Transfer_Model->select_all("player", $arg_1);
				$data["player"]    = $CI->Player_Model->select($arg_1);
				$data["aspect"]    = "player";
				BREAK;
			
			///////////////////////////////////////////////////////////
			//  CSAPAT MEGJELENT�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			///////////////////////////////////////////////////////////
			CASE "pages/containers/club":
				/*************************************************
				*  Csapat adatainak lek�rdez�se az adatb�zisb�l  *																		 *
				*************************************************/
				$data["club"] = $CI->Club_Model->select($arg_1);;
				BREAK;
			
			/////////////////////////////////////////////////////////////////
			//  �TIGAZOL�SOK MEGJELENT�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			/////////////////////////////////////////////////////////////////
			CASE "pages/containers/players":
				/************************************************************
				*  Csapat ban j�tsz� j�t�kosok lek�rdez�se az adatb�zisb�l  *																		 *
				************************************************************/
				$data["players"] = $CI->Player_Model->select_all($arg_1);
				BREAK;
			
			/////////////////////////////////////////////////////////////////
			//  �TIGAZOL�SOK MEGJELENT�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			/////////////////////////////////////////////////////////////////
			CASE "pages/containers/transfers":
				/******************************************************************************************
				*  Csapat �tigazol�sainak lek�rdez�se az adatb�zisb�l, valamint a list�z�s szempontj�nak  *
				*  �s az aktu�lis csapat azonos�t�sz�m�nak ismertet�se a n�zettel						  *																		 *
				******************************************************************************************/
				$data["transfers"] = $CI->Transfer_Model->select_all("fromclub", $arg_1);
				$data["aspect"]    = "club";
				$data["club"]	   =  $arg_1;
				BREAK;
			
			//////////////////////////////////////////////////////////////////////////////
			//  ALAP�RTELMEZETT OLDALMEN� MEGJELENT�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			//////////////////////////////////////////////////////////////////////////////
			CASE "sidebars/default":
				/**************************************************
				*  Oldalmen� egyedek lek�rdez�se az adatb�zisb�l  *
				**************************************************/
				$data["values"] = $CI->Club_Model->select_all();
				/***********************************************************
				*  Ha meg van adva a kiv�lasztott men�elem azonos�t�sz�ma  *
				***********************************************************/
				IF(ISSET($arg_1)) $data["selected"] = $arg_1;
				BREAK;
			
			/////////////////////////////////////////////////////////
			//  CSAPAT M�DOS�T�S�HOZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			/////////////////////////////////////////////////////////
			CASE "dialogs/add_update_club":
				/**************************************
				*  Ha nem m�dos�tunk, akkkor kil�p�s  *
				**************************************/
				IF(!ISSET($arg_1)) BREAK;
				/*************************************************
				*  Csapat adatainak lek�rdez�se az adatb�zisb�l  *																		 *
				*************************************************/
				$data["club"] = $CI->Club_Model->select($arg_1);
				BREAK;
				
			//////////////////////////////////////////////////////////
			//  J�T�KOS M�DOS�T�S�HOZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			//////////////////////////////////////////////////////////
			CASE "dialogs/add_update_player":
				/*****************************************
				*  Csapatokhoz tartoz� modell bet�lt�se  *
				*****************************************/
				$CI->load->model("Club_Model");
				/*****************************************
				*  Csapatok lek�rdez�se az adatb�zisb�l  *																		 *
				*****************************************/
				$data["clubs"] = $CI->Club_Model->select_all();
				/**************************************
				*  Ha nem m�dos�tunk, akkkor kil�p�s  *
				**************************************/
				IF(!ISSET($arg_1)) BREAK;
				/**************************************************
				*  J�t�kos adatainak lek�rdez�se az adatb�zisb�l  *																		 *
				**************************************************/
				$data["player"] = $CI->Player_Model->select($arg_1);
				BREAK;
				
			/////////////////////////////////////////////////////////////
			//  �TIGAZOL�S M�DOS�T�S�HOZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			/////////////////////////////////////////////////////////////
			CASE "dialogs/add_update_transfer":
				/**********************************************************
				*  Csapatokhoz �s j�t�kososkhoz tartoz� modell bet�lt�se  *
				**********************************************************/
				$CI->load->model("Club_Model");
				$CI->load->model("Player_Model");
				/******************************************************
				*  Csapatok �s a j�t�kos lek�rdez�se az adatb�zisb�l  *																		 *
				******************************************************/
				$data["player"] = $CI->Player_Model->select($arg_2);
				$data["clubs"]  = $CI->Club_Model->select_all();
				/*****************************************************************************
				*  Ha m�dos�tunk, akkor az �tigazol�s adatainak lek�rdez�se az adatb�zisb�l  *
				*****************************************************************************/
				IF($arg_1 != "NULL") $data["transfer"] = $CI->Transfer_Model->select($arg_1);
				BREAK;
				
			//////////////////////////////////////////////////////////
			//  �TIGAZOL�S T�RL�S�HEZ SZ�KS�GES ADATOK L�TREHOZ�SA  //
			//////////////////////////////////////////////////////////
			CASE "dialogs/delete":
				/*****************************************************************************
				*   T�rl�st v�gz� vez�rl�, t�r�lni k�v�nt egyed azonos�t�sz�m�nak felv�tele  *
				*****************************************************************************/
				$data["controller"] = $CI->router->fetch_class();
				$data["del_id"]    	= $arg_1;
				$data["player"]    	= $arg_2;
				$data["parent"]    	= ISSET($arg_2) ? "player" : "club";
				BREAK;
		}
		/************************************************************************
		*  Visszat�r�s a megjelen�t�shez sz�ks�ges adatokat tartalmaz� t�mbbel  *
		************************************************************************/
		RETURN $data;
	}
}

/* End of file view_helper.php */
/* Location: ./system/helpers/view_helper.php */