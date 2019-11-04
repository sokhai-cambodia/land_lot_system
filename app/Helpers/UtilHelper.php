<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Route;

Class UtilHelper
{

    public static function selected($value, $compareValue) {
        return  $value == $compareValue ? 'selected' : '';
    }

    public static function checked($value, $compareValue) {
        return  $value == $compareValue ? 'checked' : '';
    }

    public static function hasValue($value, $defaultValue = '') {
        return  ($value != '' && $value != null) ? $value : $defaultValue;
    }

    public static function slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    public static function activeSideBar($routeArr, $hasTreeView = false) {
        $str = $hasTreeView ? 'menu-open' : 'active';
        return in_array(request()->route()->getName(), $routeArr) ? $str : '';
    }

    public static function route($name, $params = []) {
        return Route::has($name) ? route($name, $params) : '#';
    }

}

?>
