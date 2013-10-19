var oTable;

/***********************************************
*  Oldal betöltése után történő függvényhívás  *
***********************************************/
$(document).ready(function() {
	//Focicsapatok menüpont kiválasztása
	$("a#a_clubs").addClass("current");
	//Adattábla inicializálása
	myInitDataTable();
	//Szövegbuborékok inicializálása
	myInitPoshyTip();
});

/*************************************************************
*  Oldalmenü elemre való kattintáskor történő függvényhívás  *
*************************************************************/
$(document).on("click", "div.menuitem_f", function(event, id) {
	//Ha a csapat átigazolásait megjelenítő oldalon voltunk
	var transfer = $("div.b_club").length != 0 ? true : false;
	//Ha nem az aktuálisan kiválasztott elemre kattintottunk(és nem triggereltünk)
	if(!$(this).hasClass("active") || typeof(event.originalEvent) === "undefined") {
		//Kiválasztott menüelem és azonosítószámának meghatározása
		var menu_item = typeof(id) === "undefined" ? $(this) : $("div#c_" + id);
		var c_id = menu_item.attr("id").substring(2);
		//Elem kiválasztása, a korábban kiválasztott elem kijeőlésésnek megszűntetése
		$("div.menuitem.active").removeClass("active");
		menu_item.addClass("active");
		//Ha a csapat főoldaláról indultunk
		if(!transfer) {
			//Csapat adatainak betöltése
			$("div.right_content").load("/HM_ORMO/index.php/club/load/pages-club/" + c_id, function() {
				//Adattábla inicializálása
				myInitDataTable();
				//Korábbi szűrés elvetése
				oTable.fnFilter("");
				//Szövegbuborékok inicializálása
				myInitPoshyTip();
			});
		}
		//Ha a csapat átigazolásainak oldaláról indultunk
		else {
			//Csapat adatainak betöltése
			$("div#c_container").load("/HM_ORMO/index.php/club/load/pages-containers-club/" + c_id, function() {
				//Ätigazolások betöltése
				$("div#d_container").load("/HM_ORMO/index.php/transfer/load/pages-containers-transfers/" + c_id, function() {
					//Adattábla inicializálása
					myInitDataTable();
					//Korábbi szűrés elvetése
					oTable.fnFilter("");
					//Szövegbuborékok inicializálása
					myInitPoshyTip();
				});
			});
		}
		//Cspaptok szűrése
		$("input.search_input").trigger("keyup");
	}
});

/****************************************************************
*  Átigazolások gombra való kattintáskor történő függvényhívás  *
****************************************************************/
$(document).on("click", "div#transfers", function() {
	//Kiválasztott csapat azonosítószámának meghatározása
	var c_id = $("div.menuitem_f.active").attr("id").substring(2);
	//Csapat átigazolásainak betöltése
	$("div#d_container").load("/HM_ORMO/index.php/transfer/load/pages-containers-transfers/" + c_id, function() {
		//Adattábla inicializálása
		myInitDataTable();
		//Korábbi szűrés elvetése
		oTable.fnFilter("");
		//Szövegbuborékok inicializálása
		myInitPoshyTip();
	});
});

/******************************************************
*  Játékosra való kattintáskor történő függvényhívás  *
******************************************************/
$(document).on("click", "p.player", function() {
	//Kiválasztott játékos azonosítószámának meghatározása
	var p_id = $(this).attr("id").substring(2);
	//Játékos adatlapjának betöltése
	$("div.right_content").load("/HM_ORMO/index.php/player/load/pages-player/" + p_id, function() {
		//Adattábla inicializálása
		myInitDataTable();
		//Korábbi szűrés elvetése
		oTable.fnFilter("");
		//Szövegbuborékok inicializálása
		myInitPoshyTip();
	});
	//Játékos csapatának lekérdezése
	var c_id = $.ajax({ type: "GET", url:"/HM_ORMO/index.php/player/get_club/" + p_id, async: false }).responseText;
	//Csapat kiválasztása, a korábban kiválasztott csapat kijeőlésésnek megszűntetése
	$("div.menuitem.active").removeClass("active");
	$("div#c_" + c_id).addClass("active");
});

/*****************************************************
*  Csapatra való kattintáskor történő függvényhívás  *
*****************************************************/
$(document).on("click", "p.club", function() {
	//Kiválasztott csapat azonosítószámának meghatározása
	var c_id = $(this).attr("id").substring(3);
	//Csapat adatlapjának betöltése
	$("div.menuitem.active").trigger("click", [c_id]);
	//Cspaptok szűrése
	$("input.search_input").trigger("keyup");
});

/***************************************************************
*  Visszatérés gombra való kattintáskor történő függvényhívás  *
***************************************************************/
$(document).on("click", "div#back", function() {
	//Szövegbuborék elrejtése
	$("div.tip-twitter").hide();
	//Kiválasztott csapat azonosítószámának meghatározása
	var c_id = $("div.menuitem_f.active").attr("id").substring(2);
	//Csapat játékosainak betöltése
	$("div#d_container").load("/HM_ORMO/index.php/player/load/pages-containers-players/" + c_id, function() {
		//Adattábla inicializálása
		myInitDataTable();
		//Korábbi szűrés elvetése
		oTable.fnFilter("");
		//Szövegbuborékok inicializálása
		myInitPoshyTip();
	});
	//Ha játékos adatlapjáról megyünk vissza a csapatra
	if($(this).hasClass("b_player")) {
		//Csapat adatainak betöltése
		$("div#c_container").load("/HM_ORMO/index.php/club/load/pages-containers-club/" + c_id, function() {
			//Adattábla inicializálása
			myInitDataTable();
			//Korábbi szűrés elvetése
			oTable.fnFilter("");
			//Szövegbuborékok inicializálása
			myInitPoshyTip();
		});
	}
});

/*************************************************************
*  Módosítás gombra való kattintáskor történő függvényhívás  *
*************************************************************/
$(document).on("click", "div.edit", function() {
	//Módosító nézet és a betöltést végző vezérlő meghatározása
	var view;
	var controller;
	//Módosítandó egyed azonosítószámának meghatározása
	var e_id = $(this).attr("id").substring(4);
	//Ha csapatot módosítunk
	if($(this).hasClass("club")) {
		view = "dialogs-add_update_club";
		controller = "club";
	}
	//Ha játékost módosítunk
	else if($(this).hasClass("player")) {
		view = "dialogs-add_update_player";
		controller = "player";
	}
	//Ha átigazolást módosítunk
	else if($(this).hasClass("transfer_control")) {
		view = "dialogs-add_update_transfer";
		controller = "transfer";
		//Játékos azonosítószámának meghatározása
		var p_id = $(this).hasClass("t_player") ? $("input#p_id").val() : $(this).closest("td").attr("id").substring(4);
		//Játékos azonosítószámának felvétele
		e_id += "/" + p_id;
	}
	//Módosító nézet betöltése egy dialógusablakba
	myShowViewInDialog(view, controller, e_id);
});

/**********************************************************
*  Törlés gombra való kattintáskor történő függvényhívás  *
**********************************************************/
$(document).on("click", "div.delete", function() {
	//A törlést végző vezérlő meghatározása
	var controller;
	//Törlendő egyed azonosítószámának meghatározása
	var e_id = $(this).attr("id").substring(4);
	//Ha csapatot törlünk
	if($(this).hasClass("club")) controller = "club";
	//Ha játékost törlünk
	else if($(this).hasClass("player")) controller = "player"; 
	//Ha átigazolást módosítunk
	else if($(this).hasClass("transfer_control")) {
		controller = "transfer";
		//Játékos/csapat azonosítószámának meghatározása
		var p_c_id = $(this).hasClass("t_player") ? $("input#p_id").val() : ""; //$("input#c_id").val();
		//Játékos/csapat azonosítószámának felvétele
		e_id += "/" + p_c_id;
	}
	//Módosító nézet betöltése egy dialógusablakba
	myShowViewInDialog("dialogs-delete", controller, e_id);
});

/************************************************************************************
*  Új csapat létrehozására szolgáló gombra való kattintáskor történő függvényhívás  *
************************************************************************************/
$(document).on("click", "a#a_new_club", function() {
	//Létrehozó nézet betöltése egy dialógusablakba
	myShowViewInDialog("dialogs-add_update_club", "club");
});

/***********************************************************************************
*  Új játékos felvételére szolgáló gombra való kattintáskor történő függvényhívás  *
***********************************************************************************/
$(document).on("click", "a#a_new_player", function() {
	//Létrehozó nézet betöltése egy dialógusablakba
	myShowViewInDialog("dialogs-add_update_player", "player");
});

/**************************************************************************************
*  Új átigazolás felvételére szolgáló gombra való kattintáskor történő függvényhívás  *
**************************************************************************************/
$(document).on("click", "div.transfer", function() {
	//Játékos azonosítószámának meghatározása
	var p_id = $("input#p_id").val();
	//Létrehozó nézet betöltése egy dialógusablakba
	myShowViewInDialog("dialogs-add_update_transfer", "transfer", "NULL/" + p_id);
});

/***********************************************************************************************
*  Átigazolásnál a csapat megváltoztatásakor történő függvényhívás(függőségi listák kezelése)  *
***********************************************************************************************/
$(document).on("change", "select.transfer_select", function() {
	//Lista indexének és a benne kiválasztott elem azonosítószámának meghatározása
	var c_id = $(this).val();
	var index = $("select.transfer_select").index($(this));
	//Ha kijelöltünk egy csapatot
	if(c_id != "")
	{
		//Csapatok lekérdezése az adatbázisból
		$.ajax({
			type: "POST",
			url: "/HM_ORMO/index.php/club/select_all/",
			dataType: "JSON",
			success: function(clubs) {
				//Listák iterálása
				$("select.transfer_select").each(function() {
					//Ha a lista nem az éppen megváltoztatott lista
					if($("select.transfer_select").index($(this)) != index) {
						//Kiválasztott elem meghatározása
						var selected = $(this).val();
						var list = $(this);
						//lista kiürítése és az üres elem betétele
						list.empty();
						list.append("<option></option>");
						var option;
						//Viszatért értékek iterálása
						$.each(clubs, function(i, club) {
							//Ha a csapat nem a kiválasztott
							if(club.ID != c_id) {
								//Listabéli opciók HTML kódjának megszerkesztése
								option = "<option value='" + club.ID + "'";
								//A korábban kiválasztott érték visszaállítása
								if(club.ID == selected) option += " selected";
								option += ">" + club.NAME + "</option>";
								//Opció felvétele a listába
								list.append(option);
							}
						});
					}
				});
			}
		});
	}
});