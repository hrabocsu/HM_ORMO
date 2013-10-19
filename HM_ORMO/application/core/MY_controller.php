<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                                  ALAPÉRTELMEZETT NYILVÁNOS VEZÉRLŐ ŐS OSZTÁLY                                   //
// --------------------------------------------------------------------------------------------------------------- //

CLASS MY_Controller EXTENDS CI_Controller 
{
	/******************************************
	*  Védett globális változók deklarációja  *
	******************************************/
    PROTECTED $template;
	PROTECTED $template_data;
	PROTECTED $default_model;
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:      __construct																		   //
	//	Leírás: 			Konstrukciós művelet															   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Sztring[alapértelmezett modell neve]											   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION __construct($default_model) 
	{
		/*******************************************
		*  Szülőosztály konstruktorának meghívása  *
		*******************************************/
        parent::__construct();
		/********************************
		*  Nyelv és időzóna beállítása  *
		********************************/
		SETLOCALE(LC_ALL, "hungarian");
		DATE_DEFAULT_TIMEZONE_SET("Europe/Budapest");
		/***********************************************
		*  Alapértelmezett model és sablon beállítása  *
		***********************************************/
		$this->default_model = $default_model;
		$this->template 	 = "templates/default_template";
		/*************************************
		*  Alapértelmezett modell betöltése  *
		*************************************/
		$this->load->model($default_model);
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		load								 		    								   //
	//	Leírás:		  		Lapnak a hozzá tartozó dinamikus adatokkal történő betöltésére szolgáló eljárás    //
	//	Láthatóság:   		Nyilvános							 		    								   //
	//	Argumentumok: 		Sztring[nézet neve]																   //
	//						Változó[kiegészítő információ](opcionális)										   //
	//						Változó[kiegészítő információ](opcionális)										   //
	//	Visszatérési típus: Nincs								 											   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION load($view, $arg_1 = NULL, $arg_2 = NULL)
	{
		/********************************************************************************************************
		*  A "-" karakterek kicserélése "/" karakterekre a nézet nevében(nézet elérési útvonalának dekódolása)  *
		********************************************************************************************************/
		$view = str_replace("-", "/", $view);
		/***********************************************************************************************
		*  Nézet megjelenítéséhez szükséges adatok létrehozása(a függvényt a view helper tartalmazza)  *
		***********************************************************************************************/
		$data = generate_view_data($view, $arg_1, $arg_2);
		/******************************************************
		*  Megadott nézet betöltése, a létrehozott adatokkal  *
		******************************************************/
		$this->load->view($view, $data);
	}

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE: 		add_update																		   //
	//	LEÍRÁS: 			Egyednek az adatbázisban történő létrehozására, vagy egy adott azonosítószámú  	   //
	//						egyednek az adatbázisban történő módosítására szolgáló általános eljárás		   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[csapat azonosítószáma](opcionális)										   //
	//	VISSZATÉRÉSI TÍPUS: Logikai[létrehozás/módosítás sikeressége]										   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION add_update($id = NULL)
	{
		/*****************************************
		*  Alapértelmezett modell meghatározása  *
		*****************************************/
		$model = $this->default_model;
		/*******************************************************
		*  CodeIgniter űrlap-ellenőrző könyvtárának betöltése  *
		*******************************************************/
		$this->load->library("form_validation");
		/******************************************************************************
		*  Az esetlegesen szükséges modell megadása a kiterjesztett könyvtár számára  *
		******************************************************************************/
		$this->form_validation->set_model($model);
		/*************************************************
		*  Ha az űrlapellenőrzés hiba nélkül tér vissza  *
		*************************************************/
		IF($this->form_validation->run()) 
		{
			/******************************
			*  Bevitt adatok lekérdezése  *
			******************************/
			$entity = $this->input->post(NULL, TRUE);
			/***********************************
			*  Felesleges információ kivétele  *
			***********************************/
			UNSET($entity["e_id"]);
			/*******************************************************************************************
			*  Ha a függvénynek nincs megadott paramétere, akkor új egyed létrehozása az adatbázisban  *
			*******************************************************************************************/
			IF(!ISSET($id))	ECHO "id:" . $this->$model->insert($entity);
			/******************************************************************************
			*  Ha a függvénynek van megadott paramétere, akkor az adott egyed módosítása  *
			******************************************************************************/		
			ELSE $this->$model->update($id, $entity);
			/**************************************
			*  Visszatérés igaz logikai értékkel  *
			**************************************/
			RETURN TRUE;
		}
		/*************************************************************************
		*  Ha az űrlapellenőrzés hibával tér vissza, akkor a hibaüzenet kiírása  *
		*************************************************************************/
		ELSE ECHO VALIDATION_ERRORS();
		/***************************************
		*  Visszatérés hamis logikai értékkel  *
		***************************************/
		RETURN FALSE;
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE: 		delete																			   //
	//	LEÍRÁS: 			Egyednek az adatbázisból történő törlésére szolgáló általános eljárás			   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[egyed azonosítószáma]														   //
	//	VISSZATÉRÉSI TÍPUS: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION delete($id)
	{
		/*****************************************
		*  Alapértelmezett modell meghatározása  *
		*****************************************/
		$model = $this->default_model;
		/**********************************
		*  Egyed törlése az adatbázisból  *
		**********************************/		
		$this->$model->delete($id);
	}
	
// --------------------------------------------------------------------------------------------------------------- //
//                                          VÉDETT FÜGGVÉNYEK DEFINÍCIÓI                                           //
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		set_template_data						   				  					  	   //
	//	Leírás:		  		"template_data" globális tömbnek adattaggal való bővítésére szolgáló eljárás  	   //
	//	Láthatóság:   		Védett													  				  		   //
	//	Argumentumok: 		Sztring[index]																	   //
	//						Tömb[adatok]					 	   						  				  	   //
	//	Visszatérési típus: Nincs								   					  	  				  	   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION set_template_data($part, $data) 
	{
        $this->template_data[$part] = $data;
    }

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		set_template_part						   					  				  	   //
	//	Leírás:		  		"template_data" globális tömbnek nézettel való bővítésére szolgáló eljárás  	   //
	//	Láthatóság:   		Védett													  				  		   //
	//	Argumentumok: 		Sztring[index]																	   //
	//						Sztring[sablon neve]															   //
	//						Tömb[adatok]				 	   						  				  		   //
	//	Visszatérési típus: Nincs								   					  	  				  	   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
    PROTECTED FUNCTION set_template_part($part, $view, $data = ARRAY()) 
	{
        $this->template_data[$part] = $this->load->view($view, $data, TRUE);
    }
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve:		display_template						  										   //
	//	Leírás:		  		Nézet megjelenítésére szolgáló eljárás  										   //
	//	Láthatóság:   		Védett								  											   //
	//	Argumentumok: 		Sztring[sablon neve](opcionális)												   //
	//						Tömb[adatok](opcionális)   	   			  										   //
	//	Visszatérési típus: Nincs				  	  				  										   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
    PROTECTED FUNCTION display_template($view = NULL, $data = ARRAY()) 
	{
        IF(!is_null($view)) $this->set_template_part("content", $view, $data);
        $this->load->view($this->template, $this->template_data);
    }
}
/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */