<?php 
class Modelo extends CI_Model {
	
	function __construct()	{
		parent::__construct();
		$this->load->database();
	}
	public function ingresar_usuario_sys($usuario,$password){
		// echo $password;exit();

		$obj=$this->db->query("SELECT
		persona.nombre,
		persona.paterno,
		tipo_usuario.tipo_usuario,
		usuario.idusuario
		FROM usuario
		INNER JOIN tipo_usuario ON usuario.idtipo_usuario = tipo_usuario.idtipo_usuario
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		WHERE usuario.name='$usuario' AND usuario.password='$password' 
		AND usuario.u_estado='activo' ");
		if ($obj->num_rows()) { //convierte un objeto en booleano
			return $obj->row(); 
		}else{
			return false;
		}

	}

	public function admin_usuario(){
		return $this->db->query("SELECT * FROM usuario
		INNER JOIN tipo_usuario ON usuario.idtipo_usuario = tipo_usuario.idtipo_usuario
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		WHERE usuario.u_estado!='eliminar' ")->result();
	}
	public function guardar_nuevo_usuario($ci,$dpto,$nombre,$paterno,$materno,$telf,$genero,$t_usuario,$usuario,$pass1,$imag){
		$obj1=array(
			'ci'=>$ci,
			'dpto'=>$dpto,
			'nombre'=>$nombre,
			'paterno'=>$paterno,
			'materno'=>$materno,
			'telefono'=>$telf,
			'genero'=>$genero,
			'p_fecha_reg'=>date('Y-m-d'),
			'p_id_usuario_sys'=>$this->session->userdata('idusuario')
		);
		$this->db->insert("persona",$obj1);
		$id_p=$this->db->insert_id();

		$obj2=array(
			'name'=>$usuario,
			'password'=>$pass1,
			'imagen'=>$imag,
			'u_estado'=>'activo',
			'u_fecha_reg'=>date('Y-m-d'),
			'u_id_usuario_sys'=>$this->session->userdata('idusuario'),
			'idtipo_usuario'=>$t_usuario,
			'idpersona'=>$id_p
		);
		$this->db->insert("usuario",$obj2);

	}
	public function eliminar_usuario($idusuario){
		$obj=array(
			'u_estado'=>'eliminar'
		);
		$this->db->WHERE("idusuario",$idusuario);
		$this->db->update("usuario",$obj);
	}
	public function editar_usuario($idusuario){
		return $this->db->query("SELECT * FROM usuario
		INNER JOIN tipo_usuario ON usuario.idtipo_usuario = tipo_usuario.idtipo_usuario
		INNER JOIN persona ON usuario.idpersona = persona.idpersona
		WHERE usuario.idusuario='$idusuario' ")->row();
	}

	public function listar_cantida_usuario($estado){
		return $this->db->query("SELECT count(idusuario) as cantidad from usuario WHERE u_estado='$estado' ")->row();
		
	}

	public function ver_imagen(){
		$id=$this->session->userdata('idusuario');
		return $this->db->query("SELECT imagen from usuario WHERE idusuario= '$id'  ")->row();

	}

}

