<?php

use PHPUnit\Framework\TestCase;
use Config\Services;
    class UsuarioTest extends TestCase {
    
    public function testGuardarUsuarioValido(){
    //Declaracion de los datos
    $data = [
        'nombre' => "John",
        'correo' => 'nuevo@email.com',
        'contrasenia' => 'John123',
    ];
    //Declaracion de las reglas
    $reglas = [
        'nombre' => 'required',
        'correo' => 'required|valid_email',
        'contrasenia' => 'required'
    ];

    $validation = Services::validation();
    $validation->setRules($reglas);

    //Esperamos que sea True (Datos validos)
    $this->assertTrue($validation->run($data));
}

public function testGuardarUsuarioInvalido(){
    //Declaracion de los datos
    $data = [
        'nombre' => "John",
        'correo' => 'nuevo@email.com',
        'contrasenia' => 'John',
    ];
    
    //Declaracion de las reglas
    $reglas = [
        'nombre' => 'required|min_length[5]',
        'correo' => 'required|valid_email',
        'contrasenia' => 'required|min_length[8]'
    ];

    $validation = Services::validation();
    $validation->setRules($reglas);

    //Esperamos que sea False (datos invalidos)
    $this->assertFalse($validation->run($data));
}
    public function testGuardarUsuarioConCorreoExistente(){
        
        //Lista de correos existentes. 
        $correoExistente = [
            ['correo' => 'john89@gmail.com'],
            ['correo' => 'usuario@example.com']
        ];

        //Declaracion de los datos a insertar
        $data = [
            'nombre' => "John",
            'correo' => 'john89@gmail.com',
            'contrasenia' => 'John123',
        ];

        //Declaracion de las reglas de validacion
        $rules = [
            'nombre' => 'required',
            'correo' => 'required|valid_email',
            'contrasenia' => 'required'
        ];
        
        $validation = Services::validation();
        $validation->reset(); 
        $validation->setRules($rules);

        // Validacion basica de los datos
        $this->assertTrue($validation->run($data));

        // Obtener correos atraves de la clave
        $correos = array_column($correoExistente, 'correo');

        // Esperamos que sea True (El correo ya existe.)
        $this->assertTrue(in_array($data['correo'], $correos));
    }

    public function testGuardarUsuarioConContraseniaInvalida(){
        

        //Declaracion de los datos a insertar
        $data = [
            'nombre' => "John",
            'correo' => 'john89@gmail.com',
            'contrasenia' => 'John123',
        ];

        //Declaracion de las reglas de validacion
        $rules = [
            'contrasenia' => 'required|min_length[8]'
        ];
        
        $validation = Services::validation();
        $validation->reset(); 
        $validation->setRules($rules);

        // Validacion basica de los datos
        $this->assertFalse($validation->run($data));
    }
}