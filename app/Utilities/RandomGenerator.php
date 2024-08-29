<?php

namespace App\Utilities;

use Illuminate\Database\Eloquent\Model;

class RandomGenerator
{
    /**
     * @param $length
     * @return string
     * @throws \Exception
     */
    public static function generate_random_string($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        return $token;
    }

    /**
     * @param int $length
     * @return string
     */
    public static function generate_random_numbers($length)
    {
        $salt = "123456789";
        $len = strlen($salt);
        $makepass = '';

        mt_srand(10000000*(double)microtime());

        for ($i = 0; $i < $length; $i++) {
            $makepass .= $salt[mt_rand(0,$len - 1)];
        }

        return $makepass;
    }

    /**
     * @return string
     */
    public static function generate_unique_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0C2f ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0x2Aff ), mt_rand( 0, 0xffD3 ), mt_rand( 0, 0xff4B )
        );
    }

    /**
     * @param Model $model
     * @param $length
     * @param $type
     * @return string
     * @throws \Exception
     */
    public static function generate_unique_code(Model $model, $length, $type = 'string')
    {
        $code = $type == 'string' ? self::generate_random_string($length) : self::generate_random_numbers($length);

        $exists = $model->soft_deleting ? $model->withTrashed()->whereCode($code)->first() : $model->whereCode($code)->first();

        if($exists){
            self::generate_unique_code($model, $length, $type);
        }

        return 'PRISMA-'.$code;
    }
}
