<?php

require_once "GestPayCrypt.inc.php";

$esercente = ""; //Inserire codice esercente Gestpay/Banca Sella
$amount = $_GET['amount'];
$transaction= $_GET['transaction'];

$crypt = new GestPayCrypt();

// parametri
$crypt->SetShopLogin($esercente); // Codice esercente
$crypt->SetShopTransactionID($transaction); // Identificativo transazione
$crypt->SetAmount($amount); // Importo
$crypt->SetCurrency("242"); // Codice valuta. 242 = euro

if (!$crypt->Encrypt()) {
	die("Errore: ".$crypt->GetErrorCode().": ".$crypt->GetErrorDescription()."\n");
}

$url = "https://ecomm.sella.it/gestpay/pagam.asp".
       "?a=".$crypt->GetShopLogin().
       "&b=".$crypt->GetEncryptedString();

header("Location: ".$url);

?>
