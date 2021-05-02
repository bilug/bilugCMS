<?php
    /*
        carica le sottocategorie da scegliere dinamicamente...
    */

	require_once("include_ajax.php");
    
    $key = $_GET['key'];
        
    if ( $key != '' ) {
      $str1=" SELECT ID, categoria FROM ecommercecategoria WHERE categoria LIKE '$key||%' LIMIT 1";          
      $risultato1=mysql_query($str1);
      $control1=mysql_fetch_row($risultato1);
      $cat = explode( '||', $control1[1] );
      
      if ( $cat[1] != '' ) {?>
        	<div class="float100">Sotto-categoria:</div>
        	<div class="float160">
             <select id="sottocategoria">
             <?php
				echo "<option value=\"\">------------</option>";
                $cat[1] = substr( $cat[1], 0, strlen( $cat[1] ) - 2 );
                $sccat = explode( '--', $cat[1] );
                foreach( $sccat as $key => $val ) {
                    echo "<option value=\"$val\">$val</option>";
                }
             ?>
             </select>
             </div>
            <div class="azzerafloat"><br></div>
      <?php
      }
    }
    ?>
