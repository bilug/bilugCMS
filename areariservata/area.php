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
<?
require_once("auth.php");

$typo = $_SESSION['typo'];

include_once("../utility/versione.php");
include_once("./custom/headadm.html");
include_once("./custom/head.php");
include_once("./custom/scriptadm.html");

$pag = apici( $_GET['pag'] );

$visibile = '';
if ( $typo != 'A' )
	$visibile = "AND visibile='si'";

echo "<title>"._SITOADM."</title>";?> 
</head>

<div id="contenutoadm">
	<div id="testadm">
		<div id="logoadm">
			<?include_once("./custom/logoadm.html");?>			
		</div>		
	</div>
	<div id="centrale">
		<div id="corpoadm">
			<div class="contenitore">
				<button class="nascondi">Arrotola</button>
				<div class="nascondi">
					<div class="azzerafloat"></div>
					<div class="float187">
						<ul class="tab">
							<? if ($typo == "A") { ?>						
							<li><a title="|Gestione Menu Amministrazione" href="?pag=elenco_menuadmin.php"><img src="./img/utilities.png" class="menu-ico" />Gestione Permessi Admin</a></li>						
							<?}
	 						$stringamenu="SELECT menu,link,extra,descr FROM menuadmin where colonna=1 $visibile order by ordine"; 						
	  						$menu =mysql_query($stringamenu);
	  						if (mysql_num_rows($menu)>0)
	  						{
	  							while($inserire=mysql_fetch_row($menu))
	  							{
	  								echo "<li><a ";
	  								if ($inserire[3]!="")
	  								echo "class=\"$inserire[3]\" ";
	  								echo "href=\"?pag=$inserire[1]\">".$inserire[0];
	  								if ($inserire[2] !="") 
	  								{
										echo " (";	  							
		  								@include ($inserire[2]);
		  								echo ")";
		  							}  								
	  								echo "</a></li>";  								  								
	  							}
	  						}              
	                ?>
	                <li><a title="|Esci dall'area amministrativa" href="exit.php"><img src="./img/exit.png" class="menu-ico" />Exit</a></li>
						</ul>
					</div>
					<div class="float187">
						<ul class="tab">	
						<?
	 						$stringamenu="SELECT menu,link,extra,descr FROM menuadmin where colonna=2 $visibile order by ordine"; 						
	  						$menu =mysql_query($stringamenu);
	  						if (mysql_num_rows($menu)>0)
	  						{
	  							while($inserire=mysql_fetch_row($menu))
	  							{
	  								echo "<li><a ";
	  								if ($inserire[3]!="")
	  								echo "class=\"$inserire[3]\" ";
	  								echo "href=\"?pag=$inserire[1]\">".$inserire[0];
	  								if ($inserire[2] !="") 
	  								{
										echo " (";	  							
		  								@include ($inserire[2]);
		  								echo ")";
		  							};  								
	  								echo "</a></li>";  								  								
	  							}
	  						}              
	                ?>						
						</ul>
					</div>
					<div class="float187">
						<ul class="tab">
							<?
	 						$stringamenu="SELECT menu,link,extra,descr FROM menuadmin where colonna=3 $visibile order by ordine"; 						
	  						$menu =mysql_query($stringamenu);
	  						if (mysql_num_rows($menu)>0)
	  						{
	  							while($inserire=mysql_fetch_row($menu))
	  							{
	  								echo "<li><a ";
	  								if ($inserire[3]!="")
	  								echo "class=\"$inserire[3]\" ";
	  								echo "href=\"?pag=$inserire[1]\">".$inserire[0];
	  								if ($inserire[2] !="") 
	  								{
										echo " (";	  							
		  								@include ($inserire[2]);
		  								echo ")";
		  							} 								
	  								echo "</a></li>";  								  								
	  							}
	  						}              
	                ?>
						</ul>
					</div>
					<div class="float187">
						<ul class="tab">
							<?
	 						$stringamenu="SELECT menu,link,extra,descr FROM menuadmin where colonna=4 $visibile order by ordine"; 						
	  						$menu =mysql_query($stringamenu);
	  						if (mysql_num_rows($menu)>0)
	  						{
	  							while($inserire=mysql_fetch_row($menu))
	  							{
	  								echo "<li><a ";
	  								if ($inserire[3]!="")
	  								echo "class=\"$inserire[3]\" ";
	  								echo "href=\"?pag=$inserire[1]\">".$inserire[0];
	  								if ($inserire[2] !="") 
	  								{
										echo " (";	  							
		  								@include ($inserire[2]);
		  								echo ")";
		  							};  								
	  								echo "</a></li>";  								  								
	  							}
	  						}              
	                ?>
	               	<li><a target="_blank" title="|Informazioni sulla Versione del Server" href="ver.php">Visualizza Info Server</a></li>						
						</ul>
					</div>	
					<div class="float187">
						<ul class="tab">
						<?
	 						$stringamenu="SELECT menu,link,extra,descr FROM menuadmin where colonna=5 $visibile order by ordine"; 						
	  						$menu =mysql_query($stringamenu);
	  						if (mysql_num_rows($menu)>0)
	  						{
	  							while($inserire=mysql_fetch_row($menu))
	  							{
	  								echo "<li><a ";
	  								if ($inserire[3]!="")
	  								echo "class=\"$inserire[3]\" ";
	  								echo "href=\"?pag=$inserire[1]\">".$inserire[0];
	  								if ($inserire[2] !="") 
	  								{
										echo " (";	  							
		  								@include ($inserire[2]);
		  								echo ")";
		  							}  								
	  								echo "</a></li>";  								  								
	  							}
	  						}              
	                ?>						
						</ul>
					</div>
				</div>	
				<div class="azzerafloat"></div>				
			</div>
			<div class="azzerafloat"></div>
			<br/>
			<p>      
<?
include_once("control.php");
$cont=control($pag);
if($cont=="ok")
{
	$inizio = substr($pag,0,1); 
	if ($pag!="" AND $inizio!="/"  AND stristr($pag, 'http://')==FALSE  AND stristr($pag, 'ftp://')==FALSE  AND stristr($pag, 'https://')==FALSE)
	{
		//se $pag è diverso da nullo, allora includiamo il file linkato, sempre se esiste
	if (file_exists ($pag))
	{
		include ($pag);
		}
	else
	//se $pag è diverso da nullo ma il file linkato non esiste, allora includiamo un file di default
		include ("default.html");
	}
	else
		//se $pag è nullo, includiamo una pagina bianca
	include ("benvenuto.php");
}
?>            
</P>
		</div>
	</div>
	<div id="piedeadm">
		<?include_once("../custom/piedeadm.html");?>
		<p>
			<a class="del" href="http://www.bilug.it" title="|Official Site">
				<img src="./img/logo-bilug.gif" class="piedelogo" alt="BilugCMS" />
					<span class="versione">Admin Ver. <?=$versione?></span>
			</a>
		</p>     
	</div>
</div>
</body>

</html>
