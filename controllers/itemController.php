<?php
require_once './model/model.php';

class ItemController
{
    private $model;

    public function __construct()
    {
        // Inicializar el modelo
        $this->model = new ItemModel();
    }

    public function index()
    {
        // Obtener todos los items del modelo
        $items = $this->model->getAllItems();

        // Pasar los datos a la vista
        include 'views/item-list.php';
    }

    public function create()
    {   
        // Mostrar el formulario de creación de item
        include 'views/item-create.php';
    }

    public function store($data)
    {
        // Validación en el lado del servidor (PHP)
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Validar campos requeridos
            $errors = array();
            if (empty($data['nombre'])) {
                $errors[] = "Por favor, ingresa el nombre del archivo.";
            }

            // Errores adicionales
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p>Error: $error</p>";
                }
                exit; 
            }

            // Validación de tipo de archivo (SOLO PDF)
            $url = ''; // Definir una URL predeterminada

            if(isset($_FILES['adjunto'])){
		        if( $_FILES['adjunto']['type'] == "application/pdf") {
                    
                    $name    =  $_FILES['adjunto']['name']; 
                    $tmpname =  $_FILES['adjunto']['tmp_name'];
                    $ext     =  explode('.',$name);	
                    $ext	 =  end($ext);				// obtener la extension
                    $url    =  'files/';			// ruta donde guardar el documento
                    $url    =  $url.$data['nombre'].'.'.$ext;  

                    if(move_uploaded_file($tmpname, $url)){ 
                        // Si la validación es exitosa, continuar con el procesamiento de los datos
                        // Crear un nuevo item usando el modelo
                        $this->model->createItem($data, $url);

                        // Redirigir al index
                        header("Location: ?action=index&message=El documento se ha insertado exitosamente");
                        exit();
                    }else{
                        echo "<p>Error: Ocurrio un error inesperado, por favor vuelve a intentarlo</p>";
                        exit;
                    }
		        }else{
                    echo "<p>Error: Ingrese un tipo de archivo valido</p>";
                    exit;
                }   
		    }else{ 
               echo "<p>Error: Por favor, seleccione un tipo de archivo valido</p>";
               exit;
            }

        }
    }

    public function edit($id)
    {
        // Obtener los detalles del item del modelo
        $item = $this->model->getItemById($id);

        // Pasar los datos a la vista
        include 'views/item-edit.php';
    }

    public function update($id, $data)
    {
        // Validación en el lado del servidor (PHP)
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Validar campos requeridos
            $errors = array();
            if (empty($data['nombre'])) {
                $errors[] = "Por favor, ingresa el nombre del archivo.";
            }

            // Errores adicionales
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p>Error: $error</p>";
                }
                exit; 
            }

            // Validación de tipo de archivo (SOLO PDF)
            $url = ''; // Definir una URL predeterminada

            if($_FILES['adjunto']['error'] == 4){
            // Si la validación es exitosa, continuar con el procesamiento de los datos
                // Actualizar el item usando el modelo
                //Este update solamente ingresara los datos del nombre, en caso de que no se seleccione un archivo
                $rowCount = $this->model->updateItem($id, $data, $url);

                // Redirigir al index
                header("Location: ?action=index&message=El documento se ha actualizado exitosamente");
                exit();
            }else{
                if(isset($_FILES['adjunto'])){
                    if( $_FILES['adjunto']['type'] == "application/pdf") {
                        
                        $name    =  $_FILES['adjunto']['name']; 
                        $tmpname =  $_FILES['adjunto']['tmp_name'];
                        $ext     =  explode('.',$name);	
                        $ext	 =  end($ext);				// obtener la extension
                        $url    =  'files/';			// ruta donde guardar el documento
                        $url    =  $url.$data['nombre'].'.'.$ext;  
    
                        if(move_uploaded_file($tmpname, $url)){ 
                            // Si la validación es exitosa, continuar con el procesamiento de los datos
                            // Actualizar el item usando el modelo
                            $rowCount = $this->model->updateItem($id, $data, $url);
    
                            // Redirigir al index
                            header("Location: ?action=index&message=El documento se ha actualizado exitosamente");
                            exit();
                        }else{
                            echo "<p>Error: Ocurrio un error inesperado, por favor vuelve a intentarlo</p>";
                            exit;
                        }
                    }else{
                        echo "<p>Error: Ingrese un tipo de archivo valido</p>";
                        exit;
                    }   
                }else{ 
                    echo "<p>Error: Por favor, seleccione un tipo de archivo valido</p>";
                    exit;
                }    
            }

            
        }

    }

    public function delete($id)
    {
        // Eliminar el item usando el modelo
        $rowCount = $this->model->deleteItem($id);

        // Redirigir al index
        header("Location: ?action=index&message=El documento se ha eliminado exitosamente");
        exit();
    }
}
?>
