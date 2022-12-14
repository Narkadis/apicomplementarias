<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//rutas para el API
$routes->group('/',['namespace' => 'App\Controllers'],function($routes){

    $routes->get('departamentos', 'Departamentos::index');
    $routes->post('departamentos', 'Departamentos::create');
    $routes->get('departamentos/(:num)', 'Departamentos::show/$1');
    $routes->put('departamentos/(:num)', 'Departamentos::update/$1');

    $routes->get('jefes', 'JefesDepartamento::index');
    $routes->post('jefes', 'JefesDepartamento::create');
    $routes->get('jefes/(:any)', 'JefesDepartamento::show/$1');
    $routes->put('jefes/(:any)', 'JefesDepartamento::update/$1');

    $routes->get('carrera', 'Carreras::index');
    $routes->post('carrera', 'Carreras::create');
    $routes->get('carrera/(:num)', 'Carreras::show/$1');
    $routes->put('carrera/(:num)', 'Carreras::update/$1');
    
    $routes->get('alumnos', 'Alumnos::index');
    $routes->post('alumnos', 'Alumnos::create');
    $routes->get('alumnos/(:any)', 'Alumnos::show/$1');
    $routes->put('alumnos/(:any)', 'Alumnos::update/$1');
   
    $routes->get('periodo', 'Periodos::index');
    $routes->post('periodo', 'Periodos::create');
    $routes->get('periodo/(:num)', 'Periodos::show/$1');
    $routes->put('periodo/(:num)', 'Periodos::update/$1');

    $routes->get('actcomplementarias', 'ActComplementarias::index');
    $routes->post('actcomplementarias', 'ActComplementarias::create');
    $routes->get('actcomplementarias/(:num)', 'ActComplementarias::show/$1');
    $routes->put('actcomplementarias/(:num)', 'ActComplementarias::update/$1');
    $routes->delete('actcomplementarias/(:num)', 'ActComplementarias::delete/$1');

    $routes->get('tipoact', 'TipoActividades::index');
    $routes->post('tipoact', 'TipoActividades::create');
    $routes->get('tipoact/(:num)', 'TipoActividades::show/$1');
    $routes->put('tipoact/(:num)', 'TipoActividades::update/$1');

    $routes->get('solicitud', 'Solicitudes::index');
    $routes->post('solicitud', 'Solicitudes::create');
    $routes->get('solicitud/(:num)', 'Solicitudes::show/$1');
    $routes->put('solicitud/(:num)', 'Solicitudes::update/$1');
    $routes->delete('solicitud/(:num)', 'Solicitudes::delete/$1');
    
    $routes->get('evidenciascomprobatorias', 'EvidenciaComprobatoria::index');
    $routes->post('evidenciascomprobatorias', 'EvidenciaComprobatoria::create');
    $routes->get('evidenciascomprobatorias/(:num)', 'EvidenciaComprobatoria::show/$1');
    $routes->put('evidenciascomprobatorias/(:num)', 'EvidenciaComprobatoria::update/$1');
    $routes->delete('evidenciascomprobatorias/(:num)', 'EvidenciaComprobatoria::delete/$1');

    $routes->get('evidenciapresentar', 'EvidenciasPresentar::index');
    $routes->post('evidenciapresentar', 'EvidenciasPresentar::create');
    $routes->get('evidenciapresentar/(:num)', 'EvidenciasPresentar::show/$1');
    $routes->put('evidenciapresentar/(:num)', 'EvidenciasPresentar::update/$1');
    $routes->delete('evidenciapresentar/(:num)', 'EvidenciasPresentar::delete/$1');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
