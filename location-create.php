<?php
// Inclut le fichier contenant la classe Crud pour pouvoir l'utiliser.
// Cette classe permet d'effectuer des opérations de base de données.
require_once "class/Crud.php";

// Crée une instance de la classe Crud pour interagir avec la base de données.
$Crud = new Crud;


// Récupère la liste de tous les clients et de tous les livres depuis la base de données
// pour les afficher dans des menus déroulants dans le formulaire.
// Les données sont triées par nom pour les clients et par titre pour les livres.
$clients = $Crud->select("client", "nom");
$livres = $Crud->select("livre", "titre");

// Définit la date de début de la location à la date du jour.
$datedebut = date("Y-m-d");

// Calcule les dates de fin possibles pour la location, à 7 ou 14 jours à partir de la date de début.
$datefin7 = strtotime("+7 day");
$datefin7 = date("Y-m-d", $datefin7);
$datefin14 = strtotime("+14 day");
$datefin14 = date("Y-m-d", $datefin14);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle location</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav>
        <a href="index.php">Locations</a>
        <a href="client-index.php">Clients</a>
        <a href="livre-index.php">Livres</a>
        <a href="location-create.php">Nouvelle Location</a>
        <a href="client-create.php">Nouveau Client</a>
    </nav>
    <main>
        <h2>Saisir une location</h2>
        <!-- Formulaire pour saisir une nouvelle location, envoyant les données à 'location-store.php'. -->
        <form action="location-store.php" method="post">
            <!-- Sélection du client pour la location. -->
            <label>Client
                <select name="client_id">
                    <!-- Boucle sur chaque client pour les ajouter comme options dans le menu déroulant. -->
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?php echo $client['id']; ?>"><?php echo $client['prenom'] . ' ' . $client['nom']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <br>
            <!-- Sélection du livre pour la location. -->
            <label>Livre
                <select name="livre_id">
                    <!-- Boucle sur chaque livre pour les ajouter comme options dans le menu déroulant. -->
                    <?php foreach ($livres as $livre) { ?>
                        <option value="<?php echo $livre['id']; ?>"><?php echo $livre['titre']; ?></option>
                    <?php } ?>
                </select>
            </label>
            <br>
            <!-- Sélection de la durée de la location. -->
            <label>Durée de location
                <select name="date_fin">
                    <option value="<?php echo $datefin7; ?>">1 semaine</option>
                    <option value="<?php echo $datefin14; ?>">2 semaines</option>
                </select>
            </label>
            <!-- Champ caché pour envoyer la date de début de la location. -->
            <input type="hidden" name="date_debut" value="<?php echo $datedebut; ?>">
            <input type="submit" value="Enregistrer" class="submit">
        </form>
    </main>
</body>

</html>