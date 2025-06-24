<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;



class CrearTareaTest extends CIUnitTestCase{
    use FeatureTestTrait;
    public function equivalenciaDebilProvider(): array
{
    return [
        "Color rojo con prioridad baja" => [[
            'titulo' => 'Tarea A',
            'descripcion' => 'Descripción ejemplo',
            'prioridad' => 'baja',
            'fecha_vencimiento' => '2025-12-01',
            'fecha_recordatorio' => '2025-11-30',
            'color' => 'rojo',
        ]],
        "Color azul con prioridad normal" => [[
            'titulo' => 'Tarea B',
            'descripcion' => 'Otra descripción',
            'prioridad' => 'normal',
            'fecha_vencimiento' => '2025-12-02',
            'fecha_recordatorio' => '2025-12-01',
            'color' => 'azul',
        ]],
        "Color naranja con prioridad alta" => [[
            'titulo' => 'Tarea C',
            'descripcion' => 'Texto cualquiera',
            'prioridad' => 'alta',
            'fecha_vencimiento' => '2025-12-03',
            'fecha_recordatorio' => '2025-12-02',
            'color' => 'naranja',
        ]],
        "Color verde con prioridad baja" => [[
            'titulo' => 'Tarea D',
            'descripcion' => 'Otra tarea',
            'prioridad' => 'baja',
            'fecha_vencimiento' => '2025-12-04',
            'fecha_recordatorio' => '2025-12-03',
            'color' => 'verde',
        ]],
        "Color celeste con prioridad normal" => [[
            'titulo' => 'Tarea E',
            'descripcion' => 'Desc E',
            'prioridad' => 'normal',
            'fecha_vencimiento' => '2025-12-05',
            'fecha_recordatorio' => '2025-12-04',
            'color' => 'celeste',
        ]],
        "Color gris con prioridad alta" => [[
            'titulo' => 'Tarea F',
            'descripcion' => 'Tarea gris',
            'prioridad' => 'alta',
            'fecha_vencimiento' => '2025-12-06',
            'fecha_recordatorio' => '2025-12-05',
            'color' => 'gris',
        ]],
        "Color violeta con prioridad baja" => [[
            'titulo' => 'Tarea G',
            'descripcion' => 'Final test',
            'prioridad' => 'baja',
            'fecha_vencimiento' => '2025-12-07',
            'fecha_recordatorio' => '2025-12-06',
            'color' => 'violeta',
        ]],
    ];
    }
    /**
    * @dataProvider equivalenciaDebilProvider
    */
    public function testCrearTareaEquivalenciaDebil(array $formData)
    {
        $response = $this->post('tareas/guardar', $formData);
        $response->assertRedirect();
        $mensaje = session('mensaje');
        $this->assertEquals('Tarea creada con éxito', $mensaje);
    }
    public function equivalenciaFuerteProvider(): array
    {
    $T = ['Tarea válida'];           
    $P = ['baja', 'normal', 'alta'];      
    $F = ['2025-12-31'];                  
    $FR = ['2025-12-30'];                 
    $C = ['rojo', 'azul', 'naranja', 'verde', 'celeste', 'gris', 'violeta'];

    $resultados = [];

    foreach ($T as $titulo) {
        foreach ($P as $prioridad) {
            foreach ($F as $fecha) {
                foreach ($FR as $recordatorio) {
                    foreach ($C as $color) {
                        $formData = [
                            'titulo' => $titulo,
                            'descripcion' => 'Descripción ejemplo',
                            'prioridad' => $prioridad,
                            'fecha_vencimiento' => $fecha,
                            'fecha_recordatorio' => $recordatorio,
                            'color' => $color,
                        ];
                        $resultados[] = [$formData];
                    }
                }
            }
        }
    }
    return $resultados;
    }
    /**
    * @dataProvider equivalenciaFuerteProvider
    */
    public function testCrearTareaEquivalenciaFuerte(array $formData)
    {
        $response = $this->post('tareas/guardar', $formData);

        $response->assertRedirect();
        $response->assertSessionHas('mensaje');

        $mensaje = session('mensaje');
        $this->assertIsString($mensaje);
        $this->assertEquals('Tarea creada con éxito', $mensaje);
    }
}
