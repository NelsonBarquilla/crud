<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use Validator;

class CrudController extends Controller
{
    public function index() 
    {
        return view('crud');
    } 

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'         => 'required|email',
            'mobile'        => 'required|regex:/(09)[0-9]{9}/|min:11',
            'age'           => 'required|integer|gt:0',
            'birthday'      => 'required',
            'gender'        => 'required',
        ]);

        if ($validator->passes()) {
            $contact = new Detail;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->mobile = $request->mobile;
            $contact->birthday = $request->birthday;
            $contact->age = $request->age;
            $contact->gender = $request->gender;
            $contact->save();
			return response()->json(['success'=>'Saved Successfully!']);
        }
    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}
