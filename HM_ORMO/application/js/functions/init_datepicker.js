$(function() {
    //Dátum választó objektum létrehozása
	$( "input.date" ).datepicker({
		showAnim: "drop",
		changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		dateFormat: "yy-mm-dd",
		yearRange: "1850",
		onClose: function() {
			//Ûrlapellenõrzõ szabályok hozzáadása a beviteli mezõhöz
			$(this).addClass("validate[required]");
			//Mezõ értékének ellenõrzése
			$(this).validationEngine("validate");
		}
    });
	//Betûméret változtatása
	$(".ui-datepicker").css("font-size", "12px");
});