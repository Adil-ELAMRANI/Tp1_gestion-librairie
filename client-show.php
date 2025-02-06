<?php
// Vérifie si un 'id' est fourni dans l'URL via la méthode GET.
if (isset($_GET['id'])) {
    // Stocke l'ID du client récupéré de l'URL dans une variable.
    $id = $_GET['id'];

    // Inclut le fichier contenant la classe Crud pour accéder à ses méthodes.
    require_once "class/Crud.php";

    // Crée une instance de la classe Crud.
    $Crud = new Crud;

    // Utilise la méthode selectId de Crud pour récupérer les informations du client spécifié par l'ID.
    $client = $Crud->selectId('client', $id);

    // Utilise la méthode selectCompare pour récupérer les informations de la ville du client
    // en utilisant l'ID de la ville stocké dans les informations du client.
    $ville = $Crud->selectCompare($client['ville_id'], '*', 'ville');

    // Extrait les informations du client dans des variables séparées pour un accès facile.
    extract($client);
} else {
    // Si aucun ID n'est fourni, redirige l'utilisateur vers la page d'index des clients.
    header('Location: client-index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Barre de navigation avec des liens vers différentes sections de l'application -->
    <nav>
        <a href="index.php">Locations</a>
        <a href="client-index.php">Clients</a>
        <a href="livre-index.php">Livres</a>
        <a href="location-create.php">Nouvelle Location</a>
        <a href="client-create.php">Nouveau Client</a>
    </nav>
    <main>
        <!-- Affiche les détails du client, y compris son prénom, nom, adresse, etc. -->
        <p><strong>Prénom : </strong><?php echo $prenom; ?></p>
        <p><strong>Nom : </strong><?php echo $nom; ?></p>
        <p><strong>Adresse : </strong><?php echo $adresse; ?></p>
        <p><strong>Code Postal : </strong><?php echo $code_postal; ?></p>
        <p><strong>Téléphone : </strong><?php echo $phone; ?></p>
        <p><strong>Ville : </strong><?php echo $ville['nom']; ?></p>
        <p><a href="client-edit.php?id=<?php echo $id; ?>">Modifier</a></p>
    </main>
</body>

</html>