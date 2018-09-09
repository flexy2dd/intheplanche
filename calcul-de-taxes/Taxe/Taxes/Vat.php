<?php
namespace Taxe\Taxes;

class Vat
{
    private $_verbose = false;
    public  $rate     = 0;
    public  $amountHt   = 0;
    public  $amountTtc = 0;
    
    // Contructor
    public function __construct()
    {
    }

    // set verbose
    public function setVerbose(bool $bVerbose)
    {
        $this->_verbose = $bVerbose;
    }

    // log
    public function log($sMessage)
    {
        if ($this->_verbose)
            echo $sMessage . "\n";
    }

    // calcul vat
    public function calcul($fAmountHt, $fRate)
    {
    	  $this->amountHt = $fAmountHt;
    	  $this->rate   = $fRate;
    	  
        $fVat = $this->rate/100;
        $this->amountTtc = $this->amountHt * (1 + $fVat);
        
//$montarifttc = montarifht * (1 + $tva);
//$montarifht = montarifttc / (1 + $tva);
        return true;
    }
}