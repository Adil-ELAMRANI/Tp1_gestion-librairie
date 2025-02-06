<?php
// Inclut le fichier contenant la classe Crud pour accéder à ses méthodes de gestion de base de données.
require_once "class/Crud.php";

// Crée une nouvelle instance de la classe Crud pour effectuer des opérations CRUD sur la base de données.
$Crud = new Crud;

// Utilise la méthode select de l'instance Crud pour récupérer tous les livres de la table 'livre', triés par leur titre.
$livres = $Crud->select("livre", "titre");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres</title>
    <!-- Lien vers la feuille de style CSS pour styliser la page. -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <!-- Barre de navigation fournissant des liens vers différentes pages de l'application. -->
        <a href="index.php">Locations</a>
        <a href="client-index.php">Clients</a>
        <a href="livre-index.php">Livres</a>
        <a href="location-create.php">Nouvelle Location</a>
        <a href="client-create.php">Nouveau Client</a>
    </nav>
    <main>
        <h1>Liste des livres</h1>
        <table>
            <thead>
                <!-- En-tête du tableau listant les livres avec des colonnes pour le titre, l'auteur, le nombre de pages et la catégorie. -->
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Nombre de pages</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <!-- Boucle PHP pour afficher chaque livre récupéré de la base de données. -->
                <?php
                foreach ($livres as $livre) {
                    // Pour chaque livre, récupère les informations de la catégorie associée à partir de son ID de catégorie.
                    $categorie = $Crud->selectCompare($livre['categorie_id'], '*', 'categorie');
                ?>
                    <!-- Crée une ligne dans le tableau pour chaque livre avec ses détails. -->
                    <tr>
                        <td><?php echo $livre['titre'] ?></td>
                        <td><?php echo $livre['auteur'] ?></td>
                        <td><?php echo $livre['nombre_pages'] ?></td>
                        <!-- Affiche le nom de la catégorie récupéré à partir de la table 'categorie'. -->
                        <td><?php echo $categorie['nom']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
