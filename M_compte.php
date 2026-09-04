<?php
require_once "Compte.php";

class M_compte
{
    private $cnx;

    private function connexion()
    {
        $this->cnx=mysqli_connect("localhost", "root","", "project-banque");
        mysqli_set_charset($this->cnx, "utf8");
    }

    private function deconnexion()
    {
        mysqli_close($this->cnx);
    }

    public function GetListe()
    {
        $resultat=array();
        $this->connexion();
        $req="select * from compte";
        $res=mysqli_query($this->cnx, $req);
        $ligne=mysqli_fetch_assoc($res);
        while ($ligne)
        {

            $compte=new Compte($ligne["numero"],$ligne["nom"],$ligne["solde"]);
            $resultat[]=$compte;
            $ligne=mysqli_fetch_assoc($res);
        }
        $this->deconnexion();
        return $resultat;
    }

    public function Ajouter(Compte $compte)
    {
        $this->connexion();
        $req="insert into compte values ('".$compte->GetNumero()."','"
        .$compte->GetNom()."','".$compte->GetSolde()."')";
        $ok=mysqli_query($this->cnx, $req);
        $this->deconnexion();
        return $ok;
    }
}
?>