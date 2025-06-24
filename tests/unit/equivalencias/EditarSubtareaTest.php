<?php

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\Tarea;
use Config\Services;
use App\Controllers\subTareaController;

class EditarSubtareaTest extends CIUnitTestCase{
    use FeatureTestTrait;
    private static $id = 1;

    private function setProtectedProperty(object $object, string $property, $value): void
    {
        $reflection = new \ReflectionClass($object);
        if ($reflection->hasProperty($property)) {
            $prop = $reflection->getProperty($property);
            $prop->setAccessible(true);
            $prop->setValue($object, $value);
        }
    }
    public static function setUpBeforeClass(): void
    {
        $modeloTarea = new Tarea();
        $tarea = $modeloTarea->orderBy('id', 'DESC')->first();
        if (empty($tarea)) {
            $modeloTarea->insert([
                'id' => 1,
                'titulo' => 'Tarea A',
                'descripcion' => 'Descripción ejemplo',
                'prioridad' => 'baja',
                'fecha_vencimiento' => '2025-12-01',
                'fecha_recordatorio' => '2025-11-30',
                'color' => 'rojo',
                ]);
            $tarea = $modeloTarea->orderBy('id', 'DESC')->first();
        }
    }
    public function equivalenciaDebilSubtareaProvider(): array{
        $this->setUp();
        return [
                'Variación de Título' => [[
                    'titulo' => 'Subtarea',          
                    'descripcion' => 'Desc.',            
                    'estado' => 'definida', 
                    'tarea_id' => self::$id,               
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '2025-12-29',
                    'color' => 'rojo',                   
                ]],

                'Variación de Estado' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Desc.',         
                    'estado' => 'en_proceso',
                    'tarea_id' => self::$id,              
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '2025-12-29',
                    'color' => 'rojo',                   
                ]],

                'Subtarea Completada' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Desc.',         
                    'estado' => 'completada',
                    'tarea_id' => self::$id,              
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '2025-12-29',
                    'color' => 'rojo',                   
                ]],

                'Variación de Prioridad' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Desc.',            
                    'estado' => 'definida',
                    'tarea_id' => self::$id,                  
                    'prioridad' => 'Alta',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '2025-12-29',
                    'color' => 'rojo',                   
                ]],

                'Variación de Fecha de Vencimiento' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Desc.',            
                    'estado' => 'definida',
                    'tarea_id' => self::$id,                  
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-31',  
                    'fecha_recordatorio' => '2025-12-30',
                    'color' => 'rojo',                   
                ]],

                'Variación de Fecha de Recordatorio' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Desc.',            
                    'estado' => 'definida',
                    'tarea_id' => self::$id,                  
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '',         
                    'color' => 'rojo',                   
                ]],

                'Variación de Color' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Desc.',            
                    'estado' => 'definida',
                    'tarea_id' => self::$id,                  
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '2025-12-29',
                    'color' => 'azul',                   
                ]],

                'Variación de Descripción' => [[
                    'titulo' => 'Subtarea',              
                    'descripcion' => 'Una descripción extensa de prueba válida.', 
                    'estado' => 'definida',
                    'tarea_id' => self::$id,                  
                    'prioridad' => 'baja',               
                    'fecha_vencimiento' => '2025-12-30', 
                    'fecha_recordatorio' => '2025-12-29',
                    'color' => 'rojo',                   
                ]],
            ];
    }
    /**
    * @dataProvider equivalenciaDebilSubtareaProvider
     */
    public function testEditarSubtareaEquivalenciaDebil(array $formData){
    $subtareaController = new subtareaController();
        $_POST = [];
        foreach ($formData as $key => $value) {
            $_POST[$key] = $value;
        }

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $response = Services::response();
        $this->setProtectedProperty($subtareaController, 'request', $requestSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->editar(self::$id);
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

    
        $json = json_decode($response->getBody(), true);    
        $this->assertIsArray($json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('Subtarea actualizada con éxito', $json['message']);
    }
    public function equivalenciaFuerteProvider(): array
    {
    $T = ['Subtarea válida'];
    $P = ['baja', 'normal', 'alta'];      
    $E = ['definida', 'en_proceso', 'completada'];           
    $F = ['2025-12-31'];                  
    $FR = ['2025-12-30'];                 
    $C = ['rojo', 'azul', 'naranja', 'verde', 'celeste', 'gris', 'violeta'];
    $modeloTarea = new Tarea();
    $tarea = $modeloTarea->orderBy('id', 'DESC')->first();
    self::$id = $tarea['id'];
    $resultados = [];

    foreach ($T as $titulo) {
        foreach ($P as $prioridad) {
            foreach ($F as $fecha) {
                foreach ($FR as $recordatorio) {
                    foreach ($C as $color) {
                        foreach($E as $estado){
                            $formData = [
                            'titulo' => $titulo,
                            'descripcion' => 'Descripción ejemplo',
                            'prioridad' => $prioridad,
                            'estado' => $estado,
                            'tarea_id' => self::$id,
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
    }
    return $resultados;
    }
    /**
    * @dataProvider equivalenciaFuerteProvider
    */
    
    public function testEditarTareaEquivalenciaFuerte(array $formData)
    {
        $subtareaController = new subtareaController();
        $_POST = [];
        foreach ($formData as $key => $value) {
            $_POST[$key] = $value;
        }

        $_SERVER['HTTP_X_REQUESTED_WITH'] = 'XMLHttpRequest';
        $_SERVER['REQUEST_METHOD'] = 'POST';

        Services::reset();
        $requestSubtarea = Services::request();
        $response = Services::response();
        $this->setProtectedProperty($subtareaController, 'request', $requestSubtarea);
        $this->setProtectedProperty($subtareaController, 'response', $response);
        $response = $subtareaController->editar(self::$id);
        
        $this->assertInstanceOf(\CodeIgniter\HTTP\ResponseInterface::class, $response);
        
        $json = json_decode($response->getBody(), true);

    
        $json = json_decode($response->getBody(), true);    
        $this->assertIsArray($json);
        $this->assertTrue($json['success']);
        $this->assertArrayHasKey('message', $json);
        $this->assertEquals('Subtarea actualizada con éxito', $json['message']);
    }
}
