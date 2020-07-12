<?php
/**
 * Created by PhpStorm
 * @author JueXie
 * @license GPL
 * @date 2020-07-12-012
 * @time 15:49
 */


namespace App\MaxCore;


class EnvEdit
{
    /**
     *TODO 先大概这样写吧，后期优化一下代码
     */
    public static function editEnvWithKey($data_key,$data_value){

        $envPath = base_path('.env');
        $envData="";
        $data_arr = EnvEdit::getEnvArray($envPath);


        $data_arr[$data_key] = $data_value;
        foreach ($data_arr as $key=>&$value){
            //如果不判断key是否为空字符，会报php底层putenv的错误。
            if ($key!=""){
                $envData = $envData.$key."=".$value."\n";
            }
        }
        try {
            file_put_contents($envPath, $envData);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    public static function editEnvWithData($envData){
        $envPath = base_path('.env');
        try {
            file_put_contents($envPath, $envData);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    /**
     * @param $arr
     * 接收一个关联数组更改.env文件
     * 还没调试过
     */
    public static function editEnvWithArray($arr){
        $envPath = base_path('.env');
        $envData = "";

        $data_arr = EnvEdit::getEnvArray($envPath);
        foreach ($data_arr as $old_key => &$old_value){
            foreach ($arr as $new_key => &$new_value){
                if ($old_key==$new_key){
                    $data_arr[$old_key] = $new_value;
                    unset($arr[$new_key]);
                }
            }
        }
        $now_data = array_merge($data_arr,$arr);
        foreach ($now_data as $key=>&$value){
            //如果不判断key是否为空字符，会报php底层putenv的错误。
            if ($key!=""){
                $envData = $envData.$key."=".$value."\n";
            }
        }
        try {
            file_put_contents($envPath, $envData);
            return true;
        }
        catch(Exception $e) {
            return false;
        }
    }

    private static function getEnvArray($envPath){
        $data = file_get_contents($envPath);
        $data = explode("\n",$data);
        $data_arr = [];
        foreach ($data as $key=>&$value){
            $pos = strpos($value,"=");
            $key = substr($value,0,$pos);
            $value = substr($value,$pos+1,strlen($value));
            if ($key!=""){
                $data_arr[$key] = $value;
            }
        }
        return $data_arr;
    }
}

