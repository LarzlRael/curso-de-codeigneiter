
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotroller_login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		// $this->load->helper('funciones_helper');
		$this->load->model('Modelo');
	}

	
	public function index(){ 
		if ($this->session->userdata('is_logued_in')) {
			redirect(base_url().'Cotroller_sistema');
		}else{
			$this->load->view('login');
		}
	}
	public function ingreso_session(){
		$usuario=$this->input->post("usu");
		$password=$this->input->post("pas");

		if (preg_match('/^[A-Za-z0-9_\&\*\#\@.-]+$/', $usuario) && 
		preg_match('/^[A-Za-z0-9_\&\*\#\@.-]+$/', $password)) {
			// echo "hola";exit();

			$user = $this->Modelo->ingresar_usuario_sys($usuario,sha1($password));

			// print_r($user);exit();

			if($user == TRUE) {
				$nom=$user->nombre;
				$a=explode(" ", $nom);//sacar primer nombre
				$data = array(
		            'is_logued_in' 	=> 	TRUE,
		            'tipo_usuario' 	=> 	$user->tipo_usuario,
		            'idusuario' 	=> 	$user->idusuario,
		            'username' 		=> 	$a[0].' '.$user->paterno
	    		);		
				$this->session->set_userdata($data);

				$data = array(0 =>1 );
				echo json_encode($data);
			}else{
				$data = array(0 =>0 );
				echo json_encode($data);
			}
		}else{
			$data = array(0 =>0 );
			echo json_encode($data);
		}
	}

	public function cerrar_session(){
		$this->session->sess_destroy();
		redirect(base_url(),'refresh');
	}






}
