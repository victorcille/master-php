<?php
require_once './includes/conexion.php';

if(isset($_SESSION['login']) && isset($_GET['id'])){
    $usuario_id = $_SESSION['login']['id'];
    $entrada_id = $_GET['id'];
    
    $query = "DELETE FROM entradas WHERE usuario_id = $usuario_id AND id = $entrada_id";
    $result = mysqli_query($db, $query);
    
    // echo mysqli_error($db);die();
}

header('Location: ./index.php');