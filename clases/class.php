<?php
class correo
{
	private $nombre;
	private $correo;
	private $comentario; // IGUAL A PREGUNTA	
	
	private $remitente;
	private $asunto;	
	private $cuerpo;
	private $destino;
	
	public function __construct($nombr, $corre, $comen)
	{
		$this->nombre = $nombr;
		$this->correo = $corre;
		$this->comentario = $comen;
	}
	
	public function introMensaje($remi, $asun, $cuer, $dest)
	{
		$this->remitente = $remi;
		$this->asunto = $asun;
		$this->cuerpo = $cuer;
		$this->destino = $dest;
		
		$this->cuerpo =
			
		$sheader="From:".$this->remitente."\nReply-To:".$this->remitente."\n"; 
		$sheader=$sheader."X-Mailer:PHP/".phpversion()."\n"; 
		$sheader=$sheader."Mime-Version: 1.0\n"; 
		$sheader=$sheader."Content-Type: text/html"; 

		$destino = "johana@localhost.com";
		mail($this->destino,$this->asunto,$this->cuerpo,$sheader);
	}
	
	public function imprimir()
	{
		return $this->remitente;
	}
}

?>