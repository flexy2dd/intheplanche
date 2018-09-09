<?php
namespace MakeChange;

require 'Utils.php';
require 'Change.php';

class Client
{
    private $_verbose = false;

    public function optimalChange($iAmount)
    {
        if (($iAmount>2147483647) || ($iAmount<0)) {
        	  throw new \Exception("Le montant doit etre compris entre 0 et 2147483647");
        }

        $oChange = new Change();
        $oChange->setVerbose($this->_verbose);

        $aResult = $oChange->getOptimalChange($iAmount);

        if ($aResult==false)
            return null;

        return $oChange;
    }

    public function setVerbose(bool $bVerbose)
    {
        $this->_verbose = $bVerbose;
    }    
}