<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use FileHelper;

class RevenueCost extends Model
{
    
    use SoftDeletes;

    protected $table = 'revenue_costs';
    protected $guarded = [];

    public function getPhoto()
    {
        return asset(FileHelper::hasImage($this->image));
    }  

    public function RevenueCostCategories(){
    	return $this->hasMany(RevenueCostCategory::class,'category_id','id');
    }

}
