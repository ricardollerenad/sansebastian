<?php

$vector = [
    "acciontipo" => "guardaEvaluacion", 
    "alumnoid" => [     
        ["alumnoid" => '322', "valoraciones" => '2', "comentarios"=> '1'],
        ["alumnoid" => '323', "valoraciones" => '2', "comentarios"=> '2'],
        ["alumnoid" => '324', "valoraciones" => '2', "comentarios"=> '3'],
        ["alumnoid" => '325', "valoraciones" => '2', "comentarios"=> '4'],
        ["alumnoid" => '326', "valoraciones" => '2', "comentarios"=> '5'],
        ["alumnoid" => '327', "valoraciones" => '2', "comentarios"=> '6'],
        ["alumnoid" => '328', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '329', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '330', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '331', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '332', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '333', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '334', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '334', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '336', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '337', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '338', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '339', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '340', "valoraciones" => '2', "comentarios"=> ''],
        ["alumnoid" => '341', "valoraciones" => '2', "comentarios"=> '']
    ],
    "bimestre" => "3",
    "cursoid" => "227",
    "docente_id" => "2",
    "evaluaciones" => [
        ["competencia"=> '1', "capacidad"=> '1', "desempeno" => 'asd'],
        ["competencia"=> '17', "capacidad"=> '59', "desempeno" => 'asd'],
        ["competencia"=> '', "capacidad"=> '', "desempeno" => 'asd']
    ],
    "sesion" => "1"
];

$alumnos = $vector['alumnoid'];
$evaluaciones = $vector['evaluaciones'];

foreach($alumnos as $alumno ){
    foreach($evaluaciones as $competencia){
        echo ("Alumno ID -> ".$alumno['alumnoid']." | bimestre -> ".$vector['bimestre']." | cursoid -> ".$vector['cursoid']." | docente_id -> ".$vector['sesion']." | competencia ->".$competencias['competencia']." | competencia ->".$competencias['competencia'] ).PHP_EOL;
    }
    

}



?>