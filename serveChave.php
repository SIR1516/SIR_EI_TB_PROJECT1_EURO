<?php
header("Content-type: application/json");

class Chave {
	public $numeros = array();
	public $estrelas = array();
};


class Gerador {
	public $chave;
	
	public function __construct() {
		$this->chave = new Chave();
		$this->geraChave();
	}
	
	private function geraChave() {
		// gerar chave aleatoria
		$todosnumeros = range(1,50);
		$todasestrelas = range(1,11);
		
		for($i=1;$i<5;$i++) {
			$randomindex = rand(0,count($todosnumeros)-1);
			$numero = array_splice($todosnumeros,$randomindex,1);
			$this->chave->numeros[] = $numero[0];
		}
		
		for($i=1;$i<2;$i++) {
			$randomindex = rand(0,count($todasestrelas)-1);
			$estrela = array_splice($todasestrelas,$randomindex,1);
			$this->chave->estrelas[] = $estrela[0];
		}
		
	}
	
	public function toJSON() {
		return json_encode($this->chave);
	}
}

//echo '{"numeros":[1,2,3,45,50], "estrelas":[10,11]}';

$g = new Gerador();
$chaveJSON = $g->toJSON();
echo $chaveJSON;

?>
