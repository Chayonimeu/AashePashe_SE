<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RandomNumberModel extends Model {

    // This funciton will generate 5-15 characters random number
    public function random_number($min = 5, $max = 15) {
        $length = rand($min, $max);
        $string = '';
        $index = '0123456789abcdefghijklmnopqrstuvwxyzOLIVineLiMiTeDABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i++) {
            $string .= $index[rand(0, strlen($index) - 1)];
        }
        return $string;
    }

    // This funciton will generate 6 digits number for mobile verification
    public function mobile_verification($min = 6, $max = 6) {
        $length = rand($min, $max);
        $string = '';
        $index = '0123456789';
        for ($i = 0; $i < $length; $i++) {
            $string .= $index[rand(0, strlen($index) - 1)];
        }
        return $string;
    }

}
