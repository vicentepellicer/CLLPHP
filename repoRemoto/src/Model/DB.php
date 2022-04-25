<?php
namespace Geeks\Model;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DB{

    public $host="localhost";


    public function __construct()
    {
        // create a log channel
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(__DIR__.'/../../var/log/men.log', Logger::DEBUG));
        $log->info("Creo un nuevo modelo");
    }

    public function getCursos(){
        $conector = new \mysqli("localhost", "root", "", "cursos");
        $resultado = $conector->query("SELECT curso.titulo, especialidad.nombre 
        FROM curso INNER JOIN 
        especialidad ON curso.id_especialidad = especialidad.id;")->fetch_all();
        return $resultado;
    }

}