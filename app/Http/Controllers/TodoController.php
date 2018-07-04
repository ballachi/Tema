<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DB;
class TodoController extends Controller
{
    // adauga un todo nou
    // valideaza campul todo
    // valideaza imaginea
    // adauga in tabela
    function upload(Request $request)
    {

    	$validator = $this->validate($request ,[
		'todo' => 'required|max:255'
		]);
    	$serializedArr = serialize($request->taguri);
	    if($request->file('select_file') != null){
	    	$this->validate($request, [
	    	 	'select_file'  => 'required|mimes:jpeg,png']);
	    	$image = $request->file('select_file');
	    	if( $image->getClientOriginalExtension() != "jpeg" && $image->getClientOriginalExtension() != "png"){
	    		return redirect('uploadfile');
	    	}

	    	$new_name = time() . '.' . $image->getClientOriginalExtension();
	    	$image->move(public_path("/images"),$new_name);

	    	DB::insert('insert into todos (todo,path,tags) values(?,?,?)',[request()->todo ,$new_name,$serializedArr]);
	    	return redirect('/');
	    }
	    else{
	    	DB::insert('insert into todos (todo,path,tags) values(?,?,?)',[request()->todo, "null" ,$serializedArr]);
	    	return redirect('/');
	    }
    }

    // schimba tagurile unui todo
    function updatetag(Request $request)
    {
    	if(count($request->taguri)==0){
    		$serializedArr = serialize(array(" "));
    		    	DB::table('todos')
            ->where('id', [request()->todoId])
            ->update(['tags' => $serializedArr]);
    	}
        // serializeza tagurile pentru a le adauga in baza de date
    	$serializedArr = serialize($request->taguri);
    	DB::table('todos')
            ->where('id', [request()->todoId])
            ->update(['tags' => $serializedArr]);

    	$todo = \App\Todo::orderBy('created_at','asc')->get();
    	return view('edittodo',['todo'=>$todo]);

    }

//  intoarce toate tudo-urile
    function edit()
    {
    	$todo = \App\Todo::orderBy('created_at','asc')->get();
    	return view('edittodo',['todo'=>$todo]);
    }

// cauta in funtie de data si taguri si intoarce todu-urile
    function find(Request $request) {
		$todo = \App\Todo::orderBy('created_at','asc')->get();

		$todo = DB::table('todos')
		         ->where('created_at','>',request()->startdata)
		         ->Where('created_at','<',request()->enddata)
		         ->get();

	    $newtodo = array();
	      if(count($request->taguri)!=0){
	        for ($i=0; $i < count($todo) ; $i++) { 
	            if( gettype( unserialize($todo[$i]->tags)) == "array" ){
	                if( array_diff( $request->taguri, unserialize($todo[$i]->tags)) == NULL){
	                   array_push($newtodo ,$todo[$i]);
	                }
	            }
	        }
	      }
	      else{
	        $newtodo = $todo;
	      }


    	$tag = \App\Tag::orderBy('created_at','asc')->get();
    	return view('welcome',
       		['todo'=>$newtodo, 'tags'=>$tag , 'data'=>request()->startdata]);
	}

// intoarce tagu-rile si todo-urile
    function edittag(Request $request)
    {
    	$tags = \App\Tag::orderBy('created_at','asc')->get();
    	$results = \App\Todo::find(request()->todoId);
    	return view('edittodotag',["todo" => $results, 'tags'=>$tags]);
    }

}
