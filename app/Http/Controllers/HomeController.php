<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function user(Request $request){

        $search = $request->get('search', '');
        $users =  User::where('age', '>', '50')->paginate(7);

        return view('user.index', compact('users'));
    }

     public function show($id, Request $request){

        $staff = User::find($id);
         
        return view('user.update', compact('staff'));
    }

     public function password($id, Request $request){

        $staff = User::find($id);
         
        return view('user.updatePassword', compact('staff'));
    }


     public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'oldPassword' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('id', $id)->first();

         if(Hash::check($request['oldPassword'], $user->password)) {

            $user->password = Hash::make($request['password']);

            $user->save();

            return redirect()->route('home')->with('success','User Password Succesfully Updated');
            
        } else {
                
            return redirect()->back()->with('error','User Password is Wrong');
        }
        
    }


     public function update(Request $request, $id){


        $this->validate($request, [
        'name'=>'required|max:255',
        'email'=>'required|email|max:255',
        'age'=>'required|max:225',
        'address'=>'required|max:225',

        ]);
         
         $user = User::find($id);
         $user->name = $request['name'];
         $user->email = $request['email'];
         $user->age = $request['age'];
         $user->address = $request['address'];
         $user->save();

         return redirect()->route('home')->with('success','User Bank Account Changed Successfully');
    }
}
