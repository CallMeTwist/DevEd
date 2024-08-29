<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\BlogPost;
use App\Models\FAQ;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Settings;
use App\Models\Testimonial;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * @return Application|Factory|View|Application
     */
    public function index()
    {
        $settings = Settings::first();
//        dd($settings);
        $blogs = BlogPost::latest()->take(3)->get();
        $services = Service::take(3)->get();
        $projects = Project::take(2)->get();
        $partners = Partner::all();
        $testimonials = Testimonial::all();
        $abouts = About::first();

        return view('welcome')->with([
            'blogs' => $blogs,
            'services' => $services,
            'projects' => $projects,
            'partners' => $partners,
            'testimonials' => $testimonials,
            'abouts' => $abouts,
            'settings' => $settings
        ]);
    }

    /**
     * @return Application|Factory|View|Application
     */
    public function about()
    {
        $about = About::first();
        $partners = Partner::all();
        $services = Service::all();
        $testimonials = Testimonial::all();
        return view('about')->with([
            'about' => $about,
            'partners' => $partners,
            'services' => $services,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * @return Application|Factory|View|Application
     */
    public function services()
    {
        $services = Service::all();
        $partners = Partner::all();
        $testimonials = Testimonial::all();
        return view('services.index')->with([
            'services' => $services,
            'partners' => $partners,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * @param $title
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function viewService($title)
    {
        $title = title_case(str_replace('-', ' ', $title));

        $service = Service::where('title', $title)->first();
        $relatedServices = Service::where('title', '!=', $title)->take(3)->get();
        $faqs = FAQ::all();

        return view('services.view')->with([
            'service' => $service,
            'relatedServices' => $relatedServices,
            'faqs' => $faqs
        ]);
    }

    /**
     * @return Application
     */
    public function portfolios()
    {
        $portfolios = Project::all();
        return view('portfolios.index')->with('portfolios', $portfolios);
    }

    /**
     * @param $name
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function viewProject($name)
    {
        $name = title_case(str_replace('-', ' ', $name));

        $project = Project::where('name', $name)->first();

        return view('portfolios.view')->with([
            'project' => $project,
        ]);
    }

   /**
    * @return Application|Factory|View|\Illuminate\Foundation\Application
    */
    public function blogs()
    {

        $blogs = BlogPost::all();
        return view('blogs.index')->with('blogs', $blogs);
    }

    /**
     * @param $title
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function viewBlog($slug)
    {
        $blog = BlogPost::where('slug', $title)->with('categories')->first();
        $recentArticles = BlogPost::where('title', '!=', $title)
            ->latest()
            ->take(3)
            ->get();

//        dd($blog, $blog->categories);

        return view('blogs.view')->with([
            'blog' => $blog,
            'recentArticles' => $recentArticles
        ]);
    }

    /**
     * @return Application
     */
    public function faqs()
    {
        $faqs = FAQ::all();
        return view('faqs')->with('faqs', $faqs);
    }

    /**
     * @return Application
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send_contact(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string'
        ]);

        $message = "{$request->message}\n\n" . ucwords($request->firstname . ' ' . $request->last_name) . "\n{$request->subject}\n" . strtolower($request->phone);


        // send email
        mail(config('app.email'), $request->email, $message);

        session()->flash('success', 'Message has been sent successfully.');
        return redirect()->back();
    }

}
