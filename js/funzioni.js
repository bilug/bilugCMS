/***********************************
*
* 
* 	Funzioni generali
* 
* 
* 
* 
************************************/



// funzione Trim come in php
function Trim( word ) {
	return word.replace( /\s+$|^\s+/g, "" );
}


// funzione per il cambio della scritta
function togli_mostra_scritta( div, scritta, azione ) {
	if ( azione == 'm' ) {
		if ( div.value == scritta ) {
			div.style.color = '#333';
			div.value = '';
		}
	}

	if ( azione == 'n' ) {
		if ( div.value == '' ) {
			div.value = scritta;
			div.style.color = '#868686';
		}
	}
	
	if ( azione == 'n2' ) {
		div.value = scritta;
		div.style.color = '#868686';
	}
}



// funzione per il controllo della email dinamico ( per okKeyUp ad esempio )
function ctrl_mail( mail ) {
	var m = Trim( mail.value );
	var espressione = /^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/;
	
	if ( espressione.test(m) )
		mail.style.color = "#0f0";
	else
		mail.style.color = "#f00";
}




// funzione per il controllo della email statico ( per onSubmit ad esempio )
function ctrl_mail_statico( mail ) {
	var m = Trim( mail );
	var espressione = /^[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$/;
	
	if ( espressione.test(m) )
		return false; // Non ha trovato l'errore
	else
		return true; // ha trovato l'errore
}



// Crezione popup standard per pagine fuori dal sito
function Popup( pag ) {
	var stile_popup = "top=10, left=10, width=400, height=500, status=no, menubar=yes, toolbar=no, scrollbars=yes";

	window.open( pag, "privacy", stile_popup );
}

