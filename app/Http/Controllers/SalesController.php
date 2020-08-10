<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\film;
use App\Models\genre;
use App\Models\sale;
use Auth;

class SalesController extends Controller
{
    //


    public function store(Request $request)
    {
       $this->validate($request, [
            'title' => 'required|max:255',
            'genre' => 'required|max:255',
            'price' => 'required',

        ]);

            // Store your user in database 
            // $user =  User::find(Auth::id());
             sale::create([
                'title' => $request['title'],
                'genre' => $request['genre'],
                'price'=>$request['price'],
            ]);
        
        return redirect()->route('film')->with('success','Film added successfully'); 
    }
}
