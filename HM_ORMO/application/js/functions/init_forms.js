/********************************************************************************
*  Űrlap jóváhagyására szolgáló gombra való kattintáskor történő függvényhívás  *
********************************************************************************/
$(document).on("submit", "form", function() {
	//Az űrlap és az új név feljegyzése
	var name = $("input#inp_name").val();
	var form = $(this);
	//Űrlap metódusának végrehajtása
	$.ajax({
		url: this.action,
		type: this.method,
		data: $(this).serialize(),
		async: false,
		success: function(response) {
			//Ha a szerveroldali űrlapellenőrzés hibával tért vissza, akkor annak megjelenítése
			if(response != "" && response.substring(0, 3) != "id:") $("div.error_box").empty().html(response).fadeIn(300);
			else { 
				//Ha egy csapat nevét változtattuk meg, akkor annak megváltoztatása a menüben és a csapat adatlapjának megjelenítése
				if(form.attr("id") == "form_club" && form.hasClass("update")) $("div.menuitem.active").text(name).trigger("click");
				
				//Ha egy játékost változtattunk meg, akkor az adatlapjának megjelenítése
				else if(form.attr("id") == "form_player" && form.hasClass("update")) $("p.player").trigger("click");
				
				//Ha egy játékost változtattunk meg, akkor az adatlapjának megjelenítése
				else if(form.attr("id") == "form_transfer") $("p.player").trigger("click");
				
				//Ha csapatot hoztunk létre
				else if(form.attr("id") == "form_club" && form.hasClass("insert")) {
					//Újonnan létrehozott csapat azonosítószámának meghatározása
					var c_id = response.substring(3);
					//Menü frissítése
					$("div.sidebarmenu").load("/HM_ORMO/index.php/club/load/sidebars-default/" + c_id + "/sidebar", function() {
						//Újonnan létrehozott csapat megjelenítése
						$("div.menuitem.active").trigger("click");
					});
				}
				
				//Ha töröltünk
				else if(form.attr("id") == "form_delete") {
					//Törölt egyed típusának meghatározása
					var e_type = $("div#dialog input#e_type").val();
					//Ha átigazolást töröltünk(játékos oldaláról), akkor a játékos adatlapjának frissítése
					if(e_type == "transfer" && $("input#parent").val() == "player") $("p.player").trigger("click");
					//Ha átigazolást töröltünk(csapat oldaláról), akkor a csapat adatlapjának frissítése
					else if(e_type == "transfer" && $("input#parent").val() == "club") $("div.menuitem.active").trigger("click");
					//Ha játékost törlünk, akkor visszatérés a csapat oldalára
					else if(e_type == "player") $("div.menuitem.active").trigger("click");
					//Ha csapatot törlünk, akkor az oldal inicializálása
					else if(e_type == "club")
						$("div.sidebarmenu").load("/HM_ORMO/index.php/club/load/sidebars-default/", function() {
							//Az alapértelmezett csapat megjelenítése
							$("div.menuitem.active").trigger("click");
						});
				}
				
				//Ha játékost vettünk fel
				else if(form.attr("id") == "form_player" && form.hasClass("insert")) {
					//Újonnan felvett játékos azonosítószámának meghatározása
					var p_id = response.substring(3);
					//Újonnan felvett játékos megjelenítése
					$("p#p_").attr("id", "p_" + p_id).trigger("click");
				}
				
				//Megnyitott Lightview dialógusablak bezárása
				if($("div.lv_window").is(":visible")) {
					Lightview.hide();
					$("div#dialog").empty().hide();
					$("div.error_box").hide();
				}
			}
		}   
	});
	return false;
});

/***********************************************************
*  Elvetés gombra való kattintáskor történő függvényhívás  *
***********************************************************/
$(document).on("click", "input.cancel", function() {
	//Megnyitott Lightview dialógusablak bezárása
	if($("div.lv_window").is(":visible")) {
		Lightview.hide();
		$("div#dialog").empty().hide();
		$("div.error_box").hide();
	}
});