

<?php

  function parse_dia($dia){         
    //Reemplazamos la A y a
    $dia = str_replace(
    array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'),
    array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'),
    $dia
    );
    return $dia;
  } 

  function parse_mes($mes){         
    //Reemplazamos la A y a
    $mes = str_replace(
    array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
    array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'),
    $mes
    );
    return $mes;
  }

  function incrementarDias($date, $cantidad){
      $new_date = strftime("%Y-%m-%d", strtotime($date . " " . $cantidad . "day"));
      return $new_date;
  }

  function set_semanas($comienzo,$fin){
    $semanas = [];
    $fecha_actual = $comienzo;
    while($fecha_actual < $fin) {
      $comienzo_semana = $fecha_actual;
      $fin_semana = incrementarDias($comienzo_semana,6);
      array_push($semanas,[$comienzo_semana,$fin_semana]);
      $fecha_actual = incrementarDias($fin_semana,1);
    }

    return $semanas;

  }


  function construir_resumen_registrados($start, $end, $filas_registros,$filas_convocatorias){
    $semanas = set_semanas($start,$end);
    $array_semanas = [];

    foreach ($semanas as $s):
      $s_inicio = $s[0];
      $s_fin = $s[1];
      $arr = [];


      /*$s_inicio_dia = parse_dia(date('D',strtotime($s_inicio)) . " " .date('d',strtotime($s_inicio)));
      $s_inicio_mes = parse_mes(date('M',strtotime($s_inicio)));
      $s_fin_dia = parse_dia(date('D',strtotime($s_fin)) . " " .date('d',strtotime($s_fin)));
      $s_fin_mes = parse_mes(date('M',strtotime($s_fin)));*/

      $s_inicio_dia = parse_dia(date('d',strtotime($s_inicio)));
      $s_inicio_mes = parse_mes(date('M',strtotime($s_inicio)));
      $s_fin_dia = parse_dia(date('d',strtotime($s_fin)));
      $s_fin_mes = parse_mes(date('M',strtotime($s_fin)));

      array_push($arr,$s_inicio_dia . " de " . $s_inicio_mes);
      array_push($arr,$s_fin_dia . " de " . $s_fin_mes);
      
      

      $total=0;

      foreach ($filas_convocatorias as $convocatoria):

        $s=0;

          foreach ($filas_registros as $registro):
                  
            if($registro->Fecha_registro>=$s_inicio&&
                $registro->Fecha_registro<=$s_fin&&
                $registro->Convocatoria==$convocatoria->Convocatoria&&
                $registro->Año==$convocatoria->Año){
                $s++;
                $total++;
            }
          endforeach;
          if($convocatoria->Inicio_Convocatoria<=$s_fin && $convocatoria->Fin_Convocatoria>=$s_inicio){
            array_push($arr,$s);
          }elseif($convocatoria->Inicio_Convocatoria>=$s_inicio){
            array_push($arr," ");
          }else{
            array_push($arr,"-");
          }
          

      endforeach;

      array_push($arr,$total);
        
      array_push($array_semanas,$arr);

    endforeach;

    return $array_semanas;
  }

  function construir_resumen_presentados($start, $end, $filas_registros,$filas_convocatorias){
    $semanas = set_semanas($start,$end);
    $array_semanas = [];

    foreach ($semanas as $s):
      $s_inicio = $s[0];
      $s_fin = $s[1];
      $arr = [];


      $s_inicio_dia = parse_dia(date('d',strtotime($s_inicio)));
      $s_inicio_mes = parse_mes(date('M',strtotime($s_inicio)));
      $s_fin_dia = parse_dia(date('d',strtotime($s_fin)));
      $s_fin_mes = parse_mes(date('M',strtotime($s_fin)));

      array_push($arr,$s_inicio_dia . " de " . $s_inicio_mes);
      array_push($arr,$s_fin_dia . " de " . $s_fin_mes);
      
      

      $total=0;

      foreach ($filas_convocatorias as $convocatoria):

        $s=0;

          foreach ($filas_registros as $registro):
                  
            if($registro->Fecha_formulario_completado>=$s_inicio&&
                $registro->Fecha_formulario_completado<=$s_fin&&
                $registro->Convocatoria==$convocatoria->Convocatoria&&
                $registro->Año==$convocatoria->Año){
                $s++;
                $total++;
            }
          endforeach;

          if($convocatoria->Inicio_Convocatoria=='-'){
            array_push($arr,"-");
          }elseif($convocatoria->Inicio_Convocatoria<=$s_fin && $convocatoria->Fin_Convocatoria>=$s_inicio){
            array_push($arr,$s);
          }elseif($convocatoria->Inicio_Convocatoria>=$s_fin){
            array_push($arr," ");
          }else{
            array_push($arr,"-");
          }

      endforeach;

      array_push($arr,$total);
        
      array_push($array_semanas,$arr);

    endforeach;

    return $array_semanas;
  }

?>






