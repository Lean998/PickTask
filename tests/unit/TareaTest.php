<?php

use App\Controllers\TareaController;
use App\Models\Tarea;
use PHPUnit\Framework\TestCase;
use Config\Services;
    class TareaTest extends TestCase {
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
        $this->controlador = new TareaController();
    }
    public function testCrearTarea(){
        session()->start();

        $_POST = [];
        $_POST['tarea_id'] = 1;
        $_POST['titulo'] = "Tarea de Prueba";
        $_POST['descripcion'] = "Tarea creada para testear el flujo";
        $_POST['prioridad'] = "normal";
        $_POST['fecha_vencimiento'] = "2025-07-10";
        $_POST['fecha_recordatorio'] = "2025-07-01";
        $_POST['color'] = "azul";

        $_SERVER['REQUEST_METHOD'] = 'POST';
        Services::reset();
        $request = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $request);

        $response = $this->controlador->guardar();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $msg = session()->getFlashdata('mensaje');
        $this->assertEquals('Tarea creada con éxito', $msg);
    }
    public function testEditarTarea(){
        $modeloTarea = new Tarea();
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);
        
        $_POST = [];
        $_POST['id'] = $tareaActual['id'];
        $_POST['titulo'] = "Tarea de Prueba actualizada";
        $_POST['descripcion'] = "Tarea editada para testear el flujo";
        $_POST['prioridad'] = "normal";
        $_POST['fecha_vencimiento'] = "2025-07-10";
        $_POST['fecha_recordatorio'] = "2025-07-08";
        $_POST['color'] = "morado";

        $_SERVER['REQUEST_METHOD'] = 'POST';
        Services::reset();
        $requestTareaUpdate = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $requestTareaUpdate);
        $response = $this->controlador->actualizar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);

        $tareaActualizada = $modeloTarea->orderBy('id', 'DESC')->first();

        $this->assertEquals($tareaActual['id'], $tareaActualizada['id']);
        $this->assertNotEquals($tareaActual['titulo'], $tareaActualizada['titulo']);
        $this->assertNotEquals($tareaActual['descripcion'], $tareaActualizada['titulo']);
        $this->assertNotEquals($tareaActual['fecha_recordatorio'], $tareaActualizada['fecha_recordatorio']);
        $this->assertNotEquals($tareaActual['color'], $tareaActualizada['color']);
        $this->assertEquals('Tarea actualizada con éxito', session()->getFlashdata('mensaje'));
    }
    public function testEliminarTarea(){
        $modeloTarea = new Tarea();
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);
        
        $_POST = [];
        $_POST['id_tarea'] = $tareaActual['id'];

        $_SERVER['REQUEST_METHOD'] = 'POST';
        Services::reset();
        $request = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $response = $this->controlador->baja();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        
        $this->assertNull($modeloTarea->find($tareaActual['id']));
        $this->assertEquals('Tarea eliminada correctamente', session()->getFlashdata('mensaje'));
    }
    public function testArchivarTarea(){
        $modeloTarea = new Tarea();
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        Services::reset();
        $request = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $response = $this->controlador->archivar($tareaActual['id']);
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $msg = session()->getFlashdata('mensaje');
        $this->assertEquals('Tarea archivada correctamente.', $msg);
    }
    public function testDesarchivarTarea(){
        $modeloTarea = new Tarea();
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);

        $_SERVER['REQUEST_METHOD'] = 'POST';
        Services::reset();
        $request = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $request);
        $response = $this->controlador->desarchivar($tareaActual['id']);
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $msg = session()->getFlashdata('mensaje');
        $this->assertEquals('Tarea desarchivada correctamente.', $msg);
        $this->limpiarDB();
    }
    public function limpiarDB(){
        $db = db_connect();
        $db->query('SET FOREIGN_KEY_CHECKS=0');

        $db->table('tarea')->where('id !=', 1)->delete();

        $db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}