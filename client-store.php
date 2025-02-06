<?php
// Inclut le fichier 'Crud.php'. Cette instruction assure que le code défini dans 'Crud.php' est exécuté une seule fois ici.
// Si 'Crud.php' contient la définition de la classe Crud, cela rend cette classe disponible pour utilisation dans le script actuel.
require_once 'class/Crud.php';

// Crée une nouvelle instance de la classe Crud. Cela invoque le constructeur de la classe Crud,
// qui établit une connexion à la base de données selon les détails spécifiés dans ce constructeur.
$Crud = new Crud;

// Appelle la méthode insert de l'objet $Crud, en passant 'client' comme nom de la table dans laquelle insérer les données,
// et $_POST comme tableau des données à insérer. $_POST est un tableau superglobal contenant les données envoyées par
// une requête HTTP POST. Cette méthode va insérer les données fournies dans la table 'client' de la base de données.
$insert = $Crud->insert('client', $_POST);
