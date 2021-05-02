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

<div class="contenitore">
<form name="upload" method="post" action="area.php?pag=up.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?=$id?>"/>
<!-- il valore di id lo passiamo alla pagina di action con un campo nascosto -->
<h3>Scegliere per quale categoria effettuare l'upload:</h3>
<div class="azzerafloat"><br/></div>
<div class="float300"> &nbsp; </div>
<div class="float140">
<img src="./img/photo.png" class="ico" />	&nbsp; Immagini<br/>
</div>
<script type="text/javascript">

function openKCFinder(field) {
    window.KCFinder = {
        callBack: function(value) {
            document.getElementById(field).value = value;
        }
    };
    window.open('../kcfinder/browse.php?type=images	', 'kcfinder',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>

<div class="float100">
	<input type="button" class="medio" value="Sfoglia" onclick="openKCFinder('kc_file')" />
</div>

<div class="azzerafloat"><br/></div>
<div class="float300"> &nbsp; </div>
<div class="float140">
	
<img src="./img/file.png" class="ico" />	&nbsp; Materiale
</div>
<script type="text/javascript">

function openKCFinder1(field) {
    window.KCFinder = {
        callBack: function(value) {
            document.getElementById(field).value = value;
        }
    };
    window.open('../kcfinder/browse.php?type=files	', 'kcfinder',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>

<div class="float100">
	<input type="button" class="medio" value="Sfoglia" onclick="openKCFinder1('kc_file')" />
</div>
<div class="azzerafloat"><br/></div>
</form>
</div>





