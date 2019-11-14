<?php
namespace App\Helpers;
use File;
use DNS1D;
Class FileHelper
{

    public static function getDefaultPathName() {
        return  env('UPLOAD_PATH', 'assets/uploads');
    }

    public static function getDefaultImage() {
        return  env('DEFAULT_IMAGE_PATH', 'assets/cms/default.jpg');
    }

    public static function getLoginImage() {
        return  env('DEFAULT_IMAGE_PATH', 'assets/cms/login-background.jpg');
    }

    public static function getDashboardImage() {
        return  asset(env('DASHBOARD_IMAGE_PATH', 'assets/cms/dashboard.png'));
    }

    public static function getFrontEndImage() {
        return  asset(env('DASHBOARD_IMAGE_PATH', 'assets/front-end/logo.png'));
    }

    public static function upload($file, $pathName = '') {
        $pathName = $pathName == '' ? FileHelper::getDefaultPathName() : $pathName;
        $fileNewName = time().$file->getClientOriginalName();
        $file->move($pathName, $fileNewName);
        return $fileNewName;
    }

    public static function updateImage($file, $oldFile = "",  $pathName = '') {
        $pathName = $pathName == '' ? FileHelper::getDefaultPathName() : $pathName;
        FileHelper::deleteImage($oldFile, $pathName);

        return FileHelper::upload($file, $pathName);
    }

    public static function deleteImage($file, $pathName = '') {
        $pathName = $pathName == '' ? FileHelper::getDefaultPathName() : $pathName;
        $imagePath = $pathName.'/'.$file;
        if(File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    public static function hasImage($image, $pathName = '') {
        if($image == '' || $image == null) return FileHelper::getDefaultImage();
        $pathName = $pathName == '' ? FileHelper::getDefaultPathName() : $pathName;
        $imagePath = $pathName.'/'.$image;

        return File::exists($imagePath) ? $imagePath : FileHelper::getDefaultImage();
    }

    /*
        |========================================================|
        |    Reference URL: https://github.com/milon/barcode     |
        |========================================================|
    */
    public static function generateBarcode($code, $type = "C39+", $width = 1, $heigh = 50) {
        return "data:image/png;base64,".DNS1D::getBarcodePNG($code, $type, $width, $heigh);
    }

    public static function generateBarcodeBase64($code, $type = "EAN13", $width = 1, $heigh = 50) {
        return DNS1D::getBarcodePNG($code, $type, $width, $heigh);
    }

}

?>
