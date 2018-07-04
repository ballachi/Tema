<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TagController extends Controller
{

	// intoarce toate tag-urile
     function index()
    {
    	$tags = \App\Tag::orderBy('created_at','asc')->get();
    	return view('upload',['tags'=>$tags]);
    }



	// va primi tagul care va fi sters si va intoarce tagurile ramase
    function delete(\App\Tag $tag)
    {
		$tag->delete();
		$tag = \App\Tag::orderBy('created_at','asc')->get();
        return view('tags',['tags'=>$tag]);
    }

    // va primi tagul care va fi modificat si valoare noua a tagului
    // va schimba valoarea si va intoarce tagurile ramase
    function update(Request $request, \App\Tag $tag)
    {
    	$validator = Validator::make($request->all() ,[
		'name' => 'required|max:255']);

	    if($validator->fails()){
	    	return redirect("/tag")
	    		->withInput()
	    		->withErrors($validator);
	    }

	    $tag->name = $request->name;
	    $tag->save();

        $tag = \App\Tag::orderBy('created_at','asc')->get();
        return view('tags',['tags'=>$tag]);
	}

	// valideaza tagul si il adauga in baza de date
	// intoarce tagurile existente
    function add(Request $request)
    {

    	$validator = Validator::make($request->all() ,[
		'name' => 'required|max:255']);

	    if($validator->fails()){
	    	return redirect("/tag")
	    		->withInput()
	    		->withErrors($validator);
	    }
	    $tag = new \App\Tag;
	    $tag->name = $request->name;
	    $tag->save();

	    $tag = \App\Tag::orderBy('created_at','asc')->get();
	       return view('tags',
	        ['tags'=>$tag]);
	
    }



}
