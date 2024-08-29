<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Utilities\RandomGenerator;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->model = new Project();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $projects = $this->model->all();
        return view('admin.dashboard.projects.index')->with('projects', $projects);
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'=>'required|string|max:225',
            'link'=>'required|string|max:225',
            'image'=>'required|image|mimes:jpg,png|max:2000',
            'client'=>'required|string|max:225',
            'location'=>'required|string|max:225',
            'description' => 'required|string'
        ]);

        try{
            $name = str_slug($request->name).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/portfolios/'), $name);

            $this->model->create([
                'name' => $request->name,
                'link' => $request->link,
                'image' => 'uploads/portfolios/'.$name,
                'client' => $request->client,
                'location' => $request->location,
                'description' => $request->description,
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
            'project' => 'required|string',
            'name' => 'required|string',
            'link' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png|max:2000',
            'client' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string'
        ]);

        try{
            $project = $this->model->where('code', $request->project)->first();
            if(!$project){
                session()->flash('warning', 'The selected project does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('name', $request->name)->first();
            if($unique && ($unique->id != $project->id)){
                session()->flash('warning', 'The selected project name is already in use');
                return redirect()->back()->withInput($request->all());
            }

            if($request->image){

                @unlink(public_path($project->image));

                $name = str_slug($request->name).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/portfolios/'), $name);
            }

            $project->update([
                'name' => $request->name,
                'link' => $request->link,
                'image' => $request->image ? 'uploads/portfolios/'.$name : $project->image,
                'client' => $request->client,
                'location' => $request->location,
                'description'=> $request->description
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', $project->name .' has been updated successfully');
        return redirect()->back();
    }

    /**
     * @param $code
     * @return mixed
     */
    public function view($code)
    {
        try{
            $project = $this->model->where('code', $request->project)->first();
            if(!$project){
                session()->flash('warning', 'The selected project does not exist');
                return redirect()->route('admin.portfolios.manage');
            }
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        return view('admin.dashboard.projects.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
        public function delete(Request $request)
    {
        $request->validate([
            'project' => 'required|string'
        ]);

        try{
            $project = $this->model->where('code', $request->project)->first();
            if(!$project){
                session()->flash('warning', 'The selected project does not exist');
                return redirect()->back();
            }

            if (file_exists(public_path($project->image))) {
                @unlink(public_path($project->image));
            }

            $project->forceDelete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger', $project->name .' has been deleted successfully');
        return redirect()->route('admin.portfolios.manage');
    }
}
