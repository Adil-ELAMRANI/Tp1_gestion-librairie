<?php
// Vérifie si un identifiant ('id') a été envoyé via la méthode GET, typiquement en tant que partie de l'URL.
if (isset($_GET['id'])) {
        
    // Si un 'id' est présent, il est stocké dans la variable $id.
    $id = $_GET['id'];    

    // Inclut une fois le fichier 'Crud.php' qui définit la classe Crud. Cela permet d'utiliser cette classe dans le script actuel.
    require_once "class/Crud.php";

    // Crée une nouvelle instance de la classe Crud. Cela établit la connexion à la base de données selon la configuration définie dans le constructeur de Crud.
    $Crud = new Crud;

    // Utilise l'instance de Crud pour récupérer les informations du client ayant l'identifiant spécifié. 
    // La méthode selectId est définie dans la classe Crud pour effectuer cette opération.
    $client = $Crud->selectId('client', $id);
    
    
    // Utilise l'instance de Crud pour récupérer toutes les villes disponibles dans la base de données. 
    // Cela servira à peupler le menu déroulant des villes dans le formulaire.
    $villes = $Crud->select('ville');



    // Extrait les variables du tableau associatif $client. 
    // Cela crée des variables PHP ($prenom, $nom, etc.) directement accessibles dans le script.
    extract($client);
}
// Si aucun 'id' n'a été envoyé via GET, l'utilisateur est redirigé vers la page de liste des clients.
else {
    header('Location: client-index.php');
    exit; // Il est bon de mettre exit après header pour s'assurer que le script s'arrête après la redirection.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <style>
        input {
            display: block;
            margin: 5px;
        }
    </style>
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
        <h1>Modifier</h1>
        <form action="client-update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Prénom
                <input type="text" name="prenom" value="<?php echo $prenom; ?>">
            </label>
            <label>Nom
                <input type="text" name="nom" value="<?php echo $nom; ?>">
            </label>
            <label>Adresse
                <input type="text" name="adresse" value="<?php echo $adresse; ?>">
            </label>
            <label>Code Postal
                <input type="text" name="code_postal" value="<?php echo $code_postal; ?>">
            </label>
            <label>Téléphone
                <input type="text" name="phone" value="<?php echo $phone; ?>">
            </label>
            <label>Ville
                <select name="ville_id">
                    <?php foreach ($villes as $ville) { ?>
                        <option value="<?php echo $ville['id']; ?>" id="<?php echo $ville['id']; ?>" <?php
                                                                                                        // Pour que la ville du client soit sélectionnée de base
                                                                                                        if ($ville['id'] == $client['ville_id']) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                        ?>>

                            <?php echo $ville['nom']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>
            <input type="submit" value="Modifier" class="submit">
        </form>
        <form action="client-delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Supprimer" class="submit">
        </form>
    </main>
</body>

</html>