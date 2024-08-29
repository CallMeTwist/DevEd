<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Utilities\RandomGenerator;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->model = new BlogCategory();
    }

    public function index()
    {
        $categories = $this->model->withCount('blogs')->get();
      return view('admin.dashboard.blogs.categories.index')->withCategories($categories);
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string'
        ]);
        try{
            $this->model->create([
                'title' => $request->title,
                'code' => RandomGenerator::generate_unique_uuid()
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', $request->title .'has been created successfully');
        return redirect()->back();

    }
    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string'
        ]);

        try{
            $category = $this->model->where('code', $request->category)->first();
            if(!$category){
                session()->flash('warning', 'The selected category does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('title', $request->title)->first();
            if($unique && ($unique->id != $category->id)){
                session()->flash('warning', 'The selected category name is already in use');
                return redirect()->back()->withInput($request->all());
            }

            $category->update([
                'title' => $request->title,
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', $category->title .' has been updated successfully');
        return redirect()->back();

    }
    public function view($code)
    {
        try{
            $category = $this->model->with('blogs')->where('code', $code)->first();
            if(!$category){
                session()->flash('warning', 'The selected brand does not exist');
                return redirect()->route('admin.brands.manage');
            }
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        return view('admin.dashboard.blogs.categories.view')->with('category', $category);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'category' => 'required|string'
        ]);

        try{
            $category = $this->model->withCount('blogs')->where('code', $request->category)->first();
            if(!$category){
                session()->flash('warning', 'The selected category does not exist');
                return redirect()->back();
            }

            if($category->blogs_count){
                session()->flash('warning', 'The selected category cannot be deleted because there are '. $category->blogs_count .' blogs attached to it');
                return redirect()->back();
            }

            $category->delete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger', $category->title .' has been deleted successfully');
        return redirect()->route('admin.categories.manage');

    }
}
