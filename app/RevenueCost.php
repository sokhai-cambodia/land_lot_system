<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use FileHelper;
class RevenueCost extends Model
{
    
    use SoftDeletes;
    //
    protected $table = 'revenue_cost_categories';
    protected $guarded = [];
    //get show image
    public function getPhoto()
    {
        return asset(FileHelper::hasImage($this->image));
    }  
    public function RevenueCostCategories(){
    	return $this->hasMany(RevenueCostCategory::class,'category_id','id');
    }

}
