<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Documento</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #0086b3;
            color: #fff;
            border-radius: 4px;
        }

        .custom-file-upload:hover {
            background-color: #007199;
        }

        .file-name {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }

        .a_guardar {
            font-size: 15px;
            color: white; 
            background-color: #0086b3; 
            padding: 10px 20px; 
            border-radius: 5px; 
            text-decoration: none;
        }
    </style>
</head>
<body>
    
<div class="container">
    <h1>Editar Documento PDF</h1>
    <form enctype="multipart/form-data" method="POST" action="?action=update&id=<?php echo $item['id']; ?>">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre del archivo" required value="<?php echo $item['nombre_archivo']; ?>">

        <label for="adjunto" class="custom-file-upload">Adjuntar PDF</label>
        <input type="file" name="adjunto" id="adjunto" accept="application/pdf" onchange="showFileName(this)">

        <div id="file-name-container" class="file-name"></div>

        <div style="text-align: right;">
            <button class="a_guardar" type="submit">Guardar</button>
        </div>
    </form>
</div>

<script src="views/js/scripts.js"></script>
<script>
    function showFileName(input) {
        var file = input.files[0];
        var fileName = file.name;
        var fileNameContainer = document.getElementById("file-name-container");
        fileNameContainer.textContent = fileName;
    }
</script>
</body>
</html>
