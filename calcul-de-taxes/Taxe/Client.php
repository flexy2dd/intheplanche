<?php
namespace Taxe;

require 'Utils.php';
require 'Taxes/Vat.php';

class Client
{
    private $_verbose = false;

    public function calculVat($fAmount, $fRate)
    {
        $oTaxe = new Taxes\Vat();
        $oTaxe->setVerbose($this->_verbose);
        $aResult = $oTaxe->calcul($fAmount, $fRate);

        if ($aResult==false)
            return null;

        return $oTaxe;
    }

    public function setVerbose(bool $bVerbose)
    {
        $this->_verbose = $bVerbose;
    }    
}