<?php 
IF(!defined("BASEPATH")) EXIT("No direct script access allowed");

// --------------------------------------------------------------------------------------------------------------- //
//                                   ALAPÉRTELMEZETT NYILVÁNOS MODELL ŐS OSZTÁLY                                   //
// --------------------------------------------------------------------------------------------------------------- //

CLASS MY_Model EXTENDS CI_Model 
{
	/*****************************
	*  Védett globális változók  *
	*****************************/
	PROTECTED $table;
	PROTECTED $id_column;
	PROTECTED $name_column;
	
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
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		select_all																		   //
	//	Leírás: 			Az összes egyed adatainak az adatbázisból való lekérdezésére szolgáló eljárás	   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Nincs																			   //
	//	Visszatérési típus: Objektumtömb[lekérdezett egyedek]												   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION select_all()
	{
		RETURN $this->_select_all();
	}

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		select																		 	   //
	//	Leírás: 			Adott azonosítószámú egyed adatainak az adatbázisból való lekérdezésére szolgáló   //
	//						eljárás																			   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Egész[egyed azonosítószáma]														   //
	//	Visszatérési típus: Objektum[egyed adatai]															   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION select($id)
	{
		/*****************************************
		*  A megfelelő SQL lekérdezés futtatása  *
		*****************************************/
		$this->db->from ($this->table)
				 ->where($this->id_column, $id);
		/********************************************************
		*  Visszatérés az egyed adatait tartalamzó objektummal  *
		********************************************************/
		RETURN $this->db->get()->row();
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		get_first_id																 	   //
	//	Leírás: 			Kilistázott egyedek közül az első azonosítószámának az adatbázisból való		   //
	//						lekérdezésére szolgáló eljárás													   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Nincs																			   //
	//	Visszatérési típus: Egész[első egyed azonosítószáma]												   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION get_first_id()
	{
		/*****************************************
		*  A megfelelő SQL lekérdezés futtatása  *
		*****************************************/
		$this->db->select  ($this->id_column)
				 ->from    ($this->table)
				 ->order_by($this->name_column)
				 ->limit   (1, 0);
		/************************************************
		*  Visszatérés az első egyed azonosítószámával  *
		************************************************/
		RETURN $this->db->get()->row($this->id_column);
	}
	
// ---------------------------------------------------------------------------------------------------------------
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		insert																			   //
	//	LEÍRÁS: 			Új egyednek az adatbázisban történő létrehozására szolgáló általános eljárás       //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Tömb[egyed adatai]																   //
	//	VISSZATÉRÉSI TÍPUS: Egész[új egyed azonosítószáma]													   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION insert($data) 
	{
		/**************************************
		*  Egyed létrehozása az adatbázisban  *
		**************************************/
		FOREACH($data AS $key => $value) $this->db->set($key, $value);
		$this->db->insert($this->table);
		/*************************************************
		* Visszatérés s beszúrt egyed azonosítószámával  *
		*************************************************/		
		RETURN $this->db->insert_id();
	}
	
// ---------------------------------------------------------------------------------------------------------------
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		update																			   //
	//	LEÍRÁS: 			Adott egyednek az adatbázisban történő módosítására szolgáló általános eljárás     //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[egyed azonosítószáma]														   //
	//						Tömb[egyed adatai]																   //
	//	VISSZATÉRÉSI TÍPUS: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION update($id, $data) 
	{
		/***********************
		*  Értékek frissítése  *
		***********************/
		FOREACH($data AS $key => $value) $this->db->set($key, $value);
		$this->db->where ($this->id_column, $id)
				 ->update($this->table);
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		delete																			   //
	//	Leírás: 			Adott azonosítószámú egyednek az adattáblából való törlésére szolgáló eljárás	   //
	//	Láthatóság: 		Nyilvános																		   //
	//	Argumentumok: 		Egész[egyed azonosítószáma]														   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION delete($id)
	{
		/*****************************************
		*  A megfelelő SQL lekérdezés futtatása  *
		*****************************************/
		$this->db->where ($this->id_column, $id)
				 ->delete($this->table		   );
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	FÜGGVÉNY NEVE:		count_by_id_and_name															   //
	//	LEÍRÁS: 			Azon egyedek számának a lekérdezésére szolgáló eljárás, amelyek azonosítószáma	   //
	//						eltér, de a nevük megegyezik a megadott értékkel(UNIQUE CHECK)	  				   //
	//	LÁTHATÓSÁG: 		Nyilvános																		   //
	//	ARGUMENTUMOK: 		Egész[egyed azonosítószáma]														   //
	//						Sztring[egyed azonosítója]														   //
	//	VISSZATÉRÉSI TÍPUS: Egész[találatok száma]															   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PUBLIC FUNCTION count_by_id_and_name($id, $name)
	{
		/*****************************************
		*  A megfelelő SQL lekérdezés futtatása  *
		*****************************************/
		$this->db->from ($this->table)
				 ->where($this->id_column." != ", $id)
				 ->where($this->name_column, $name);
		/*******************************************************************
		*  Visszatérés a szűrési feltételnek megfelelő találatok számával  *
		*******************************************************************/
		RETURN $this->db->count_all_results();
	}

// --------------------------------------------------------------------------------------------------------------- //
//                                          VÉDETT FÜGGVÉNYEK DEFINÍCIÓI                                           //
// --------------------------------------------------------------------------------------------------------------- //

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		select_all																		   //
	//	Leírás: 			Az összes egyed lekérdezésére szolgáló általános eljárás						   //
	//	Láthatóság: 		Védett																			   //
	//	Argumentumok: 		Tömb[szelekciós lista](opcionális)												   //
	//				 		Tömb[szűrőfeltételek listája](opcionális)										   //
	//				 		Tömb[szűrőfeltételek listája](opcionális)										   //
	//				 		Tömb[csatolandó tálák listája](opcionális)										   //
	//				 		Sztring[rendezési szempont](opcionális)											   //
	//	Visszatérési típus: Objektumtömb[lekérdezett egyedek]												   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION _select_all($columns = NULL, $filters = NULL, $or_filters = NULL, $connections = NULL, $ordering = NULL)
	{
		/*******************************************************************
		*  Az azonosítószámot és a nevet tartalmazó oszlopok kiválasztása  *
		*******************************************************************/
		$this->db->select($this->id_column . " AS ID", FALSE);
		$this->db->select($this->name_column . " AS NAME", FALSE);
		/******************************************************************************
		*  Ha meg van adva a szelekciós lista, akkor a további oszlopok kiválasztása  *
		******************************************************************************/
		IF(ISSET($columns)) FOREACH($columns AS $key => $value) $this->db->select($value);
		/*********************
		*  A tábla megadása  *
		*********************/
		$this->db->from($this->table);
		/****************************************************************************************
		*  Ha meg van adva a csatolandó táblák listája, akkor azok hozzáfűzése az alaptáblához  *
		****************************************************************************************/
		IF(ISSET($connections)) FOREACH($connections AS $key => $value) $this->db->join($key, $value);
		/***************************************************************************************
		*  Ha van megadva szűrési feltételek listája, akkor az eredmény szűrése ezek eszerint  *
		***************************************************************************************/
		IF(ISSET($filters))    FOREACH($filters AS $key => $value) $this->db->where($key, $value);
		IF(ISSET($or_filters)) FOREACH($or_filters AS $key => $value) $this->db->or_where($key, $value); 
		/***********************
		*  Eredmény rendezése  *
		***********************/
		$this->db->order_by($this->name_column, ISSET($ordering) ? $ordering : "ASC");
		/********************************************************
		*  Visszatérés az egyedeket tartalamzó objektumtömbbel  *
		********************************************************/
		RETURN $this->db->get()->result();
	}
	
// --------------------------------------------------------------------------------------------------------------- //	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		_get																			   //
	//	Leírás: 			Szűrési feltételnek megfelelő egyed kívánt oszlopának az adattáblából való 		   //
	//						lekérdezésére szolgáló általános eljárás										   //
	//	Láthatóság: 		Védett																			   //
	//	Argumentumok: 		Sztring[lekérdezni kívánt attribútum neve]										   //
	//				 		Tömb[szűrőfeltételek]															   //
	//	Visszatérési típus: Változó[lekérdezni kívánt érték]												   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION _get($column, $filters)
	{
		/*****************************************
		*  A megfelelő SQL lekérdezés futtatása  *
		*****************************************/
		$this->db->select($column)
				 ->from  ($this->table);
		/***********************
		*  Az egyedek szűrése  *
		***********************/
		FOREACH($filters AS $key => $value) $this->db->where($key, $value);
		/**********************************
		*  Visszatérés a kívánt értékkel  *
		**********************************/
		RETURN $this->db->get()->row($column);
	}
	
// --------------------------------------------------------------------------------------------------------------- //	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		_set																			   //
	//	Leírás: 			Szűrési feltételnek megfelelő egyed kívánt oszlopának az adattáblából való 		   //
	//						módosítására szolgáló általános eljárás											   //
	//	Láthatóság: 		Védett																			   //
	//	Argumentumok: 		Sztring[módosítani kívánt attribútum neve]										   //
	//				 		Változó[új érték]																   //
	//				 		Tömb[szűrőfeltételek]															   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION _set($column, $value, $filters)
	{
		/*****************************************
		*  A megfelelő SQL lekérdezés futtatása  *
		*****************************************/
		$this->db->set($column, $value);
		/***********************
		*  Az egyedek szűrése  *
		***********************/
		FOREACH($filters AS $key => $value) $this->db->where($key, $value);
		/**************************
		*  Attribútum módosítása  *
		**************************/
		RETURN $this->db->update($this->table);
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		set_table																		   //
	//	Leírás: 			Adattábla nevének beállítására szolgáló eljárás									   //
	//	Láthatóság: 		Védett																			   //
	//	Argumentumok: 		Sztring[addattábla neve]														   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION set_table($table)
	{
		$this->table = $table;
	}

// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		set_id_column																	   //
	//	Leírás: 			Azonosítószámot tartalmazó oszlop nevének beállítására szolgáló eljárás			   //
	//	Láthatóság: 		Védett																			   //
	//	Argumentumok: 		Sztring[oszlop neve]															   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION set_id_column($id_column)
	{
		$this->id_column = $id_column;
	}
	
// --------------------------------------------------------------------------------------------------------------- //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//	Függvény neve: 		set_name_column																	   //
	//	Leírás: 			Nevet tartalmazó oszlop nevének beállítására szolgáló eljárás					   //
	//	Láthatóság: 		Védett																			   //
	//	Argumentumok: 		Sztring[oszlop neve]															   //
	//	Visszatérési típus: Nincs																			   //
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	PROTECTED FUNCTION set_name_column($name_column)
	{
		$this->name_column = $name_column;
	}
}
/* End of file MY_model.php */
/* Location: ./application/core/MY_model.php */