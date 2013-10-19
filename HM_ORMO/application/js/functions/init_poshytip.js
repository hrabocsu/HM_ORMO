/********************************************************************************************************************
* Név:		   myInitPoshyTip																						*
* Leírás:	   Szövegbuborékok inicializálására szolgáló eljárás													*
* Paraméterek: Sztring[szöveg]																						*
* Vissz.típus: Sztring[formázott szöveg]																			*
********************************************************************************************************************/
function myInitPoshyTip() {
	//Szövegbuborékok hozzáadása a megfelelő elemekhez
	$(".poshytip").poshytip({
		className: "tip-twitter",
		showTimeout: 1,
		alignTo: "target",
		alignX: "center",
		offsetY: 5,
		allowTipHover: false
	});
}