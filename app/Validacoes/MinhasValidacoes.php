<?php

//namespace App\Validacoes;

//class MinhasValidacoes{
	
	//public function validaNif(string $nif, string &$error = null): bool {

    //    $nif = str_pad(preg_replace('/[^0-9]/', '', $nif), 11, '0', STR_PAD_LEFT);
           // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
    //    if (strlen($nif) != 9 || $nif == '000000000' || $nif == '111111111' || $nif == '222222222' || $nif == '333333333' || $nif == '444444444' || $nif == '555555555' || $nif == '666666666' || $nif == '777777777' || $nif == '888888888' || $nif == '999999999') {

     //       $error = 'Por favor digite um NIF válido';
     //       return FALSE;
     //   } else {
            // Calcula os números para verificar se o NIF é verdadeiro
      //      for ($t = 9; $t < 11; $t++) {
     //       for ($d = 0, $c = 0; $c < $t; $c++) {
      //              $d += $nif[$c] * (($t + 1) - $c);
      //         }
       //         $d = ((10 * $d) % 11) % 10;
       //         if ($nif[$c] != $d) {
        //            $error = 'Por favor digite um NIF válido';
       //             return FALSE;
       //         }
      //      }
      //      return TRUE;
      //  }
  //  }
//}

