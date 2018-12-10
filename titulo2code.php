<pre>
<?php

$debug = 1;
$jsonString = file_get_contents('codigos.json');
$data = json_decode($jsonString, true);

$cadenas = array(' Gran  Apertura De Centro', ' Gran  Abertura De Centro', 'Gran Apertura HOy','Gran APErtura','Gran Abertura HoY','Gran Apertura Hoy Martes','Gran Apertura hoy MArtes', 'Gran Abertura hoy MArtes');

foreach ($cadenas as &$cadena) {
	// $cadena = 'Gran Apertura De Centro';
	$cadena_limpia = preg_replace('/\s\s+/', ' ',strtoupper(trim($cadena)));
	// si ya existe el titulo no genera una nueva
	if (isset($data[$cadena_limpia]) == 1 && $debug == 0) continue;
//----------- genera la lista de opciones --------------------
	// convertir la expresion en mayusculas y cora la variable en espacios
	$valore = preg_split("/ /",  $cadena_limpia);
	$opciones = array();
	// crea la secuencia base
	for ($i = 0; $i < 4; $i++) $opciones[0] .= $valore[$i][0];
	// si la sigla es menor a 4
	if (strlen($opciones[0]) < 4 ) for ($i = 0; $i < (5 - strlen($opciones[0])); $i++) $opciones[0] .= $valore[count($valore) -1][$i+1];
	// agrega otros pedasos
	for ($w = 0; $w < 3; $w++) 
		for ($k = count($valore)-1; $k > 0; $k--) for ($i = 1; $i < strlen($valore[$k]); $i++) $opciones[count($opciones)+1] =  substr($opciones[0], 0, 3-$w).$valore[$k][$i]. substr($opciones[0], 0, $w);
//---------debug----------------------
	if ($debug) {
		echo $cadena."\n\n";
		// print_r($opciones);
		print_r(array_unique($opciones));
		// en base el XML elejir una y guardarla
		echo isset($data[$cadena_limpia]);
		// si en la base de datos no existe el titulo
	}
//----------- busca que la sigla no se repita --------------------
	if (!(isset($data[$cadena_limpia]) == 1)) {
		$i = 0;
		// comprobar que el codigo no exista
		foreach (array_unique($opciones) as &$opcion) {
			if (! in_array($opcion, $data)) { 
				$data[$cadena_limpia] = $opcion;
				break;
			}
		}
	}
	$newJsonString = json_encode($data);
	file_put_contents('codigos.json', $newJsonString);
}
