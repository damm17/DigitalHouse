<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Película</title>
</head>
<body>
    <form id="agregarPelicula" name="agregarPelicula" method="POST">
       @csrf
        <div>
            <label for="titulo">Titulo</label>
            <input type="text" name="titulo" id="titulo"/>
        </div>
        <div>
            <label for="rating">Rating</label>
            <input type="text" name="rating" id="rating"/>
        </div>
        <div>
            <label for="premios">Premios</label>
            <input type="text" name="premios" id="premios"/>
        </div>
        <div>
            <label for="duracion">Duracion</label>
            <input type="text" name="duracion" id="duracion"/>
        </div>
        <div>
            <label>Fecha de Estreno</label>
            <select name="day">
                <option value="">Dia</option>
                <?php for ($i=1; $i < 32; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <select name="month">
                <option value="">Mes</option>
                <?php for ($i=1; $i < 13; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <select name="year">
                <option value="">Anio</option>
                <?php for ($i=1900; $i < 2017; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Agregar Pelicula" name="submit"/>
    </form>
</body>
</html>