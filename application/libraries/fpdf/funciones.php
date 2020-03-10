<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funciones {           
    
	protected $ci;
   
    function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->library('ion_auth');
    }
	
	function FechaLiteral($Fecha, $Formato=2) {
        if( $Fecha=='0000-00-00')  
			return '';
		else {
			$dias = array(1=>'Lunes', 2=>'Martes', 3=>'Mi�rcoles', 4=>'Jueves', 5=>'Viernes', 6=>'S�bado', 7=>'Domingo');
			$meses = array(1=>'enero', 2=>'febrero', 3=>'marzo', 4=>'abril', 5=>'mayo', 6=>'junio',
						   7=>'julio', 8=>'agosto', 9=>'septiembre', 10=>'octubre', 11=>'noviembre', 12=>'diciembre');    
			$aux = date_parse($Fecha);
			switch ($Formato) {
				case 1:  // 04/10/10
					return date('d/m/y', $Fecha);
				case 2:  //04/oct/10
					return sprintf('%02d/%s/%02d', $aux['day'], substr($meses[$aux['month']],0,3), $aux['year'] % 100);
				case 3:   //octubre 4, 2010
					return $meses[$aux['month']] . ' '.sprintf('%.2d',$aux['day']).', '.$aux['year'];
				case 4:   // 4 de octubre de 2010
					return $aux['day'].' de ' . $meses[$aux['month']] . ' de '.$aux['year'];
				case 5: 
					return date('d/m/Y', $Fecha);       
				default: 
					return date('d/m/Y', $Fecha);
			}
		}
    }
    
    //recibe la fecha en formato dd/mm/aaaa o dd-mm-aaaa
    //y convierte a aaaa-mm-dd
    function FechaParaMySQL($Fecha) {
        if( $Fecha!='') {
            $Fecha = strtr($Fecha, '-', '/');  //convierte a dd/mm/aaaa
            $Fecha = implode( '/', array_reverse( explode( '/', $Fecha ) ) ) ;
        }
        return $Fecha;
    }

    //recibe la fecha en formato aaaa/mm/dd o aaaa-mm-dd
    //y convierte a dd/mm/aaaa
    function FechaDeMySQL($Fecha) {
        if( $Fecha!='') {
            $Fecha = strtr($Fecha, '-', '/');  //convierte a aaaa/mm/dd
            $Fecha = implode( '/', array_reverse( explode( '/', $Fecha ) ) ) ;
        }
        return $Fecha;
    }

	function FechaParaMySQL1($Fecha) {
        $elm = '/';
        if ($Fecha == '') {
            return NULL;
        }
        $date2 = explode($elm, $Fecha);
        return $date2[2] . $elm . $date2[0] . $elm . $date2[1];
    }
	
	function VerificaSesion() {
		if( ! $this->ci->ion_auth->logged_in() )
			redirect('auth/login');
	}
}

?>