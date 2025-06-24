<?php
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\Subtarea;
    class CoberturaCambiarEstadoTest extends CIUnitTestCase {
    use FeatureTestTrait;
    private $controlador;
    public function testCoberturaDeSentenciaYArco(){
        $modeloSubtarea = new Subtarea();
        
        $actual = $modeloSubtarea->find(1);
        $estadoActual = $actual['estado'];
        switch($estadoActual){
            case 'completada' :
                $nuevoEstado = "en_proceso";
            break;
            case 'en_proceso' :
                $nuevoEstado = "completada";
            break;
            case 'definida':
                $nuevoEstado = "en_proceso";
            break;
        }

        $formData = [
        'subtarea_id' => 1,
        'estado' => $nuevoEstado,
        'tarea_id' => 1
        ];
        $response = $this->post('subtareas/cambiarEstado', $formData);
        $response->assertRedirect();
        $this->assertEquals('Cambio de estado actualizado con éxito.', session()->getFlashdata('mensaje'));
        
        $nuevo = $modeloSubtarea->find(1);
        $estadoFinal = $nuevo['estado'];
        
        $this->assertEquals($nuevoEstado, $estadoFinal);
        $this->assertNotEquals($estadoActual, $estadoFinal);
    }
}