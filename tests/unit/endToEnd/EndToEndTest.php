<?php

use App\Controllers\subTareaController;
use App\Controllers\TareaController;
use App\Controllers\UsuarioController;
use App\Models\Subtarea;
use App\Models\Tarea;
use PHPUnit\Framework\TestCase;
use Config\Services;
    class EndToEndTest extends TestCase {
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
    public function setUp(): void{
        parent::setUp();
        session()->destroy();
        Services::reset();
        $tareaModel = new Tarea();
        $tareas = $tareaModel->findAll();
        if(sizeof($tareas) >= 12){
            $tareaModel->where('usuario_id', 1)->delete();
        }

        $subtareaModel = new Subtarea();
        $subtareas = $subtareaModel->findAll();
        if(sizeof($subtareas) >= 10){
            $subtareaModel->where('usuario_id', 1)->delete();
        }
    }
    public function testRegistrarUsuario(){
            $this->controlador = new UsuarioController();
            
            $_POST["nombre"] = "Leandro";
            $_POST["correo"] = "leandro@gmail.com";
            $_POST["clave"] = "1111";

            $usuarioModel = new \App\Models\Usuario();
            $usuario = $usuarioModel->where('correo', "leandro@gmail.com")->first();
            if ($usuario) {
                $usuarioModel->delete($usuario['id']);
            }

            $this->setProtectedProperty($this->controlador, 'request', Services::request());
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $response = $this->controlador->guardarRegistro();

            $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
            $msg = session()->getFlashdata('success');
            $this->assertTrue($response->hasHeader('Location'));
            $this->assertStringContainsString('/login', $response->getHeaderLine('Location'));
            $this->assertEquals('Registro exitoso. Ahora puedes iniciar sesión.', $msg);
    }
    public function testIniciarSesion(){
            $this->controlador = new UsuarioController();
            
            $_POST["correo"] = "leandro@gmail.com";
            $_POST["clave"] = "1111";
            session()->start();

            $this->setProtectedProperty($this->controlador, 'request', Services::request());
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $response = $this->controlador->autenticar();

            $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
            $this->assertTrue( session()->get('isLoggedIn'));
    }
    public function testIniciarSesionDatosInvalidos(){
        $this->controlador = new UsuarioController();
        $_POST["correo"] = "leandro12@gmail.com";
        $_POST["clave"] = "1111";
        session()->start();

        $this->setProtectedProperty($this->controlador, 'request', Services::request());
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $response = $this->controlador->autenticar();

        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertEquals('Correo o contraseña incorrectos', session()->getFlashdata('error'));
    }
    public function testIniciarSesionYCrearTarea(){
        $this->controlador = new TareaController();
        $userController = new UsuarioController();

        session()->start();

        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestLogin = Services::request();
        $this->setProtectedProperty($userController, 'request', $requestLogin);
        
        $response = $userController->autenticar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertTrue( session()->get('isLoggedIn'));

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
        $requestTarea = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $requestTarea);

        $response = $this->controlador->guardar();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $msg = session()->getFlashdata('mensaje');
        $this->assertEquals('Tarea creada con éxito', $msg);
    }
    public function testIniciarSesionYEditarTareaExistente(){
        $this->controlador = new TareaController();
        $userController = new UsuarioController();

        session()->start();

        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestLogin = Services::request();
        $this->setProtectedProperty($userController, 'request', $requestLogin);
        
        $response = $userController->autenticar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertTrue( session()->get('isLoggedIn'));

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
        
        $tareaActualizada = $modeloTarea->orderBy('id', 'DESC')->first();

        $this->assertEquals($tareaActual['id'], $tareaActualizada['id']);
        $this->assertNotEquals($tareaActual['titulo'], $tareaActualizada['titulo']);
        $this->assertNotEquals($tareaActual['descripcion'], $tareaActualizada['titulo']);
        $this->assertNotEquals($tareaActual['fecha_recordatorio'], $tareaActualizada['fecha_recordatorio']);
        $this->assertNotEquals($tareaActual['color'], $tareaActualizada['color']);
    }
    public function testIniciarSesionCrearTareaConSubtareaYCompletarSubtarea(){
        $this->controlador = new TareaController();
        $userController = new UsuarioController();
        $subtareaController = new subTareaController;

        session()->start();

        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestLogin = Services::request();
        $this->setProtectedProperty($userController, 'request', $requestLogin);
        
        $response = $userController->autenticar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertTrue( session()->get('isLoggedIn'));

        $modeloTarea = new Tarea();
        $modeloSubtarea = new Subtarea();

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
        $requestTarea = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $requestTarea);
        $response = $this->controlador->guardar();
        
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);
        
        $_POST['titulo'] = 'Subtarea a editar';
        $_POST['descripcion'] = 'Subtarea creada para testear el flujo de edicion';
        $_POST['estado'] = 'creada' ;
        $_POST['tarea_id'] = $tareaActual['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $this->setProtectedProperty($subtareaController, 'request', $requestSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('id', $json);
        $this->assertIsNumeric($json['id']);
        
        $subtareaActual = $modeloSubtarea->orderBy('id', 'DESC')->first();
        
        $_POST['titulo'] = 'Subtarea editada';
        $_POST['descripcion'] = 'Subtarea editada para testear el flujo de edicion';
        $_POST['estado'] = 'completada';
        $_POST['tarea_id'] = $tareaActual['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestEditarSubtarea = Services::request();
        $this->setProtectedProperty($subtareaController, 'request', $requestEditarSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->editar($subtareaActual['id']);

        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        $json = json_decode($response->getBody(), true);
        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('Subtarea actualizada con éxito', $json['message']);

        $subtareaEditada = $modeloSubtarea->find($subtareaActual['id']);
        
        $this->assertNotEquals($subtareaActual['titulo'], $subtareaEditada['titulo']);
        $this->assertNotEquals($subtareaActual['descripcion'], $subtareaEditada['descripcion']);
        $this->assertNotEquals($subtareaActual['estado'], $subtareaEditada['estado']);

        $tareaActualizada = $modeloTarea->find($tareaActual['id']);

        $this->assertNotEquals($tareaActual['estado'], $tareaActualizada['estado']);
    }
    public function testIniciarSesionYCrearSubtareaParaTareaExistente(){
        $this->controlador = new TareaController();
        $userController = new UsuarioController();
        $subtareaController = new subTareaController;

        session()->start();

        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestLogin = Services::request();
        $this->setProtectedProperty($userController, 'request', $requestLogin);
        
        $response = $userController->autenticar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertTrue( session()->get('isLoggedIn'));

        $modeloTarea = new Tarea();

        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);
        
        $_POST['titulo'] = 'Subtarea de Prueba';
        $_POST['descripcion'] = 'Subtarea creada para testear el flujo';
        $_POST['estado'] = 'creada' ;
        $_POST['tarea_id'] = $tareaActual['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $this->setProtectedProperty($subtareaController, 'request', $requestSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('id', $json);
        $this->assertIsNumeric($json['id']);
    }
    public function testIniciarSesionCrearTareaCrearSubtareaYEditarSubtarea(){
        $this->controlador = new TareaController();
        $userController = new UsuarioController();
        $subtareaController = new subTareaController;

        session()->start();

        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestLogin = Services::request();
        $this->setProtectedProperty($userController, 'request', $requestLogin);
        
        $response = $userController->autenticar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertTrue( session()->get('isLoggedIn'));

        $modeloTarea = new Tarea();
        $modeloSubtarea = new Subtarea();

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
        $requestTarea = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $requestTarea);
        $response = $this->controlador->guardar();
        
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);
        
        $_POST['titulo'] = 'Subtarea a editar';
        $_POST['descripcion'] = 'Subtarea creada para testear el flujo de edicion';
        $_POST['estado'] = 'creada' ;
        $_POST['tarea_id'] = $tareaActual['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $this->setProtectedProperty($subtareaController, 'request', $requestSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('id', $json);
        $this->assertIsNumeric($json['id']);
        
        $subtareaActual = $modeloSubtarea->orderBy('id', 'DESC')->first();
        
        $_POST['titulo'] = 'Subtarea editada';
        $_POST['descripcion'] = 'Subtarea editada para testear el flujo de edicion';
        $_POST['estado'] = 'en_proceso';
        $_POST['tarea_id'] = $tareaActual['id'];
        $_POST['prioridad'] = 'alta' ;
        $_POST['color'] = 'rojo';
        $_POST['fecha_vencimiento'] = '2025-07-05';
        $_POST['fecha_recordatorio'] = '2025-07-01';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestEditarSubtarea = Services::request();
        $this->setProtectedProperty($subtareaController, 'request', $requestEditarSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->editar($subtareaActual['id']);

        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        $json = json_decode($response->getBody(), true);
        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('Subtarea actualizada con éxito', $json['message']);

        $subtareaEditada = $modeloSubtarea->find($subtareaActual['id']);
        
        $this->assertNotEquals($subtareaActual['titulo'], $subtareaEditada['titulo']);
        $this->assertNotEquals($subtareaActual['descripcion'], $subtareaEditada['descripcion']);
        $this->assertNotEquals($subtareaActual['estado'], $subtareaEditada['estado']);
    }
    public function testIniciarSesionYCrearSubtareaInvalida(){
        $this->controlador = new TareaController();
        $userController = new UsuarioController();
        $subtareaController = new subTareaController;

        session()->start();

        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $requestLogin = Services::request();
        $this->setProtectedProperty($userController, 'request', $requestLogin);
        
        $response = $userController->autenticar();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
        $this->assertTrue( session()->get('isLoggedIn'));

        $modeloTarea = new Tarea();

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
        $requestTarea = Services::request();
        $this->setProtectedProperty($this->controlador, 'request', $requestTarea);
        $response = $this->controlador->guardar();
        
        $tareaActual = $modeloTarea->orderBy('id', 'DESC')->first();
        
        session()->setFlashdata('tarea_id', $tareaActual['id']);
        
        $_POST['titulo'] = '';
        $_POST['descripcion'] = '';
        $_POST['estado'] = '' ;
        $_POST['tarea_id'] = $tareaActual['id'];
        $_POST['prioridad'] = '' ;
        $_POST['color'] = '';
        $_POST['fecha_vencimiento'] = '';
        $_POST['fecha_recordatorio'] = '';

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $responseService = Services::response();
        $this->setProtectedProperty($subtareaController, 'request', $requestSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $responseService);
        $response = $subtareaController->crear();
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

        $this->assertIsArray($json);
        $this->assertArrayHasKey('success', $json);
        $this->assertFalse($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('El título y la tarea asociada son requeridos.', $json['message']);
    }
    public function testIniciarSesionYCerrarSesion(){
            $this->controlador = new UsuarioController();
            
            $_POST["correo"] = "leandro@gmail.com";
            $_POST["clave"] = "1111";
            session()->start();

            $this->setProtectedProperty($this->controlador, 'request', Services::request());
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $response = $this->controlador->autenticar();

            $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
            $this->assertTrue( session()->get('isLoggedIn'));

            $response = $this->controlador->logout();

            $this->assertTrue($response->hasHeader('Location'));
            $this->assertStringContainsString('/login', $response->getHeaderLine('Location'));
            $this->limpiarBD();    
    }
    private function limpiarBD(){
    $db = db_connect();
    $db->query('SET FOREIGN_KEY_CHECKS=0');

    $db->table('tarea')->where('id !=', 1)->delete();
    $db->table('usuario')->where('id !=', 1)->delete();
    $db->table('subtarea')->where('id !=', 1)->delete();

    $db->query('SET FOREIGN_KEY_CHECKS=1');
}    
}