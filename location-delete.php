<?php
require_once 'class/Crud.php';

$Crud = new Crud;

// Appelle la méthode delete de l'objet Crud pour supprimer une entrée dans la table 'location'.
$delete = $Crud->delete('location', $_POST['id']);
