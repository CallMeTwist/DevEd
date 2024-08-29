<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->model = new Settings();
    }

    /**
     * @return mixed
     */
    public function system()
    {
        return view('admin.dashboard.settings.system');
    }

    public function account()
    {
        return view('admin.dashboard.settings.account');
    }

    public function updateSystemSettings(Request $request)
    {
        $request->validate([
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'name' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,png|max:2000',
            'theme' => 'nullable|string',
        ]);
        try{
            if($request->logo){

                @unlink(public_path($settings->logo));

                $name = str_slug($request->name).'.'.$request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('uploads/logos/'), $name);
            }

            $this->model->updateOrCreate([
                'email' => $request->email,
                'phone' =>$request->phone,
                'name' =>$request->name,
                'theme' =>$request->theme == 'dark',
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success','System Settings updated successfully');
        return redirect()->back();
    }

    public function updateAccountSettings(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|string',
        ]);

        try{
            
            me()->update([
                'name' => title_case($request->name),
                'email' => $request->email,
            ]);
    
        }
            catch(Exception $exception){
                session()->flash('danger', $exception->getMessage());
                return redirect()->back()->withInput($request->all());
            }

            session()->flash('success','Account Settings updated successfully');
            return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        try{
            if(!password_verify($request->old_password, me()->password)) {
                session()->flash('danger', 'Password does not match with your current password!');
                return redirect()->back();
            }
    
            if(password_verify($request->password, me()->password)){
                session()->flash('info', 'No changes was detected!');
                return redirect()->back();
            }
    
            me()->update([
                'password' => bcrypt($request->password)
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', 'Password has been changed successfully!');
        return redirect()->back();

    }
}
