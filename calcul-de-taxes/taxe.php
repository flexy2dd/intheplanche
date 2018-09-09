<?php

require 'Taxe/Client.php';

Use Taxe\Client;
Use Taxe\Utils;

$oUtils = new Utils();
$aParams = $oUtils->parseParameters();

if (isset($aParams['help'])) {
    echo "Usage: " . $GLOBALS['argv'][0] . " [OPTION]\n\n";
    echo "Mandatory arguments.\n";
    echo "  --amount Montant Hors taxes \n";
    echo "  --rate   Taux de tva ex:19.6 \n";
    echo "Optional arguments.\n";
    echo "  --verbose verbose\n";
    echo "ex: php " . $GLOBALS['argv'][0] . " --amount=100 --rate=19.6 --verbose\n";
    die();
}

//check required parameters
$aRequired = array(
  'amount',
  'rate',
);
if ($oUtils->requiredOptions($aParams, $aRequired)) {
    die("\n" . $GLOBALS['argv'][0] . " needs the following options:\n\n\t- " . implode("\n\t- ", $aRequired) . "\n\nTry php " . $GLOBALS['argv'][0] . " --help\n\n");
}

$oTaxe = new Client();

//Set verbose
if (isset($aParams['verbose']))
    $oTaxe->setVerbose(true);

//perform change
try {
    $oChange = $oTaxe->calculVat($aParams['amount'], $aParams['rate']);
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    die();
}

echo "Result:\n";
$aPropertys = get_object_vars($oChange);
foreach($aPropertys as $kProperty => $vProperty) {
    echo " $kProperty : " . $oChange->$kProperty . "\n";
}
