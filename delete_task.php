<?php
/* Conexion a la base de datos */
require("database/connection.php");

/* Asignación de ID para  */
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    /* Eliminamos la tarea con su respectivo ID */
    $query = "DELETE FROM task  WHERE id_task=:id_task";
    $result = $db->prepare($query);
    if ($result->execute([":id_task" => $id])) {
        $_SESSION["message"] = "Tarea eliminada correctamente";
        $_SESSION["message_type"] = "danger";
        header("Location: index.php");

    } else {
        die("Consulta fallida");
    }

}


?>