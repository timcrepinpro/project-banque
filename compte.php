<?php

class Compte
{
    private $numero;
    private $nom;
    private $solde;
    private static $nbComptes=0;
/*
    public function Init($p_numero,$p_nom)
    {
        $this->numero=$p_numero;
        $this->nom=$p_nom;
        $this->solde=0;
        self::$nbComptes++;
    }*/

    public function Crediter($p_montant)
    {
        $this->solde+=$p_montant;
    }

    public function Debiter($p_montant)
    {
        $this->solde-=$p_montant;
    }

    public function GetSolde()
    {
        return $this->solde;
    }

    public function GetNom()
    {
        return $this->nom;
    }

    public function SetNom($p_nom)
    {
        $this->nom=$p_nom;
    }

    public static function GetNbComptes()
    {
        return self::$nbComptes;
    }

    public function GetNumero()
    {
        return $this->numero;
    }

    
    public function __construct($p_numero, $p_nom,$p_solde=0) {
        $this->numero = $p_numero;
        $this->nom = $p_nom;
        $this->solde = $p_solde;
        self::$nbComptes++;
    }




    public function EstSuperieur(Compte $p_cpte)
    {
        if ($this->solde > $p_cpte->GetSolde())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}


?>