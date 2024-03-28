<?php 
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=todo','root','Raja1949');
        } catch(PDOException $e){
         die("Erreur connexion: ".$e-> getMessage());
        }
?>