<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;
use DB;

class FormController extends Controller
{
    public function index(Request $request)
    {
        $forms=Form::where('title','like',"%{$request->get('cari')}%")
            ->orWhere('description','like',"%{$request->get('cari')}%")
            ->orderBy('id','DESC')
            ->paginate(5);
           
        return view('blog/index', compact('forms'));
    }

    public function create()
    {
        return view('blog/create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
			'title' =>'required|min:2'		
        ]);
            
        $forms = new Form;
        $forms->title = $request->title;
        $forms->description = $request->description;
        $forms->save();

        return redirect('/forms');

    }

    public function show($id)
    {
        $forms =Form::find($id);

		if (!$forms)abort(404);


	 return view('blog/show', ['forms' =>$forms]);
    }
    public function edit($id)
    {
        $forms =Form::find($id);
	 return view('blog.edit', compact('forms'));
    }
    public function update(Request $request, $id)
    {
        $forms =Form::find($id);
		$forms->title 		= $request->title;
		$forms->description	= $request->description;
        $forms->save();	
		
        return redirect('/forms');
	}
   
    public function destroy($id)
    {
        $forms =Form::find($id);
		$forms->delete();
        return redirect('forms');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        DB::table("forms")->whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
