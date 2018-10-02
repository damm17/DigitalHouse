<?php 
    function validarRegistro($datos){
        $validacion=[]; 
        // Primero crea un array vacío para ir guardando los distintos errores que surjan durante la validación de cada uno de los datos.
        $json = file_get_contents("datos.json");
        $json = json_decode($json, true);
        // Importo y convierto en array los registros que ya tenga creados para validar que no haya usernames/emails iguales.
        
        if (strlen($datos["nombre"])<2){
            $validacion["nombre"] = 'El nombre debe ser mayor a 2 caracteres.';
        } elseif (!preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/', $datos["nombre"])) {
            $validacion["nombre"] = 'El nombre debe contener sólo letras.';
        }
        
        if (strlen($datos["username"])<6){
            $validacion["username"] = "El nombre de usuario debe ser mayor a 6 caracteres.";
        } elseif (strlen($datos["username"])>16) {
            $validacion["username"] = "El nombre de usuario debe ser menor a 16 caracteres.";
        } elseif(in_array($datos["username"], array_column($json["usuarios"], 'username'))) { 
            $validacion["username"] = "El nombre de usuario ingresado ya está en uso. Por favor elija otro.";
        }
        
        if (!filter_var($datos["email"], FILTER_VALIDATE_EMAIL)){
            $validacion["email"] = "Por favor ingrese un E-mail válido.";
        } elseif(in_array($datos["email"], array_column($json["usuarios"], 'email'))) { // Busca el mail ingresado en el formulario, en el array del json cuya "columna" o posición coincida con la especificada.
            $validacion["email"] = "El E-mail ingresado ya está en uso. Por favor elija otro.";
        }
        
        if ($datos["email"]!==$datos["emailConfirm"]){
            $validacion["emailConfirm"] = "Los E-mails no coinciden.";
        }
        
        // Le saco las validaciones adicionales de la password porque me tienen las bolas llenas.
        
        /*$mayuscula = preg_match('@[A-Z]@', $datos["password"]);
        $minuscula = preg_match('@[a-z]@', $datos["password"]);
        $numeros = preg_match('@[0-9]@', $datos["password"]);*/
        
        if (strlen($datos["password"])<10){
            $validacion["password"] = "La contraseña debe ser mayor a 10 caracteres.";
        } elseif (strlen($datos["password"])>16) {
            $validacion["password"] = "La contraseña debe ser menor a 16 caracteres.";
        } /*elseif(!$mayuscula){
            $validacion["password"] = "La contraseña debe tener al menos una letra mayúscula.";
        } elseif(!$minuscula){
            $validacion["password"] = "La contraseña debe tener al menos una letra minúscula.";
        } elseif(!$numeros){
            $validacion["password"] = "La contraseña debe tener al menos un número.";
        }*/
        
        if ($datos["password"]!==$datos["passwordConfirm"]){
            $validacion["passwordConfirm"] = "Las contraseñas no coinciden.";
        }
        
        $time = strtotime($datos["fechaNac"]);
        $date = getdate($time);
        $fechaNacimiento = mktime(0, 0, 0, $date["mon"], $date["mday"], $date["year"]);
        $hoy['day']   = date('d');
        $hoy['month'] = date('m');
        $hoy['year']  = date('Y') - 18;
        $fechaHoy = mktime(0, 0, 0, $hoy['month'], $hoy['day'], $hoy['year']);
        
        if ($fechaNacimiento > $fechaHoy) {
            $validacion["fechaNac"] = "Debe ser mayor de 18 años para registrarse.";
        }
        
        if (!isset($datos["sexo"])){
            $validacion["sexo"] = "Por favor elija su sexo.";
        }
        
        if (!isset($datos["intereses"])){
            $validacion["intereses"] = "Debe elegir al menos una opción.";
        }
        
        if (!isset($datos["nacionalidad"])){
            $validacion["nacionalidad"] = "Elija su país de nacimiento.";
        }
        
        return $validacion;
    }

    function validarImagen($datos, $imagen){
        $imgValida = '';
        if ($imagen["avatar"]["error"] === UPLOAD_ERR_OK){
            $name = $imagen["avatar"]["name"];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                $size = $imagen["avatar"]["size"];
                if ($size < 2097152) {
                    $temp = $imagen["avatar"]["tmp_name"];
                    $file = 'avatares/'.'avatar_'.$datos["username"].'.'.$ext;
                    move_uploaded_file($temp, $file);
                } else {
                    $imgValida = "La imagen debe ser menor a 2 MB";
                }
            } else {
                $imgValida = "La imagen debe ser de tipo .png, .jpg, .jpeg o .gif";
            }
        } else {
            $imgValida = "Hubo un error al cargar la imagen. Intente nuevamente.";
        }
        return $imgValida;
    }
    
    function registrarUsuario($datos, $imagen){
        $imgValida = validarImagen($datos, $imagen);
        if (empty($imgValida)) {
            unset($datos["passwordConfirm"], $datos["emailConfirm"]);
            $datos["password"] = password_hash($datos["password"], PASSWORD_DEFAULT);
            $name = $imagen["avatar"]["name"];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $datos["avatar"] = 'avatar_'.$datos["username"].'.'.$ext;
            $jsonActual = file_get_contents("datos.json");
            $jsonActual = json_decode($jsonActual, true);
            $jsonActual["usuarios"][]=$datos;
            $jsonNuevos = json_encode($jsonActual);
            file_put_contents("datos.json", $jsonNuevos);
            header("Location:exito.php?registro=ok");
        } else {
            return $imgValida;
        }     
    }

    function validarLogin($datos){
        $json = file_get_contents("datos.json");
        $json = json_decode($json, true);
        for ($i=0;$i<count($json["usuarios"]);$i++){
            $userData = $json["usuarios"][$i];
            if ($userData["username"]==$datos["username"]){
                if (password_verify($datos["password"],$userData["password"])){
                    session_start();
                    $_SESSION["user"] = $userData;
                    header("Location:exito.php?login=ok");
                    break;
                }
            } 
        }
        return "Los datos ingresados no son correctos.";
    }

    function editarImagen($sesion, $imagen){
        $imgValida = '';
        if ($imagen["avatar"]["error"] === UPLOAD_ERR_OK){
            $name = $imagen["avatar"]["name"];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif') {
                $size = $imagen["avatar"]["size"];
                if ($size < 2097152) {
                    $temp = $imagen["avatar"]["tmp_name"];
                    $result = glob("avatares/avatar_".$sesion["user"]["username"].".*");
                    if ($result){
                        foreach ($result as $imgVieja){
                            unlink($imgVieja);
                        }
                    }
                    $file = 'avatares/'.'avatar_'.$sesion["user"]["username"].'.'.$ext;
                    move_uploaded_file($temp, $file);
                } else {
                    $imgValida = "La imagen debe ser menor a 2 MB";
                }
            } else {
                $imgValida = "La imagen debe ser de tipo .png, .jpg, .jpeg o .gif";
            }
        } else {
            $imgValida = "Hubo un error al cargar la imagen. Intente nuevamente.";
        }
        return $imgValida;
    }

    function editarDatos($datos, $sesion, $imagen=''){
        $validacion = [];
        $json = file_get_contents("datos.json");
        $json = json_decode($json, true);
        if (strlen($datos["nombre"])<2){
            $validacion["nombre"] = 'El nombre debe ser mayor a 2 caracteres.';
        } elseif (!preg_match('/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/', $datos["nombre"])) {
            $validacion["nombre"] = 'El nombre debe contener sólo letras.';
        }
        if (!$imagen == ''){
           $imgValida = editarImagen($sesion, $imagen);
        }
        if (!$validacion && empty($imgValida)) {
            for ($i=0;$i<count($json["usuarios"]);$i++){
                $userData = $json["usuarios"][$i];
                if ($userData["username"]==$sesion["user"]["username"]){
                    $userData["nombre"] = $datos["nombre"];
                    $userData["descripcion"] = $datos["descripcion"];
                    $name = $imagen["avatar"]["name"];
                    $ext = pathinfo($name, PATHINFO_EXTENSION);
                    $userData["avatar"] = 'avatar_'.$sesion["user"]["username"].'.'.$ext;
                    $json["usuarios"][$i] = $userData;
                }
            }
            $jsonUpdate = json_encode($json);
            file_put_contents("datos.json", $jsonUpdate);
            session_start();
            $_SESSION["user"] = $userData;
            header("Location: perfil.php");
        } elseif (!$validacion){
            for ($i=0;$i<count($json["usuarios"]);$i++){
                $userData = $json["usuarios"][$i];
                if ($userData["username"]==$sesion["user"]["username"]){
                    $userData["nombre"] = $datos["nombre"];
                    $userData["descripcion"] = $datos["descripcion"];
                    $json["usuarios"][$i] = $userData;
                }
            }
            $jsonUpdate = json_encode($json);
            file_put_contents("datos.json", $jsonUpdate);
            session_start();
            $_SESSION["user"] = $userData;
            header("Location: perfil.php");
        }
        return $validacion;
    }

?>