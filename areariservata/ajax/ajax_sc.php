<?php
    /*
        carica le sottocategorie da scegliere dinamicamente...
    */

    require_once("include_ajax.php");
    
    $key = $_GET['key'];
    @$sc = $_GET['sc'];
    
    if ( !@$sc ) $sc = '';
    
    if ( $key != '' ) {
      $str1=" SELECT ID, categoria FROM ecommercecategoria WHERE ID = $key LIMIT 1";          
      $risultato1=mysql_query($str1);
      $control1=mysql_fetch_row($risultato1);
      $cat = explode( '||', $control1[1] );
      
      if ( $cat[1] != '' ) {?>
        	<div class="float160">&nbsp;</div>
        	<div class="float140">Sotto-categoria:</div>
        	<div class="float300">
             <select name="sottocat" tabindex="7">
             <?php
                $cat[1] = substr( $cat[1], 0, strlen( $cat[1] ) - 2 );
                $sccat = explode( '--', $cat[1] );
                foreach( $sccat as $key => $val ) {
                    $sel = '';
                    if ( $val == $sc )
                        $sel = "selected='selected'";
                    echo "<option value=\"$val\" $sel>$val</option>";
                }
             ?>
             </select>
             </div>
            <div class="azzerafloat"><br></div>
      <?php
      }
    }
    ?>