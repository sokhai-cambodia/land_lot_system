<?php

namespace App\Http\Controllers\Cms;

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
    private $icon = 'icon-layers';
    private $gender = ['male', 'female'];

    public function edit()
    {
        $data = [
            'title' => 'Edit Profile',
            'icon' => $this->icon,
            'gender' => $this->gender,
        ];
        
        return view('cms.profile.edit')->with($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'gender' => [
                'required',
                Rule::in(['male', 'female']),
            ],
            'dob' => 'required|date',
            'username' =>  [
                'required',
                'max:255',
                Rule::unique('users')->ignore(Auth::id()),
            ],
        ]);

        try 
        {
            $user = User::findOrFail(Auth::id());
            if($request->hasFile('photo')) {
                $user->photo = FileHelper::updateImage($request->photo, $user->photo, '');
            }
            
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->gender = $request->gender;
            $user->dob = $request->dob;
            $user->phone = $request->phone;
            $user->username = $request->username;
            $user->updated_by = Auth::id();
            $user->save();

            NotificationHelper::setSuccessNotification('updated_success');
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
            'title' => 'Edit Profile',
            'icon' => $this->icon,
        ];
        
        return view('cms.profile.change-password')->with($data);
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
