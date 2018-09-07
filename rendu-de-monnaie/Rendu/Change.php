<?php
namespace Rendu;

class Change
{
    const 
        AvailableCoins = array(
            2 => 'coin2',
        ),
        AvailableBills = array(
            5  => 'bill5',
            10 => 'bill10',
        );
    
    private $_verbose = false;

    private $_aAvailableBillsCoins = array();
    
    public function __construct()
    {
        $this->_aAvailableBillsCoins = self::AvailableCoins + self::AvailableBills;

        krsort($this->_aAvailableBillsCoins);

        foreach ($this->_aAvailableBillsCoins as $kAvailableBillsCoins => $vAvailableBillsCoins) {
            $this->$vAvailableBillsCoins = 1;
        }
        $this->reset();
    }

    public function reset()
    {
        foreach ($this->_aAvailableBillsCoins as $kAvailableBillsCoins => $vAvailableBillsCoins) {
            $this->$vAvailableBillsCoins = 0;
        }
    }

    public function getAvailableBillsCoins()
    {
        return $this->_aAvailableBillsCoins;
    }

    public function setVerbose(bool $bVerbose)
    {
        $this->_verbose = $bVerbose;
    }
}