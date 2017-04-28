<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
/* Controlador Principal que controla la Aplicaion*/
$route['default_controller'] = "home";

/* Controlador encargado de la ruta del Login*/
$route['login'] = "/Users/login";

/* Controlador encargado de la ruta del Signup, el cual es el Registro de Usuario*/
$route['signup'] = "/Users/registration";

/* Controlador encargado de la ruta del Signup, el cual es el Registro de Usuario*/
$route['registration'] = "/Users/registration";

/* Controlador encargado de la ruta del Home, el cual es la Pagina Principal de Bienvenida*/
$route['home'] = "/home/index";

/* Controlador encargado de la ruta del Logout, el cual es para cerrar la sesión*/
$route['logout'] = "/Users/logout";



/* Controlador encargado de la ruta del Account, el cual es para despues de haber ingresado correctamente el login*/
$route['account'] = "/Users/account";

/* Controlador encargado de la ruta del Information Animals, el cual es para despues de haber ingresado correctamente el login y poseen links para los mantenimientos de los animales*/
$route['information_animals'] = "/Users/information_animals";

/* Controlador encargado de la ruta del New Case File, el cual es para despues de haber ingresado correctamente el login y poseen links para la creacion de un expediente a la mascota con su respectivo dueño y mascota*/
$route['new_case_file'] = "/Users/new_case_file";

/* Controlador encargado de la ruta del Owner, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Inserción, Eliminacion y Edición*/
$route['owner'] = "/Users/owner";

/* Controlador encargado de la ruta del Owner Register, crear un nuevo Dueño*/
$route['%20owner_register'] = "/Users/owner_register";


/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Inserción.
$route['%20owner_register'] = "/Users/owner_register";*/
$route['insertOwner'] = "/Users/insertOwner";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Edición*/
$route['users/edit/(:any)'] = '/Users/edit_owner/$1';



/*-------------------        Especie ---------------------------------*/

/* Controlador encargado de la ruta de Especie*/
$route['species'] = "/Users/species";

/* Controlador encargado de la ruta del Owner Register, crear un nuevo Dueño*/
$route['%20species_register'] = "/Users/species_register";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Inserción.*/
$route['insertSpecies'] = "/Users/insertSpecies";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Edición*/
$route['users/editSpecie/(:any)'] = '/Users/edit_species/$1';


/*-------------------        Raza ---------------------------------*/

/* Controlador encargado de la ruta de Especie*/
$route['race'] = "/Users/race";

/* Controlador encargado de la ruta del Owner Register, crear un nuevo Dueño*/
$route['%20race_register'] = "/Users/race_register";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Inserción.*/
$route['insertRace'] = "/Users/insertRace";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Edición*/
$route['users/editRace/(:any)'] = '/Users/edit_race/$1';



/*-------------------        Vacuna ---------------------------------*/

/* Controlador encargado de la ruta de Especie*/
$route['vaccine'] = "/Users/vaccine";

/* Controlador encargado de la ruta del Owner Register, crear un nuevo Dueño*/
$route['%20vaccine_register'] = "/Users/vaccine_register";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Inserción.*/
$route['insertVaccine'] = "/Users/insertVaccine";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Edición*/
$route['users/editVaccine/(:any)'] = '/Users/edit_vaccine/$1';


/*-------------------        Enfermedades ---------------------------------*/

/* Controlador encargado de la ruta de disease*/
$route['disease'] = "/Users/disease";

/* Controlador encargado de la ruta del disease_register, crear un nuevo disease*/
$route['%20disease_register'] = "/Users/disease_register";

/* Controlador encargado de la ruta del insertdisease, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el disease, este es el mantenimiento de Inserción.*/
$route['insertDisease'] = "/Users/insertDisease";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el Dueño, este es el mantenimiento de Edición*/
$route['users/editDisease/(:any)'] = '/Users/edit_disease/$1';


/*-------------------        Vacunas-Enfermades   ---------------------------------*/

/* Controlador encargado de la ruta de vaccine_disease*/
$route['vaccine_disease'] = "/Users/vaccine_disease";

/* Controlador encargado de la ruta del vaccine_disease, crear un nuevo vaccine_disease*/
$route['%20vaccine_disease_register'] = "/Users/vaccine_disease_register";

/* Controlador encargado de la ruta del insertvaccine_disease, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el vaccine_disease, este es el mantenimiento de Inserción.*/
$route['insertVaccine_disease'] = "/Users/insertVaccine_disease";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el vaccine_disease, este es el mantenimiento de Edición*/
$route['users/editVaccine_disease/(:any)'] = '/Users/edit_vaccine_disease/$1';



/*-------------------        MASCOTA   ---------------------------------*/

/* Controlador encargado de la ruta de mascota*/
$route['pet'] = "/Users/pet";

/* Controlador encargado de la ruta del vaccine_disease, crear un nuevo vaccine_disease*/
$route['%20pet_register'] = "/Users/pet_register";

/* Controlador encargado de la ruta del insertvaccine_disease, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el vaccine_disease, este es el mantenimiento de Inserción.*/
$route['insertPet'] = "/Users/insertPet";

/* Controlador encargado de la ruta del Owner Register, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el vaccine_disease, este es el mantenimiento de Edición*/
$route['users/editPet/(:any)'] = '/Users/edit_pet/$1';


/*-------------------        MASCOTA VACUNA ENFERMEDAD   ---------------------------------*/

/* Controlador encargado de la ruta de pet_vacuna_enfermedad*/
$route['pet_vacuna_enfermedad'] = "/Users/pet_vacuna_enfermedad";

/* Controlador encargado de la ruta del pet_vacuna_enfermedad, crear un nuevo pet_vacuna_enfermedad*/
$route['%20pet_vacuna_enfermedad_register'] = "/Users/pet_vacuna_enfermedad_register";

/* Controlador encargado de la ruta del pet_vacuna_enfermedad, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el pet_vacuna_enfermedad, este es el mantenimiento de Inserción.*/
$route['insertPet_vacuna_enfermedad'] = "/Users/insertPet_vacuna_enfermedad";

/* Controlador encargado de la ruta del pet_vacuna_enfermedad, el cual es para despues de haber ingresado correctamente el login, dentro de New Case File y respectivamente el pet_vacuna_enfermedad, este es el mantenimiento de Edición*/
$route['users/editPet_vacuna_enfermedad/(:any)'] = '/Users/edit_pet_vacuna_enfermedad/$1';


/*-------------------        CONSULTAS   ---------------------------------*/

/* Controlador encargado de la ruta de consult_vaccine*/
$route['consult_vaccine'] = "/Users/consult_vaccine";

/* Controlador encargado de la ruta de consult_disease*/
$route['consult_disease'] = "/Users/consult_disease";