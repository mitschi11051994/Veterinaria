<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    function __construct() {
        $this->userTbl = 'veterinaria.users';
        $this->userTb2 = 'veterinaria.dueno';
        $this->userTb3 = 'veterinaria.especie';
        $this->userTb4 = 'veterinaria.raza';
        $this->userTb5 = 'veterinaria.vacuna';
        $this->userTb6 = 'veterinaria.enfermedad';
        $this->userTb7 = 'veterinaria.vacuna_enfermedad';
        $this->userTb8 = 'veterinaria.mascota';
        $this->userTb9 = 'veterinaria.mascota_vacuna_enfermedad';
    }




    /*------------------------------- Usuario -------------------------------------------------------- */
    /*
     * get rows from the users table
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userTbl);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            $query = $this->db->get();
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $query->num_rows();
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
            }else{
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }

        //return fetched data
        return $result;
    }
    
    /*
     * Insert USer information
     */
    public function insert($data = array()) {
        //add created and modified data if not included
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }        
        //insert user data to users table
        $insert = $this->db->insert($this->userTbl, $data);        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }



    /*--------------------------------------- Dueño -------------------------------------------------------- */

    /*
     * Encargado del guardado de los datos de un nuevo Dueño.
     */    
    public function guardarOwner($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb2, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }   

    /*
     * Encargado de la edicion de los datos de un  Dueño.
     */      
    public function update_owner($id_species, $data)
    {
        $this->db->where('id', $id_species);
        $this->db->update($this->userTb2, $data);
    }

    /*
     * Encargado de la eliminacion de los datos de un Dueño.
     */ 
    public function eliminarOwner($id){
        $this->db->where('id', $id);
        $this->db->delete($this->userTb2);
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla Dueño  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo Dueño.
     */ 
    public function obtener_por_id_Owner($id){
        $this->db->select('*');
        $this->db->from($this->userTb2);
        $this->db->where('id', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla Dueño .
     */ 
    public function obtener_todos_Owner(){
        $this->db->select('*');
        $this->db->from($this->userTb2);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla Dueño en la utilizacion del update .
     */ 

    public function obtener_todos_Owner_update($id){
        $this->db->select('*');
        $this->db->from($this->userTb2);
        $this->db->where('id', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }


    /*-------------------------------Especie-------------------------------------------------------- */

        
        /*
     * Encargado del guardado de los datos de un nuevo Especies.
     */    
    public function guardarSpecies($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb3, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }   

    /*
     * Encargado de la edicion de los datos de un  Especies.
     */      
    public function update_species($id_species, $data)
    {
        $this->db->where('cod_especie', $id_species);
        $this->db->update($this->userTb3, $data);
    }

    /*
     * Encargado de la eliminacion de los datos de un Especies.
     */ 
    public function eliminarSpecies($cod_especie){
        $this->db->where('cod_especie', $cod_especie);
        $this->db->delete($this->userTb3);
    }

        public function obtener_todos_species(){
        $this->db->select('*');
        $this->db->from($this->userTb3);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla Especies en la utilizacion del update .
     */ 
    public function obtener_todos_Species_update($cod_especie){
        $this->db->select('*');
        $this->db->from($this->userTb3);
        $this->db->where('cod_especie', $cod_especie);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla Especies  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo Especies.
     */ 
    public function obtener_por_id_species($id){
        $this->db->select('*');
        $this->db->from($this->userTb3);
        $this->db->where('cod_especie', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }





    /*-------------------------------Raza-------------------------------------------------------- */

    public function obtener_todos_race(){
        $this->db->select('*');
        $this->db->from($this->userTb4);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla Raza  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo Raza.
     */ 
    public function obtener_por_id_race($cod_raza){
        $this->db->select('*');
        $this->db->from($this->userTb4);
        $this->db->where('cod_raza', $cod_raza);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

       /*
     * Encargado del guardado de los datos de un nuevo Raza.
     */    
    public function guardarRace($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb4, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Encargado de la eliminacion de los datos de un Raza.
     */ 
    public function eliminarRace($cod_raza){
        $this->db->where('cod_raza', $cod_raza);
        $this->db->delete($this->userTb4);
    } 


     /*
     * Encargado de la edicion de los datos de un  Raza.
     */      
    public function update_race($cod_raza, $data)
    {
        $this->db->where('cod_raza', $cod_raza);
        $this->db->update($this->userTb4, $data);
    }



     /* Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla Especies en la utilizacion del update .
     */ 
    public function obtener_todos_Race_update($cod_raza){
        $this->db->select('*');
        $this->db->from($this->userTb4);
        $this->db->where('cod_raza', $cod_raza);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

      /*-------------------------------Vacuna-------------------------------------------------------- */

    public function obtener_todos_vaccine(){
        $this->db->select('*');
        $this->db->from($this->userTb5);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla Vacuna  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo Vacuna.
     */ 
    public function obtener_por_id_vaccine($cod_vacuna){
        $this->db->select('*');
        $this->db->from($this->userTb5);
        $this->db->where('cod_vacuna', $cod_vacuna);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

       /*
     * Encargado del guardado de los datos de un nuevo Vacuna.
     */    
    public function guardarVaccine($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb5, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Encargado de la eliminacion de los datos de un Vacuna.
     */ 
    public function eliminarVaccine($cod_vacuna){
        $this->db->where('cod_vacuna', $cod_vacuna);
        $this->db->delete($this->userTb5);
    } 


     /*
     * Encargado de la edicion de los datos de un  Vacuna.
     */      
    public function update_vaccine($cod_vacuna, $data)
    {
        $this->db->where('cod_vacuna', $cod_vacuna);
        $this->db->update($this->userTb5, $data);
    }



     /* Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla Especies en la utilizacion del update .
     */ 
    public function obtener_todos_Vaccine_update($cod_vacuna){
        $this->db->select('*');
        $this->db->from($this->userTb5);
        $this->db->where('cod_vacuna', $cod_vacuna);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

     /*-------------------------------Enfermedad-------------------------------------------------------- */

    public function obtener_todos_disease(){
        $this->db->select('*');
        $this->db->from($this->userTb6);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla disease  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo disease.
     */ 
    public function obtener_por_id_disease($cod_enfermedad){
        $this->db->select('*');
        $this->db->from($this->userTb6);
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

       /*
     * Encargado del guardado de los datos de un nuevo disease.
     */    
    public function guardarDisease($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb6, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Encargado de la eliminacion de los datos de un disease.
     */ 
    public function eliminarDisease($cod_enfermedad){
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $this->db->delete($this->userTb6);
    } 


     /*
     * Encargado de la edicion de los datos de un  disease.
     */      
    public function update_disease($cod_enfermedad, $data)
    {
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $this->db->update($this->userTb6, $data);
    }



     /* Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla disease en la utilizacion del update .
     */ 
    public function obtener_todos_Disease_update($cod_enfermedad){
        $this->db->select('*');
        $this->db->from($this->userTb6);
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }


      /*---------------------------Vacuna Enfermedad-------------------------------------------- */

    public function obtener_todos_vaccine_disease(){
        $this->db->select('*');
        $this->db->from($this->userTb7);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla vaccine_disease  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo vaccine_disease.
     */ 
    public function obtener_por_id_vaccine_disease($cod_enfermedad){
        $this->db->select('*');
        $this->db->from($this->userTb7);
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla pet  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo pet.
     */ 
    public function obtener_por_id_vaccine_disease_exist($cod_mascota){
        $this->db->select('cod_enfermedad');
        $this->db->from($this->userTb8);
        $this->db->where('cod_mascota', $cod_mascota);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

       /*
     * Encargado del guardado de los datos de un nuevo vaccine_disease.
     */    
    public function guardarVaccine_disease($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb7, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Encargado de la eliminacion de los datos de un vaccine_disease.
     */ 
    public function eliminarVaccine_disease($cod_enfermedad){
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $this->db->delete($this->userTb7);
    } 


     /*
     * Encargado de la edicion de los datos de un  vaccine_disease.
     */      
    public function update_vaccine_disease($cod_enfermedad, $data)
    {
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $this->db->update($this->userTb7, $data);
    }



     /* Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla vaccine_disease en la utilizacion del update .
     */ 
    public function obtener_todos_Vaccine_disease_update($cod_enfermedad){
        $this->db->select('*');
        $this->db->from($this->userTb7);
        $this->db->where('cod_enfermedad', $cod_enfermedad);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }


    /*---------------------------Mascota-------------------------------------------- */

    public function obtener_todos_pet(){
        $this->db->select('*');
        $this->db->from($this->userTb8);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function obtener_todos_pet_owner(){
        $this->db->select('id , nombre');
        $this->db->from($this->userTb2);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla pet  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo pet.
     */ 
    public function obtener_por_id_pet($cod_mascota){
        $this->db->select('*');
        $this->db->from($this->userTb8);
        $this->db->where('cod_mascota', $cod_mascota);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla pet  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo pet.
     */ 
    public function obtener_por_id_pet_owner($cod_mascota){
        $this->db->select('id');
        $this->db->from($this->userTb8);
        $this->db->where('cod_mascota', $cod_mascota);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }


       /*
     * Encargado del guardado de los datos de un nuevo pet.
     */    
    public function guardarPet($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb8, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Encargado de la eliminacion de los datos de un pet.
     */ 
    public function eliminarPet($cod_mascota){
        $this->db->where('cod_mascota', $cod_mascota);
        $this->db->delete($this->userTb8);
    } 


     /*
     * Encargado de la edicion de los datos de un  pet.
     */      
    public function update_pet($cod_mascota, $data)
    {
        $this->db->where('cod_mascota', $cod_mascota);
        $this->db->update($this->userTb8, $data);
    }



     /* Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla pet en la utilizacion del update .
     */ 
    public function obtener_todos_Pet_update($cod_mascota){
        $this->db->select('*');
        $this->db->from($this->userTb8);
        $this->db->where('cod_mascota', $cod_mascota);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

        /*---------------------------Mascota Vacuna Enfermedad--------------------------------------- */

    public function obtener_todos_pet_vacuna_enfermedad(){
        $this->db->select('*');
        $this->db->from($this->userTb9);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }


    /*
     * Encargado de la creacion de una consulta sql, para obtener cuanta cantidad de registros
     de la tabla pet_vacuna_enfermedad  existen mediante un id,  para asi utilizar en la validación de la insercion  de un nuevo pet_vacuna_enfermedad.
     */ 
    public function obtener_por_id_pet_vacuna_enfermedad($cod_mascota){
        $this->db->select('*');
        $this->db->from($this->userTb9);
        $this->db->where('cod_mascota', $cod_mascota);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

       /*
     * Encargado del guardado de los datos de un nuevo pet_vacuna_enfermedad.
     */    
    public function guardarPet_vacuna_enfermedad($data = array()) {        
        //insert user data to users table
        $insert = $this->db->insert($this->userTb9, $data);
        
        //return the status
        if($insert){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }

    /*
     * Encargado de la eliminacion de los datos de un pet_vacuna_enfermedad.
     */ 
    public function eliminarPet_vacuna_enfermedad($cod_mascota){
        $this->db->where('cod_mascota', $cod_mascota);
        $this->db->delete($this->userTb9);
    } 


     /*
     * Encargado de la edicion de los datos de un  pet_vacuna_enfermedad.
     */      
    public function update_pet_vacuna_enfermedad($cod_mascota, $data)
    {
        $this->db->where('cod_mascota', $cod_mascota);
        $this->db->update($this->userTb9, $data);
    }



     /* Encargado de la creacion de una consulta sql, para obtener todos los registros
     de la tabla pet en la utilizacion del update .
     */ 
    public function obtener_todos_Pet_vacuna_enfermedad_update($cod_mascota){
        $this->db->select('*');
        $this->db->from($this->userTb9);
        $this->db->where('cod_mascota', $cod_mascota);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

}

