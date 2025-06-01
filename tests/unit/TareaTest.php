<?php

use CodeIgniter\Test\FeatureTestTrait;
use PHPUnit\Framework\TestCase;
use App\Models\Tarea;
    class TareaTest extends TestCase {
    use FeatureTestTrait;

    public function testGuardarTareaConDatosValidos(){
        //Inicializar el modelo
        $tarea = new Tarea();

        //Datos validos para una tarea
        $data = [
            'tarea_id' => 1,
            'titulo' => 'Tarea test',
            'descripcion' => 'Desde test',
            'prioridad' => 'normal',
            'fecha_vencimiento' => '2025-12-31',
            'fecha_recordatorio' => '2025-12-01',
            'color' => 'azul',
        ];
        
        //Verificar que los datos sean validos
        //Retornos True (validos) False (Invalidos)
        $result = $tarea->validate($data);

        //Verificar que el resultado obtenido sea True (Valido)
        $this->assertTrue($result);
        
    }


    public function testGuardarTareaConDatosInvalidos(){
        //Inicializar el modelo
        $tarea = new Tarea();

        //Preparacion de datos invalidos
        $data = [
            'tarea_id' => 1,
            'titulo' => '',
            'descripcion' => '',
            'prioridad' => '',
            'fecha_vencimiento' => '',
            'fecha_recordatorio' => '',
            'color' => '',
        ];

        //Verificar que los datos sean validos
        //Retornos True (validos) False (Invalidos)
        $result = $tarea->validate($data);
        
        //Verificar que el resultado obtenido sea false
        $this->assertFalse($result);

        //Almacenar los mensajes de error
        $errors = $tarea->errors();

        //Verificar que los campos obligatorios esten señalados como invalidos/con errores. 
        $this->assertArrayHasKey('titulo', $errors);
        $this->assertArrayHasKey('prioridad', $errors);
    }

}