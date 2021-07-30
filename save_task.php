<?php
/* Requerimos la conexion a la base de datos  */
require('database/connection.php');

/* Insertamos la tarea */
if (isset($_POST['save_task'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];

    $query = "INSERT INTO task (title, description) VALUES (:title, :description)";
    $result = $db->prepare($query);

if ($result->execute([":title" => $title, ":description" => $description])) {

    /* Guardamos mensajes en sesión */
    $_SESSION["message"] = "Tarea guardada correctamente";

    /* Guardamos el color para el mensaje  */
    $_SESSION["message_type"] = "success";

    header("Location: index.php");
   
} else {
   die('Consulta fallida');
}



}







?>