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

<link rel="stylesheet" type="text/css" href="<?=_URLSITO?>/css/glDatePicker.flatwhite.css" />
<script type="text/javascript" src="<?=_URLSITO?>/js/glDatePicker.min.js"></script>

<?php							
	
$sql = "
	SELECT e.id, e.dataora 
	FROM eventi AS e 
	INNER JOIN lingue AS l ON l.id = e.id_lingua 
	WHERE l.sigla = '$lingua_query' 
";  
$rssql = mysql_query( $sql );

?>

<div class="blocco blocco-eventi-appuntamenti">
	
	<h3><span><?=$titolo?></span></h3>
	
	<div class="modulo">
		<div id="bilug-calendar" gldp-id="bilug-calendar" gldp-el="bilug-calendar"></div>
	</div>
	
	<script>
	 $(document).ready(function(){
		// Or you can do it with multiple calls
		$('#bilug-calendar').glDatePicker({
			cssName: 'flatwhite',
			showAlways: true,
			dowOffset: 1,
			monthNames: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
			dowNames: ['Do', 'Lu', 'Ma', 'Me', 'Gi', 'Ve', 'Sa'],
			onShow: function(calendar) { calendar.show(); },
			specialDates: [
				<?php 
					$eventi = "";
					while( $r = mysql_fetch_row($rssql) ) {
						$data = explode( ' ', $r[1] );
						$data = explode( '-', $data[0] );
						$aaaa = $data[0];
						$mm = (int)$data[1] - 1;
						$gg = $data[2];
						$link = rurl( $r[0], 'eventi-appupntamenti' );
						$eventi .= "{
							date: new Date($aaaa, $mm, $gg),
							data: {link: '$link'}
						},";
					}
					$eventi = substr( $eventi, 0, strlen($eventi)-1 );
					echo $eventi;
				?>
			],
			onClick: function(target, cell, date, data) {
				if(data != null) {
					window.location = data.link;
				}
			}
		});
	});
	</script>	
</div>