-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Lug 03, 2012 alle 11:47
-- Versione del server: 5.5.16
-- Versione PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Bilug green dream`
--


--
-- Dump dei dati per la tabella `argomenti`
--

INSERT INTO `argomenti` (`ID`, `argomenti`, `menu_arg`, `id_lingua`) VALUES
(1, 'Prova', 1, 1);


--
-- Dump dei dati per la tabella `lingue`
--

INSERT INTO `lingue` (`id`, `sigla`, `lingua`, `img`, `attiva`) VALUES
(1, 'it', 'Italiano', '/img/bandierina-italia.gif', 1),
(2, 'en', 'English', '/img/bandierina-inghilterra.gif', 0),
(3, 'fr', 'Fran&ccedil;ais', '/img/bandierina-francia.gif', 0),
(4, 'de', 'Deutsch', '/img/bandierina-germania.gif', 0),
(5, 'es', 'Espa&ntilde;ol', '/img/bandierina-spagna.gif', 0),
(6, 'pt', 'Portugu&ecirc;s', '/img/bandierina-portogallo.gif', 0);

-- --------------------------------------------------------


--
-- Dump dei dati per la tabella `moduli`
--

INSERT INTO `moduli` (`ID`, `titolo`, `titvideo`, `titvideo_en`, `titvideo_es`, `titvideo_pt`, `titvideo_de`, `titvideo_fr`, `modulo`, `posizione`, `attivo`, `zona`, `ordine`) VALUES
(1, 'Funzione cerca', 'Cerca tra le news', NULL, NULL, NULL, NULL, NULL, 'index_cerca.php', 's', 'no', 't', 1),
(2, 'Men&ugrave; Argomenti', 'Argomenti', NULL, NULL, NULL, NULL, NULL, 'index_arg.php', 's', 'no', 't', 0),
(3, 'Galleria', 'Argomenti Galleria', NULL, NULL, NULL, NULL, NULL, 'index_gallerie.php', 's', 'no', 't', 0),
(4, 'Sondaggio Libero', 'Sondaggio', NULL, NULL, NULL, NULL, NULL, 'sondaggio.php', 's', 'no', 't', 3),
(5, 'Stato Online', '', NULL, NULL, NULL, NULL, NULL, 'online.php', 's', 'no', 't', 4),
(6, 'Pagine statiche', 'men&ugrave;', NULL, NULL, NULL, NULL, NULL, 'index_statichedb.php', 'd', 'si', 't', 0),
(7, 'Eventi Appuntamenti per tutti', 'Appuntamenti/Eventi', NULL, NULL, NULL, NULL, NULL, 'index_eventoapp.php', 's', 'no', 't', 0),
(8, 'Mailinglist', 'Mailing List', NULL, NULL, NULL, NULL, NULL, 'index_mailinglist.php', 'd', 'no', 't', 0),
(9, 'Login Utenti', 'Utenti Registrati', NULL, NULL, NULL, NULL, NULL, 'index_login.php', 'd', 'no', 't', 0),
(10, 'Donazioni', 'Sostienici', NULL, NULL, NULL, NULL, NULL, 'index_donazioni.php', 'd', 'no', 't', 4),
(11, 'pagamenti', 'Pagamenti Online', NULL, NULL, NULL, NULL, NULL, 'index_paypal.php', 'd', 'no', 't', 5),
(12, 'Sondaggi Interni', 'Sondaggio Interno', NULL, NULL, NULL, NULL, NULL, 'sondaggioutenti.php', 'c', 'no', 'u', 0),
(13, 'Notizie Interne', '', NULL, NULL, NULL, NULL, NULL, 'news.php', 'c', 'no', 'u', 1),
(14, 'News Flash', 'Notizie', NULL, NULL, NULL, NULL, NULL, 'index_news_flash.php', 'd', 'no', 't', 7),
(15, 'Eventi Flash', 'Eventi', NULL, NULL, NULL, NULL, NULL, 'index_eventiflash.php', 's', 'no', 't', 7),
(16, 'Modulo RSS', 'RSS', NULL, NULL, NULL, NULL, NULL, 'index_rss.php', 'd', 'no', 't', 0),
(17, 'Skype', '', NULL, NULL, NULL, NULL, NULL, 'index_skype.php', 's', 'no', 't', 6),
(18, 'Aggiuntivo Sinistra', NULL, NULL, NULL, NULL, NULL, NULL, '../custom/index_left.php', 'b', 'no', 't', 0),
(19, 'Aggiuntivo Destra', NULL, NULL, NULL, NULL, NULL, NULL, '../custom/index_right.php', 'd', 'no', 't', 11),
(21, 'Menu Alto laterale', NULL, NULL, NULL, NULL, NULL, NULL, 'index_menulat.php', 'a', 'no', 't', 1),
(22, 'Menu Laterale Completo', NULL, NULL, NULL, NULL, NULL, NULL, 'index_menu.php', 'd', 'no', 't', 2),
(23, 'Ricerca con Goolge', 'Cerca con Google', NULL, NULL, NULL, NULL, NULL, 'index_google.php', 's', 'no', 't', 0),
(24, 'Immagine Random', '', NULL, NULL, NULL, NULL, NULL, 'index_imgrandom.php', 's', 'no', 't', 9),
(25, 'Argomenti galleria nel corpo', 'Argomenti galleria', NULL, NULL, NULL, NULL, NULL, 'index_gallerie_corpo.php', 'c', 'no', 't', 27),
(26, 'NewsLetter', 'Newsletter', NULL, NULL, NULL, NULL, NULL, 'index_newsletter.php', 'd', 'no', 't', 1),
(28, 'Menu Laterale Completo con Lingua', NULL, NULL, NULL, NULL, NULL, NULL, 'index_menualto_ling.php', 'd', 'no', 't', 1),
(29, 'Menu Alto multiplo', '', NULL, NULL, NULL, NULL, NULL, 'index_menualtomultiplo.php', 'a', 'no', 't', 1),
(30, 'Menu multiplo laterale', '', NULL, NULL, NULL, NULL, NULL, 'index_menumultiplo.php', 'd', 'no', 't', 1),
(37, 'tendina', '', NULL, NULL, NULL, NULL, NULL, 'menu_tendina.php', 'a', 'no', 't', 1),
(39, 'according1', 'according 1', NULL, NULL, NULL, NULL, NULL, 'according1.php', 's', 'no', 't', 0),
(40, 'according2', 'according 2', NULL, NULL, NULL, NULL, NULL, 'according2.php', 's', 'no', 't', 1),
(41, 'according3', 'according 3', NULL, NULL, NULL, NULL, NULL, 'according3.php', 's', 'no', 't', 2),
(42, 'according4', 'according 4', NULL, NULL, NULL, NULL, NULL, 'according4.php', 's', 'no', 't', 3),
(38, 'according5', 'according 5', NULL, NULL, NULL, NULL, NULL, 'according5.php', 's', 'no', 't', 4),
(43, 'Google Adsense', 'Google Adsense', NULL, NULL, NULL, NULL, NULL, 'index_adsense.php', 's', 'no', 't', 0),
(44, 'ecommerce', 'E-commerce', NULL, NULL, NULL, NULL, NULL, 'ecommerce_modulo.php', 'd', 'no', 't', 2),
(46, 'ecommerce riservato', 'E-commerce login', NULL, NULL, NULL, NULL, NULL, 'ecommerce_login.php', 'a', 'no', 't', 0),
(47, 'ecommerce pubblico e riservato', 'E-commerce', NULL, NULL, NULL, NULL, NULL, 'ecommerce_modulo_pub_ris.php', 'd', 'no', 't', 0),
(48, 'Men&ugrave; argomenti 1', 'Argomenti 1', NULL, NULL, NULL, NULL, NULL, 'index_arg1.php', 'd', 'no', 't', 0),
(49, 'Men&ugrave; argomenti 2', 'Argomenti 2', NULL, NULL, NULL, NULL, NULL, 'index_arg2.php', 'd', 'no', 't', 0),
(50, 'Men&ugrave; argomenti 3', 'Argomenti 3', NULL, NULL, NULL, NULL, NULL, 'index_arg3.php', 'd', 'no', 't', 0),
(51, 'Men&ugrave; Argomenti 4', 'Argomenti 4', NULL, NULL, NULL, NULL, NULL, 'index_arg4.php', 'd', 'no', 't', 0),
(52, 'Men&ugrave; Argomenti 5', 'Argomenti 5', NULL, NULL, NULL, NULL, NULL, 'index_arg5.php', 'd', 'no', 't', 0),
(53, 'Siti partners', 'Partners', NULL, NULL, NULL, NULL, NULL, 'index_partners.php', 'd', 'no', 't', 0),
(54, 'NewsBox1', 'NewsBox1', NULL, NULL, NULL, NULL, NULL, 'index_newsbox1.php', 'd', 'si', 't', 1),
(55, 'NewsBox2', 'NewsBox2', NULL, NULL, NULL, NULL, NULL, 'index_newsbox2.php', 'b', 'no', 't', 0),
(56, 'NewsBox3', 'NewsBox3', NULL, NULL, NULL, NULL, NULL, 'index_newsbox3.php', 'b', 'no', 't', 0),
(57, 'NewsBox4', 'NewsBox4', NULL, NULL, NULL, NULL, NULL, 'index_newsbox4.php', 's', 'no', 't', 1),
(58, 'NewsBox5', 'NewsBox5', NULL, NULL, NULL, NULL, NULL, 'index_newsbox5.php', 's', 'no', 't', 1),
(59, 'Ecommerce cliccati', 'I pi&ugrave; ricercati', NULL, NULL, NULL, NULL, NULL, 'ecommerce_modulo_cliccati.php', 's', 'no', 't', 0),
(60, 'Notizie pi&ugrave; cliccate', 'Notizie pi&ugrave; viste', NULL, NULL, NULL, NULL, NULL, 'index_notizie_cliccate.php', 's', 'no', 't', 0),
(63, 'Multilingue Select', 'Scegli lingua', NULL, NULL, NULL, NULL, NULL, 'index_multilingue_select.php', 's', 'no', 't', 0),
(64, 'Multilingue Bandierine', 'Scegli lingua', NULL, NULL, NULL, NULL, NULL, 'index_multilingue_bandierine.php', 'a', 'no', 't', 2),
(65, 'Social Network', 'Social Network', NULL, NULL, NULL, NULL, NULL, 'index_social_network.php', 's', 'no', 't', 0),
(66, 'Intestazione', 'Intestazione', NULL, NULL, NULL, NULL, NULL, 'intestazione.php', 'a', 'si', 't', 0),
(67, 'Corpo principale pagina', 'Corpo', NULL, NULL, NULL, NULL, NULL, 'index_corpo.php', 'c', 'si', 't', 0),
(68, 'Pi&egrave; di pagina', 'Piede extra', NULL, NULL, NULL, NULL, NULL, '../custom/index_piedipagina.php', 'b', 'si', 't', 4),
(70, 'Bottoni a pi&egrave; di pagina', 'Bottoni a pi&egrave; di pagina', NULL, NULL, NULL, NULL, NULL, 'index_bottoni_pie.php', 'b', 'no', 't', 0),
(71, 'Sitemap', 'Sitemap', NULL, NULL, NULL, NULL, NULL, 'index_sitemap.php', 'b', 'no', 't', 0),
(72, 'Ultime news', 'Ultime news', NULL, NULL, NULL, NULL, NULL, 'index_ultime_news.php', 's', 'no', 't', 0),
(73, 'Notizie cliccate oggi', 'I pi&ugrave; ricercati oggi', NULL, NULL, NULL, NULL, NULL, 'index_notizie_cliccate_oggi.php', 's', 'no', 't', 0),
(74, 'Gestione TAG', 'TAG del sito', NULL, NULL, NULL, NULL, NULL, 'index_tag.php', 's', 'no', 't', 0),
(75, 'Accessibilit&agrave;', 'Accessibilit&agrave;', NULL, NULL, NULL, NULL, NULL, 'index_accessibilita.php', 'a', 'no', 't', 0),
(76, 'Link Social', 'Seguici su', NULL, NULL, NULL, NULL, NULL, 'index_link_social.php', 'b', 'no', 't', 2);

--
-- Dump dei dati per la tabella `newsbox`
--

INSERT INTO `newsbox` (`id`, `notizia`, `immagine`, `testo`, `modulo`, `id_lingua`) VALUES
(1, 1, '/custom/archivio/images/standard.jpg;', 'ecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis...', 1, 1),
(2, 0, '', 'ecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis...', 4, 1),
(3, 0, '', 'ecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis...', 4, 1),
(4, 0, '', 'ecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis...', 4, 1),
(5, 0, '', 'ecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis...', 5, 1);

--
-- Dump dei dati per la tabella `notizie`
--

INSERT INTO `notizie` (`ID`, `titolo`, `sottotitolo`, `description`, `keywords`, `testo`, `autore`, `argomento`, `data`, `link`, `autorizza`, `evidenzia`, `filmato`, `cliccato`, `cliccato_oggi`) VALUES
(1, 'Lorem ipsum dolor', '', '', '', '<h2>Lorem ipsum dolor</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem ipsum dolor</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem ipsum dolor</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem ipsum dolor</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem ipsum dolor</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor. Curabitur molestie. Duis velit augue, condimentum at, ultrices a, luctus ut, orci.</p>\r\n', 1, 1, '2013-03-12 17:09:39', '', 'si', 'no', 'O:11:"DatiFilmato":6:{s:4:"sito";s:7:"YouTube";s:3:"ris";s:1:"0";s:6:"codice";s:0:"";s:3:"rel";s:1:"1";s:5:"bordi";N;s:3:"pos";s:1:"0";}', 0, 0);


--
-- Dump dei dati per la tabella `parametri`
--

INSERT INTO `parametri` (`sezione`, `label`, `nomecampo`, `tipo`, `valore`) VALUES
(0, 'Corpo', '_CORPO', 0, './html/static.php'),
(1, 'Numero di Notizie visualizzate', '_MAX_ARG', 1, '20'),
(1, 'Numero di ultime notizie da visualizzare', '_MAX_LAST_ARG', 1, '5'),
(2, 'Numero di foto visualizzate per pagina', '_MAX_FOTO', 1, '12'),
(2, 'Larghezza disponibile per la galleria', '_MAX_SPAZIO', 1, '650'),
(2, 'Largezza miniature galleria', '_MAX_LARG_FOTO', 1, '150'),
(2, 'Larghezza foto galleria', '_MAX_LARGHEZZA', 1, '1024'),
(2, 'Altezza foto galleria', '_MAX_ALTEZZA', 1, '600'),
(2, 'Dimensione immagine massima', '_MAX_DIMENSIONE', 1, '3145728'),
(2, 'Dimensione watermark massima ', '_MAX_DIMENSIONE_W', 1, '3145728'),
(2, 'Dimensione altri file massima ', '_MAX_DIMENSIONE_A', 1, '3145728'),
(3, 'Largezza miniature galleria random', '_MAX_LARG_R', 1, '140'),
(3, 'Altezza miniature galleria random', '_MAX_ALT_R', 1, '140'),
(3, 'Descrizione massima foto', '_MAX_DESC', 1, '14'),
(2, 'Galleria di Default (se prima pagina)', '_DEFGAL', 0, 'anime_fantasy_a'),
(2, 'Argomento di Default (se prima pagina)', '_DEFARGGAL', 0, 'prova'),
(4, 'Mese Selezionato', '_MESE', 1, '10'),
(4, 'Anno selezionato', '_ANNO', 1, '2008'),
(1, 'Visualizza Data nelle news', '_DATA', 2, 'true'),
(1, 'Visualizza Autore nelle news', '_AUTORE', 2, 'true'),
(1, 'Colore 1 per VideoYoutube', '_COLOR1', 0, '0xbfd9f0'),
(1, 'Colore 2 per VideoYoutube', '_COLOR2', 0, '0xe7f3fd'),
(0, 'Voce di Menu per l''invio email ', '_TESTOEMAIL', 0, 'SCRIVICI'),
(0, 'Titolo Eventi / Appuntamenti', '_APPTITOLO', 0, 'Appuntamenti'),
(0, 'Nome visualizzato nelle e-mail delle newsletter', '_NOMENEWSLETTER', 0, 'Newsletter BiLugCMS <bilugcms@bilugcms.it>'),
(6, 'Num MAX per pi&ugrave; ricercati', '_MAXCLICCATIECOMMERCE', 1, '2'),
(1, 'Num MAX per pi&ugrave; ricercati', '_MAXCLICCATINEWS', 1, '3'),
(0, 'Bottone aggiuntivo pi&egrave;', '_BOTTONE_PIE', 0, 'http://www.nomesito.it'),
(0, 'Nome per le chiamate Skype', '_SKYPE', 0, ''),
(5, 'Pagina selezionata dalle statiche IT', '_STATICADB_IT', 1, '1'),
(5, 'Pagina selezionata dalle statiche EN', '_STATICADB_EN', 1, '1'),
(5, 'Pagina selezionata dalle statiche DE', '_STATICADB_DE', 1, '1'),
(5, 'Pagina selezionata dalle statiche FR', '_STATICADB_FR', 1, '1'),
(5, 'Pagina selezionata dalle statiche ES', '_STATICADB_ES', 1, '1'),
(5, 'Pagina selezionata dalle statiche PT', '_STATICADB_PT', 1, '1'),
(6, 'Pagina selezionata e-commerce IT', '_ECOMMERCEDB_IT', 1, '0'),
(6, 'Pagina selezionata e-commerce EN', '_ECOMMERCEDB_EN', 1, '0'),
(6, 'Pagina selezionata e-commerce DE', '_ECOMMERCEDB_DE', 1, '0'),
(6, 'Pagina selezionata e-commerce FR', '_ECOMMERCEDB_FR', 1, '0'),
(6, 'Pagina selezionata e-commerce ES', '_ECOMMERCEDB_ES', 1, '0'),
(6, 'Pagina selezionata e-commerce PT', '_ECOMMERCEDB_PT', 1, '0'),
(5, 'Modulo statiche HOME', '_MODULO_STATICHE_HOME', 0, ''),
(5, 'Modulo statiche SCRIVICI', '_MODULO_STATICHE_SCRIVICI', 0, ''),
(0, 'Lingua di default multilingue', '_LINGUADEFAULT', 0, 'IT'),
(0, 'Abilitazione Cluetip', '_CLUETIP', 2, 'false'),
(1, 'Abilita pulsante Facebook', '_SOCIAL_DINAMICHE_FB', 2, 'false'),
(1, 'Abilita pulsante Google plus', '_SOCIAL_DINAMICHE_GP', 2, 'false'),
(1, 'Abilita pulsante Twitter', '_SOCIAL_DINAMICHE_TW', 2, 'false'),
(1, 'Grandezza pulsanti ( 1=piccolo, 2=grande )', '_SOCIAL_DINAMICHE_SIZE', 1, '1'),
(5, 'Abilita pulsante Facebook', '_SOCIAL_STATICHE_FB', 2, 'false'),
(5, 'Abilita pulsante Goole plus', '_SOCIAL_STATICHE_GP', 2, 'false'),
(5, 'Abilita pulsante Twitter', '_SOCIAL_STATICHE_TW', 2, 'false'),
(5, 'Grandezza pulsanti ( 1=piccolo, 2=grande )', '_SOCIAL_STATICHE_SIZE', 1, '2'),
(0, 'Abilita pulsante Facebook', '_SOCIAL_SITO_FB', 2, 'false'),
(0, 'Abilita pulsante Google plus', '_SOCIAL_SITO_GP', 2, 'false'),
(0, 'Abilita pulsante Twitter', '_SOCIAL_SITO_TW', 2, 'false'),
(0, 'Grandezza pulsanti ( 1=piccolo, 2=grande )', '_SOCIAL_SITO_SIZE', 1, '2'),
(1, 'Posizione pulsanti ( 1=sopra, 2=sotto )', '_SOCIAL_DINAMICHE_POSITION', 1, '1'),
(5, 'Posizione pulsanti ( 1=sopra, 2=sotto )', '_SOCIAL_STATICHE_POSITION', 1, '1'),
(2, 'Abilita pulsante Facebook', '_SOCIAL_GALS_FB', 2, 'true'),
(2, 'Abilita pulsante Google plus', '_SOCIAL_GALS_GP', 2, 'true'),
(2, 'Abilita pulsante Twitter', '_SOCIAL_GALS_TW', 2, 'true'),
(2, 'Grandezza pulsanti ( 1=piccolo, 2=grande )', '_SOCIAL_GALS_SIZE', 1, '1'),
(2, 'Posizione pulsanti ( 1=sopra, 2=sotto )', '_SOCIAL_GALS_POSITION', 1, '1'),
(6, 'Abilita pulsante Facebook', '_SOCIAL_ECOMMERCE_FB', 2, 'false'),
(6, 'Abilita pulsante Google plus', '_SOCIAL_ECOMMERCE_GP', 2, 'false'),
(6, 'Abilita pulsante Twitter', '_SOCIAL_ECOMMERCE_TW', 2, 'false'),
(6, 'Grandezza pulsanti ( 1=piccolo, 2=grande )', '_SOCIAL_ECOMMERCE_SIZE', 1, '1'),
(6, 'Posizione pulsanti ( 1=sopra, 2=sotto )', '_SOCIAL_ECOMMERCE_POSITION', 1, '1'),
(0, 'Informazioni extra sitemap', '_INFO_SITEMAP', 0, '<p>Informazioni generali</p>'),
(0, 'Link per la visualizzazione degli RSS', '_FEED_RSS', 0, 'http://www.nomesito.it/custom/rss.xml');

--
-- Dump dei dati per la tabella `statiche`
--

INSERT INTO `statiche` (`ID`, `titolo`, `description`, `keywords`, `corpo`, `maps`, `ordine`, `id_lingua`) VALUES
(1, 'Lorem', '', '', '<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n', '', 1, 1),
(2, 'Lorem 2', '', '', '<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>Lorem Ipsum</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas feugiat consequat diam. Maecenas metus. Vivamus diam purus, cursus a, commodo non, facilisis vitae, nulla. Aenean dictum lacinia tortor. Nunc iaculis, nibh non iaculis aliquam, orci felis euismod neque, sed ornare massa mauris sed velit. Nulla pretium mi et risus. Fusce mi pede, tempor id, cursus ac, ullamcorper nec, enim. Sed tortor.</p>\r\n', '', 2, 1);



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
