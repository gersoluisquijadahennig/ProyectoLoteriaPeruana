<?php
ini_set('memory_limit','1512M');
ini_set('max_execution_time', 0);
gc_enabled();#recolector de basura de php Importante, porque sino da error de memoria


$numero   = (isset($_POST['numero']) && !empty($_POST['numero'])) ? $_POST['numero'] : 0 ;#numero principal
$inicio   = (isset($_POST['inicio']) && !empty($_POST['inicio'])) ? $_POST['inicio'] : 0 ;#numero de inicio de la sumatoria
$NumerosExcluidos = (isset($_POST['excluir']) && !empty($_POST['excluir'])) ? $_POST['excluir'] : 0 ;#cadena numeros excluidos
$consecutivo = (isset($_POST['consecutivo']) && !empty($_POST['consecutivo'])) ? $_POST['consecutivo'] : 0 ;#si quiere calcular y mostrar las sumatorias que poseen numeros consecutivos


# Funcion que retorna un arreglo de numeros segun el numero principal a calcular
# ejemplo, $numero = 10, entonces creamos un arreglo [1,2,3,4,5,6,7,8,9].
function crearArreglo($numero){
	$arr = array();
	for ($i=0; $i < $numero; $i++) {

		array_push($arr, $i);
	}
		array_shift($arr);
	return $arr;

}
//print_r(crearArreglo(10));

# Funcion que a partir de un arreglo crea los pares equidistantes,
# ejemplo, $arr = [1,2,3,4,5,6,7,8,9], entonces creamos un arreglo [0=>[1,9],1=>[2,8],....] 
function crearArreglos($arr){
	
	$cantidad = count($arr);
	$r = ($cantidad/2)-1;
	$arr1 =  array();
		for ($i=0; $i < $r; $i++) { 
			#saco el primer numero
			$primer = array_shift($arr);
			#saco el ultimo
			$ultimo = array_pop($arr);
			array_push($arr1, [$primer,$ultimo]);

		}
	return $arr1;
}

//print_r(crearArreglos([1,2,3,4,5,6,7,8,9]));

# Funcion que busca los numeros consecutivos en un arreglo de numeros (por lo menos una coincidencia)
# return 1 si es true, 0 si es false
function buscaConsecutivos($arr){

	$arr2 = $arr;
	
	foreach ($arr as $key => $value1) {
	//echo $value1;array_shift($arr2);

		foreach ($arr2 as $key => $value2) {
			//echo $value2;
			if ($value1+1 == $value2) {
				//echo 'existe un numero correlativo';
				$resultado = 1;
				break(2);	
			}else{
				$resultado = 0;
			}
		}
		//echo "<br>";
	}

	if ($GLOBALS['consecutivo'] == 1) {
		$resultado = 0;
	}

	return $resultado;
}

//echo buscaConsecutivos([1,3,5,7,9,11]);

# Funcion que busca los numeros consecutivos en un arreglo de numeros (por lo menos una coincidencia)
# return 1 si es true, 0 si es false
function buscaConsecutivosMayorMenor($arr){

	$arr2 = $arr;
	

	foreach ($arr as $key => $value1) {
	echo $value1;
	array_shift($arr2);
		foreach ($arr2 as $key => $value2) {
			echo $value2;
			if ($value1-1 == $value2) {
				echo 'existe un numero correlativo';
				$resultado = 1;
				break(2);	
			}else{
				$resultado = 0;
			}
		}
		echo "<br>";
	}

	if ($GLOBALS['consecutivo'] == 1) {
		$resultado = 0;
	}

	return $resultado;
}

//echo buscaConsecutivosMayorMenor([1,2,1,4,6,5]);

# Funcion que busca los numeros consecutivos a la Izquierda en un arreglo(de la mitad del arreglo) de numeros (por lo menos una coincidencia)
# return 1 si es true, 0 si es false
function buscaConsecutivosMitadIzquierda($arr){

	$arr = array_slice($arr,0,3);
	$arr2 = $arr;
	array_shift($arr2);

	foreach ($arr as $key => $value1) {
	//echo $value1;
		foreach ($arr2 as $key => $value2) {
			//echo $value2;
			if ($value1+1 == $value2) {
				//echo 'existe un numero correlativo';
				$resultado = 1;
				break(2);	
			}else{
				$resultado = 0;
			}
		}
		//echo "<br>";
	}

	if ($GLOBALS['consecutivo'] == 1) {
		$resultado = 0;
	}

	return $resultado;
}

//echo buscaConsecutivosMitadIzquierda([1,3,5,7,9,11]);


# Funcion que busca los numeros consecutivos a la Derecha en un arreglo(de la mitad del arreglo) de numeros (por lo menos una coincidencia)
# return 1 si es true, 0 si es false
function buscaConsecutivosMitadDerecha($arr){

	$arr = array_slice($arr,3,5);
	$arr2 = $arr;
	array_shift($arr2);

	foreach ($arr as $key => $value1) {
	//echo $value1;
		foreach ($arr2 as $key => $value2) {
			//echo $value2;
			if ($value1+1 == $value2) {
				//echo 'existe un numero correlativo';
				$resultado = 1;
				break(2);	
			}else{
				$resultado = 0;
			}
		}
		//echo "<br>";
	}

	if ($GLOBALS['consecutivo'] == 1) {
		$resultado = 0;
	}

	return $resultado;
}

//echo buscaConsecutivosMitadDerecha([1,2,3,8,10,12]);

# Funcion que busca si los numeros contenidos en un arreglo se encuentran en otro
# si por lo menos uno es encontrado entonces devuelve 1.
function buscaExiste($arr,$arregloNumerosExcluidos){

#print_r($arr);
	foreach ($arregloNumerosExcluidos as $key => $value) {
	#echo $value;
		if (in_array($value, $arr)) {
			$resultado = 1;
			break;
		}else{

			$resultado = 0;

		}
	}

return $resultado;
	
}

//echo buscaExiste([1,12,15,17,20,22],[22,23,24]);

#Funcion en construcion para buscar solo los numeros incluidos en un arreglo
#
/*function buscaExisteIncluido($arr,$arregloNumerosIncluidos){

#print_r($arr);
	$resultado = 0;
	$cantidadNumerosIncluidos = count($arregloNumerosIncluidos);
	$i = 0;
	if (!empty($arregloNumerosIncluidos) && $cantidadNumerosIncluidos >= 6) {
		foreach ($arregloNumerosIncluidos as $key => $value) {
		#echo $value;
			if (in_array($value, $arr) && ++$i == $cantidadNumerosIncluidos) {
					$resultado = 1;
				}
		}
	}else
		{
			$resultado = 1;
		}

return $resultado;
	
}*/

//echo buscaExisteIncluido([1,12,15,17,20,22],[]);


#Funcion que dado un arreglo descompone el ultimo numero segun las formulas y crea una nueva posibilidad de resultado positivo
#Ejemplo $arr =  [1,9] decomponemos el ultimo numero, $ultimo = 9, dividimos 9 / 2 = 4, resultado = [1,4,5]
#Formula [a,b] =  [a, b = (b/2),c = (b/2)+1], donde (b/2) es integer, esto siempre y cuando el numero sea impar
# en el caso de que el numero es par [a,b =(b/2)-1,c = b+1].
# luego entra en un ciclo para restar 1 al penultimo, y sumar 1 al ultimo, hasta que antepenultimo < $penultimo, es decir, [a,b = a<b,c]
#todos los resultados se guardan en un nuevo arreglo y es lo que retorna la funcion
function buscaposiblidad($arr,$arregloNumerosExcluidos){
	$i = 1;
	$result =  array();
	$ultimo = end($arr);
	$mod =  $ultimo % 2;
	$division =  $ultimo / 2;
	$divisio_entera = intval($division);
		$penultimo = $divisio_entera;#descomposicion 1
		$ultimo = $penultimo +1;#desconposicion 2
			array_pop($arr);#le quitamos el ultimo numero al arreglo principal
			$result = $arr;#creamo un nuevo arreglo con los valores anteriores menos el numero que se descompuso
			array_push($result,$penultimo,$ultimo);#al arreglo le agregamos los numeros del resultado de la descomposicion
			$ultimo = end($result);
			$penultimo = prev($result);
			$antepunultimo = prev($result);
			#si es par
			if ($mod == 0) {
				$penultimo--;
			}
			
			$result =array();
			
			while ($antepunultimo < $penultimo) {
				$i++;
				gc_collect_cycles();
				$a = array_merge($arr,[$penultimo--,$ultimo++]);
					if (buscaConsecutivos($a)==0 && buscaExiste($a,$arregloNumerosExcluidos) == 0) {
		            #solo se ingresa los que no son consecutivos y que no esten excluidos
						array_push($result, $a);
					}
			} ;
	
		return $result;
}

//print_r(buscaposiblidad([1,3,5,29],[2]));

#Funcion que revisa si una posibilidad se puede convertir en otra; 
function posible($arr){
	 $value = 0;
	 $arreglo = $arr;
	 $ultimo  = end($arreglo);
	 $penultimo = prev($arreglo);
	
	$value = ($ultimo / 2);
	if (intval($value) > $penultimo) {
			return 'true';
		}else {
			return 'false';
		}
}

//echo posible([1,2,3,14]);


#Funcion que hace el llamado a las funciones anteriores guardando las posibilidades resultante y encontrando nuevas 
#cuado $i = 3 devuelve las posibilidades que cumplen con la sumatoria de 6 numeros a+b+c+d+e+f, esta definido de una vez
#
function PosibilidadesTotales($arr,$num,$arregloNumerosExcluidos){

if ($GLOBALS['consecutivo'] == 1) {
	$consecutivo = 'CC';
}else{
	$consecutivo = 'SC';
}

$a = $arr;
$dir = __DIR__.'/datos/';
$file = $dir.$arr[0].'-'.end($arr).'-'.$num.'['.implode(",",$arregloNumerosExcluidos).']'.$consecutivo.'.txt';
$arr = buscaposiblidad($arr,$arregloNumerosExcluidos);
$nuevas_posibilidades =  array();
$result =  array_merge([$a],$arr);
$i = 0;

if (!file_exists($file)) {

	do {
		++$i;
		$nuevas_posibilidades =  array();
		foreach ($arr as $key => $value) {
			if (posible($value) == 'true') {
				#agregar archivo si no existe archivo con nombre value
				array_push($nuevas_posibilidades,buscaposiblidad($value,$arregloNumerosExcluidos));
			}
		}
		$arr =  array();
		foreach ($nuevas_posibilidades as $key => $value) {
			foreach ($value as $key => $posibilidad) {

					array_push($arr, $posibilidad);
			}
		}
				//$result = array_merge($result,$arr);
				$result = $arr;
				gc_collect_cycles();//colector de basura ciclicas de php
				//file_put_contents($file.' P'.$i,serialize($result));
				

		if ($i == 3) {#en el tercer ciclo se obtienen los resultados de  igual 6 sumandos
			$nuevas_posibilidades =  array();
		}

	}while (count($nuevas_posibilidades) > 0);

  	
    #Insertamos en el archivo de texto
 	file_put_contents($file,serialize($result));

 	return $result;
	
	}else{

		$array = unserialize(file_get_contents($file));
		return $array;
	}

    return $result;
}

//print_r(PosibilidadesTotales([1,19]));

#Funcion que imprime los arreglos de manera sumatoria, donde el ultimo numero <= 45

function imprimirResultados($arr){

$i = 1;
	foreach ($arr as $value) {
		
		if (end($value) <= 45) {		
		echo $i++,'.- ';
		foreach ($value as $key => $resultado) {
				if (end($value) == $resultado) {
					echo $resultado;
				}else{
					echo $resultado,' + ';
				}
				
			}		
		echo '<br>';

		}
	}
}
//imprimirResultados(PosibilidadesTotales([2,78]));


function main($numero,$inicio,$arregloNumerosExcluidos){

natsort($arregloNumerosExcluidos);

	if (($numero > 1) && ($inicio > 0) && ($inicio < intval(($numero/2)))) {
		if ($inicio < $numero-$inicio) {
			$arr =  [$inicio, $numero-$inicio];
			imprimirResultados(PosibilidadesTotales($arr,$numero,$arregloNumerosExcluidos));
		}
		
	
	}else{
		echo "ERROR <br>" ;
	}

	$directorio = opendir("./datos"); //ruta actual

	$arreglo_numeros = crearArreglo($numero);
	$arreglo_equidistante = crearArreglos($arreglo_numeros);

	while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
	{
	    if (is_dir($archivo))//verificamos si es o no un directorio
	    {
	        //echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
	    }
	    else
	    {
	        
	        
	        $arrArc =  explode("[", $archivo);
	       
	        foreach ($arreglo_equidistante as $value) {
	        	//echo $value[0].'-'.$value[1].'-'.$numero.'.txt';echo "<br>";
	        	   if ($value[0].'-'.$value[1].'-'.$numero == $arrArc[0]) {
	        			 echo '<a  id="link" onclick ="mostrarArchivotxt(\''. $archivo .'\','.$numero.')">'. $archivo . "</a><br />";
	        		}else{
	        			//echo 'Falta generar las iteraciones para '. $value[0].'-'.$value[1].'-'.$numero.'.txt' . "<br />";
	        		}

	        		//echo $value[0].'-'.$value[1].'-'.$numero.'['.implode(",", $arregloNumerosExcluidos).'].txt';
	        }
	     

	    }
	}
	

}
//print_r(explode(",",$NumerosExcluidos));



main($numero,$inicio,explode(",",$NumerosExcluidos));



function listarArchivo($nombreArchivo){
	
	$arr = unserialize(file_get_contents($nombreArchivo));
	imprimirResultados($arr);

}

//listarArchivo('30-220-250.txt');


?>