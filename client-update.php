<?php
// Cette ligne inclut le fichier 'Crud.php' qui contient la définition de la classe Crud.
// 'require_once' garantit que le fichier est inclus une seule fois pour éviter les erreurs de redéfinition.
require_once 'class/Crud.php';

// Crée une nouvelle instance de la classe Crud. 
// Cela invoque automatiquement le constructeur de la classe Crud, qui établit la connexion à la base de données.
$Crud = new Crud;

// Appelle la méthode 'update' de l'instance $Crud. Cette méthode est destinée à mettre à jour des enregistrements dans la table 'client'.
// Le premier argument passé à la méthode 'update' est le nom de la table dans laquelle les modifications doivent être apportées ('client' dans ce cas).
// Le second argument est le tableau des données à mettre à jour, ici récupéré du tableau superglobal $_POST, 
// qui contient les données soumises via un formulaire HTML.
$update = $Crud->update('client', $_POST);
