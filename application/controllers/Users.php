<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * user Management class created by CodexWorld
 */
class users extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('user');
    }
    
    /*
     * user account information
     */
    public function account(){
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['owner'] = $this->user->obtener_todos_Owner();
            //load the view
            $this->load->view('users/account', $data);
            }else{
            redirect('users/login');
        }
    }


    /*
     * View Consult Vaccine
     */
    public function consult_vaccine(){
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['pet_vacuna_enfermedad'] = $this->user->obtener_todos_pet_vacuna_enfermedad();
            //load the view
            $this->load->view('consult/consult_vaccine', $data);
            }
    }

    /*
     * View Consult Disease
     */
    public function consult_disease(){
       $data = array();
        if($this->session->userdata('isuserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['pet_vacuna_enfermedad'] = $this->user->obtener_todos_pet_vacuna_enfermedad();          
            $this->load->view('consult/consult_disease', $data);
            }
    }


    
    /*
     * user login
     */
    public function login(){
        $data = array();
        if($this->session->userdata('success_msg')){
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if($this->session->userdata('error_msg')){
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }
        if($this->input->post('loginSubmit')){
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == true) {
                $con['returnType'] = 'single';
                $con['conditions'] = array(
                    'email'=>$this->input->post('email'),
                    'password' => md5($this->input->post('password')),
                    'status' => '1'
                );
                $checkLogin = $this->user->getRows($con);
                if($checkLogin){
                    $this->session->set_userdata('isuserLoggedIn',TRUE);
                    $this->session->set_userdata('userId',$checkLogin['id']);
                    redirect('users/account/');
                    $this->load->view('users/information_animals',$checkLogin);
                }else{
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            }
        }
        //load the view
        $this->load->view('users/login', $data);
    }
    
    /*
     * user registration
     */
    public function registration(){
        $data = array();
        $userData = array();
        if($this->input->post('regisSubmit')){
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

            $userData = array(
                'name' => strip_tags($this->input->post('name')),
                'email' => strip_tags($this->input->post('email')),
                'password' => md5($this->input->post('password')),
                'gender' => $this->input->post('gender'),
                'phone' => strip_tags($this->input->post('phone'))
            );

            if($this->form_validation->run() == true){
                $insert = $this->user->insert($userData);
                if($insert){
                    $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('users/login');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }
        }
        $data['user'] = $userData;
        //load the view
        $this->load->view('users/registration', $data);
    }
    
    /*
     * user logout
     */
    public function logout(){
        $this->session->unset_userdata('isuserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/login/');
    }
    
    /*
     * Existing email check during validation
     */
    public function email_check($str){
        $con['returnType'] = 'count';
        $con['conditions'] = array('email'=>$str);
        $checkEmail = $this->user->getRows($con);
        if($checkEmail > 0){
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /*
    Encargada de abrir la vista para creacion y edicion de mantenimientos de animales.
    */
    public function information_animals(){
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            //load the view
            $this->load->view('users/information_animals', $data);
        }

    }

    /*
    Encargada de abrir la vista para crear un  nuevo expediente.
    */

    public function new_case_file(){
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            //load the view
            $this->load->view('users/new_case_file', $data);
        }

    }



    /*-------------------------------- Dueño ----------------------------------------------------*/

    /*
    Encargado de llamar a la Vista Owner , el cual posee la tabla mantenimiento para los owner
    Esta se utiliza para el link del new_case_file , el boton Owner
    */
    public function owner(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['owner'] = $this->user->obtener_todos_Owner();
            //load the view
            $this->load->view('owner/owner', $data);
        }
    }

    /*
    Encargado de llamar a la Vista Registrar Owner
    Esta se utiliza para el link del Perfil Owner , el boton Crear nuevo Owner
    */
    public function owner_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['owner'] = $this->user->obtener_todos_Owner();
            //load the view
            $this->load->view('owner/insert_owner', $data);
        }
    }

    /*
    Encargado de insertar un nuevo Dueño.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de Dueños en la base de datos
    Insercion de Dueños
    */
    public function insertOwner(){
        $data = array();
        $userData = array();
        if($this->input->post('SumitOwner')){
            $this->form_validation->set_rules('id', 'Id', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('primer_apellido', 'Primer Apellido', 'required');
            $this->form_validation->set_rules('segundo_apellido', 'Segundo Apellido', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required');

            $userData = array(
                'id' => strip_tags($this->input->post('id')),
                'nombre' => strip_tags($this->input->post('nombre')),
                'primer_apellido' => strip_tags($this->input->post('primer_apellido')),
                'segundo_apellido' => strip_tags($this->input->post('segundo_apellido')),
                'telefono' => strip_tags($this->input->post('telefono')),
                'direccion' => strip_tags($this->input->post('direccion'))
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_species($this->input->post('id'));
                if($consulta == false){
                    $insert = $this->user->guardarOwner($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('owner');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20owner_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['owner'] = $this->user->obtener_todos_Owner();
        //load the view
        $this->load->view('owner/owner', $data);
    }



    /*
    Encargado de editar un Dueño.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de Usuarios.
    */
    function edit_owner($id_species) {
             if($this->input->post('editOwnerSumit')){            
            //validate form input
            $this->form_validation->set_rules('id', 'Id', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('primer_apellido', 'Primer Apellido', 'required');
            $this->form_validation->set_rules('segundo_apellido', 'Segundo Apellido', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required');

            $data = array(
                'id' => strip_tags($this->input->post('id')),
                'nombre' => strip_tags($this->input->post('nombre')),
                'primer_apellido' => strip_tags($this->input->post('primer_apellido')),
                'segundo_apellido' => strip_tags($this->input->post('segundo_apellido')),
                'telefono' => strip_tags($this->input->post('telefono')),
                'direccion' => strip_tags($this->input->post('direccion'))
            );

            if ($this->form_validation->run() === true)
            {
                $this->user->update_owner($id_species, $data);
                $this->session->set_flashdata('message', "<p>owner updated successfully.</p>");                
                redirect(base_url().'owner');
            }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['owner'] = $this->user->obtener_todos_Owner_update($id_species);
        //load the view
        $this->load->view('owner/edit_owner', $data);          
    }        

        
    
    /*
    Encargada de la Eliminacion de Dueños.
    */
    public function eliminarOwner($id){
        $this->load->model('user');
        $this->user->eliminarOwner($id);
        redirect('owner');
    }


        /*-------------------------------- Especie ----------------------------------------------------*/

    /*
    Encargado de llamar a la Vista Especie , el cual posee la tabla mantenimiento para los Especie
    Esta se utiliza para el link del new_case_file , el boton Species
    */
    public function species(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['species'] = $this->user->obtener_todos_species();
            //load the view
            $this->load->view('species/specie', $data);
        }
    }

    /*
    Encargado de llamar a la Vista Registrar Owner
    Esta se utiliza para el link del Perfil Owner , el boton Crear nuevo Owner
    */
    public function species_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['species'] = $this->user->obtener_todos_species();
            //load the view
            $this->load->view('species/insert_specie', $data);
        }
    }

    /*
    Encargado de insertar un nuevo Dueño.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de Dueños en la base de datos
    Insercion de Dueños
    */
    public function insertSpecies(){
        $data = array();
        $userData = array();
        if($this->input->post('SumitSpecies')){
            $this->form_validation->set_rules('cod_especie', 'Codigo Especie', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            $userData = array(
                'cod_especie' => strip_tags($this->input->post('cod_especie')),
                'descripcion' => strip_tags($this->input->post('descripcion'))
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_species($this->input->post('cod_especie'));
                if($consulta == false){
                    $insert = $this->user->guardarSpecies($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('species');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20species_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['species'] = $this->user->obtener_todos_species();
        //load the view
        $this->load->view('species/specie', $data);
    }



    /*
    Encargado de editar un Dueño.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de Usuarios.
    */
    function edit_species($id_species) {
             if($this->input->post('SumitSpeciesEdit')){            
            //validate form input
            $this->form_validation->set_rules('cod_especie', 'Codigo Especie', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            $data = array(
                'cod_especie' => strip_tags($this->input->post('cod_especie')),
                'descripcion' => strip_tags($this->input->post('descripcion'))
            );

            if ($this->form_validation->run() === true)
            {
                $this->user->update_species($id_species, $data);
                $this->session->set_flashdata('message', "<p>species updated successfully.</p>");                
                redirect(base_url().'species');
            }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['species'] = $this->user->obtener_todos_Species_update($id_species);
        //load the view
        $this->load->view('species/edit_specie', $data);          
    }        

        
    
    /*
    Encargada de la Eliminacion de Dueños.
    */
    public function eliminarSpecies($cod_especie){
        $this->load->model('user');
        $this->user->eliminarSpecies($cod_especie);
        redirect('species');
    }


    /*-------------------------------- Raza ----------------------------------------------------*/



    /*
    Encargado de llamar a la Vista Especie , el cual posee la tabla mantenimiento para los Especie
    Esta se utiliza para el link del information_animal , el boton Species
    */
    public function race(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['race'] = $this->user->obtener_todos_race();
            //load the view
            $this->load->view('race/race', $data);
        }
    }


    /*
    Encargado de llamar a la Vista Registrar Raza
    Esta se utiliza para el link del Perfil Ra<a , el boton Crear nuevo Raza */
    
    
    public function race_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['race'] = $this->user->obtener_todos_race();
            $data['species'] = $this->user->obtener_todos_species();
            //load the view
            $this->load->view('race/insert_race', $data);
        }
    }
    

    /*
    Encargado de insertar un nuevo RazA.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de Raza en la base de datos
    Insercion de Raza
    */
    public function insertRace(){
        $data = array();
        $userData = array();
        if($this->input->post('SumitRace')){
            $this->form_validation->set_rules('cod_raza', 'Codigo Raza', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            $userData = array(
                'cod_raza' => $this->input->post('cod_raza'),
                'descripcion' => $this->input->post('descripcion'),
                'cod_especie' => $this->input->post('combobox')
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_race($this->input->post('cod_raza'));
                if($consulta == false){
                    $insert = $this->user->guardarRace($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('race');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20race_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['race'] = $this->user->obtener_todos_race();
        //load the view
        $this->load->view('race/race', $data);
    }



    /*
    Encargado de editar un RAza.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de RAza.
    */
    function edit_race($cod_raza) { 
            if($this->input->post('SumitSpeciesEdit')){ 
                          # code...        
                //validate form input
                $this->form_validation->set_rules('cod_raza', 'Codigo Especie', 'required');
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

                $data = array(
                    'cod_raza' => ($this->input->post('cod_raza')),
                    'descripcion' => ($this->input->post('descripcion')),
                    'cod_especie' => ($this->input->post('combobox'))
                );

                if ($this->form_validation->run() === true)
                {
                    $this->user->update_race($cod_raza, $data);
                    $this->session->set_flashdata('message', "<p>race updated successfully.</p>");                
                    redirect('race');
                }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['race'] = $this->user->obtener_todos_Race_update($cod_raza);
        $data['species'] = $this->user->obtener_todos_species();
        //load the view
        $this->load->view('race/edit_race', $data);          
    }        

        
    
    /*
    Encargada de la Eliminacion de Dueños.
    */
    public function eliminarRace($cod_raza){
        $this->user->eliminarRace($cod_raza);
        redirect('race');
    }

    /*-------------------------------- Vacuna ----------------------------------------------------*/



    /*
    Encargado de llamar a la Vista Vacuna , el cual posee la tabla mantenimiento para los Vacuna
    Esta se utiliza para el link del information animal , el boton Vaccine
    */
    public function vaccine(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['vaccine'] = $this->user->obtener_todos_vaccine();
            //load the view
            $this->load->view('vaccine/vaccine', $data);
        }
    }


    /*
    Encargado de llamar a la Vista Registrar vacuna
    Esta se utiliza para el link del Perfil Ra<a , el boton Crear nuevo vacuna */
    
    
    public function vaccine_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['vaccine'] = $this->user->obtener_todos_vaccine();
            //load the view
            $this->load->view('vaccine/insert_vaccine', $data);
        }
    }
    

    /*
    Encargado de insertar un nuevo Vacuna.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de Vacuna en la base de datos
    Insercion de Vacuna
    */
    public function insertVaccine(){
        $data = array();
        $userData = array();
        if($this->input->post('SumitVaccine')){
            $this->form_validation->set_rules('cod_vacuna', 'Codigo Vacuna', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            $userData = array(
                'cod_vacuna' => $this->input->post('cod_vacuna'),
                'descripcion' => $this->input->post('descripcion')
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_vaccine($this->input->post('cod_vacuna'));
                if($consulta == false){
                    $insert = $this->user->guardarVaccine($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('vaccine');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20vaccine_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['vaccine'] = $this->user->obtener_todos_vaccine();
        //load the view
        $this->load->view('vaccine/vaccine', $data);
    }



    /*
    Encargado de editar un Vacuba.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de Vacuna.
    */
    function edit_vaccine($cod_vacuna) { 
            if($this->input->post('SumitVaccineEdit')){ 
                          # code...        
                //validate form input
                $this->form_validation->set_rules('cod_vacuna', 'Codigo Especie', 'required');
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

                $data = array(
                    'cod_vacuna' => ($this->input->post('cod_vacuna')),
                    'descripcion' => ($this->input->post('descripcion'))
                );

                if ($this->form_validation->run() === true)
                {
                    $this->user->update_vaccine($cod_vacuna, $data);
                    $this->session->set_flashdata('message', "<p>race updated successfully.</p>");                
                    redirect('vaccine');
                }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['vaccine'] = $this->user->obtener_todos_Vaccine_update($cod_vacuna);
        //load the view
        $this->load->view('vaccine/edit_vaccine', $data);          
    }        

        
    
    /*
    Encargada de la Eliminacion de Vacuna.
    */
    public function eliminarVaccine($cod_vacuna){
        $this->user->eliminarVaccine($cod_vacuna);
        redirect('vaccine');
    }


        /*-------------------------------- Enfermedad ----------------------------------------------------*/



    /*
    Encargado de llamar a la Vista Ennfermedad , el cual posee la tabla mantenimiento para los Enfermedad
    Esta se utiliza para el link del information animal , el boton Enfermedad
    */
    public function disease(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['disease'] = $this->user->obtener_todos_disease();
            //load the view
            $this->load->view('disease/disease', $data);
        }
    }


    /*
    Encargado de llamar a la Vista Registrar disease
    Esta se utiliza para el link del Perfil disease , el boton Crear nuevo disease */
    
    
    public function disease_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['disease'] = $this->user->obtener_todos_disease();
            //load the view
            $this->load->view('disease/insert_disease', $data);
        }
    }
    

    /*
    Encargado de insertar un nuevo disease.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de disease en la base de datos
    Insercion de disease
    */
    public function insertDisease(){
        $data = array();
        $userData = array();
        if($this->input->post('SumitDisease')){
            $this->form_validation->set_rules('cod_enfermedad', 'Codigo Enfermedad', 'required');
            $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

            $userData = array(
                'cod_enfermedad' => $this->input->post('cod_enfermedad'),
                'descripcion' => $this->input->post('descripcion')
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_disease($this->input->post('cod_enfermedad'));
                if($consulta == false){
                    $insert = $this->user->guardarDisease($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('disease');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20disease_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['disease'] = $this->user->obtener_todos_disease();
        //load the view
        $this->load->view('disease/disease', $data);
    }



    /*
    Encargado de editar un disease.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de disease.
    */
    function edit_disease($cod_enfermedad) { 
            if($this->input->post('SumitDiseaseEdit')){ 
                          # code...        
                //validate form input
                $this->form_validation->set_rules('cod_enfermedad', 'Codigo Enfermedad', 'required');
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

                $data = array(
                    'cod_enfermedad' => ($this->input->post('cod_enfermedad')),
                    'descripcion' => ($this->input->post('descripcion'))
                );

                if ($this->form_validation->run() === true)
                {
                    $this->user->update_disease($cod_enfermedad, $data);
                    $this->session->set_flashdata('message', "<p>race updated successfully.</p>");                
                    redirect('disease');
                }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['disease'] = $this->user->obtener_todos_Disease_update($cod_enfermedad);
        //load the view
        $this->load->view('disease/edit_disease', $data);          
    }        

        
    
    /*
    Encargada de la Eliminacion de disease.
    */
    public function eliminarDisease($cod_enfermedad){
        $this->user->eliminarDisease($cod_enfermedad);
        redirect('disease');
    }

     /*-------------------------- Vacuna Enfermedad ------------------------------------------*/



    /*
    Encargado de llamar a la Vista vaccine_disease , el cual posee la tabla mantenimiento para  vaccine_disease
    Esta se utiliza para el link del information animal , el boton vaccine_disease
    */
    public function vaccine_disease(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['vaccine_disease'] = $this->user->obtener_todos_vaccine_disease();
            //load the view
            $this->load->view('vaccine_disease/vaccine_disease', $data);
        }
    }


    /*
    Encargado de llamar a la Vista Registrar insert_vaccine_disease
    Esta se utiliza para el link del Perfil vaccine_disease , el boton Crear nuevo vaccine_disease */
    
    
    public function vaccine_disease_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['vaccine_disease'] = $this->user->obtener_todos_vaccine_disease();
            $data['disease'] = $this->user->obtener_todos_disease();
            $data['vaccine'] = $this->user->obtener_todos_vaccine();
            //load the view
            $this->load->view('vaccine_disease/insert_vaccine_disease', $data);
        }
    }
    

    /*
    Encargado de insertar un nuevo vaccine_disease.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de vaccine_disease en la base de datos
    Insercion de vaccine_disease
    */
    public function insertVaccine_disease(){
        $data = array();
        $userData = array();
        if($this->input->post('SumitVaccine_disease')){
            $this->form_validation->set_rules('porcentaje_efectividad', 'Porcentaje Efectividad', 'required');
            $this->form_validation->set_rules('notas', 'Notas', 'required');

            $userData = array(
                'cod_enfermedad' => $this->input->post('combobox_disease'),
                'cod_vacuna' => $this->input->post('combobox_vaccine'),
                'porcentaje_efectividad' => $this->input->post('porcentaje_efectividad'),
                'notas' => $this->input->post('notas')
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_vaccine_disease($this->input->post('cod_enfermedad'));
                if($consulta == false){
                    $insert = $this->user->guardarVaccine_disease($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('vaccine_disease');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20vaccine_disease_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['vaccine_disease'] = $this->user->obtener_todos_vaccine_disease();
        $data['vaccine'] = $this->user->obtener_todos_vaccine();
        $data['disease'] = $this->user->obtener_todos_disease();
        //load the view
        $this->load->view('vaccine_disease/vaccine_disease', $data);
    }



    /*
    Encargado de editar un vaccine_disease.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de vaccine_disease.
    */
    function edit_vaccine_disease($cod_enfermedad) { 
            if($this->input->post('SumitVaccine_diseaseEdit')){       
                //validate form input
            $this->form_validation->set_rules('porcentaje_efectividad', 'Porcentaje Efectividad', 'required');
            $this->form_validation->set_rules('notas', 'Notas', 'required');

                $data = array(
                'cod_enfermedad' => $this->input->post('combobox_disease'),
                'cod_vacuna' => $this->input->post('combobox_vaccine'),
                'porcentaje_efectividad' => $this->input->post('porcentaje_efectividad'),
                'notas' => $this->input->post('notas')
            );

                if ($this->form_validation->run() === true)
                {
                    $this->user->update_vaccine_disease($cod_enfermedad, $data);
                    $this->session->set_flashdata('message', "<p>race updated successfully.</p>");                
                    redirect('vaccine_disease');
                }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['vaccine_disease'] = $this->user->obtener_todos_Vaccine_disease_update($cod_enfermedad);
        $data['vaccine'] = $this->user->obtener_todos_vaccine();
        $data['disease'] = $this->user->obtener_todos_disease();
        //load the view
        $this->load->view('vaccine_disease/edit_vaccine_disease', $data);          
    }                
    
    /*
    Encargada de la Eliminacion de vaccine_disease.
    */
    public function eliminarVaccine_disease($cod_enfermedad){
        $this->user->eliminarVaccine_disease($cod_enfermedad);
        redirect('vaccine_disease');
    }



         /*-------------------------- Mascota ------------------------------------------*/



    /*
    Encargado de llamar a la Vista pet , el cual posee la tabla mantenimiento para  pet
    Esta se utiliza para el link del new case file , el boton pet
    */
    public function pet(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['pet'] = $this->user->obtener_todos_pet();
            //load the view
            $this->load->view('pet/pet', $data);
        }
    }


    /*
    Encargado de llamar a la Vista pet insert_pet
    Esta se utiliza para el link del Perfil pet , el boton Crear nuevo pet */
    
    
    public function pet_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['pet'] = $this->user->obtener_todos_pet();
            $data['race'] = $this->user->obtener_todos_race();
            $data['owner'] = $this->user->obtener_todos_owner();
            //load the view
            $this->load->view('pet/insert_pet', $data);
        }
    }
    

    /*
    Encargado de insertar un nuevo pet.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de pet en la base de datos
    Insercion de pet
    */
    public function insertPet(){//hay que hacerle una consulta sql join mascota-id con owner y mascota-cod_raza con raza
        $data = array();
        $userData = array();
        if($this->input->post('SumitPet')){
            $this->form_validation->set_rules('cod_mascota', 'Codigo Mascota', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('fecha_nacimiento', 'Fecha Nacimiento', 'required');

            $userData = array(
                'cod_mascota' => $this->input->post('cod_mascota'),
                'id' => $this->input->post('combobox_owner'),
                'nombre' => $this->input->post('nombre'),
                'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
                'cod_raza' => $this->input->post('combobox_race')
            );

            if($this->form_validation->run() == true){
                $consulta= $this->user->obtener_por_id_pet($this->input->post('cod_mascota'));
                if($consulta == false){
                    $insert = $this->user->guardarPet($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('pet');
                }else{
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            }else{
                redirect('%20pet_register');
            }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['pet'] = $this->user->obtener_todos_pet();
        $data['owner'] = $this->user->obtener_todos_pet_owner();
        $data['race'] = $this->user->obtener_todos_race();
        //load the view
        $this->load->view('pet/pet', $data);
    }



    /*
    Encargado de editar un pet.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de pet.
    */
    function edit_pet($cod_mascota) { //misma consulta que insert
            if($this->input->post('SumitPetEdit')){       
                //validate form input
            $this->form_validation->set_rules('cod_mascota', 'Codigo Mascota', 'required');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('fecha_nacimiento', 'Fecha Nacimiento', 'required');

            $data = array(
                'cod_mascota' => $this->input->post('cod_mascota'),
                'id' => $this->input->post('combobox_owner'),
                'nombre' => $this->input->post('nombre'),
                'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),
                'cod_raza' => $this->input->post('combobox_race')
            );

            if ($this->form_validation->run() === true)
              {
                $this->user->update_pet($cod_mascota, $data);
                $this->session->set_flashdata('message', "<p>race updated successfully.</p>");        redirect('pet');
                }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['pet'] = $this->user->obtener_todos_Pet_update($cod_mascota);
        $data['owner'] = $this->user->obtener_todos_owner();
        $data['race'] = $this->user->obtener_todos_race();
        //load the view
        $this->load->view('pet/edit_pet', $data);          
    }                
    
    /*
    Encargada de la Eliminacion de pet.
    */
    public function eliminarPet($cod_mascota){
        $this->user->eliminarPet($cod_mascota);
        redirect('pet');
    }


             /*-------------------------- Mascota Vacuna Enfermedad---------------------------------*/



    /*
    Encargado de llamar a la Vista pet_vacuna_enfermedad , el cual posee la tabla mantenimiento para  pet_vacuna_enfermedad
    Esta se utiliza para el link del mascota, pet_vacuna_enfermedad , el boton pet_vacuna_enfermedad
    */
    public function pet_vacuna_enfermedad(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['pet_vacuna_enfermedad'] = $this->user->obtener_todos_pet_vacuna_enfermedad();
            //load the view
            $this->load->view('pet_vaccine_disease/pet_vaccine_disease', $data);
        }
    }


    /*
    Encargado de llamar a la Vista pet pet_vacuna_enfermedad
    Esta se utiliza para el link del Perfil pet_vacuna_enfermedad , el boton Crear nuevo pet_vacuna_enfermedad */
    
    
    public function pet_vacuna_enfermedad_register(){
        
        $data = array();
        if($this->session->userdata('isuserLoggedIn')){            
            $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
            $data['pet_vacuna_enfermedad'] = $this->user->obtener_todos_pet_vacuna_enfermedad();
            $data['vaccine_disease'] = $this->user->obtener_todos_vaccine_disease();
            $data['pet'] = $this->user->obtener_todos_pet();
            //load the view
            $this->load->view('pet_vaccine_disease/insert_pet_vaccine_disease', $data);
        }
    }
    

    /*
    Encargado de insertar un nuevo pet_vacuna_enfermedad.
    Validacion de inputs
    Validacion si el usuario cliqueó boton aceptar
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Validacion y Consulta de pet_vacuna_enfermedad en la base de datos
    Insercion de pet_vacuna_enfermedad
    */


    public function insertPet_vacuna_enfermedad(){//hay que hacerle una consulta sql join mascota-id con owner y mascota-cod_raza con raza
        $data = array();
        $userData = array();
        if($this->input->post('SumitPet_vacuna_enfermedad')){
            $this->form_validation->set_rules('fecha_aplicacion', 'Fecha Aplicacion', 'required');
            $this->form_validation->set_rules('fecha_proxima', 'Fecha Próxima', 'required');

            $userData = array(
                'cod_mascota' => $this->input->post('combobox_pet'), 
                'cod_enfermedad' => $this->input->post('combobox_vaccine_disease'),
                'fecha_aplicacion' => $this->input->post('fecha_aplicacion'),
                'fecha_proxima' => $this->input->post('fecha_proxima')
            );

            if($this->form_validation->run() == true){
                    $insert = $this->user->guardarPet_vacuna_enfermedad($userData);
                    if($insert){
                        $this->session->set_userdata('success_msg', 'Your registration was successfully. Please login to your account.');
                    redirect('pet_vacuna_enfermedad');
                    }else{
                        $data['error_msg'] = 'Some problems occured, please try again.';
                    }
          }
        }
        $data['user'] = $userData;
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['pet_vacuna_enfermedad'] = $this->user->obtener_todos_pet_vacuna_enfermedad();
        $data['pet'] = $this->user->obtener_todos_pet();  
        $data['vaccine_disease'] = $this->user->obtener_todos_vaccine_disease();  
              //load the view
        $this->load->view('pet_vaccine_disease/pet_vaccine_disease', $data);
    }



    /*
    Encargado de editar un pet_vacuna_enfermedad.
    Validacion si el usuario cliqueó boton aceptar.
    Validacion de inputs
    Creacion de Arreglo con los datos obtenidos de los inputs.
    Update de pet_vacuna_enfermedad.
    */
    function edit_pet_vacuna_enfermedad($cod_mascota) { //misma consulta que insert
            if($this->input->post('SumitPet_vacuna_enfermedadEdit')){       
                //validate form input
            $this->form_validation->set_rules('fecha_aplicacion', 'Fecha Aplicacion', 'required');
            $this->form_validation->set_rules('fecha_proxima', 'Fecha Próxima', 'required');

            $data = array(
                'cod_mascota' => $this->input->post('combobox_pet'), 
                'cod_enfermedad' => $this->input->post('combobox_vaccine_disease'),
                'fecha_aplicacion' => $this->input->post('fecha_aplicacion'),
                'fecha_proxima' => $this->input->post('fecha_proxima')
            );

            if ($this->form_validation->run() === true)
              {
                $this->user->update_pet_vacuna_enfermedad($cod_mascota, $data);
                $this->session->set_flashdata('message', "<p>race updated successfully.</p>");        redirect('pet_vacuna_enfermedad');
                }
        }
        
        $data['user'] = $this->user->getRows(array('id'=>$this->session->userdata('userId')));
        $data['pet_vacuna_enfermedad'] = $this->user->obtener_todos_Pet_vacuna_enfermedad_update($cod_mascota);
        $data['pet'] = $this->user->obtener_todos_pet();
        $data['vaccine_disease'] = $this->user->obtener_todos_vaccine_disease();
        //load the view
        $this->load->view('pet_vaccine_disease/edit_pet_vaccine_disease', $data);          
    }                
    
    /*
    Encargada de la Eliminacion de pet_vacuna_enfermedad.
    */
    public function eliminarPet_vacuna_enfermedad($cod_mascota){
        $this->user->eliminarPet_vacuna_enfermedad($cod_mascota);
        redirect('pet_vacuna_enfermedad');
    }
}