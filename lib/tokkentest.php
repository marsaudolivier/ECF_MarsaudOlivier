<?php
require_once('../lib/pdo.php');
function TokenTest($pdo){
    //vérrification du tokken de cookie pour avoir acces au route admin crud
    if(isset($_COOKIE['token'])){
        $token = $_COOKIE['token'];
        $sql = "SELECT * FROM Utilisateurs WHERE token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($_COOKIE['token'] == $user['token']){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
