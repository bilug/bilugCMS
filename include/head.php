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


<?php if ( _META_AUTHOR != '' ) : ?>
	<meta name="Author" content="<?=_META_AUTHOR?>">
<?php endif; ?>

<?php

// massimo 150 parole di description
include_once( "include/description.php" );
// keywords separate da virgola, senza spazi
include_once( "include/keywords.php" );
// Meta open graph per i social network
include_once( "include/meta_open_graph.php" );

?>

<?php if ( _LAYOUT_ALTERNATIVE ) : ?>
	<link rel="stylesheet" type="text/css" href="<?=_URLSITO?>/css/alternative.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<?php endif; ?>


<?php if ( _META_RATING != '' ) : ?>
	<meta name="rating" content="<?=_META_RATING?>">
<?php endif; ?>


