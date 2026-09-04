<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Ajouter un compte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h1>Ajouter un nouveau compte</h1>

    <form method="post" action="">
        <label for="numero">Numéro du compte :</label>
        <input type="text" id="numero" name="numero" required />

        <label for="nom">Nom du compte :</label>
        <input type="text" id="nom" name="nom" required />

        <label for="solde">Solde initial :</label>
        <input type="number" id="solde" name="solde" step="0.01" required />

        <input type="submit" name="ajouter" value="Ajouter le compte" />
    </form>

    <?php
    if (isset($_POST['ajouter'])) {
        require_once "M_compte.php";
        $m_compte = new M_compte();

        // Récupération des données du formulaire
        $numero = htmlspecialchars($_POST['numero']);
        $nom = htmlspecialchars($_POST['nom']);
        $solde = floatval($_POST['solde']);

        // Création du compte
        $compte = new Compte($numero, $nom, $solde);
        $resultat = $m_compte->Ajouter($compte);

        // Affichage du message de résultat
        if ($resultat) {
            echo '<div class="message success">Compte enregistré avec succès !</div>';
        } else {
            echo '<div class="message error">Enregistrement impossible !</div>';
        }
    }
    ?>
</body>
</html>