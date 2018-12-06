<pre>
<?php



$cadenas = array('Gran Apertura De Centro', 'Gran Apertura HOy','Gran APErtura','Gran Abertura HoY','Gran Apertura Hoy Martes','Gran Apertura hoy MArtes', 'Gran Abertura hoy MArtes');

foreach ($cadenas as &$cadena) {
// $cadena = 'Gran Apertura De Centro pepe';

// convertir la expresion en mayusculas
// cora la variable en espacios
$valore = preg_split("/ /", strtoupper($cadena));
$opciones = array();
$n = count($valore);

for ($i = 0; $i < 4; $i++) $opciones[0] .= $valore[$i][0];
// si la sigla es menor a 4
if (strlen($opciones[0]) < 4 ) {
	echo "Error: ";
	echo $n;
	for ($i = 0; $i < (5 - strlen($opciones[0])); $i++) $opciones[0] .= $valore[$n -1][$i+1];
}

// siga sin una sigla
for ($i = 0; $i < 3; $i++) $opciones[1] .= $opciones[0][$i];
// w no me gusta pero no se me ocurre como contar
$w = 2 ;
for ($k = count($valore)-1; $k > 0; $k--) for ($i = 0; $i < strlen($valore[$k]); $i++) $opciones[count($opciones)+1] = $opciones[1].$valore[$k][$i];
$opciones[1] .= $valore[count($valore)-1][0];

// toma datos de la ultima palabra

for ($i = 0; $i < 2; $i++) $opciones[$w] .= $opciones[0][$i];
// esta no existe
$opciones[$w] .= $valore[$n-1][0];
$e = $w+1;
// toma datos de la anteultima palabra
for ($k = count($valore)-1; $k > 0; $k--) for ($i = 0; $i < strlen($valore[$k]); $i++) $opciones[] = $opciones[$w].$valore[$k][$i];
$opciones[$w] .= $opciones[0][count($valore)-1];

echo $cadena."\n\n";
// print_r($opciones);
print_r(array_unique($opciones));
}
