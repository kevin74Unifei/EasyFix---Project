<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of util
 *
 * @author Rodrigo Maia
 */
class Util {
    public static function calc_idade($data_nasc) {
        $data_nasc=explode('/',$data_nasc);
        $data_atual=date('d/m/Y');
        $data_atual=explode('/',$data_atual);
        
        $ano =  $data_atual[2]-$data_nasc[2];        
        if($data_atual[1]>=$data_nasc[1]){
            if($data_atual[0]>=$data_nasc[0]){
                return $ano;
            }else return $ano-1;
            
        }else return $ano-1;            
    }
}
