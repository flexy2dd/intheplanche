<?php

require 'MakeChange/Client.php';

Use MakeChange\Client;
Use MakeChange\Utils;
Use MakeChange\Change;

$oUtils = new Utils();
$aParams = $oUtils->parseParameters();

if (isset($aParams['help'])) {
    echo "Usage: " . $GLOBALS['argv'][0] . " [OPTION]\n\n";
    echo "Mandatory arguments.\n";
    echo "  --change  Montant a rendre\n";
    echo "Optional arguments.\n";
    echo "  --verbose verbose\n";
    echo "ex: php " . $GLOBALS['argv'][0] . " --change=6 --verbose\n";
    die();
}

//check required parameters
$aRequired = array(
  'change',
);
if ($oUtils->requiredOptions($aParams, $aRequired)) {
    die("\n" . $GLOBALS['argv'][0] . " needs the following options:\n\n\t- " . implode("\n\t- ", $aRequired) . "\n\nTry php " . $GLOBALS['argv'][0] . " --help\n\n");
}

$oRendu = new Client();

//Set verbose
if (isset($aParams['verbose']))
    $oRendu->setVerbose(true);

//perform change
try {
    $oChange = $oRendu->optimalChange((int)$aParams['change']);
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
    die();
}

if (is_null($oChange)) {
    echo "Pas de solution :(\n";
    die();
}

echo "Result:\n";
$aPropertys = get_object_vars($oChange);
foreach($aPropertys as $kProperty => $vProperty) {
    echo " Total of $kProperty : " . $oChange->$kProperty . "\n";
}
