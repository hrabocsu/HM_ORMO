/********************************************************************************************************************
* Név:		   myInitDataTable																						*
* Leírás:	   Adattáblák inicializálására szolgáló eljárás															*
* Paraméterek: Sztring[szöveg]																						*
* Vissz.típus: Sztring[formázott szöveg]																			*
********************************************************************************************************************/
function myInitDataTable() {
	//Adadttábla inicializálása
	oTable = $("table.datatable").dataTable({
		"bAutoWidth": false,
		"aaSorting": [],
		"bSort": false,
		"bStateSave": true,
		"iDisplayLength": 7,
		"bDestroy": true,
		"sDom": "<'table_filter' f>rt<'table_paging' p>",
		"oLanguage": {
			"sProcessing":   "Feldolgozás...",
			"sLengthMenu":   "_MENU_ találat oldalanként",
			"sZeroRecords":  "Nincs találat",
			"sInfo":         "Találatok _START_ - _END_<br>[Összesen _TOTAL_]",
			"sInfoEmpty":    "Nulla találat",
			"sInfoFiltered": "(_MAX_ összes rekord közül szűrve)",
			"sInfoPostFix":  "",
			"sSearch":       "",
			"sUrl":          "",
			"oPaginate": {
				"sFirst":    "Első",
				"sPrevious": "Előző",
				"sNext":     "Következő",
				"sLast":     "Utolsó"
			}
		},
		"sPaginationType": "full_numbers"	
	});
	
	//Ha a táblázatban a játékos átigazolásai vannak, akkor a szűrő elrejtése
	if($("table.datatable").hasClass("player_transfers")) $("div.table_filter").hide();
}