<?php


use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
    class CoberturaLoginTest extends CIUnitTestCase {
    use FeatureTestTrait;
    private $controlador;
    public function testCoberturaDeSentencia(){
        // Caso 1: login correcto (entra al if)
        $formData = ['correo' => 'test@gmail.com', 'clave' => 'testing'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertTrue(session()->get('isLoggedIn'));

        session()->destroy();

        // Caso 2: login incorrecto (entra al else)
        $formData = ['correo' => 'test@gmail.com', 'clave' => '1234'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertEquals('Correo o contraseña incorrectos', session()->getFlashdata('error'));
    }
    public function testCoberturaDeCondicion(){
        // Caso 1: login correcto (entra al if en TT)
        $formData = ['correo' => 'test@gmail.com', 'clave' => 'testing'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertTrue(session()->get('isLoggedIn'));

        session()->destroy();

        // Caso 2: entra al else
        $formData = ['correo' => 'test@gmail.com', 'clave' => '1234'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertEquals('Correo o contraseña incorrectos', session()->getFlashdata('error'));
        
        // Caso 3: entra al if (con TF) y el usuario no existe
        $formData = ['correo' => 'inexistente@gmail.com', 'clave' => 'testing'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertEquals('Correo o contraseña incorrectos', session()->getFlashdata('error'));
    }
    public function testCoberturaDeCondicionMultiple(){
        // Caso 1: entra 1er if TT
        $formData = ['correo' => 'test@gmail.com', 'clave' => 'testing'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertTrue(session()->get('isLoggedIn'));

            session()->destroy();

        // Caso 2: entra 1er if TF
        $formData = ['correo' => 'test@gmail.com', 'clave' => '1234'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertEquals('Correo o contraseña incorrectos', session()->getFlashdata('error'));

        // Caso 3: entra 1er if FF
        $formData = ['correo' => 'inexistente@gmail.com', 'clave' => 'inexistente'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertNull(session()->get('isLoggedIn'));
    }
    public function testCoberturaDeArco(){
        // Caso 1: login correcto (entra al if)
        $formData = ['correo' => 'test@gmail.com', 'clave' => 'testing'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertTrue(session()->get('isLoggedIn'));

        session()->destroy();

        // Caso 2: login incorrecto (entra al else)
        $formData = ['correo' => 'test@gmail.com', 'clave' => '1234'];
        $response = $this->post('usuario/autenticar', $formData);
        $response->assertRedirect();
        $this->assertEquals('Correo o contraseña incorrectos', session()->getFlashdata('error'));
    }
}