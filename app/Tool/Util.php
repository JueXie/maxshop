<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-03-06-006
 * @time 19:56
 */


namespace App\Tool;


class Util
{
    public function addQueryArg($arg_arr,$host){
        $arg = '';
        $count = count($arg_arr);
        $i = 0;
        foreach ($arg_arr as $key=>$value){
            if ($i < $count -1 ){
                $arg .= $key.'='.$value.'&';
            }else{
                $arg .= $key.'='.$value;
            }
            $i++;
        }
        return $host.'?'.$arg;
    }

}