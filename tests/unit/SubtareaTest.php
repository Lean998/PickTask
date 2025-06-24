<?php

use App\Controllers\SubTareaController;
use App\Models\Subtarea;
use App\Models\Tarea;
use CodeIgniter\CodeIgniter;
use PHPUnit\Framework\TestCase;
use Config\Services;
    class SubtareaTest extends TestCase {
    private $controlador;
    private function setProtectedProperty(object $object, string $property, $value): void
    {
        $reflection = new \ReflectionClass($object);
        if ($reflection->hasProperty($property)) {
            $prop = $reflection->getProperty($property);
            $prop->setAccessible(true);
            $prop->setValue($object, $value);
        }
    }
    public function setUp():void{
        parent::setUp();
        Services::reset();
        session()->destroy();
        session()->start();
        $this->controlador = new subTareaController();
    }
    public function testCrearSubtarea(){
        $modeloTarea = new Tarea();

        $tarea = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tarea['id']);
        
        $_POST['titulo'] = 'Subtarea de Prueba';
        $_POST['descripcion'] = 'Subtarea creada para testear el flujo';
        $_POST['estado'] = 'creada' ;
        $_POST['tarea_id'] = $tarea['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $requestSubtarea);
        $this->setProtectedProperty($this->controlador, 'response', Services::response());
        $response = $this->controlador->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('id', $json);
        $this->assertIsNumeric($json['id']);
    }
    public function testCrearSubtareaVacia(){
        $modeloTarea = new Tarea();
        $tarea = $modeloTarea->orderBy('id', 'DESC')->first();

        session()->start();
        session()->setFlashdata('tarea_id', $tarea['id']);
        
        $_POST['titulo'] = '';
        $_POST['descripcion'] = '';
        $_POST['estado'] = '' ;
        $_POST['tarea_id'] = $tarea['id'];
        $_POST['prioridad'] = '' ;
        $_POST['color'] = '';
        $_POST['fecha_vencimiento'] = '';
        $_POST['fecha_recordatorio'] = '';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $request = Services::request();
        $response = Services::response();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $this->setProtectedProperty($this->controlador, 'response', $response);
        $response = $this->controlador->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertFalse($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('El título y la tarea asociada son requeridos.', $json['message']);
    }
    public function testCrearSubtareaConEstadoInvalido(){
        $modeloTarea = new Tarea();
        $modeloSubtarea = new Subtarea();
        $tarea = $modeloTarea->orderBy('id', 'DESC')->first();

        session()->start();
        session()->setFlashdata('tarea_id', $tarea['id']);
        
        $_POST['titulo'] = 'Subtarea de Prueba';
        $_POST['descripcion'] = 'Subtarea creada para testear el flujo';
        $_POST['estado'] = 'invalido' ;
        $_POST['tarea_id'] = $tarea['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $request = Services::request();
        $response = Services::response();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $this->setProtectedProperty($this->controlador, 'response', $response);
        $response = $this->controlador->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        $json = json_decode($response->getBody(), true);
        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('id', $json);
        $this->assertIsNumeric($json['id']);
        $subtarea = $modeloSubtarea->find($json['id']);

        $this->assertEquals('creada', $subtarea['estado']);
    }
    public function testCrearSubtareaConTareaInexistente(){
        $modeloTarea = new Tarea();
        $tarea = $modeloTarea->orderBy('id', 'DESC')->first();

        session()->start();
        session()->setFlashdata('tarea_id', $tarea['id']);
        
        $_POST['titulo'] = 'Subtarea de Prueba';
        $_POST['descripcion'] = 'Subtarea creada para testear el flujo';
        $_POST['estado'] = 'creada' ;
        $_POST['tarea_id'] = -1;
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $request = Services::request();
        $response = Services::response();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $this->setProtectedProperty($this->controlador, 'response', $response);
        $response = $this->controlador->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertFalse($json['success']);
        $this->assertArrayHasKey('message', $json);
        $error = 'Error al guardar la subtarea: Cannot add or update a child row: a foreign key constraint fails (`picktask_test`.`subtarea`, CONSTRAINT `subtarea_ibfk_1` FOREIGN KEY (`tarea_id`) REFERENCES `tarea` (`id`) ON DELETE CASCADE)';
        $this->assertEquals($error, $json['message']);
    }
    public function testEliminarSubtarea(){
        $modeloSubtarea = new Subtarea();
        $subtarea = $modeloSubtarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $subtarea['id']);
        
        $_POST['tarea_id'] = $subtarea['id'];

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $request = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $this->setProtectedProperty($this->controlador, 'response', Services::response());
        $response = $this->controlador->eliminar($subtarea['id']);
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);
        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('Subtarea eliminada correctamente',$json['message']);
        $this->assertNull($modeloSubtarea->find($subtarea['id']));
        $this->limpiarBD();
    }
    private function limpiarBD(){
        $db = db_connect();
        $db->query('SET FOREIGN_KEY_CHECKS=0');

        $db->table('subtarea')->where('id !=', 1)->delete();

        $db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}