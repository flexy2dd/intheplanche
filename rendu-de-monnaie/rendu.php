<?php

require 'Rendu/Rendu.php';

Use Rendu\Rendu;
Use Rendu\Utils;
Use Rendu\Change;

$oUtils = new Utils();
$aParams = $oUtils->parseParameters();

if (isset($aParams['help'])) {
    echo "Usage: " . $GLOBALS['argv'][0] . " [OPTION]\n";
    echo "performs a transaction.\n\n";

    echo "Mandatory arguments.\n";
    echo "  --change   vendor of transaction\n";
    echo "Optional arguments.\n";
    echo "  --verbose     verbose\n";
    echo "ex: php " . $GLOBALS['argv'][0] . " --env=staging --provider=GlobalCollect --country=FR --vendor=NEXWAYFR_PREP --currency=EUR --amount=100 --verbose\n";
    die();
}

//check required parameters
$aRequired = array(
  'change',
);
if ($oUtils->requiredOptions($aParams, $aRequired)) {
    die("\n" . $GLOBALS['argv'][0] . " needs the following options:\n\n\t- " . implode("\n\t- ", $aRequired) . "\n\nTry php " . $GLOBALS['argv'][0] . " --help\n\n");
}

$oRendu = new Rendu();

//Set verbose
if (isset($aParams['verbose']))
    $oRendu->setVerbose(true);

//perform change
$oChange = $oRendu->optimalChange($aParams['change']);

if ($oChange===false) {
    echo "No solutions found :(\n";
    die();
}

echo "Result:\n";
echo " Total of coin 2 : " . $oChange->coin2 . "\n";
echo " Total of bill 5 : " . $oChange->bill5 . "\n";
echo " Total of bill 10: " . $oChange->bill10 . "\n";

