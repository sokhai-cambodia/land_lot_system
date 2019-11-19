<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RevenueCostCategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'revenue_cost_categories';
    protected $guarded = [];
}
