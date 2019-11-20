<?php

use Illuminate\Database\Seeder;
use App\RevenueCostCategory;
use App\User;

class RevenueCostCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::find(1);
        $data = [
            [
                'company_id' => $user->company_id,
                'name' => 'Land Deposit',
                'code' => 'land_deposit',
                'type' => 'revenue',
                'is_editable' => 0,
                'created_by' => 1
            ],
            [
                'company_id' => $user->company_id,
                'name' => 'Land Payment',
                'code' => 'land_payment',
                'type' => 'revenue',
                'is_editable' => 0,
                'created_by' => 1
            ],
            [
                'company_id' => $user->company_id,
                'name' => 'Land Commission',
                'code' => 'land_commission',
                'type' => 'cost',
                'is_editable' => 0,
                'created_by' => 1
            ],
            [
                'company_id' => $user->company_id,
                'name' => 'Legal Service Process Fee',
                'code' => 'legal_service_process_fee',
                'type' => 'cost',
                'is_editable' => 0,
                'created_by' => 1
            ],
            [
                'company_id' => $user->company_id,
                'name' => 'Installment Payment',
                'code' => 'installment_payment',
                'type' => 'revenue',
                'is_editable' => 0,
                'created_by' => 1
            ],
        ];

        RevenueCostCategory::insert($data);
    }
}
