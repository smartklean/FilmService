<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\film;
use App\Models\genre;
use App\User;
use Auth;

class FilmController extends Controller
{
    //

    public function welcome(Request $request){

        $search = $request->get('search', '');

        $films = film::where('genre', 'like', '%'.$search.'%')->paginate(5);
        
        return view('welcome', compact('films'));

    }

     public function index(Request $request){

        $search = $request->get('search', '');

        $films = film::where('genre', 'like', '%'.$search.'%')->paginate(5);
        
        return view('film.index', compact('films'));
    }

    public function new(){

    	$genres = genre::all();

    	 return view('film.add', compact('genres'));
    }


    public function store(Request $request)
    {
       $this->validate($request, [
            'title' => 'required|max:255',
            'genre' => 'required|max:255',
            'price' => 'required',

        ]);

            // Store your user in database 
            // $user =  User::find(Auth::id());
             film::create([
                'title' => $request['title'],
                'genre' => $request['genre'],
                'price'=>$request['price'],
            ]);
        
        return redirect()->route('film')->with('success','Film added successfully'); 
    }

   
    public function show($id, Request $request){
    	$user = User::find(Auth::id());
        $film = film::find($id);
        $genres = genre::all();
        return view('film.show', compact('film', 'user', 'genres'));
    }

    public function destroy($id){
         
        $user = user::find($id);
        $user->activate = 0;
        $user->update();
       return redirect()->route('users')->with('success','User Succesfully Delete');
    }


    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'genre' => 'required|max:255',
            'price' => 'required',
        ]);
           	$film = film::find($id);
	         $film->title = $request['title'];
	         $film->genre = $request['genre'];
	         $film->price = $request['price'];
	         $film->save();
        
        return redirect()->route('film')->with('success','Film added successfully'); 
    }
}
