<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Débiter un compte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h1>Débiter un compte</h1>

    <?php
    require_once "M_compte.php";
    $m_compte = new M_compte();
    $liste_comptes = $m_compte->GetListe();

    // Initialisation des variables
    $numero = "";
    $nom = "";
    $solde_actuel = "";
    $montant_debite = "";

    // Si un ID est passé dans l'URL, on cherche le compte correspondant
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        foreach ($liste_comptes as $unCompte) {
            if ($unCompte->GetNumero() == $id) {
                $numero = htmlspecialchars($unCompte->GetNumero());
                $nom = htmlspecialchars($unCompte->GetNom());
                $solde_actuel = htmlspecialchars($unCompte->GetSolde());
                break;
            }
        }
    }
    ?>

    <?php 
    echo '<p><a href="detail.php?id=' . $numero . '">retour</a></p>';
    ?>

    <form method="post" action="">
        <input type="hidden" name="numero" value="<?php echo $numero; ?>" />

        <label for="nom">Nom du compte :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" readonly />

        <label for="solde_actuel">Solde actuel :</label>
        <input type="text" id="solde_actuel" name="solde_actuel" value="<?php echo $solde_actuel; ?>" readonly />

        <label for="montant_debite">Montant à débiter :</label>
        <input type="number" id="montant_debite" name="montant_debite" step="0.01" value="0" required min="0" />

        <input type="submit" name="debiter" value="Débiter le compte" />
    </form>
    

    <?php
    if (isset($_POST['debiter'])) {
        $numero = htmlspecialchars($_POST['numero']);
        $montant_debite = floatval($_POST['montant_debite']);

        // Recherche du compte à débiter
        foreach ($liste_comptes as $unCompte) {
            if ($unCompte->GetNumero() == $numero) {
                // Vérification que le solde est suffisant
                if ($unCompte->GetSolde() >= $montant_debite) {
                    // Calcul du nouveau solde
                    $nouveau_solde = $unCompte->GetSolde() - $montant_debite;

                    // Mise à jour du solde (à implémenter dans M_compte.php)
                    $resultat = $m_compte->MettreAJourSolde($numero, $nouveau_solde);

                    if ($resultat) {
                        echo '<div class="message success">Débit effectué avec succès ! Nouveau solde : ' . $nouveau_solde . '</div>';
                    } else {
                        echo '<div class="message error">Débit impossible (erreur technique) !</div>';
                    }
                } else {
                    echo '<div class="message error">Solde insuffisant pour effectuer ce débit !</div>';
                }
                break;
            }
        }
    }
    ?>
</body>
</html>