<?php
    session_start();
    if($_SESSION){
        $id = $_SESSION["user"]["username"];
        $img = $_SESSION["user"]["avatar"];
        $nombre = $_SESSION["user"]["nombre"];
        $desc = $_SESSION["user"]["descripcion"];
        $email = $_SESSION["user"]["email"];
        $fechaNac = $_SESSION["user"]["fechaNac"];
        $nacionalidad = $_SESSION["user"]["nacionalidad"];
        $sexo = $_SESSION["user"]["sexo"];
    }
    $paises = [
        'AR' => 'Argentina',
        'BR' => 'Brasil',
        'CH' => 'Chile',
        'UR' => 'Uruguay',
        'PA' => 'Paraguay',
        'PE' => 'Perú',
        'BO' => 'Bolivia',
        'CO' => 'Colombia',
        'VE' => 'Venezuela',
        'EC' => 'Ecuador',
    ];
    $nacionalidad = $paises[$nacionalidad];
    require ("funciones.php");
    if($_POST){
        $validacion = editarDatos($_POST, $_SESSION, $_FILES);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= $id; ?></title>
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Perfil de <?= $id; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="container">
        <form action="" method="post" enctype="multipart/form-data" class="mt-5">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo $nombre; ?>">
                        <!-- Arriba: persiste el dato, sin importar si está bien o mal -->
                        <!-- Abajo: Si el dato no pasa la validación, muestra un mensaje de error. -->
                        <?php if(isset($validacion["nombre"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["nombre"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-6">
                    <!--<div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $email; ?>">
                        <?php if(isset($validacion["email"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["email"]; ?></small>
                        <?php } ?>
                    </div>-->
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="desc">Descripción</label>
                        <textarea name="descripcion" id="desc" cols="30" rows="5" class="form-control"><?php echo $desc; ?></textarea>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <p class="mb-2">Foto de Perfil:</p>
                        <input type="file" name="avatar">
                        <?php if (!empty($error)) { ?>
                        <small class="form-text text-danger"><?php echo $error; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Actualizar datos</button>
        </form>
    </section>
    
          <!--BOOTSTRAP JS CDN-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>