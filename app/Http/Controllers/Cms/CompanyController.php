<?php

namespace App\Http\Controllers\Cms;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Auth;
use App\User;
use NotificationHelper;
use FileHelper;


class CompanyController extends Controller
{   
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function edit()
    {
        if(Auth::user()->company_id == null) {
            return redirect()->route('cms');
        }
        $company = Company::find(Auth::user()->company_id);
        
        $data = [
            'title' => 'Edit Company',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Edit Company', 'route' => 'company', 'class' => 'active']
            ],
            'company' => $company
        ];
        
        return view('cms.company.edit')->with($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'found_at' => 'required|date',
        ]);

        try 
        {
            $company = Company::findOrFail(Auth::user()->company_id);
            if($request->hasFile('logo')) {
                $company->logo = FileHelper::updateImage($request->logo, $company->logo, '');
            }
            
            $company->name = $request->name;
            $company->address = $request->address;
            $company->found_at = $request->found_at;
            $company->updated_by = Auth::id();
            $company->save();

            NotificationHelper::setSuccessNotification('updated_success');
            return redirect()->route('company');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

  

}
