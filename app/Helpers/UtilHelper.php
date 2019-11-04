<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Route;

Class UtilHelper
{

    /**
     * use to selected on selected html tag
     */
    public static function selected($value, $compareValue) {
        return  $value == $compareValue ? 'selected' : '';
    }

    /**
     * use to checked on checkbox html tag
     */
    public static function checked($value, $compareValue) {
        return  $value == $compareValue ? 'checked' : '';
    }

    /**
     * check if has value. use it for on create or edit form
     */
    public static function hasValue($value, $defaultValue = '') {
        return  ($value != '' && $value != null) ? $value : $defaultValue;
    }

    /**
     * use to generate slug for utf8
     */
    public static function slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }

    /**
     * use to active sidebar
     * @hasTreeView = true: if sidebar has sub sidebar
     */
    public static function activeSideBar($routeArr, $hasTreeView = false) {
        $str = $hasTreeView ? 'menu-open' : 'active';
        return in_array(request()->route()->getName(), $routeArr) ? $str : '';
    }

    /**
     * prevent error when missing route name
     * missing route name will generate '#'
     */
    public static function route($name, $params = []) {
        return Route::has($name) ? route($name, $params) : '#';
    }

}

?>
