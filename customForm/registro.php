<?php 
    require("funciones.php");

    if($_POST){
        $validacion = validarRegistro($_POST); 
        // Si hay datos por $_POST, se ejecuta la función de validación y se guardan los errores (array) en una variable.
        if (empty($validacion)){
             $error = registrarUsuario($_POST, $_FILES);
        } // Y si luego de validar los datos el array de errores vuelve vacío, se ejecuta la función de registro (guardado de datos). Sino, muestra los errores donde los haya.
    }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro Formulario</title>
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Formulario de Registro</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
        
    </nav>
    <section class="container mt-5">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="<?php echo (isset($_POST["nombre"]))?$_POST["nombre"]:''; ?>">
                        <!-- Arriba: persiste el dato, sin importar si está bien o mal -->
                        <!-- Abajo: Si el dato no pasa la validación, muestra un mensaje de error. -->
                        <?php if(isset($validacion["nombre"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["nombre"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="username" placeholder="Nombre de Usuario" name="username" value="<?php echo (isset($_POST["username"]))?$_POST["username"]:''; ?>">
                        <?php if(isset($validacion["username"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["username"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--cierra row-->

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo (isset($_POST["email"]))?$_POST["email"]:''; ?>">
                        <?php if(isset($validacion["email"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["email"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="emailConfirm">Confirmar E-mail</label>
                        <input type="email" class="form-control" id="emailConfirm" placeholder="Confirmar E-mail" name="emailConfirm" value="<?php echo (isset($_POST["emailConfirm"]))?$_POST["emailConfirm"]:''; ?>">
                        <?php if(isset($validacion["emailConfirm"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["emailConfirm"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--cierra row-->

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña" name="password">
                        <?php if(isset($validacion["password"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["password"]; ?></small>
                        <?php } else { ?>
                            <small class="form-text text-muted">La contraseña debe tener de 10 a 16 caracteres. Al menos una mayúscula, una minúscula y un número.</small>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="passwordConfirm">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="passwordConfirm" placeholder="Confirmar Contraseña" name="passwordConfirm">
                        <?php if(isset($validacion["passwordConfirm"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["passwordConfirm"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--cierra row-->

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fechaNac">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNac" placeholder="" name="fechaNac" value="<?php echo (isset($_POST["fechaNac"]))?$_POST["fechaNac"]:''; ?>">
                        <?php if(isset($validacion["fechaNac"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["fechaNac"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="nacionalidad">País de Nacimiento</label>
                        <select class="form-control" id="nacionalidad" name="nacionalidad">
                            <option value="" <?php if(!isset($_POST["nacionalidad"])) { echo 'selected'; } ?> disabled>Seleccione un país</option>
                            <?php 
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
                                ksort($paises);
                                foreach($paises as $id => $pais) { ?>
                                    <option value="<?= $id; ?>" <?php if(isset($_POST["nacionalidad"])&& ($_POST["nacionalidad"] == $id)) { echo 'selected'; }; ?>><?= $pais; ?></option>
                            <?php } ?>
                        </select>
                        <?php if(isset($validacion["nacionalidad"])){ ?>
                            <small class="form-text text-danger"><?php echo $validacion["nacionalidad"]; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--cierra row-->

            <div class="row">
                <div class="col">
                    <p class="mb-0 text-primary">Sexo:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Masculino" id="masculino" name="sexo" <?php if(isset($_POST["sexo"])&&($_POST["sexo"]=='Masculino')){ echo 'checked'; }; ?>>
                        <label class="form-check-label" for="masculino">
                            Masculino
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="Femenino" id="femenino" name="sexo" <?php if(isset($_POST["sexo"])&&($_POST["sexo"]=='Femenino')){ echo 'checked'; }; ?>>
                        <label class="form-check-label" for="femenino">
                            Femenino
                        </label>
                    </div>
                    <?php if(isset($validacion["sexo"])){ ?>
                        <small class="form-text text-danger"><?php echo $validacion["sexo"]; ?></small>
                    <?php } ?>
                </div>
            </div>
            <!--cierra row-->

            <div class="row">
                <div class="col">
                    <p class="mb-0 mt-4 text-primary">Intereses:</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Música" id="musica" name="intereses[]" <?php if (isset($_POST["intereses"])&&in_array("Música",$_POST["intereses"])) { echo 'checked'; } ?>>
                        <label class="form-check-label" for="musica">
                            Música
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Deportes" id="deportes" name="intereses[]" <?php if (isset($_POST["intereses"])&&in_array("Deportes",$_POST["intereses"])) { echo 'checked'; } ?>>
                        <label class="form-check-label" for="deportes">
                            Deportes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Cine" id="cine" name="intereses[]" <?php if (isset($_POST["intereses"])&&in_array("Cine",$_POST["intereses"])) { echo 'checked'; } ?>>
                        <label class="form-check-label" for="cine">
                            Cine
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Series" id="series" name="intereses[]" <?php if (isset($_POST["intereses"])&&in_array("Series",$_POST["intereses"])) { echo 'checked'; } ?>>
                        <label class="form-check-label" for="series">
                            Series
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Arte" id="arte" name="intereses[]" <?php if (isset($_POST["intereses"])&&in_array("Arte",$_POST["intereses"])) { echo 'checked'; } ?>>
                        <label class="form-check-label" for="arte">
                            Arte
                        </label>
                    </div>
                    <?php if(isset($validacion["intereses"])){ ?>
                        <small class="form-text text-danger"><?php echo $validacion["intereses"]; ?></small>
                    <?php } ?>
                </div>
            </div>
            <!--cierra row-->
            <div class="row mt-3">
                <div class="col-4">
                    <div class="form-group">
                        <p class="mb-2">Foto de Perfil:</p>
                        <input type="file" name="avatar">
                        <?php if (!empty($error)) { ?>
                        <small class="form-text text-danger"><?php echo $error; ?></small>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="desc">Descripción</label>
                        <textarea name="descripcion" id="desc" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Registrarme</button>
        </form>
        <br><br>
    </section>

    <!--BOOTSTRAP JS CDN-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
