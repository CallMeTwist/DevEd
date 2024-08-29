<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Utilities\RandomGenerator;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{

    public function __construct()
    {
        $this->model = new Service();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $services = $this->model->all();
        return view('admin.dashboard.services.index')->with('services', $services);
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title'=>'required|string|max:225',
            'image'=>'required|image|mimes:jpg,png|max:2000',
            'summary' => 'required|string',
            'description' => 'required|string'
        ]);

        try{
            $title = str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/services/'), $title);

            $this->model->create([
                'title' => $request->title,
                'image' => 'uploads/services/'.$title,
                'description' => $request->description,
                'summary' => json_encode(explode(',', $request->summary)),
                'code' => RandomGenerator::generate_unique_uuid()
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', $request->title .' has been created successfully');
        return redirect()->back();

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'service' => 'required|string',
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png|max:2000',
            'summary' => 'nullable|string',
            'description' => 'required|string'
        ]);

        try{
            $service = $this->model->where('code', $request->service)->first();
            if(!$service){
                session()->flash('warning', 'The selected service does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('title', $request->title)->first();
            if($unique && ($unique->id != $service->id)){
                session()->flash('warning', 'The selected service name is already in use');
                return redirect()->back()->withInput($request->all());
            }

            if($request->image){

                @unlink(public_path($service->image));

                $name = str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/services/'), $name);
            }

            $service->update([
                'title' => $request->title,
                'image' => $request->image ? 'uploads/services/'.$title : $service->image,
                'summary' => $request->filled('summary') ? explode(',', $request->summary) : $service->summary,
                'description'=> $request->description
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', $service->title .' has been updated successfully');
        return redirect()->back();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function view($code)
    {
        try{
            $service = $this->model->where('code', $request->service)->first();
            if(!$service){
                session()->flash('warning', 'The selected service does not exist');
                return redirect()->route('admin.services.manage');
            }
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        return view('admin.dashboard.services.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
        public function delete(Request $request)
    {
        $request->validate([
            'service' => 'required|string'
        ]);

        try{
            $service = $this->model->where('code', $request->service)->first();
            if(!$service){
                session()->flash('warning', 'The selected service does not exist');
                return redirect()->back();
            }

            if (file_exists(public_path($service->image))) {
                @unlink(public_path($service->image));
            }

            $service->forceDelete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger', $service->title .' has been deleted successfully');
        return redirect()->route('admin.services.manage');
    }
}
