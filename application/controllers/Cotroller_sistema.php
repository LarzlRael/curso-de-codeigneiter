
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cotroller_sistema extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('is_logued_in')) { 
			redirect(base_url());
		}
		$this->load->helper('funciones_helper');
		$this->load->model('Modelo');
	}

	
	public function index(){ 
		if ($this->session->userdata('is_logued_in')) {
			redirect(base_url().'Cotroller_sistema/inicio');
		}else{
			$this->load->view('login');
		}
	}
	public function inicio(){
		$data['contenido']="menu/inicio";
		$this->load->view("plantilla",$data);
	}
	public function admin_usuario(){
		$data['contenido']="vista_usuario/admin_usuario";
		//$data['listar_usuarios']=$this->Modelo->admin_usuario();
		$data['img']=$this->Modelo->ver_imagen();
		$this->load->view("plantilla",$data);
	}
	public function guardar_nuevo_usuario(){
		$ci=$this->input->post("ci");
		$dpto=$this->input->post("dpto");
		$nombre=$this->input->post("nombre");
		$paterno=$this->input->post("paterno");
		$materno=$this->input->post("materno");
		$telf=$this->input->post("telf");
		$genero=$this->input->post("genero");
		$t_usuario=$this->input->post("t_usuario");
		$usuario=$this->input->post("usuario");
		$pass1=sha1($this->input->post("pass1"));
		///guardar imagen
		$imagen=$_FILES['imagen']['tmp_name'];
		if ($imagen==null) {
			$imag='';
		}else{
			if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || 
			$_FILES['imagen']['type']=="image/png" || $_FILES['imagen']['type']=="image/gif") {

				$ext=explode(".", $_FILES['imagen']['name']);
				$ima=round(microtime(true)).'.'.end($ext);
				move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/imagen_perfil/user_".$ima);
				$imag="user_".$ima;
			}
		}
		$this->Modelo->guardar_nuevo_usuario($ci,$dpto,$nombre,$paterno,$materno,$telf,$genero,$t_usuario,$usuario,$pass1,$imag);
		echo "::EXITOSAMENTE GUARDADO::";

	}
	public function eliminar_usuario(){
		$idusuario=$this->input->post('idusuario');
		$this->Modelo->eliminar_usuario($idusuario);
	}
	public function editar_usuario(){
		$idusuario=$this->input->post('idusuario');
		$data['obj1']=$this->Modelo->editar_usuario($idusuario);
		$this->load->view("vista_usuario/editar_usuario",$data);
	}

	public function listar_cantida_usuario(){
		$estado='activo';
		$obj_a=$this->Modelo->listar_cantida_usuario($estado);
		$estado1='inactivo';
		$obj_i=$this->Modelo->listar_cantida_usuario($estado1);

		echo json_encode(array(0=>$obj_a->cantidad,1=>$obj_i->cantidad));
	}

	public function imprimir_reporte_pdf(){
		/////////////////7reporte pdf
		require_once APPPATH."/libraries/fpdf/fpdf/fpdf.php";   
				$pdf = new FPDF();
				$pdf->AddPage();


				$pdf->Image ("assets/alerta/img3.gif" ,20,11,20,'JPG');
				$pdf->setFont('times', 'U', 15);
				$pdf->Cell(0,13,('UNIVERISIDAD PUBLICA DE EL ALTO'), 0, 1, 'C');
				$pdf->setFont('times', 'B', 18);
				$pdf->Cell(0, 10,'LISTA DE USUARIOS', 0, 1, 'C');
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(50,10,'Fecha:'.date('d-m-Y').'',0,1, 'C');
				$pdf->Ln(15);

				$pdf->SetFillColor(224,235,255);	
				$pdf->Cell(30,10,'CARNET',1,0, 'C',1);
				$pdf->Cell(80,10,'NOMBRE Y APELLIDO',1,0, 'C',1);
				$pdf->Cell(50,10,'TIPO USUARIO',1,0, 'C',1);
				$pdf->Cell(30,10,'FECHA',1,1, 'C',1);

				$listar_usuarios=$this->Modelo->admin_usuario();
				foreach ($listar_usuarios as $obj) {
					$pdf->Cell(30,5,$obj->ci.' '.$obj->dpto,1,0, 'C',1);
					$pdf->Cell(80,5,$obj->nombre.' '.$obj->paterno.' '.$obj->materno,1,0, 'C',1);
					$pdf->Cell(50,5,$obj->tipo_usuario,1,0, 'C',1);
					$pdf->Cell(30,5,$obj->u_fecha_reg,1,1, 'C',1);
				}

				$nombre='ENTREGA-.pdf';
				$pdf->Output($nombre,'I');
		}

		public function imprimir_reporte_exel(){

			header('Content-type:application/xls');
			header('Content-Disposition: attachment; filename=usuarios.xls');
			echo '<h3 aling="center">Lista de Usuarios </h3> 
			 <table border="1">

					  <tr>
					    <th>CARNET</th>
					    <th>NOMBRE Y APELLIDO</th>
					    <th>TIPO USUARIO</th>
					    <th>FECHA</th>

					  </tr>';
					   $listar_usuarios=$this->Modelo->admin_usuario();
					   foreach ($listar_usuarios as $obj){
					   	echo '
					  <tr>
					    <td>'.$obj->ci.' '.$obj->dpto.'</td>
					    <td>'.$obj->nombre.' '.$obj->paterno.' '.$obj->materno.'</td>
					    <td>'.$obj->tipo_usuario.'</td>
					    <td>'.$obj->u_fecha_reg.'</td>
					    
					  </tr>';
					}
					echo '</table>';
		}

}
