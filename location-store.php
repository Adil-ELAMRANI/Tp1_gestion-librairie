<?php
require_once 'class/Crud.php';

$Crud = new Crud;

// Appelle la méthode 'insert' de l'objet $Crud pour insérer des données dans la table 'location'.
// Le tableau $_POST contient toutes les données soumises par un formulaire HTML via la méthode POST.

$insert = $Crud->insert('location', $_POST);