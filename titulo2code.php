<pre>
<?php

$debug = 1;
$jsonString = file_get_contents('codigos.json');
$data = json_decode($jsonString, true);

$cadenas = array(' Gran  Apertura De Centro', ' Gran  Abertura De Centro', 'Gran Apertura HOy','Gran APErtura','Gran Abertura HoY','Gran Apertura Hoy Martes','Gran Apertura hoy MArtes', 'Gran Abertura hoy MArtes');

foreach ($cadenas as &$cadena) {
	// $cadena = 'Gran Apertura De Centro';
	$cadena_limpia = preg_replace('/\s\s+/', ' ',strtoupper(trim($cadena)));
	if (isset($data[$cadena_limpia]) == 1) continue;

	// convertir la expresion en mayusculas y cora la variable en espacios
	$valore = preg_split("/ /",  $cadena_limpia);
	$opciones = array();
	$n = count($valore);

	for ($i = 0; $i < 4; $i++) $opciones[0] .= $valore[$i][0];
	// si la sigla es menor a 4
	if (strlen($opciones[0]) < 4 ) for ($i = 0; $i < (5 - strlen($opciones[0])); $i++) $opciones[0] .= $valore[$n -1][$i+1];
	// siga sin una sigla
	for ($i = 0; $i < 4; $i++) $opciones[1] .= $opciones[0][$i];
	// w no me gusta pero no se me ocurre como contar
	for ($w = 0; $w < 3; $w++) 
		for ($k = count($valore)-1; $k > 0; $k--) for ($i = 1; $i < strlen($valore[$k]); $i++) $opciones[count($opciones)+1] =  substr($opciones[0], 0, 3-$w).$valore[$k][$i]. substr($opciones[0], 0, $w);

	if ($debug) {
		echo $cadena."\n\n";
		// print_r($opciones);
		print_r(array_unique($opciones));
		// en base el XML elejir una y guardarla

		echo isset($data[$cadena_limpia]);
		// si en la base de datos no existe el titulo
	}
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
