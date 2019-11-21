<?php
namespace App\Helpers;

Class DateHelper
{

    /**
     * use to selected on selected html tag
     */
    public static function toKhmerDate($date) {
        $date = strtotime($date);
        $d = date('d', $date);      
        $m = date('m', $date);
        $y = date('Y', $date);

        return DateHelper::toKhmerNo($d).' - '.DateHelper::toKhmerMonth($m).' - '.DateHelper::toKhmerNo($y);
    }

    public static function toKhmerNo($no) {
        $noArr = [
            "០",
            "១",
            "២",
            "៣",
            "៤",
            "៥",
            "៦",
            "៧",
            "៨",
            "៩",
        ];
        $str = "";
        for($i = 0; $i < strlen($no); $i++) {
            $str .= $noArr[$no[$i]];
        }

        return $str;
    }

    public static function toKhmerMonth($month) {
        $monthArr = [
            "មករា",
            "កុម្ភៈ",
            "មីនា",
            "មេសា",
            "ឧសភា",
            "មិថុនា",
            "កក្កដា",
            "សីហា",
            "កញ្ញា",
            "តុលា",
            "វិច្ឆិកា",
            "ធ្នូ",
        ];
    
        return $monthArr[$month - 1];
    }

    

}

?>
