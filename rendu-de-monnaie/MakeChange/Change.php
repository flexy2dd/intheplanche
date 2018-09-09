<?php
namespace MakeChange;

class Change
{
    const 
        AvailableCoins = array(
            array('value' => 2  , 'name' => 'coin2'),
            array('value' => 5  , 'name' => 'bill5'),
            array('value' => 10 , 'name' => 'bill10'),
//            array('value' => 50 , 'name' => 'bill50'),
//            array('value' => 100, 'name' => 'bill100'),
        );
    
    private $_verbose = false;
    
    // Contructor
    public function __construct()
    {
        $this->reset();
    }

    // reste property and value based of AvailableCoins contant
    public function reset()
    {
        foreach (self::AvailableCoins as $aCoin) {
        	  $sProperty = $aCoin['name'];
            $this->$sProperty = 0;
        }
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

    // Get coin of from the index
    private function getCoinFromIdx($iIdx)
    {
        return self::AvailableCoins[$iIdx];
    }

    // Compute optimal change
    //
    // Approche Dynamique a la place de Glouton
    //
    // Basé sur https://fr.wikipedia.org/wiki/Probl%C3%A8me_du_rendu_de_monnaie#R%C3%A9solution_par_programmation_dynamique
    //
    // Pour rendre v, il faut au moins une pièce, à prendre parmi n possibles. 
    // Une fois choisie cette pièce, la somme restante inférieure strictement à v, 
    // donc on sait la rendre de façon optimale. Il suffit donc d'essayer les n possibilités
    //
    public function getOptimalChange($iAmount)
    {
    	  $this->log('get optimal change for ' . $iAmount);

    	  // On initialse les pieces disponibles
    	  $aAvailableCoins = array();
        foreach (self::AvailableCoins as $aCoin) {
            $aAvailableCoins[] = $aCoin['value'];
        }
        $iCountCoins = count($aAvailableCoins);

        $this->log('AvailableCoins: ' . json_encode($aAvailableCoins));

        // On initialse la matrice et le resultat
        $aMatrix   = array();
        $aSelected = array();

        foreach($aAvailableCoins as $kAvailableCoins => $vAvailableCoins) {
            $aMatrixSub = array();
            for ($iBclAmount = 0; $iBclAmount < ($iAmount + 1); $iBclAmount++)
                $aMatrixSub[] = INF;

            $aMatrix[] = $aMatrixSub;
            $aSelected[] = 0;
        }

        for($iBclCoins = 0; $iBclCoins <= ($iCountCoins-1); $iBclCoins++) {

            $this->log('Check coin: ' . $aAvailableCoins[$iBclCoins]);

            if ($iBclCoins==0) {

                // Calcul specifique pour le premier niveau de l'arbre car 
                // on sait qu'il n'y a pas de solution en dessous
                for($iBclAmount = 0; $iBclAmount <= ($iAmount + 1); $iBclAmount++) {
                    if ($iBclAmount % $aAvailableCoins[$iBclCoins] == 0) { 
                        $aMatrix[$iBclCoins][$iBclAmount] = $iBclAmount / $aAvailableCoins[$iBclCoins];
                    }
                }

            } else {
          	
        	      for($iBclAmount = 0; $iBclAmount < ($iAmount + 1); $iBclAmount++) {
       	      	
                    $aMatrix[$iBclCoins][$iBclAmount] = $aMatrix[$iBclCoins - 1][$iBclAmount];
                    if ($aAvailableCoins[$iBclCoins] <= $iBclAmount) {
                        if (($aMatrix[$iBclCoins][$iBclAmount - $aAvailableCoins[$iBclCoins]]) + 1 < $aMatrix[$iBclCoins][$iBclAmount]) {
                            $aMatrix[$iBclCoins][$iBclAmount] = $aMatrix[$iBclCoins][$iBclAmount - $aAvailableCoins[$iBclCoins]] + 1;
                        }
                    }

                }

            }

        }

        // On va lire la matrice en retirant du maontant a rendre celle sui ale meilleurs resultat
        // et on passe au noeud suivant
        $iIdxCoins = $iCountCoins - 1;
        while($iAmount && ($iIdxCoins>=0)) {
            if ($iAmount >= $aAvailableCoins[$iIdxCoins]) {
                if (($aMatrix[$iIdxCoins][$iAmount - $aAvailableCoins[$iIdxCoins]] + 1) == $aMatrix[$iIdxCoins][$iAmount]) {
                    $aSelected[$iIdxCoins] += 1;
                    $iAmount -= $aAvailableCoins[$iIdxCoins];
                    continue;
                }
            }
            $iIdxCoins -= 1;
        }

        // convertion dynamique du resultat en propriétés pour l'objet
        $aTotal = 0;
        foreach($aSelected as $kSelectedCoin => $vSelectedCoin) {
            $aCoin = $this->getCoinFromIdx($kSelectedCoin);
            $sPropertyName = $aCoin['name'];
            $aTotal += $vSelectedCoin;
            $this->$sPropertyName = $vSelectedCoin;
        }


        $this->log('Selected: ' . json_encode($aSelected));
        $this->log('Total: ' . $aTotal);

        return $aTotal>0;
    }
}