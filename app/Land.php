<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use FileHelper;

class Land extends Model
{
    use SoftDeletes;

    protected $table = 'lands';
    protected $guarded = [];
    //get show image
    public function getPhoto()
    {
        return asset(FileHelper::hasImage($this->image));
    }

}
