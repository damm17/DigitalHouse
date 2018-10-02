<?php
    require("funciones.php");
    if($_POST){
        $error = validarLogin($_POST);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Login</title>
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Formulario de Login</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="registro.php">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="container mt-5">
        <form action="" method="post">
            <div class="row">
                <div class="col-6 mr-auto ml-auto">
                    <?php if (!empty($error)) { ?>
                        <h4 class="alert alert-danger"><?php echo $error; ?></h4>
                    <?php } ?>
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" placeholder="Nombre de Usuario" name="username">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mr-auto ml-auto">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                    </div>
                </div>
            </div>
            <!--cierra row-->
            <div class="row">
                <div class="col-6 mr-auto ml-auto">
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger text-light">Ingresar</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
    
   
    <!--BOOTSTRAP JS CDN-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>