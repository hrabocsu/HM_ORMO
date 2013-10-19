$(document).ready(function() {
	//Kor�bbi sz�r�s megsz�ntet�se
	$("input.search_input").val("");
});

/*********************
*  Csapatok sz�r�se  *
*********************/
$(document).on("keyup", "input.search_input", function() {
	//Be�rt sztring meghat�roz�sa
	var c_name = $.trim($(this).val().toLowerCase());
	//Csapatok iter�l�sa
	$("div.menuitem_f").each(function(i) {
		//Ha a csapat nincs kiv�lasztva �s a neve nem tartalmazza a be�rt sztringet, akkor a csapat elrejt�se az oldalmen�b�l
		if(!$(this).hasClass("active") && $(this).text().toLowerCase().indexOf(c_name) < 0) $(this).hide();
		else $(this).show();
	});
});

/********************************************************************************************************************
* N�v:		   myShowViewInDialog																					*
* Le�r�s:	   Megadott n�zetnek dial�gusablakban t�rt�n� megjelen�t�s�re szolg�l� elj�r�s							*
* Param�terek: Sztring[n�zet neve]																					*
* 			   Sztring[bet�lt�st v�gz� vez�rl� neve]																*
*			   Sztring[egyed azonos�t�sz�ma, amelyhez tartoz� adatokat a n�zet megjelen�ti](opcion�lis)				*
* Vissz.t�pus: Nincs																								*
********************************************************************************************************************/
function myShowViewInDialog(view, controller, id) {
	//Ha nincs megadva azonos�t�sz�m, akkor annak �res sztrigg� alak�t�sa
	if(typeof(id) === "undefined") id = "";
	//N�zet bet�lt�se az erre szolg�l� kont�nerbe
	$("div#dialog").empty();
	$("div#dialog").load("/HM_ORMO/index.php/" + controller + "/load/" + view + "/" + id, function() {
		//Kont�ner megjelen�t�se egy Lightview dial�gusablakban
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
		//Kliens-oldali �rlapellen�rz� hozz�ad�sa a dial�gusablakban tal�lhat� �rlaphoz
		$("div#dialog form").validationEngine("attach", { focusFirstField: false, scroll: false });
	});
}