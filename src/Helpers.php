<?php

namespace Marifhasan\Helpers;

use Illuminate\Support\Str;

class Helpers
{
    private function __construct()
    {
    }

    public static function greeting()
    {
        $hours = date('H');

        $greeting = $hours < '12' ? 'Good Morning' : '';
        $greeting .= $hours >= '12' && $hours < '15' ? 'Good Noon' : '';
        $greeting .= $hours >= '15' && $hours < '17' ? 'Good Afternoon' : '';
        $greeting .= $hours >= '17' && $hours < '19' ? 'Good Evening' : '';
        $greeting .= $hours >= '19' ? 'Good Night' : '';

        return $greeting;
    }

    public static function toClosing($amount)
    {
        return $amount < 0 ? '('.self::toAmount($amount * -1).')' : self::toAmount($amount);
    }

    public static function toOrdinal($number)
    {
        $nf = new \NumberFormatter('en_US', \NumberFormatter::ORDINAL);
        $number = $nf->format($number);

        return $number;
    }

    public static function toAmount($number)
    {
        $sign = '';
        if ($number < 0) {
            $sign = '-';
            $number = $number * -1;
        }

        $data_string = strval($number);
        $data_array = explode('.', $data_string);

        $value = $data_array[0];
        $decimal = count($data_array) > 1 ? $data_array[1] : '';
        $decimal = Str::of($decimal)->padRight(2, '0');

        $value = strrev($value);
        $number_array = [];

        $digits = [3, 2, 2];
        $i = 0;

        do {
            $digit = $digits[$i % 3];
            $number_array[] = substr($value, 0, $digit);
            $value = substr($value, $digit);
            $i++;
        } while (strlen($value) > 0);

        $rev_value = implode(',', $number_array);
        $value = strrev($rev_value);
        $decimal = substr($decimal, 0, 2);

        return strval($sign.($value ?? '0').'.'.$decimal);
    }

    public static function toNumber($unfiltered_number)
    {
        return filter_var($unfiltered_number, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function toQuantity($number)
    {
        return strval(substr(self::toAmount($number), 0, -3));
    }

    public static function toWords($main_price, $currency = 'BDT')
    {
        $string = '';
        $price = intval($main_price);
        $length = strlen((string) $price);

        if ($length > 7) {
            $string .= intval($price / 10000000) > 0 ? self::numberToWords(intval($price / 10000000)) . ' ' . 'Crore' .' ' : '';
            $price = $price % 10000000;

            $length = strlen((string) $price);
            $price = floatval($price);
        }

        if ($length > 5) {
            $string .= intval($price / 100000) > 0 ? self::numberToWords(intval($price / 100000)) . ' ' . 'Lac' . ' ' : '';
            $price = $price % 100000;

            $length = strlen((string) $price);
            $price = floatval($price);
        }

        if ($length > 3) {
            $string .= intval($price / 1000) > 0 ? self::numberToWords(intval($price / 1000)) . ' ' .  'Thousand' . ' ' : '';
            $price = $price % 1000;
        }

        if ($length > 2) {
            $string .= intval($price / 100) > 0 ? self::numberToWords(intval($price / 100)) . ' ' . 'Hundred' . ' ' : '';
            $price = $price % 100;
        }

        $string .= self::numberToWords($price);
        $string .= $currency != 'BDT' ? '' : ' Taka ';

        $amount = explode('.', $main_price);
        if (count($amount) > 1 && floatval($amount[1]) > 0) {
            $string .= ' & ';
            $string .= self::numberToWords($amount[1]);
            $string .= $currency != 'BDT' ? ' Cent ' : ' Paisa ';
        }

        $string .= ' Only';

        return trim($string);
    }

    private static function numberToWords($price)
    {
        $ones = [0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen'];
        $tens = [0 => '', 1 => '', 2 => 'Twenty', 3 => 'Thirty', 4 => 'Forty', 5 => 'Fifty', 6 => 'Sixty', 7 => 'Seventy', 8 => 'Eighty', 9 => 'Ninety'];

        $string = '';
        $value = floatval($price);
        if ($value > 19) {
            $string .= $value / 10 > 1 ? $tens[intval($value / 10)].' ' : '';
            $value = $value % 10;
        } else {
            $string .= $value / 10 > 0 ? $ones[intval($value / 1)].' ' : '';
            $value = $value > 0 ? $value % $value : 0;
        }
        $string .= $ones[intval($value / 1)];

        return $string;
    }
}
