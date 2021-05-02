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
<script type="text/javascript">
$(function(){
	var i = 1000;
	var sin = 5;
	var alto = 15;
	$('#navtop li > ul').each(function(event){
		var parent_li = $(this).parent('li');
		var last = $(this).closest('li').position();		 		 	
		$(this).css({'position':'absolute','left':last.left+sin,'top':last.top+alto,'z-index':i++});
		$(this).css({'border-right':'3px solid #000','border-bottom':'3px solid #000'});
		$(this).addClass('menum');
		$(this).find('a').addClass('menum')
		$(this).children('li').addClass('menum');
		var sub_ul = $(this).remove();		
		parent_li.find('a').hoverIntent({
		over: function(event){sub_ul.slice(0,1).slideDown('fast');event.preventDefault();}
		,internal: 10,out: {}});
		$(this).hoverIntent({over:{},timeout:500,
			out: function(event){sub_ul.slice(0,1).slideUp('fast');event.preventDefault();}});		
		parent_li.append(sub_ul)});
	$('#navtop ul ul').hide();
	$('#navtop a').not('a.menum').each(function(event){
		$(this).hover(function(event){$('#navtop ul ul').slideUp('fast');event.preventDefault();});
	});	
});
</script>
<?
	require_once("../utility/funzioni.php");
	$menu = Crea_Menu();
	echo $menu;
?>
