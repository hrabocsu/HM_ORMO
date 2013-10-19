$(function() {
    //D�tum v�laszt� objektum l�trehoz�sa
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
			//�rlapellen�rz� szab�lyok hozz�ad�sa a beviteli mez�h�z
			$(this).addClass("validate[required]");
			//Mez� �rt�k�nek ellen�rz�se
			$(this).validationEngine("validate");
		}
    });
	//Bet�m�ret v�ltoztat�sa
	$(".ui-datepicker").css("font-size", "12px");
});