<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Documentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .center {
            text-align: center;
        }

        a {
            display: inline-block;
            margin-right: 5px;
            text-decoration: none;
            color: #333;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        a:hover {
            background-color: #ddd;
        }

        .a_crear {
            font-size: 16px;
            color: white; 
            background-color: #0086b3; 
            padding: 8px 16px; 
            border-radius: 4px; 
            text-decoration: none;
        }

        .confirmation-message {
            background-color: #E9F7EF;
            color: #008000;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .confirmation-message p {
            margin: 0;
            flex-grow: 1;
        }

        .confirmation-message .close {
            color: #008000;
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .actions a {
            margin-left: 10px;
        }

        .actions .a_crear {
            font-size: 16px;
            color: white;
            background-color: #0086b3;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }

            .actions {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>
    
</head>
<body>
    <div class="container">
        <h1>Lista de Documentos</h1>
        <div class="actions">
            <a href="?action=create" class="a_crear">
                <i class="fa-sharp fa-solid fa-user-plus"></i> Crear
            </a>
        </div>
        <table>
        <thead>
            <tr>
                <th class="center"><i class="fa-solid fa-user"></i> Nombre</th>
                <th class="center">Visualizar Documentos</th>
                <th class="center">Modificar</th>
                <th class="center">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td class="center"><?php echo $item['nombre_archivo']; ?></td>
                    <td class="center"><a href="<?php echo $item['ruta_archivo']; ?>" target="_blank"><i class="fa-solid fa-eye fa-xl"></i></a></td>
                    <td class="center"><a href="?action=edit&id=<?php echo $item['id']; ?>"><i class="fa-solid fa-pen-to-square fa-xl"></i></a></td>
                    <td class="center"><a href="?action=delete&id=<?php echo $item['id']; ?>"><i class="fa-regular fa-trash-can fa-xl" style="color: #2f3d56;"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br>


        <?php
            // Verificar si hay un mensaje de confirmación
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
                echo "<div class='confirmation-message'>
                        <p>$message</p>
                        <button type='button' class='close' onclick='closeConfirmationMessage(this)'>&times;</button>
                    </div>";
            }
        ?>
    </div>

    <script src="https://kit.fontawesome.com/a7fe91611d.js" crossorigin="anonymous"></script>
    <script src="views/js/scripts.js"></script>
</body>
</html>
