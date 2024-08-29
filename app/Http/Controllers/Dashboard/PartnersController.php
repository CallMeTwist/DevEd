<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Utilities\RandomGenerator;
use App\Http\Controllers\Controller;

class PartnersController extends Controller
{

    public function __construct()
    {
        $this->model = new Partner();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $partners = $this->model->all();  
        return view('admin.dashboard.partners.index')->with('partners', $partners);
    }

    public function add(Request $request) 
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string|max:225',
            'logo'=>'required|image|mimes:jpg,png|max:2000'
        ]);

        try{
            $name = str_slug($request->name).'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads/partners/'), $name);

            $this->model->create([
                'name' => $request->name,
                'logo' => 'uploads/partners/'.$name,
                'code' => RandomGenerator::generate_unique_uuid()
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', $request->name .' has been created successfully');
        return redirect()->back();
        
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'partner' => 'required|string',
            'name' => 'required|string',
            'logp' => 'nullable|image|mimes:jpg,png|max:2000'
        ]);

        try{
            $partner = $this->model->where('code', $request->partner)->first();
            if(!$partner){
                session()->flash('warning', 'The selected partner does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('name', $request->name)->first();
            if($unique && ($unique->id != $partner->id)){
                session()->flash('warning', 'The selected partner name is already in use');
                return redirect()->back()->withInput($request->all());
            }

            if($request->logo){

                @unlink(public_path($partner->logo));

                $name = str_slug($request->name).'.'.$request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('uploads/partners/'), $name);
            }

            $partner->update([
                'name' => $request->name,
                'logo' => $request->logo ? 'uploads/partners/'.$name : $partner->logo
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', $partner->name .' has been updated successfully');
        return redirect()->back();
    }

    /**
     * @param $code
     * @return RedirectResponse
     */
    public function view($code)
    {
        try{
            $partner = $this->model->where('code', $request->partner)->first();
            if(!$partner){
                session()->flash('warning', 'The selected partner does not exist');
                return redirect()->route('admin.partners.manage');
            }
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        return view('admin.dashboard.partners.view');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
        public function delete(Request $request)
    {
        $request->validate([
            'partner' => 'required|string'
        ]);

        try{
            $partner = $this->model->where('code', $request->partner)->first();
            if(!$partner){
                session()->flash('warning', 'The selected partner does not exist');
                return redirect()->back();
            }

            if (file_exists(public_path($partner->logo))) {
                @unlink(public_path($partner->logo));
            }

            $partner->Delete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger', $partner->name .' has been deleted successfully');
        return redirect()->route('admin.partners.manage');
    }
}
