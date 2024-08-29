<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\FAQ;
use Illuminate\Http\Request;
use App\Utilities\RandomGenerator;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{

    public function __construct()
    {
        $this->model = new FAQ();
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $faqs = $this->model->all();
        return view('admin.dashboard.faqs.index')->with('faqs', $faqs);
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'question'=>'required|string|max:225',
            'answer'=>'required|string|max:5000'
        ]);

        try{
            $this->model->create([
                'question' => $request->question,
                'answer' => $request->answer,
                'code' => RandomGenerator::generate_unique_uuid()
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('success','FAQ has been created successfully');
        return redirect()->back();

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'faq' => 'required|string',
            'question'=>'nullable|string|max:225',
            'answer'=>'nullable|string|max:5000'
        ]);

        try{
            $faq = $this->model->where('code', $request->faq)->first();
            if(!$faq){
                session()->flash('warning', 'The selected faq does not exist');
                return redirect()->back()->withInput($request->all());
            }

            $unique = $this->model->where('question', $request->question)->first();
            if($unique && ($unique->id != $faq->id)){
                session()->flash('warning', 'The selected FAQ name is already in use');
                return redirect()->back()->withInput($request->all());
            }

            //this was a learning journey so the commented code is the first trial at trying to make this shit work, I shall look back at it for further study

            // $updateData = [];
            // if ($request->filled('question')) {
            //     $updateData['question'] = $request->question;
            // }
            // if ($request->filled('answer')) {
            //     $updateData['answer'] = $request->answer;
            // }

            // if (!empty($updateData)) {
            //     $faq->update($updateData);
            // }

            $faq->update([
                'question' => $request->filled('question') ? $request->question : $faq->question,
                'answer' => $request->filled('answer') ? $request->answer : $faq->answer,
            ]);
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back()->withInput($request->all());
        }

        session()->flash('info','FAQ has been updated successfully');
        return redirect()->back();
    }

    //I will put this functionality later, for now omo i don tire abeg
    // /**
    //  * @param $code
    //  * @return RedirectResponse
    //  */
    // public function view($code)
    // {
    //     try{
    //         $faq = $this->model->where('code', $request->faq)->first();
    //         if(!$faq){
    //             session()->flash('warning', 'The selected faq does not exist');
    //             return redirect()->route('admin.faqs.manage');
    //         }
    //     }
    //     catch(Exception $exception){
    //         session()->flash('danger', $exception->getMessage());
    //         return redirect()->back();
    //     }

    //     return view('admin.dashboard.faqs.view');
    // }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
        public function delete(Request $request)
    {
        $request->validate([
            'faq' => 'required|string'
        ]);

        try{
            $faq = $this->model->where('code', $request->faq)->first();
            if(!$faq){
                session()->flash('warning', 'The selected faq does not exist');
                return redirect()->back();
            }

            $faq->Delete();
        }
        catch(Exception $exception){
            session()->flash('danger', $exception->getMessage());
            return redirect()->back();
        }

        session()->flash('danger','FAQ has been deleted successfully');
        return redirect()->route('admin.faqs.manage');
    }
}
