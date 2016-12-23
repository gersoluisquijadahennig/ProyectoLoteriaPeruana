<?php 
ini_set('memory_limit','1512M');
ini_set('max_execution_time', 0);
gc_enabled();
$archivo   = (isset($_POST['archivo']) && !empty($_POST['archivo'])) ? $_POST['archivo'] : 0 ;
$numero   = (isset($_POST['numero']) && !empty($_POST['numero'])) ? $_POST['numero'] : 0 ;

function crearArreglo($numero){
	$arr = array();
	for ($i=0; $i < $numero; $i++) {

		array_push($arr, $i);
	}
		array_shift($arr);
	return $arr;

}

//print_r(crearArreglo(10));

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

function imprimirDirectorio($numero){

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
	        
	        
	       
	        foreach ($arreglo_equidistante as $value) {
	        	   if ($value[0].'-'.$value[1].'-'.$numero.'.txt' == $archivo) {
	        			 echo '<a  id="link" onclick ="mostrarArchivotxt(\''. $archivo .'\','.$numero.')">'. $archivo . "</a><br />";
	        		}else{
	        			//echo 'Falta generar las iteraciones para '. $value[0].'-'.$value[1].'-'.$numero.'.txt' . "<br />";
	        		}

	        		//echo $value[0].'-'.$value[1].'-'.$numero.'txt';
	        }
	     

	    }
	}
}

function imprimirResultados($arr){

$i = 1;
	foreach ($arr as $value) {
		
		if (count($value) == 6 && end($value) <= 45) {
			
		
		echo $i++,'.- ';
		foreach ($value as $key => $resultado) {

				echo '+ ',$resultado;
			}
			
		
		echo '<br>';

		}
	}
}

function listarArchivo($nombreArchivo){
	
	$arr = unserialize(file_get_contents($nombreArchivo));
	imprimirResultados($arr);

}



listarArchivo($archivo);
imprimirDirectorio($numero);
?>