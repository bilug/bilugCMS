-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 15 giu, 2010 at 03:08 PM
-- Versione MySQL: 5.1.41
-- Versione PHP: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bilugvuoto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `acquisti`
--

CREATE TABLE IF NOT EXISTS `acquisti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `utente` varchar(100) NOT NULL,
  `articolo` varchar(255) NOT NULL,
  `codice` varchar(50) NOT NULL,
  `prezzo` float NOT NULL,
  `importo` float NOT NULL,
  `spedizione` float NOT NULL,
  `mail` varchar(200) NOT NULL,
  `indirizzo` varchar(200) NOT NULL,
  `citta` varchar(100) NOT NULL,
  `cap` varchar(10) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `reso` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `acquisti`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `anagrafica`
--

CREATE TABLE IF NOT EXISTS `anagrafica` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text,
  `cognome` text,
  `email` text,
  `pwd` text,
  `admin` tinytext,
  `data` text,
  `sesso` tinytext,
  `eta` int(11) DEFAULT NULL,
  `citta` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dump dei dati per la tabella `anagrafica`
--

INSERT INTO `anagrafica` (`ID`, `nome`, `cognome`, `email`, `pwd`, `admin`, `data`, `sesso`, `eta`, `citta`) VALUES
(1, 'bilug', 'bilug', 'bilug', '9cc79d0cb2dc820b830126eed554e07d', 'A', '2005-01-01', 'M', 2, 'Biella'),
(2, 'utente1', 'utente1', 'utente', '10c8bd35a3891f052b8d0d39f6e9626f', 'U', '2009-03-26', 'M', 3, ''),
(3, 'super', 'super', 'super', '6463b5e2d989604c2c8fd1b0a30b2d13', 'S', '2009-04-09', 'M', 0, '');

-- --------------------------------------------------------

--
-- Struttura della tabella `argomenti`
--

CREATE TABLE IF NOT EXISTS `argomenti` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `argomenti` text NOT NULL,
  `menu_arg` int(2) NOT NULL,
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE IF NOT EXISTS `carrello` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `codice` varchar(50) NOT NULL,
  `utente` varchar(100) NOT NULL,
  `prezzo` float NOT NULL,
  `spedizione` float NOT NULL,
  `data` date NOT NULL,
  `nome` varchar(200) NOT NULL,
  `cognome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `indirizzo` text NOT NULL,
  `cap` varchar(10) NOT NULL,
  `citta` varchar(200) NOT NULL,
  `importo` float NOT NULL,
  `elimina` boolean NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `carrello`
--


-- --------------------------------------------------------


--
-- Struttura della tabella `cerca`
--

CREATE TABLE IF NOT EXISTS `cerca` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `query` varchar(200) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------


--
-- Struttura della tabella `collegamento_tag`
--

CREATE TABLE IF NOT EXISTS `collegamento_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tag` int(11) NOT NULL,
  `id_notizia` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Struttura della tabella `datirss`
--

CREATE TABLE IF NOT EXISTS `datirss` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `vimage` varchar(2) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `datirss`
--

INSERT INTO `datirss` (`ID`, `titolo`, `descrizione`, `copyright`, `image`, `vimage`) VALUES
(1, 'BiLUG - Biella Linux User Group', 'CMS progettato dai membri del BiLUG - Biella Linux User Group', '2008/2010 BiLUG - Biella Linux User Group', 'tux.jpg', 'no');

-- --------------------------------------------------------

--
-- Struttura della tabella `ecommerce`
--

CREATE TABLE IF NOT EXISTS `ecommerce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `descrizione` text,
  `schedatecnica` varchar(255) NOT NULL,
  `categoria` int(5) NOT NULL,
  `disponibile` tinyint(1) NOT NULL,
  `mercato` varchar(255) NOT NULL,
  `segmento` varchar(255) NOT NULL,
  `modello` varchar(255) NOT NULL,
  `peso` float(10,4) NOT NULL,
  `peso_volume` float(10,4) NOT NULL,
  `prezzo` float NOT NULL,
  `quantita` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT 'standard.jpg',
  `fotofacoltative` text NOT NULL,
  `codice` varchar(15) NOT NULL,
  `ean` varchar(50) NOT NULL,
  `weee` float(5,2) NOT NULL,
  `tassa_privacy` float(5,2) NOT NULL,
  `produttore` varchar(50) NOT NULL,
  `codice_produttore` varchar(255) NOT NULL,
  `spedizione` float NOT NULL,
  `spedizione_express` float(10,2) NOT NULL,
  `riservato` int(1) NOT NULL,
  `prezzo_intero` float NOT NULL,
  `colore` varchar(100) NOT NULL,
  `taglia` varchar(100) NOT NULL,
  `evidenzia` int(1) NOT NULL,
  `offerta` int(1) NOT NULL,
  `cliccato` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `ecommerce`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `ecommercecategoria`
--

CREATE TABLE IF NOT EXISTS `ecommercecategoria` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  `id_padre` int(5) NOT NULL,
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `ecommercecategoria`
--


--
-- Struttura della tabella `ecommerce riservato`
--

CREATE TABLE IF NOT EXISTS `ecommerceris` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text,
  `note` text,
  `pwd` text,
  `data` text,
  `articoli` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Dumping data for table `ecommerceris`
--

INSERT INTO `ecommerceris` (`ID`, `nome`, `note`, `pwd`, `data`, `articoli`) VALUES
(1, 'Utente riservato', 'Utente che vede una scelta di articoli', 'password', '2011-04-04', '');




-- --------------------------------------------------------

--
-- Struttura della tabella `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `email` text NOT NULL,
  `ord` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ord` (`ord`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Dump dei dati per la tabella `email`
--

INSERT INTO `email` (`ID`, `nome`, `email`, `ord`) VALUES
(1, 'bilug', 'bilug@bilug.it', 1);



-- --------------------------------------------------------

--
-- Struttura della tabella `eventi`
--

CREATE TABLE IF NOT EXISTS `eventi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(1) NOT NULL,
  `dataora` datetime NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `luogo` varchar(255) NOT NULL,
  `descrizione` text,
  `idutente` int(11) NOT NULL,
  `link` int(11) NOT NULL,
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `eventi`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `galleria`
--

CREATE TABLE IF NOT EXISTS `galleria` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_padre` int(5) NOT NULL,
  `cartella` varchar(255) NOT NULL,
  `immagine` varchar(255) NOT NULL,
  `descrizione` text NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `immagine` (`immagine`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `galleria`
--


-- --------------------------------------------------------


--
-- Struttura della tabella `generale`
--

CREATE TABLE IF NOT EXISTS `generale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_ultimo_accesso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `generale`
--

INSERT INTO `generale` (`id`, `data_ultimo_accesso`) VALUES
(1, NOW());


-- --------------------------------------------------------


--
-- Struttura della tabella `gruppi_newsletter`
--

CREATE TABLE IF NOT EXISTS `gruppi_newsletter` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `gruppi_newsletter`
--

INSERT INTO `gruppi_newsletter` (`id`, `nome`) VALUES
(1, 'GENERALE');


-- --------------------------------------------------------


--
-- Struttura della tabella `lingue`
--

CREATE TABLE IF NOT EXISTS `lingue` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) NOT NULL,
  `lingua` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `attiva` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Struttura della tabella `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `utente` text NOT NULL,
  `data` varchar(50) NOT NULL,
  `ip` text NOT NULL,
  `browser` text NOT NULL,
  `tipo` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `log`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `maillist`
--

CREATE TABLE IF NOT EXISTS `maillist` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `mail` text NOT NULL,
  `attivo` tinytext NOT NULL,
  `argomenti` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `maillist`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sez` varchar(1) NOT NULL,
  `voce` varchar(255) NOT NULL,
  `Liv` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `menu`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `menuadmin`
--

CREATE TABLE IF NOT EXISTS `menuadmin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `menu` text NOT NULL,
  `link` text NOT NULL,
  `extra` text,
  `descr` text,
  `permessi` tinytext NOT NULL,
  `colonna` int(11) NOT NULL,
  `ordine` int(11) NOT NULL,
  `visibile` varchar(2) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Dump dei dati per la tabella `menuadmin`
--

INSERT INTO `menuadmin` (`ID`, `menu`, `link`, `extra`, `descr`, `permessi`, `colonna`, `ordine`, `visibile`) VALUES
(7, 'Gestione Utenti', 'elenco_utenti.php', '', 'Elenca Utenti del sito', 'AS', 1, 4, 'si'),
(9, 'Gestione Argomenti', 'elenco_arg.php', '', 'Elenco Argomenti', 'AS', 2, 6, 'si'),
(11, 'Gestione Pagine Statiche', 'elenco_statiche.php', '', 'Elenco pagine Statiche', 'AS', 1, 8, 'si'),
(14, 'Gestione Pagine Dinamiche', 'elenco_notargaut.php', '', 'Elenco Notizie presenti ', 'AS', 2, 10, 'si'),
(15, 'Pagine da Autorizzare', 'elenco_nonaut_notizie.php', 'daautorizzare.php', 'Elenco Notizie Inserite dagli Utenti da Autorizzare', 'AS', 2, 11, 'si'),
(17, 'Gestione Sondaggi', 'elenco_sondaggi.php', '', 'Gestione Sondaggi', 'ASU', 2, 13, 'si'),
(19, 'Gestione Eventi/App.', 'elenco_eventoapp.php', '', 'Gestione Eventi e/o Appuntamenti', 'ASU', 2, 15, 'si'),
(21, 'Gestione Mailing-List', 'elenco_nletter.php', '', 'Elenco Mailing-List', 'AS', 4, 18, 'si'),
(22, 'Upload Materiale', 'uploadi.php', '', 'Caricamento Immagini o Materiale', 'AS', 3, 19, 'si'),
(52, 'Elenco File', 'listafile.php&dir=../custom/archivio&titolo=File Archiviati sul Server:', NULL, 'Elenco File Memorizzati sul server', 'AS', 3, 22, 'si'),
(26, 'Gestione Gallerie', 'elenco_arg_gallerie.php', '', 'Elenco Delle Gallerie Presenti per Argomento', 'AS', 3, 24, 'si'),
(27, 'Gestione Watermarker', 'uploadw.php', '', 'Inserimento trademark nelle immagini in Galleria', 'A', 3, 25, 'si'),
(29, 'Elenco Notizie Interne', 'elenco_notizieint.php', '', 'Elenco Notizie Interne', 'ASU', 3, 28, 'si'),
(30, 'Visualizza Log', 'log.php', '', 'Visualizza dati di Collegamento al SIto', 'A', 4, 30, 'si'),
(31, 'Backup db', 'dbbackup.php', '', 'Salvataggio Dati Db', 'A', 4, 31, 'si'),
(34, 'Gestione Dinamica Moduli', 'elenco_moduli_new.php', '', 'Gestione Moduli presenti, modifica e annullo', 'AS', 3, 17, 'si'),
(35, 'Dati pagamenti Paypal', 'insert_datipag.php', '', 'Dati per Pagamenti Online  Tramite Paypal', 'AS', 4, 34, 'si'),
(39, 'Modifica Dati RSS', 'insert_datirss.php', '', 'Inserimento Dati per Creazione Rss', 'A', 5, 40, 'si'),
(42, 'Rubrica Contatti', 'elenco_rubrica.php', '', 'Rubrica Contatti', 'AS', 1, 42, 'si'),
(43, 'Gestione Newsletter', 'elenco_newsletter.php', '', 'Visualizza registrati alla newsletter per confermarli e/o annullarli', 'AS', 4, 27, 'si'),
(45, 'Modifica CSS', 'insert_css.php', '', 'Permette di aggiungere o modificare il css al volo', 'A', 5, 45, 'si'),
(46, 'Modifica Template NL', 'insert_templatemail.php', '', 'Modifica il template per l`email della Newsletter', 'A', 4, 29, 'si'),
(47, 'Parametri del Sito', 'insert_param.php', '', 'Modifica dei Parametri runtime', 'A', 5, 46, 'si'),
(48, 'Scelta HomePage', 'insert_pagdef.php', '', 'Selezione della pagina principale da visualizzare', 'AS', 5, 47, 'si'),
(50, 'Gestione Email', 'elenco_email.php', '', 'Elenco email inserite per il modulo scrivimi', 'AS', 1, 41, 'si'),
(53, 'Gestione dei Menu', 'elenco_menu_new.php', '', 'elenco menu tendina e according', 'AS', 2, 49, 'si'),
(55, 'Modifica Profilo Utente', 'profilo.php', '', '', 'AS', 5, 51, 'si'),
(56, 'Google Adsense Modulo', 'insert_adsensemod.php', '', '', 'AS', 1, 53, 'si'),
(57, 'Google Adsense News', 'insert_adsensenews.php', '', '', 'AS', 1, 54, 'si'),
(58, 'E-commerce', 'elenco_ecommerce_categorie.php', '', 'ecommerce', 'AS', 2, 55, 'si'),
(59, 'Personalizza Contatti', 'personalizza_form.php', '', 'personalizza il form dei contatti', 'A', 3, 56, 'si'),
(60, 'Google Analytics', 'insert_google_analytics.php', '', '', 'AS', 1, 57, 'si'),
(61, 'Gestione partners', 'elenco_partners.php', '', 'Gestione dei siti partners  o link amici ', 'A', 2, 50, 'si'),
(62, 'Gestione newsbox', 'elenco_newsbox.php', '', 'Crea dei box per le news nel sito', 'A', 3, 34, 'si'),
(63, 'Pi&egrave; di pagina', 'insert_piedipagina.php', '', '', 'A', 5, 45, 'si'),
(64, 'Gestione Multillingue', 'elenco_multilingue.php', '', 'Cambia la lingua di default', 'A', 4, 16, 'si'),
(65, 'Gestione TAG', 'gestione_tag.php', '', 'Gestisci i tag per le pagine dinamiche', 'A', 2, 7, 'si'),
(66, 'Disqus code comments', 'insert_disqus_code_comments.php', '', 'Inserire qui il codice universale di Disqus per i commenti sulle pagine dinamiche', 'AS', 1, 58, 'si'),
(67, 'Gestione social', 'elenco_social.php', '', 'Elenco dei link social', 'AS', 5, 38, 'si');

-- --------------------------------------------------------

--
-- Struttura della tabella `menutipo`
--

CREATE TABLE IF NOT EXISTS `menutipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `tipo` varchar(3) NOT NULL,
  `idpadre` int(11) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `tipolink` varchar(2) NOT NULL,
  `posizione` int(11) NOT NULL,
  `descrizione` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL,
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Struttura della tabella `menuvoci`
--

CREATE TABLE IF NOT EXISTS `menuvoci` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `IDmenu` int(11) NOT NULL,
  `voce` varchar(255) NOT NULL,
  `ordine` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL,
  `stat` varchar(2) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`ID`),
  KEY `IDmenu` (`IDmenu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `menuvoci`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `moduli`
--

CREATE TABLE IF NOT EXISTS `moduli` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(255) NOT NULL,
  `titvideo` varchar(255) DEFAULT NULL,
  `titvideo_en` varchar(255) DEFAULT NULL,
  `titvideo_es` varchar(255) DEFAULT NULL,
  `titvideo_pt` varchar(255) DEFAULT NULL,
  `titvideo_de` varchar(255) DEFAULT NULL,
  `titvideo_fr` varchar(255) DEFAULT NULL,   
  `modulo` varchar(255) NOT NULL,
  `posizione` varchar(255) NOT NULL,
  `attivo` varchar(2) NOT NULL,
  `zona` varchar(1) NOT NULL,
  `ordine` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Struttura della tabella `newsbox`
--

CREATE TABLE IF NOT EXISTS `newsbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notizia` int(11) NOT NULL,
  `immagine` varchar(200) NOT NULL,
  `testo` text NOT NULL,
  `modulo` int(1) NOT NULL,
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



--
-- Struttura della tabella `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `stato` tinyint(1) NOT NULL DEFAULT '-1',
  `code` varchar(255) NOT NULL,
  `log` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gruppo` int(5) NOT NULL,
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `newsletter`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `notizie`
--

CREATE TABLE IF NOT EXISTS `notizie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` text NOT NULL,
  `sottotitolo` text NOT NULL,
  `description` varchar(160) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `testo` text NOT NULL,
  `autore` int(11) NOT NULL DEFAULT '0',
  `argomento` int(11) NOT NULL DEFAULT '0',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `link` text,
  `autorizza` tinytext NOT NULL,
  `evidenzia` tinytext NOT NULL,
  `filmato` varchar(255) DEFAULT NULL,
  `cliccato` int(11) NOT NULL,
  `cliccato_oggi` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `notizie`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `notizieint`
--

CREATE TABLE IF NOT EXISTS `notizieint` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` text NOT NULL,
  `sottotitolo` text NOT NULL,
  `testo` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `link` text,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `notizieint`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--

CREATE TABLE IF NOT EXISTS `pagamento` (
  `ID` int(11) NOT NULL DEFAULT '1',
  `business` varchar(255) NOT NULL,
  `no_shipping` varchar(1) NOT NULL,
  `quantity` varchar(2) NOT NULL,
  `cancel_return` varchar(255) NOT NULL,
  `cn` varchar(255) NOT NULL,
  `cbt` varchar(255) NOT NULL,
  `no_note` varchar(1) NOT NULL,
  `returnok` varchar(255) NOT NULL,
  `rm` varchar(1) NOT NULL,
  `currency_code` varchar(4) NOT NULL,
  `lc` varchar(4) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `pagamento`
--

INSERT INTO `pagamento` (`ID`, `business`, `no_shipping`, `quantity`, `cancel_return`, `cn`, `cbt`, `no_note`, `returnok`, `rm`, `currency_code`, `lc`, `image_url`) VALUES
(1, 'bilug@bilug.com', '1', '1', '#', 'Altre Informazioni: BiLUG, Biella Linux User Group, associzione di volontariato senza fini di lucro', 'Ritorno al sito', '1', 'http://www.nomesito.it/transazione-effettuata-paypal/', '2', 'EUR', 'IT', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `parametri`
--

CREATE TABLE IF NOT EXISTS `parametri` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `sezione` tinyint(4) NOT NULL,
  `label` varchar(100) NOT NULL,
  `nomecampo` varchar(50) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `valore` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


--
-- Dump dei dati per la tabella `parametri`
--

INSERT INTO `parametri` (`sezione`, `label`, `nomecampo`, `tipo`, `valore`) VALUES
(0, 'URL del sito', '_URLSITO', 0, 'http://www.nomesito.it'),
(0, 'Nome Sito', '_SITO', 0, 'BilugCMS'),
(0, 'Slogan Sito', '_SLOGAN', 0, 'Free CMS dedicato al bilug'),
(0, 'Nome Area Amministrativa', '_SITOADM', 0, 'Amministrazione'),
(0, 'Meta header Societ&agrave;  per i motori di ricerca in Head.php', '_META_SOCIETY', 0, 'BilugCMS'),
(0, 'Meta header  per i motori di ricerca in Head.php', '_META_AUTHOR', 0, 'Federico Villa, Mirko Camarda'),
(0, 'Meta header Description per i motori di ricerca in Head.php', '_META_DESCRIPTION', 0, 'Questo &egrave; un sito creato col bilugCMS, un modo per gestire in maniera semplice un sito dinamico.'),
(0, 'Meta header Keywords per i motori di ricerca in Head.php', '_META_KEYWORDS', 0, ''),
(0, 'Meta header Rating per i motori di ricerca in Head.php', '_META_RATING', 0, 'Educational'),
(0, 'Licenza', '_LICENCE', 0, 'License\r\n\r\nBilugCMS (http://www.bilug.it) - Content Management System for dynamic web sites\r\n\r\nCopyright (C) 2005-2008  Federico Villa and Alessio Loro Piana\r\n\r\n\r\n\r\nThis program is free software: you can redistribute it and/or modify\r\n\r\nit under the terms of the GNU General Public License as published by\r\n\r\nthe Free Software Foundation, either version 2 of the License.\r\n\r\n\r\n\r\nThis program is distributed in the hope that it will be useful,\r\n\r\nbut WITHOUT ANY WARRANTY; without even the implied warranty of\r\n\r\nMERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the\r\n\r\nGNU General Public License for more details.\r\n\r\n\r\n\r\nYou should have received a copy of the GNU General Public License\r\n\r\nalong with this program.  If not, see <http://www.gnu.org/licenses/>.\r\n\r\n\r\n\r\nFor reference, contact bilugcms@vilnet.it\r\n\r\n\r\n\r\nLicense'),
(0, 'Abilita la compressione GZIP', '_COMPRESSIONE_GZIP', 2, 'false'),
(0, 'Larghezza max foto upload kcfinder', '_KCFINDER_MAX_WIDTH', 1, '800'),
(0, 'Altezza max foto upload kcfinder', '_KCFINDER_MAX_HEIGHT', 1, '550'),
(0, 'Larghezza thumbs foto kcfinder', '_KCFINDER_WIDTH', 1, '200'),
(0, 'Altezza thumbs foto kcfinder', '_KCFINDER_HEIGHT', 1, '200'),
(0, 'Template del sito', '_TEMPLATE', 0, ''),
(0, 'Layout alternativo per dispositivi mobili', '_LAYOUT_ALTERNATIVE', 2, 'true'),
(0, 'Abilitazione breadcrumbs', '_ABILITA_BREADCRUMBS', 2, 'false'),
(6, 'Possibilit&agrave; di indicare la presenza di pacco regalo', '_ECOMMERCE_PACCO_REGALO', 2, 'false'),
(1, 'Abilitazione dei commenti nelle pagine', '_DISQUS_BLOG_COMMENTS', 2, 'false'),
(6, 'Massimo giorni per effettuare il reso', '_ECOMMERCE_RESO_MAX_GIORNI', 1, '7'),
(1, 'Abilita navigazione articolo successivo e precedente', '_NEWS_NAVIGAZIONE_ARTICOLI', 2, 'false');


--
-- Struttura della tabella `partners`
--

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `link` varchar(200) NOT NULL,
  `link_video` varchar(100) NOT NULL,
  `ordine` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `partners`
--


-- --------------------------------------------------------


--
-- Struttura della tabella `phpmysqlautobackup`
--

CREATE TABLE IF NOT EXISTS `phpmysqlautobackup` (
  `id` int(11) NOT NULL,
  `version` varchar(6) DEFAULT NULL,
  `time_last_run` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `phpmysqlautobackup`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `rubrica`
--

CREATE TABLE IF NOT EXISTS `rubrica` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ragsoc` varchar(255) NOT NULL,
  `ragsoc1` varchar(255) DEFAULT NULL,
  `ragsoc2` varchar(255) DEFAULT NULL,
  `citta` varchar(50) DEFAULT NULL,
  `cap` smallint(5) unsigned DEFAULT NULL,
  `prov` varchar(2) DEFAULT NULL,
  `tel` text,
  `email` text,
  `note` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ragsoc` (`ragsoc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Struttura della tabella `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Struttura della tabella `sondaggi`
--

CREATE TABLE IF NOT EXISTS `sondaggi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(200) NOT NULL,
  `attivo` varchar(2) NOT NULL DEFAULT 'no',
  `opzioni` text NOT NULL,
  `totali` text NOT NULL,
  `maxvoti` int(11) NOT NULL DEFAULT '0',
  `multipli` varchar(2) NOT NULL DEFAULT 'no',
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `utenti` varchar(2) NOT NULL DEFAULT 'no',
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `sondaggi`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `spedizione`
--

CREATE TABLE IF NOT EXISTS `spedizione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `minore` int(11) NOT NULL,
  `maggiore` int(11) NOT NULL,
  `prezzo` float NOT NULL,
  `standard` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dump dei dati per la tabella `spedizione`
--


-- --------------------------------------------------------


--
-- Struttura della tabella `statiche`
--

CREATE TABLE IF NOT EXISTS `statiche` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` text NOT NULL,
  `description` varchar(160) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `corpo` longtext NOT NULL,
  `maps` text NOT NULL,
  `ordine` int(11) NOT NULL DEFAULT '0',
  `id_lingua` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------


--
-- Struttura della tabella `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_tag` varchar(100) NOT NULL,
  `link_tag` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------


--
-- Struttura della tabella `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `cartella` varchar(50) CHARACTER SET utf8 NOT NULL,
  `nome` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `templates`
--

INSERT INTO `templates` (`id`, `cartella`, `nome`) VALUES
(1, 'default', 'Template di default'),
(2, 'agricoltura', 'Template agricoltura'),
(3, 'vetrina-professionale', 'Template vetrina professionale'),
(4, 'green-dream', 'Template green dream'),
(5, 'diving', 'Template diving'),
(6, 'bilug', 'Template Bilug'),
(7, 'default-shop', 'Template E-commerce di default'),
(8, 'magunet', 'Template per blog personalizzato magunet'),
(9, 'stanto', 'Template base a due colonne');


-- --------------------------------------------------------


--
-- Struttura della tabella `voti`
--

CREATE TABLE IF NOT EXISTS `voti` (
  `ID` int(11) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `voto` int(11) NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `voti`
--

