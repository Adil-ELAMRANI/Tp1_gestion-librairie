<?php
require_once "class/Crud.php";

$Crud = new Crud;

$villes = $Crud->select("ville");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client</title>
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
        <h1>Créer un client</h1>
        <form action="client-store.php" method="post">
            <label>Nom
                <input type="text" name="nom">
            </label>
            <label>Prénom
                <input type="text" name="prenom">
            </label>
            <label>Adresse
                <input type="text" name="adresse">
            </label>
            <label>Code Postal
                <input type="text" name="code_postal">
            </label>
            <label>Téléphone
                <input type="text" name="phone">
            </label>
            <label>Ville
                <select name="ville_id">
                    <?php foreach ($villes as $ville) { ?>
                        <option value="<?php echo $ville['id']; ?>" id="<?php echo $ville['id']; ?>"><?php echo $ville['nom']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </label>
            <input type="submit" value="Enregistrer" class="submit">
        </form>
    </main>
</body>

</html>