<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Exception;
use Illuminate\Http\Request;
use App\Utilities\RandomGenerator;
use App\Http\Controllers\Controller;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->model = new BlogPost();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $blogs = $this->model->with('categories')->get();
        return view('admin.dashboard.blogs.index')->with('blogs', $blogs);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */

     public function add()
     {
        return view('admin.dashboard.blogs.create')->withCategories(BlogCategory::all());
     }

    public function create(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:225',
            'image'=>'required|image|mimes:jpg,png|max:2000',
            'category' => 'required|string',
            'body' => 'required|string',
            'tags' => 'required|string'
        ]);
        try{
            $title = str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads/blogs/'), $title);

            $this->model->create([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'image' => 'uploads/blogs/'.$title,
                'blog_category_id' => $request->category,
                'body' => $request->body,
                'tags' => $request->tag,
                'code' => RandomGenerator::generate_unique_uuid()
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success', $request->title .' has been created successfully');
        return redirect()->route('admin.blogs.manage');

    }

    public function edit($code)
    {
        $blog = $this->model->where('code', $code)->first();
        if(!$blog){
            session()->flash('warning', 'The selected blog does not exist');
            return redirect()->route('admin.blogs.manage');
        }

        $categories = BlogCategory::all();
        return view('admin.dashboard.blogs.update')->with([
           'blog' => $blog,
           'categories' => $categories
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'blog' => 'required|string',
            'title'=>'required|string|max:225',
            'image'=>'nullable|image|mimes:jpg,png|max:2000',
            'category' => 'required|string',
            'body' => 'required|string',
            'tags' => 'required|string'
        ]);

        try{
            $blog = $this->model->where('code', $request->blog)->first();
            if(!$blog){
                session()->flash('warning', 'The selected blog does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('title', $request->title)->first();
            if($unique && ($unique->id != $blog->id)){
                session()->flash('warning', 'The selected blog name is already in use');
                return redirect()->back()->withInput($request->all());
            }
            if($request->image){

                @unlink(public_path($blog->image));

                $title = str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/blogs/'), $title);
            }

            $blog->update([
                'title' => $request->title,
                'slug' => str_slug($request->title),
                'image' => $request->image ? 'uploads/blogs/'.$title : $blog->image,
                'blog_category_id' => $request->category ?? $blog->category,
                'body' => $request->body,
                'tags' => $request->tags ?? $blog->tags
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info', $blog->title .' has been updated successfully');
        return redirect()->route('admin.blogs.manage');

    }

    public function view($code)
    {
        try{
            $blog = $this->model->with('categories')->where('code', $code)->first();
            if(!$blog){
                session()->flash('warning', 'The selected blog does not exist');
                return redirect()->route('admin.blogs.manage');
            }
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        return view('admin.dashboard.blogs.view')->with('blog', $blog);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'blog' => 'required|string'
        ]);

        try{
            $blog = $this->model->where('code', $request->blog)->first();
            if(!$blog){
                session()->flash('warning', 'The selected blog does not exist');
                return redirect()->back();
            }

            if (file_exists(public_path($blog->image))) {
                @unlink(public_path($blog->image));
            }

            $blog->delete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger', $blog->title .' has been deleted successfully');
        return redirect()->route('admin.blogs.manage');

    }
}
