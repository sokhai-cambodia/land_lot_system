<?php
namespace App\Helpers;

use App\Exceptions\Handler;
use Session;

Class NotificationHelper
{

    public const NOTIFICATION_INFO = 'info';
    public const NOTIFICATION_WARNING = 'warning';
    public const NOTIFICATION_SUCCESS = 'success';
    public const NOTIFICATION_ERROR = 'error';
    
    public static function defaultLogo()
    {
        $defaultLogoPath = 'assets/logos/logo.svg';
        return asset($defaultLogoPath);
    }

    /**
     * $message = '';  
     * $type = {'info', 'warning', 'success', 'error'}
     */
    private static function setNotification($message='default message', $type='error', $isPlainMessage=false)
    {
        $msg = $isPlainMessage ? $message : NotificationHelper::cmsMessageLocalization($message);
        Session::flash('message', $msg);
    	Session::flash('type', $type);
    }

    public static function setInfoNotification($message='default message', $isPlainMessage=false)
    {
        NotificationHelper::setNotification($message, NotificationHelper::NOTIFICATION_INFO, $isPlainMessage);
    }

    public static function setSuccessNotification($message='default message', $isPlainMessage=false)
    {
        NotificationHelper::setNotification($message, NotificationHelper::NOTIFICATION_SUCCESS, $isPlainMessage);
    }

    public static function setWarningNotification($message='default message', $isPlainMessage=false)
    {
        NotificationHelper::setNotification($message, NotificationHelper::NOTIFICATION_WARNING, $isPlainMessage);
    }

    public static function setErrorNotification($message='default message', $isPlainMessage=false)
    {
        NotificationHelper::setNotification($message, NotificationHelper::NOTIFICATION_ERROR, $isPlainMessage);
    }

    public static function cmsMessageLocalization($key='')
    {
        return __('cms/message.' . trim($key));
    }
    
    public static function errorNotification($e) 
    {
        $APP_DEBUG = env("APP_DEBUG", true);
        if ($APP_DEBUG) 
        {
            return NotificationHelper::setErrorNotification($e->getMessage(), true);
        }

        return NotificationHelper::setErrorNotification('Oop... sorry something wrong..!', true);
    }

    public static function setDeletedPopUp($message='default message', $isPlainMessage=false)
    {
        $msg = $isPlainMessage ? $message : NotificationHelper::cmsMessageLocalization($message);
        Session::flash('delete-message', $msg);
    }

}

?>
