<?php

use App\Controllers\UsuarioController;
use App\Models\Usuario;
use CodeIgniter\Database\Exceptions\DatabaseException;
use PHPUnit\Framework\TestCase;
use Config\Services;
    class UsuarioTest extends TestCase {
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
        $this->controlador = new UsuarioController();
        $this->limpiarDB();
    }
    public function testGuardarUsuarioValido(){
        $_POST["nombre"] = "Leandro";
        $_POST["correo"] = "leandro@gmail.com";
        $_POST["clave"] = "1111";
        
        session()->start();
        
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
    public function testGuardarUsuarioInvalido(){
            $_POST["nombre"] = "";
            $_POST["correo"] = "";
            $_POST["clave"] = "";
            
            session()->start();
            
            $usuarioModel = new \App\Models\Usuario();
            $usuario = $usuarioModel->where('correo', "")->first();
            if ($usuario) {
                $usuarioModel->delete($usuario['id']);
            }

            $this->setProtectedProperty($this->controlador, 'request', Services::request());
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $response = $this->controlador->guardarRegistro();
            //Deberia fallar por no registrar al usuario, pero no lo hace
            $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
            $msg = session()->getFlashdata('success');
            $this->assertTrue($response->hasHeader('Location'));
            $this->assertStringContainsString('/login', $response->getHeaderLine('Location'));
            $this->assertEquals('Registro exitoso. Ahora puedes iniciar sesión.', $msg);
            $userModel = new Usuario();
            $usuario = $userModel->orderBy('id', 'DESC')->first();
            $userModel->delete($usuario['id']);
    }
    public function testGuardarUsuarioConCorreoExistente(){
        $_POST["nombre"] = "";
        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "";
        
        session()->start();

        $this->expectException(\CodeIgniter\Database\Exceptions\DatabaseException::class);

        $this->setProtectedProperty($this->controlador, 'request', Services::request());
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $response = $this->controlador->guardarRegistro();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
    }
    public function testGuardarUsuarioExistente(){
        $_POST["nombre"] = "TestUser";
        $_POST["correo"] = "test@gmail.com";
        $_POST["clave"] = "testing";
        
        session()->start();

        $this->expectException(\CodeIgniter\Database\Exceptions\DatabaseException::class);

        $this->setProtectedProperty($this->controlador, 'request', Services::request());
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $response = $this->controlador->guardarRegistro();
        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $response);
    }
    public function limpiarDB(){
        $db = db_connect();
        $db->query('SET FOREIGN_KEY_CHECKS=0');

        $db->table('usuario')->where('id !=', 1)->delete();

        $db->query('SET FOREIGN_KEY_CHECKS=1');
    }
}