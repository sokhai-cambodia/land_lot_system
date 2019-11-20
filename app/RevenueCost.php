<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use FileHelper;
use App\RevenueCostCategory;

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

    public static function createLandDeposit($data)
    {
        $category = RevenueCostCategory::where('code', 'land_deposit')->first();
        $defaultData = [
            'category_id' => $category->id,
            'type' => $category->type,
            'reference_table' => 'land_payments'
        ];
        RevenueCost::create(array_merge($data, $defaultData));
    }

    public static function createLandPayment($data)
    {
        $category = RevenueCostCategory::where('code', 'land_payment')->first();
        $defaultData = [
            'category_id' => $category->id,
            'type' => $category->type,
            'reference_table' => 'land_payments'
        ];
        RevenueCost::create(array_merge($data, $defaultData));
    }
    
    public static function createLandCommission($data)
    {
        $category = RevenueCostCategory::where('code', 'land_commission')->first();
        $defaultData = [
            'category_id' => $category->id,
            'type' => $category->type,
            'reference_table' => 'land_payments'
        ];
        RevenueCost::create(array_merge($data, $defaultData));
    }

    public static function createInstallmentPayment($data)
    {
        $category = RevenueCostCategory::where('code', 'installment_payment')->first();
        $defaultData = [
            'category_id' => $category->id,
            'type' => $category->type,
            'reference_table' => 'installment_payments'
        ];
        RevenueCost::create(array_merge($data, $defaultData));
    }

    public static function createLegalServiceProcessFee($data)
    {
        $category = RevenueCostCategory::where('code', 'legal_service_process_fee')->first();
        $defaultData = [
            'category_id' => $category->id,
            'type' => $category->type,
            'reference_table' => 'legal_service_processes'
        ];
        RevenueCost::create(array_merge($data, $defaultData));
    }

}
