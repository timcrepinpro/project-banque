<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Détails du compte</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <a href="afficherComptes.php">retour</a>

    <h1 style="text-align: center;">Détails du compte</h1>

    <?php
    if (isset($_GET['id'])) {
        $numero = htmlspecialchars($_GET['id']);
        require_once "M_compte.php";
        $m_compte = new M_compte();
        $liste_comptes = $m_compte->GetListe();

        $compte_trouve = false;
        foreach ($liste_comptes as $unCompte) {
            if ($unCompte->GetNumero() == $numero) {
                $compte_trouve = true;
                echo "<table>";
                echo "<thead><tr><th>Numéro</th><th>Nom</th><th>Solde</th></tr></thead>";
                echo "<tbody>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($unCompte->GetNumero()) . "</td>";
                echo "<td>" . htmlspecialchars($unCompte->GetNom()) . "</td>";
                echo "<td>" . htmlspecialchars($unCompte->GetSolde()) . "</td>";
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";

                // Lien de modification (uniquement si le compte est trouvé)
                echo '<p><a href="modifCompte.php?id=' . $numero . '">Modifier les informations</a></p>';
                
                echo '<p><a href="crediterCompte.php?id=' . $numero . '">credité le compte</a></p>';

                echo '<p><a href="debiterCompte.php?id=' . $numero . '">debité le compte</a></p>';
                break;
            }
        }

        if (!$compte_trouve) {
            echo "<p style='text-align: center; color: red;'>Compte non trouvé.</p>";
        }
    } else {
        echo "<p style='text-align: center; color: red;'>Aucun identifiant de compte spécifié.</p>";
    }
    ?>
</body>
</html>