<?php 
/* Conexion a la base de datos*/
require("database/connection.php");

/* Asginamos el Id */
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    /* Traemos la tarea con su respectivo ID*/
    $query = "SELECT * FROM task WHERE id_task=:id_task";
    $result = $db->prepare($query);
    if ($result -> execute(["id_task" => $id]) == 1) {

        $stmt = $result->fetch(PDO::FETCH_ASSOC);

        $title = $stmt["title"];
        $description = $stmt["description"];

    }
}

/* Actualizacion de tarea con su ID correpondiente */
if (isset($_POST["update_task"])) {
    $id = $_GET["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    $query = "UPDATE task SET title=:title, description=:description WHERE id_task=:id_task";
    $result = $db->prepare($query);
if ($result->execute([":title" => $title, ":description" => $description, ":id_task" => $id])) {

    $_SESSION["message"] = "Tarea actualizada";
    $_SESSION["message_type"] = "warning";

    header("Location: index.php");
} else {
    
    die("consulta fallida");
}

}

?>

<?php include("includes/header.php"); ?>

<!-- Formulario de actualizacion de tarea -->
<div class="container pt-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
            <form action="edit_task.php?id=<?php echo $_GET["id"]?>" method="POST">
                <div class="form-group">
                    <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Actualiza titulo">
                </div>
                <div class="form-group">
                    <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Actualiza descripción"><?php echo $description;?></textarea>
                </div>
                    <!-- Tambien puedes sacarle el type="submit" porque ya lo asume por defecto yo lo deje igual-->
                    <button type="submit" class="btn btn-primary btn-block" name="update_task">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php include("includes/footer.php");   ?>