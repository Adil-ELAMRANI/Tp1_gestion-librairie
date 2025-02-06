<?php
// Inclut le fichier contenant la définition de la classe Crud.
// Cela permet d'utiliser la classe Crud dans ce script.
require_once 'class/Crud.php';

// Crée une nouvelle instance de la classe Crud.
// Cela initialise une connexion à la base de données en utilisant le constructeur de Crud.
$Crud = new Crud;

// Appelle la méthode delete de l'objet Crud.
// Cette méthode tente de supprimer une entrée de la table 'client' où l'id correspond à celui reçu via POST.
// La variable $_POST['id'] contient l'id du client à supprimer, transmise par une requête POST.
$delete = $Crud->delete('client', $_POST['id']);

// Affiche le résultat de l'opération de suppression.
// Cependant, la méthode delete dans la classe Crud ne retourne pas de valeur mais effectue une redirection
// ou affiche une erreur en cas d'échec. Ainsi, cette ligne peut ne pas fonctionner comme attendu car l'opération de suppression
// redirige l'utilisateur ou affiche une erreur directement sans retourner de valeur à afficher.
echo $delete;
