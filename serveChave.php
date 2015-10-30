<?php

if (!isset($_GET['type'])) {
	$type = 1; // json 
} else if ($_GET['type'] == 'xml') {
	$type = 2; // xml
} else {
	$type = 1; // json
}



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
		
		for($i=0;$i<5;$i++) {
			$randomindex = rand(0,count($todosnumeros)-1);
			$numero = array_splice($todosnumeros,$randomindex,1);
			$this->chave->numeros[] = $numero[0];
		}
		
		for($i=0;$i<2;$i++) {
			$randomindex = rand(0,count($todasestrelas)-1);
			$estrela = array_splice($todasestrelas,$randomindex,1);
			$this->chave->estrelas[] = $estrela[0];
		}
		
	}
	
	public function toJSON() {
		return json_encode($this->chave);
	}
	
	public function toXML() {
		$rootXML = new SimpleXMLElement("<chave/>");
		$xn = $rootXML->addChild("numeros");
		foreach($this->chave->numeros as $numero) {
			$xn->addChild("num",$numero);
		}
		$xe = $rootXML->addChild("estrelas");
		foreach($this->chave->estrelas as $numero) {
			$xe->addChild("num",$numero);
		}
		return $rootXML->asXML();
	}
}

//echo '{"numeros":[1,2,3,45,50], "estrelas":[10,11]}';

$g = new Gerador();

if ($type == 1) {
	header("Content-type: application/json");
	$chave = $g->toJSON();
} else if ($type == 2) {
	header("Content-type: text/xml");
	$chave = $g->toXML();
} else {
	echo "está tudo maluco!!!!";
}
echo $chave;
?>
