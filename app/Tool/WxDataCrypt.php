<?php
namespace App\Tool;

class WxDataCrypt{

    public static function decryptData($iv,$session_key,$appid,$encryptedData){

        if (strlen($session_key) != 24) {
            return "错误sessionkey";
        }

        if (strlen($iv) != 24) {
            return "错误IV";
        }
        $aesKey=base64_decode($session_key);
        $aesIV=base64_decode($iv);
        $aesCipher=base64_decode($encryptedData);
        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
        $dataObj=json_decode( $result );
        if( $dataObj  == NULL )
        {
            return "解密失败，请重新获取";
        }

        if( $dataObj->watermark->appid != $appid )
        {
            return "appid不匹配";
        }
//		$res = json_encode($dataObj,JSON_UNESCAPED_UNICODE);
        return $dataObj;
    }
}