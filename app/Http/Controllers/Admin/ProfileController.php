<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Auth;
use App\User;
use NotificationHelper;
use FileHelper;


class ProfileController extends Controller
{   
    private $gender = ['male', 'female'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'gender' => $this->gender,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Edit Profile', 'route' => 'update.profile', 'class' => 'active']
            ],
        ];
        
        return view('admin.profile.edit')->with($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'gender' => [
                'required',
                Rule::in($this->gender),
            ],
            'dob' => 'required|date',
        ]);

        try 
        {
            $user = User::findOrFail(Auth::id());

            if($request->hasFile('image')) {
                $user->image = FileHelper::updateImage($request->image, $user->image, '');
            }
        
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->phone = $request->phone;
            $user->national_id = $request->national_id;
            $user->passport_id = $request->passport_id;
            $user->gender = $request->gender;
            $user->dob = $request->dob;
            $user->updated_by = Auth::id();
            $user->save();

            NotificationHelper::setSuccessNotification('updated success');
            return redirect()->route('profile.update');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function changePassword()
    {
        $data = [
            'title' => 'Change Password',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Change Password', 'route' => 'profile.change-password', 'class' => 'active']
            ],
        ];
        
        return view('admin.profile.change-password')->with($data);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6|max:255',
            'new_password' => 'required|min:6|max:255',
            'confirm_password' => 'required|min:6|same:new_password|max:255',
        ]);

        try 
        {
            $user = User::findOrFail(Auth::id());
            $password = $request->current_password;
            $hashedPassword = $user->password;
            if (!Hash::check($password, $hashedPassword)) 
            {
                NotificationHelper::setErrorNotification('incorrect_password');
                return redirect()->route('profile.change-password');
            }

            $user->password = Hash::make($request->new_password);
            $user->updated_by = Auth::id();
            $user->save();

            NotificationHelper::setSuccessNotification('updated_success');
            return redirect()->route('profile.change-password');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

}
