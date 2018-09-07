<?php
namespace Rendu;

require 'Utils.php';
require 'Change.php';

class Rendu
{
    private $_verbose = false;

    public function optimalChange($fMonnaie)
    {
        $oChange = new Change();
        $aAvailableBillsCoins = $oChange->getAvailableBillsCoins();

        return $this->change($fMonnaie, $aAvailableBillsCoins);
    }

    public function change($fMonnaie, $aAvailableBillsCoins)
    {
        $oChange = new Change();

        $oChange->setVerbose($this->_verbose);

        if ($this->_verbose)
            echo "Monnaie: " . $fMonnaie . "\n";

        while ($fMonnaie > 0) {

            $bFound = false;

            if ($this->_verbose)
                echo "begin whith " . $fMonnaie . "\n";

            foreach($aAvailableBillsCoins as $fValue => $sName) {

                if ($this->_verbose)
                    echo "  check " . $sName . " whith value: " . $fValue . "\n";

                if ($fValue <= $fMonnaie) {

                    $fMonnaie = $fMonnaie - $fValue;
                    
                    $oChange->$sName++;

                    if ($this->_verbose) {
                        echo "    found!\n";
                        echo "  new monnaie is: " . $fMonnaie . "\n";
                    }

                    $bFound = true;

                    break;

                }

            }
            
            if ($bFound==false) {
                if ($this->_verbose) {
                    echo "  not found!\n";
                    break;
                }
            }

        }
        
        if ($fMonnaie>0)
            return false;

        return $oChange;
    }

    public function setVerbose(bool $bVerbose)
    {
        $this->_verbose = $bVerbose;
    }    
}