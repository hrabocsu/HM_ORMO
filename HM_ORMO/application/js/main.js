$(document).ready(function() {
	//Korábbi szûrés megszûntetése
	$("input.search_input").val("");
});

/*********************
*  Csapatok szûrése  *
*********************/
$(document).on("keyup", "input.search_input", function() {
	//Beírt sztring meghatározása
	var c_name = $.trim($(this).val().toLowerCase());
	//Csapatok iterálása
	$("div.menuitem_f").each(function(i) {
		//Ha a csapat nincs kiválasztva és a neve nem tartalmazza a beírt sztringet, akkor a csapat elrejtése az oldalmenübõl
		if(!$(this).hasClass("active") && $(this).text().toLowerCase().indexOf(c_name) < 0) $(this).hide();
		else $(this).show();
	});
});

/********************************************************************************************************************
* Név:		   myShowViewInDialog																					*
* Leírás:	   Megadott nézetnek dialógusablakban történõ megjelenítésére szolgáló eljárás							*
* Paraméterek: Sztring[nézet neve]																					*
* 			   Sztring[betöltést végzõ vezérlõ neve]																*
*			   Sztring[egyed azonosítószáma, amelyhez tartozó adatokat a nézet megjeleníti](opcionális)				*
* Vissz.típus: Nincs																								*
********************************************************************************************************************/
function myShowViewInDialog(view, controller, id) {
	//Ha nincs megadva azonosítószám, akkor annak üres sztriggé alakítása
	if(typeof(id) === "undefined") id = "";
	//Nézet betöltése az erre szolgáló konténerbe
	$("div#dialog").empty();
	$("div#dialog").load("/HM_ORMO/index.php/" + controller + "/load/" + view + "/" + id, function() {
		//Konténer megjelenítése egy Lightview dialógusablakban
		Lightview.show({ 
			url: "dialog", 
			type: "inline",
			options: {
				effects: { window:  { show: 100, hide: 50, resize: 100, position: 180 } },
				initialDimensions: { width: 0, height: 0},
				background: {color: "#fff"},
				controls: { close: false },
				overlay: { close: false },
				keyboard: { esc: false, space: false, left: false, right: false },
				skin: "light"
			}
		});
		//Kliens-oldali ûrlapellenõrzõ hozzáadása a dialógusablakban található ûrlaphoz
		$("div#dialog form").validationEngine("attach", { focusFirstField: false, scroll: false });
	});
}