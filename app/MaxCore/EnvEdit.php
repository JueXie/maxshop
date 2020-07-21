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
    public static function editEnvWithKey($data_key, $data_value)
    {

        $envPath = base_path('.env');
        $envData = "";
        $data_arr = EnvEdit::getEnvToArray($envPath);
        $data_arr[$data_key] = $data_value;
        foreach ($data_arr as $key => &$value) {
            //如果不判断key是否为空字符，会报php底层putenv的错误。
            if ($key != "") {
                $envData = $envData . $key . "=" . $value . "\n";
            }
        }
        return EnvEdit::editEnvWithData($envData);
    }

    public static function editEnvWithData($envData)
    {
        $envPath = base_path('.env');
        try {
            file_put_contents($envPath, $envData);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @param $arr
     * 接收一个关联数组更改.env文件
     * 还没调试过
     */
    public static function editEnvWithArray($arr)
    {
        $envPath = base_path('.env');
        $envData = "";

        $data_arr = EnvEdit::getEnvToArray($envPath);
        foreach ($data_arr as $old_key => &$old_value) {
            foreach ($arr as $new_key => &$new_value) {
                if ($old_key == $new_key) {
                    $data_arr[$old_key] = $new_value;
                    unset($arr[$new_key]);
                }
            }
        }
        $now_data = array_merge($data_arr, $arr);
        foreach ($now_data as $key => &$value) {
            //如果不判断key是否为空字符，会报php底层putenv的错误。
            if ($key != "") {
                $envData = $envData . $key . "=" . $value . "\n";
            }
        }
        return EnvEdit::editEnvWithData($envData);
    }

    private static function setEnvDataByArray($arr)
    {

        $data = 'APP_NAME='.$arr["APP_NAME"]."\n".
                'APP_ENV='.$arr["APP_ENV"]."\n".
                'APP_KEY='.$arr["APP_KEY"]."\n".
                'APP_DEBUG='.$arr["APP_DEBUG"]."\n".
                'APP_URL='.$arr["APP_URL"]."\n\n".

                'LOG_CHANNEL='.$arr["LOG_CHANNEL"]."\n\n".

                'DB_CONNECTION='.$arr["DB_CONNECTION"]."\n".
                'DB_HOST='.$arr["DB_HOST"]."\n".
                'DB_PORT='.$arr["DB_PORT"]."\n".
                'DB_DATABASE='.$arr["DB_DATABASE"]."\n".
                'DB_USERNAME='.$arr["DB_USERNAME"]."\n".
                'DB_PASSWORD='.$arr["DB_PASSWORD"]."\n\n".

                'BROADCAST_DRIVER='.$arr["BROADCAST_DRIVER"]."\n".
                'CACHE_DRIVER='.$arr["CACHE_DRIVER"]."\n".
                'QUEUE_CONNECTION='.$arr["QUEUE_CONNECTION"]."\n".
                'SESSION_DRIVER='.$arr["SESSION_DRIVER"]."\n".
                'SESSION_LIFETIME='.$arr["SESSION_LIFETIME"]."\n\n".

                'REDIS_HOST='.$arr["REDIS_HOST"]."\n".
                'REDIS_PASSWORD='.$arr["REDIS_PASSWORD"]."\n".
                'REDIS_PORT=6379'.$arr["REDIS_PORT"]."\n\n".

                'MAIL_DRIVER='.$arr["MAIL_DRIVER"]."\n".
                'MAIL_HOST='.$arr["MAIL_HOST"]."\n".
                'MAIL_PORT='.$arr["MAIL_PORT"]."\n".
                'MAIL_USERNAME='.$arr["MAIL_USERNAME"]."\n".
                'MAIL_PASSWORD='.$arr["MAIL_PASSWORD"]."\n".
                'MAIL_ENCRYPTION='.$arr["MAIL_ENCRYPTION"]."\n\n".

                'PUSHER_APP_ID='.$arr["PUSHER_APP_ID"]."\n".
                'PUSHER_APP_KEY='.$arr["PUSHER_APP_KEY"]."\n".
                'PUSHER_APP_SECRET='.$arr["PUSHER_APP_SECRET"]."\n".
                'PUSHER_APP_CLUSTER=mt1'.$arr["PUSHER_APP_CLUSTER"]."\n\n".

                'MIX_PUSHER_APP_KEY='.$arr["MIX_PUSHER_APP_KEY"]."\n".
                'MIX_PUSHER_APP_CLUSTER='.$arr["MIX_PUSHER_APP_CLUSTER"]."\n\n".

                'WECHAT_MINI_PROGRAM_APPID='.$arr["WECHAT_MINI_PROGRAM_APPID"]."\n".
                'WECHAT_MINI_PROGRAM_SECRET='.$arr["WECHAT_MINI_PROGRAM_SECRET"]."\n\n".

                'WECHAT_PAYMENT_APPID='.$arr["WECHAT_PAYMENT_APPID"]."\n".
                'WECHAT_PAYMENT_MCH_ID='.$arr["WECHAT_PAYMENT_MCH_ID"]."\n".
                'WECHAT_PAYMENT_KEY='.$arr["WECHAT_PAYMENT_KEY"]."\n".
                'WECHAT_PAYMENT_NOTIFY='.$arr["WECHAT_PAYMENT_NOTIFY"]."\n".
                'WECHAT_PAYMENT_CERT_PATH='.$arr["WECHAT_PAYMENT_CERT_PATH"]."\n".
                'WECHAT_PAYMENT_KEY_PATH='.$arr["WECHAT_PAYMENT_KEY_PATH"]."\n";


    }

    private static function getEnvToArray($envPath)
    {
        $data = file_get_contents($envPath);
        $data = explode("\n", $data);
        $data_arr = [];
        foreach ($data as $key => &$value) {
            $pos = strpos($value, "=");
            $key = substr($value, 0, $pos);
            $value = substr($value, $pos + 1, strlen($value));
            if ($key != "") {
                $data_arr[$key] = $value;
            }
        }
        return $data_arr;
    }
}

