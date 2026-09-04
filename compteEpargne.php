

<?php
include_once "Compte.php";

class CompteEpargne extends Compte
{
    private $taux;

    public function __construct($p_numero,$p_nom,$p_taux)
    {
        parent::__construct($p_numero,$p_nom);
        $this->taux=$p_taux;
    }

    public function Init($p_numero,$p_nom)
    {
        parent::Init($p_numero,$p_nom);
        $this->taux=0;
    }

    public function GetSolde()
    {
        return parent::GetSolde()*(1+$this->taux/100);
    }
}

?>