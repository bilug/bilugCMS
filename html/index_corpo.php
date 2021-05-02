<? /* license

BilugCMS (http://www.bilug.it) - Content Management System for dynamic web sites
Copyright (C) 2005-2008  Federico Villa and Alessio Loro Piana

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

For reference, contact bilugcms@vilnet.it


license */ ?>

<?php

	$inizio = substr($pag,0,1); 
	// controlliamo che $pag esista e non assuma "strani" valori
	if ($pag!="" AND $inizio!="/" AND $inizio!="<" AND stristr($pag, 'http://')==FALSE  AND stristr($pag, 'ftp://')==FALSE  AND stristr($pag, 'https://')==FALSE AND stristr($pag, '<script>')==FALSE AND stristr($pag, '<object>')==FALSE AND stristr($pag, '<applet>')==FALSE AND stristr($pag, '<embed>')==FALSE AND stristr($pag, '<%')==FALSE) {
		if (file_exists(_PATH_PAGINE.$pag))
			include( _PATH_PAGINE.$pag );
		else
			include( _PATH_PAGINE._CORPO );                    		
	}
	else {
		// se la var errmail è nulla, allora carichiamo la pagina di default corpo.php
		if (!isset($_GET["errmail"]))
			include (_CORPO);
	}
	
?>
