<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrowserModel extends Model {

    public function get_browser_information() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $ub = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) {
            $bname = 'Opera';
            if (strpos($user_agent, 'OPR/')) {
                $ub = 'OPR/';
            } else {
                $ub = 'Opera';
            }
        } elseif (strpos($user_agent, 'Edge')) {
            $bname = $ub = 'Edge';
        } elseif (strpos($user_agent, 'Chrome')) {
            $bname = $ub = 'Chrome';
        } elseif (strpos($user_agent, 'Safari')) {
            $bname = $ub = 'Safari';
        } elseif (strpos($user_agent, 'Firefox')) {
            $bname = $ub = 'Firefox';
        } elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7') || strpos($user_agent, 'Trident/7.0; rv:')) {
            $bname = 'Internet Explorer';
            if (strpos($user_agent, 'Trident/7.0; rv:')) {
                $ub = 'Trident/7.0; rv:';
            } elseif (strpos($user_agent, 'Trident/7')) {
                $ub = 'Trident/7';
            } else {
                $ub = 'Opera';
            }
        }

        $pattern = '#' . $ub . '\/*([0-9\.]*)#';
        $matches = array();

        if (preg_match($pattern, $user_agent, $matches)) {
            $version = $matches[1];
        }

        return array(
            'name' => $bname, // Browser Name
            'version' => $version // Browser Version
        );
    }

}
