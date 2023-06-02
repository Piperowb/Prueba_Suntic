<?php

class ItemModel
{
    private $db;

    public function __construct()
    {
        // Iniciar conexion a la base de datos
        $this->db = new PDO('mysql:host=localhost;dbname=prueba_suntic', 'root', '');
    }

    public function getAllItems()
    {
        // Recuperar todos los elementos de la base de datos
        $query = $this->db->prepare('SELECT id, nombre_archivo, ruta_archivo, fecha_creacion FROM documentos');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemById($id)
    {
        // Recuperar un elemento por ID de la base de datos
        $query = $this->db->prepare('SELECT id, nombre_archivo, ruta_archivo, fecha_creacion FROM documentos
                                     WHERE documentos.id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createItem($data, $url)
    {
        // Insertar los datos del crear
        $query = $this->db->prepare('INSERT INTO documentos (nombre_archivo, ruta_archivo) VALUES (:nombre_archivo, :ruta_archivo)');
        $query->execute([
            'nombre_archivo' => $data['nombre'],
            'ruta_archivo' => $url,
        ]);

        $lastId = $this->db->lastInsertId();
        return $lastId;
    }

    public function updateItem($id, $data, $url)
    {   
        // Actualizar los datos
        if($url==""){
            $query = $this->db->prepare('UPDATE documentos SET nombre_archivo = :nombre_archivo
                                         WHERE id = :id');
            $query->execute([
                'nombre_archivo' => $data['nombre'],
                'id' => $id,
            ]);
        }else{
            $query = $this->db->prepare('UPDATE documentos SET nombre_archivo = :nombre_archivo, ruta_archivo = :ruta_archivo
                                         WHERE id = :id');
            $query->execute([
                'nombre_archivo' => $data['nombre'],
                'ruta_archivo' => $url,
                'id' => $id,
            ]);
        }
        
        return $query->rowCount();
    }

    public function deleteItem($id)
    {
        // Eliminar los datos
        $query = $this->db->prepare('DELETE FROM documentos WHERE id = :id');
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}