<?php

namespace App\Http\Controllers;
use DB;
use Auth;

class Helper
{
    public static function encryptor($action, $string) 
    {
        $output = false;

        $encrypt_method = "AES-256-CBC";

        // hash
        $key = 'rJ9Odqepu3h5qqhpSEERhM1K2iAiV6zw';
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = '71dd1c957d7bd7e1';

        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        //$output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt($string, $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}
