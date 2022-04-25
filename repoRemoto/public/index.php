<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

use Geeks\Model\DB; //require "../src/Model/DB.php";

//Añadir un unico container para toda la aplicación
//$container= new DI\Container();
//AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});
$app->get('/articulos/{id}', function (Request $request, Response $response, $args) {
    $id=$request->getAttribute('id');
    $articulos=["id"=>$id];
    $data=json_encode($articulos);
    $response->getBody()->write($data);
    return $response
    ->withHeader('Content-Type', 'application/json');
});

$app->get('/articulos', function (Request $request, Response $response, $args) {
    $db=new DB();
    $data=json_encode($db->getCursos());
    $response->getBody()->write($data);
    return $response
    ->withHeader('Content-Type', 'application/json');
});

//$app->get('/contactar', 'Geeks\Controller\HomeController:contactar');

$app->run();