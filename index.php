<!-- Conexion de la base de datos -->
<?php include('database/connection.php'); ?>
<!-- Recursos de maquetado -->
<?php include('includes/header.php'); ?>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4">
        <!-- Si existe algun valor dentro de la variable de sesion mostrara un mensaje por pantalla -->
            <?php if (isset($_SESSION["message"])) {  ?>
                <div class="alert alert-<?= $_SESSION["message_type"]; ?> alert-dismissible fade show" role="alert">
                <!-- Mostramos por pantalla el mensaje que se guardo en la variable de sesion -->
                <?= $_SESSION["message"] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Limpiamos los datos que tenemos en session  -->
            <?php session_unset(); } ?>
            <div class="card card-body">
                <form action="save_task.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Titulo de la tarea" autofocus>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" rows="2" placeholder="Descripcion"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" name="save_task">Guardar tarea</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = $db->prepare("SELECT * FROM task");
                $query->execute();
                $tasks = $query->fetchAll(PDO::FETCH_OBJ);
                        foreach ($tasks as $task){?>
                           <tr>
                            <td><?php echo $task->title ?></td>
                            <td><?php echo $task->description ?></td>
                            <td><?php echo $task->created_at ?></td>
                           <td>
                            <a href="edit_task.php?id=<?php echo $task->id_task?>" class="btn btn-warning "><i class="far fa-edit"></i></a>
                            <a href="delete_task.php?id=<?php echo $task->id_task?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                           </td>
                           
                           </tr>

                        <?php } ?>

            </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Scripts -->
<?php include('includes/footer.php'); ?>