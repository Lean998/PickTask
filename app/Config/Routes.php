<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

///Vista Principal
$routes->get('/', 'Home::inicio');
///Vista Tareas
$routes->post('/tarea', 'tareaController::mostrarDetalles');
///Vista Colaboracion
$routes->get('/colaboradores', 'colaboracionController::mostrarDetalles');
// Rutas del login
$routes->get('/login', 'UsuarioController::iniciarSession');
$routes->post('/login/autenticar', 'Login::autenticar');
$routes->get('/logout', 'Login::logout');





 //
$routes->get('/veterinario', 'veterinarioController::listado');
$routes->post('/veterinario/editar', 'veterinarioController::editar');
$routes->post('/veterinario/actualizar', 'veterinarioController::actualizar');
$routes->get('veterinario/alta', 'veterinarioController::alta');
$routes->post('veterinario/guardar', 'veterinarioController::guardar');
$routes->post('veterinario/baja', 'veterinarioController::baja');
$routes->post('veterinario/activar', 'veterinarioController::activar');
$routes->get('veterinario/listado', 'veterinarioController::listado');



//Amo
$routes->get('/amo', 'amoController::amo');
$routes->post('/amo/editar', 'amoController::editar');
$routes->post('/amo/actualizar', 'amoController::actualizar');

//Historial Amo
$routes->get('/historialAmo', 'amo_MascotaController::historialAmo');
//Historial Mascota
$routes->get('/historialMascota', 'MascotaController::historial');




//Amo - Mascota
$routes->post('/mascota/vincular', 'amo_MascotaController::vincular');
$routes->post('/mascota/guardar', 'amo_MascotaController::guardar');
$routes->get('mascota/alta', 'amo_MascotaController::crear');

//Mascota
$routes->get('/mascota/editar/(:num)', 'MascotaController::editar/$1'); // Ver detalles de la mascota para modificar
$routes->post('/mascota/actualizar/(:num)', 'MascotaController::actualizar/$1'); // Guardar cambios
$routes->post('mascota/baja', 'MascotaController::eliminarSeleccionada');
$routes->post('mascota/eliminarSeleccionada', 'MascotaController::eliminarSeleccionada');



