<?php

// Définition de la classe Crud qui hérite des propriétés et méthodes de la classe PDO
class Crud extends PDO
{
    // Constructeur de la classe qui établit la connexion à la base de données
    public function __construct()
    {
        // Appel du constructeur parent (PDO) avec les paramètres de connexion à la base de données
        parent::__construct('mysql:host=localhost; dbname=librairie; port=3306; charset=utf8', 'root', '');
    }

    // Méthode pour sélectionner des données dans une table
    public function select($table, $field = 'id', $order = 'ASC')
    {
        $sql = "SELECT * FROM $table ORDER BY $field $order";  // Construction de la requête SQL de sélection
        $stmt  = $this->query($sql);                           // Exécution de la requête
        return  $stmt->fetchAll();                             // Récupération et retour des résultats
    }

    // Méthode pour sélectionner des données dans une table avec une condition spécifique
    public function selectCompare($id, $col = '*', $table)
    {
        $sql = "SELECT $col FROM $table WHERE $id = id";
        $stmt  = $this->query($sql);
        return  $stmt->fetch();
    }

    // Méthode pour sélectionner une donnée spécifique dans une table et rediriger si non trouvée
    public function selectId($table, $value, $field = 'id', $url = 'client-index.php')
    {
        $sql = "SELECT * FROM $table WHERE $field = :$field";   // Construction de la requête SQL de sélection avec un paramètre lié
        $stmt = $this->prepare($sql);                           // Préparation de la requête
        $stmt->bindValue(":$field", $value);                    // Liaison du paramètre
        $stmt->execute();                                       // Exécution de la requête
        $count = $stmt->rowCount();                             // Comptage des lignes retournées

        // Vérification si une ligne est retournée
        if ($count == 1) {
            return $stmt->fetch();         // Récupération et retour du résultat
        } else {
            header("location: $url");      // Redirection si aucun résultat trouvé
        }
    }


    // Méthode pour insérer des données dans une table
    public function insert($table, $data, $url = 'index.php')
    {
        // Construction des parties de la requête d'insertion à partir des clés du tableau $data
        $nomChamp = implode(", ", array_keys($data));
        $valeurChamp = ":" . implode(", :", array_keys($data));

        // Construction de la requête SQL d'insertion
        $sql = "INSERT INTO $table ($nomChamp) VALUES ($valeurChamp)";

        // Préparation de la requête
        $stmt = $this->prepare($sql);

        // Liaison de chaque valeur du tableau $data à son paramètre correspondant dans la requête
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Exécution de la requête et vérification du succès
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());            // Affichage de l'erreur si la requête échoue
        } else {
            header('Location: ' . $url);            // Redirection en cas de succès
        }
    }

    // Méthode pour mettre à jour des données dans une table
    public function update($table, $data, $champId = 'id', $url = 'client-index.php')
    {
        $champRequete = null;

        // Construction de la partie SET de la requête d'update à partir des clés et valeurs du tableau $data
        foreach ($data as $key => $value) {
            $champRequete .= "$key = :$key, ";
        }

        // Suppression de la virgule et de l'espace en fin de chaîne
        $champRequete = rtrim($champRequete, ", ");

        // Construction de la requête SQL de mise à jour
        $sql = "UPDATE $table SET $champRequete WHERE $champId = :$champId";

        $stmt = $this->prepare($sql);        // Préparation de la requête

        // Liaison de chaque valeur du tableau $data à son paramètre correspondant dans la requête
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Exécution de la requête et vérification du succès
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());            // Affichage de l'erreur si la requête échoue
        } else {
            header('Location: ' . $url);            // Redirection en cas de succès
        }
    }

    // Méthode pour supprimer des données d'une table
    public function delete($table, $id, $champId = 'id', $url = 'index.php')
    {
        // Construction de la requête SQL de suppression
        $sql = "DELETE FROM $table WHERE $champId = :$champId";

        $stmt = $this->prepare($sql);               // Préparation de la requête

        $stmt->bindValue(":$champId", $id);         // Liaison du paramètre d'identifiant


        // Exécution de la requête et vérification du succès
        if (!$stmt->execute()) {
            print_r($stmt->errorInfo());            // Affichage de l'erreur si la requête échoue
        } else {
            header('Location: ' . $url);            // Redirection en cas de succès

        }
    }
}
