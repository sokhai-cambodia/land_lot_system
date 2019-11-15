<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use FileHelper;
class Land extends Model
{
    //
    protected $table = 'lands';
    protected $guarded = [];
    //get show image
    public function getPhoto()
    {
        return asset(FileHelper::hasImage($this->image));
    }

}
