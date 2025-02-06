<?php
// Inclut le fichier contenant la classe Crud, permettant de réaliser des opérations CRUD sur la base de données.
require_once "class/Crud.php";

// Crée une instance de la classe Crud pour effectuer des requêtes sur la base de données.
$Crud = new Crud;

// Récupère toutes les entrées des tables client, livre, et location.
$clients = $Crud->select("client");
$livres = $Crud->select("livre");
$locations = $Crud->select("location");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des locations</title>
    <!-- Lien vers la feuille de style CSS pour styliser la page. -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav>
        <!-- Barre de navigation offrant des liens vers différentes sections de l'application. -->
        <a href="index.php">Locations</a>
        <a href="client-index.php">Clients</a>
        <a href="livre-index.php">Livres</a>
        <a href="location-create.php">Nouvelle Location</a>
        <a href="client-create.php">Nouveau Client</a>
    </nav>
    <main>
        <h1>Liste des locations</h1>
        <table>
            <thead>
                <tr>
                    <!-- Définit les colonnes du tableau pour les données des locations. -->
                    <th>Nom</th>
                    <th>Livre</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Boucle sur chaque location pour afficher ses détails.
                foreach ($locations as $row) {
                    // Récupère les informations du client et du livre associés à chaque location.
                    $nom = $Crud->selectCompare($row['client_id'], '*', 'client');
                    $livre = $Crud->selectCompare($row['livre_id'], '*', 'livre');
                ?>
                    <tr>
                        <!-- Affiche les informations de la location : nom du client, titre du livre, dates de début et de fin. -->
                        <td><?php echo $nom['prenom'] . ' ' . $nom['nom'] ?></td>
                        <td><?php echo $livre['titre'] ?></td>
                        <td><?php echo $row['date_debut']; ?></td>
                        <td><?php echo $row['date_fin']; ?></td>
                        <!-- Inclut un formulaire pour supprimer la location, avec un bouton de soumission. -->
                        <td>
                            <form action="location-delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>