<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Ajouter/Modifier un compte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h1>Ajouter/Modifier un compte</h1>

    <?php
    require_once "M_compte.php";
    $m_compte = new M_compte();
    $liste_comptes = $m_compte->GetListe();

    // Initialisation des variables pour le pré-remplissage
    $numero = "";
    $nom = "";
    $solde = "";

    // Si un ID est passé dans l'URL, on cherche le compte correspondant
    if (isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        foreach ($liste_comptes as $unCompte) {
            if ($unCompte->GetNumero() == $id) {
                $numero = htmlspecialchars($unCompte->GetNumero());
                $nom = htmlspecialchars($unCompte->GetNom());
                $solde = htmlspecialchars($unCompte->GetSolde());
                break;
            }
        }
    }
    ?>

    <form method="post" action="">
        <label for="numero">Numéro du compte :</label>
        <input type="text" id="numero" name="numero" value="<?php echo $numero; ?>" required />

        <label for="nom">Nom du compte :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required />

        <label for="solde">Solde initial :</label>
        <input type="number" id="solde" name="solde" step="0.01" value="<?php echo $solde; ?>" required />

        <input type="submit" name="ajouter" value="<?php echo empty($numero) ? 'Ajouter le compte' : 'Modifier le compte'; ?>" />
    </form>

    <?php
    if (isset($_POST['ajouter'])) {
        $numero = htmlspecialchars($_POST['numero']);
        $nom = htmlspecialchars($_POST['nom']);
        $solde = floatval($_POST['solde']);

        $compte = new Compte($numero, $nom, $solde);
        $resultat = $m_compte->Ajouter($compte);

        if ($resultat) {
            echo '<div class="message success">Compte enregistré avec succès !</div>';
        } else {
            echo '<div class="message error">Enregistrement impossible !</div>';
        }
    }
    ?>
</body>
</html>