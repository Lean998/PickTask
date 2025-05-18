<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'inicio::inicio');
$routes->post('/tarea', 'tareaController::mostrarDetalles');
$routes->get('/colaboradores', 'colaboracionController::mostrarDetalles');
$routes->post('tarea/colaborar', 'colaboracionController::tareaColaborar');
$routes->get('tarea/colaborar', 'colaboracionController::tareaColaborar');
$routes->get('/login', 'UsuarioController::login');
$routes->get('/logout', 'usuarioController::logout');
$routes->get('/registro', 'UsuarioController::registrarse');
$routes->get('tareas/crear', 'tareaController::crear');
$routes->post('tareas/guardar', 'tareaController::guardar');
$routes->get('tareas/guardar', 'tareaController::guardar');
$routes->post('usuario/guardarRegistro', 'usuarioController::guardarRegistro');
$routes->get('usuario/guardarRegistro', 'usuarioController::guardarRegistro');
$routes->post('usuario/autenticar', 'usuarioController::autenticar');
$routes->get('usuario/autenticar', 'usuarioController::autenticar');
$routes->post('subtarea/quitarResponsable', 'subTareaController::quitarResponsable');
$routes->get('subtarea/quitarResponsable', 'subTareaController::quitarResponsable');
$routes->post('subtarea/agregarResponsable', 'subTareaController::agregarResponsable');
$routes->get('subtarea/agregarResponsable', 'subTareaController::agregarResponsable');
$routes->post('/subtareas/cambiarEstado', 'subTareaController::cambiarEstado');
$routes->get('/subtareas/cambiarEstado', 'subTareaController::cambiarEstado');
$routes->post('/tarea/cambiarEstado', 'tareaController::cambiarEstado');
$routes->get('tarea/mostrarDetalles/(:num)', 'TareaController::mostrarDetalles/$1');


$routes->get('/redirigirATarea', 'TareaController::redirigirATarea');
$routes->post('tarea/enviarCorreo', 'invitacionController::enviarCorreo');
$routes->get('tarea/enviarCorreo', 'invitacionController::enviarCorreo');
$routes->get('/Colaborar', 'colaboracionController::ColaborarEnTarea');
$routes->post('invitacion/verificar', 'invitacionController::IniciarColaboracion');
$routes->get('invitacion/verificar', 'invitacionController::IniciarColaboracion');
$routes->get('tareas/historial', 'tareaController::historial');
$routes->get('tarea/archivar/(:num)', 'tareaController::archivar/$1');
$routes->post('tarea/editar', 'TareaController::editar');
$routes->get('tarea/editar', 'TareaController::editar');
$routes->post('tarea/actualizar', 'TareaController::actualizar');
$routes->get('tarea/actualizar', 'TareaController::actualizar');
$routes->post('tarea/baja', 'TareaController::baja');
$routes->get('tarea/baja', 'TareaController::baja');
$routes->post('/tarea', 'tareaController::mostrarDetalles');
$routes->get('/tarea', 'tareaController::mostrarDetalles');
$routes->get('/colaboradores', 'colaboracionController::mostrarDetalles');
$routes->get('usuario/editar', 'UsuarioController::editarView');
$routes->post('usuario/editarguardar', 'UsuarioController::editarGuardar');
$routes->post('usuario/editarguardar', 'UsuarioController::editarGuardar');
$routes->post('subtarea/guardar', 'subTareaController::guardar'); 
$routes->get('subtarea/guardar', 'subTareaController::guardar'); 
$routes->post('subtarea/crear', 'subTareaController::crear');   
$routes->get('subtarea/crear', 'subTareaController::crear');    
$routes->post('subtarea/eliminar/(:num)', 'subTareaController::eliminar/$1');
$routes->get('subtarea/eliminar/(:num)', 'subTareaController::eliminar/$1');
$routes->post('subtarea/editar/(:num)', 'subTareaController::editar/$1');
$routes->get('subtarea/editar/(:num)', 'subTareaController::editar/$1');
$routes->get('tarea/mostrarDetalles', 'tareaController::mostrarDetalles');

