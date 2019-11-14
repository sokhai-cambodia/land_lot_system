<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use FileHelper;

class Company extends Model
{
    
    use SoftDeletes;
    
    public function getLogo()
    {
        return asset(FileHelper::hasImage($this->logo));
    }
}
