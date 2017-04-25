<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

 public function __construct(){
  parent::__construct();
  $this->load->model('User');
  $this->load->library(array('form_validation','session'));
  $this->load->helper(array('url','html','form'));

 }

	 //CARGA EL INDEX PRINCIPAL DE LA PAGINA
	  public function index(){
	  $this->home();
	}
	 

	//CARGA EL LOGIN RESOECTIVO DE LA PAGINA
	 public function home(){
	  $this->load->view('home_view');
	 }



}


