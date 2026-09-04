<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title>Comptes en Banque</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="fr" />
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <h1 style="text-align: center;">Liste des comptes</h1>

    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Nom</th>
                <th>Solde</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "M_compte.php";
            $m_compte = new M_compte();
            $liste_comptes = $m_compte->GetListe();

            foreach ($liste_comptes as $unCompte) {
                echo "<tr>";
                echo "<td><a href='detail.php?id=" . htmlspecialchars($unCompte->GetNumero()) . "'>" . htmlspecialchars($unCompte->GetNumero()) . "</a></td>";
                echo "<td>" . htmlspecialchars($unCompte->GetNom()) . "</td>";
                echo "<td>" . htmlspecialchars($unCompte->GetSolde()) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

