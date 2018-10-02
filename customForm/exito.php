<?php
    session_start();
    if (!empty($_SESSION)) {
        $user = $_SESSION["user"]["username"];
    }
    $titleRegistro = '';
    $titleLogin = '';
    $titleError = '';
    if (isset($_GET["registro"])&&$_GET["registro"]=='ok') {
        global $titleRegistro;
        $titleRegistro = "Registro Exitoso";
    } elseif (isset($_GET["login"])&&$_GET["login"]=='ok') {
        global $titleLogin;
        $titleLogin = "Login Exitoso";
    } else {
        global $titleError;
        $titleError = "Error 404";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titleRegistro.$titleLogin.$titleError; ?></title>
    <!--BOOTSTRAP CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Formulario de Registro/Login</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro.php">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (isset($_GET["registro"])&&$_GET["registro"]=='ok') { ?>
    <section class="container">
        <div class="row">
            <div class="col-6 offset-3 text-center">
                <h1>¡Gracias por registrarte!</h1>
                <h3><a href="login.php">Click aquí para logear</a></h3>
            </div>
        </div>        
    </section>        
    <?php } elseif (isset($_GET["login"])&&$_GET["login"]=='ok') { ?>
    <section class="container">
        <div class="row">
            <div class="col-6 offset-3 text-center">
                <h1><a href="perfil.php?user=<?php echo $user; ?>">Ver mi perfil</a></h1>
            </div>
        </div>        
    </section>   
    <?php } ?>
    
    
   
    <!--BOOTSTRAP JS CDN-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>