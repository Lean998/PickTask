<?php
use PHPUnit\Framework\TestCase;
use Config\Services;
    class SubtareaTest extends TestCase {

    public function testGuardarSubtareaValida(){
    //Declaracion de los datos
    $data = [
        'titulo' => "Subtarea de prueba",
        'descripcion' => 'Esta subtarea es una prueba',
    ];
    //Declaracion de las reglas
    $reglas = [
        'titulo' => 'required|min_length[5]',
        'descripcion' => 'required|min_length[5]',
    ];

    $validation = Services::validation();
    $validation->setRules($reglas);

    //Esperamos que sea True (Datos validos)
    $this->assertTrue($validation->run($data));
    }

public function testGuardarSubtareaInvalida(){
    //Declaracion de los datos
    $data = [
        'titulo' => "",
        'descripcion' => '',
    ];
    //Declaracion de las reglas
    $reglas = [
        'titulo' => 'required|min_length[5]',
        'descripcion' => 'required|min_length[5]',
    ];

    $validation = Services::validation();
    $validation->setRules($reglas);

    //Esperamos que sea False (datos invalidos)
    $this->assertFalse($validation->run($data));
    }   

}