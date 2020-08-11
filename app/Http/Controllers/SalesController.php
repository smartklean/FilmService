<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\film;
use App\User;
use App\Models\sale;
use Auth;
use Carbon\Carbon;

class SalesController extends Controller
{
   public function index(Request $request){

        $films = film::all();

         $user =  User::find(Auth::id());

        $sales = sale::where('user_id', '=', $user->id)->paginate(5);

        return view('sales.index', compact('sales', 'films'));
    }

     public function index2(Request $request){

        $films = film::all();

        $users = User::all();

        $sales = sale::orderBy('id','ASC')->paginate(5);
        
        return view('sales.sales', compact('sales', 'users', 'films'));
    }


    public function store(Request $request)
    {
       $this->validate($request, [
            'price' => 'required',
            'film_id' => 'required',

        ]);

             // Store your user in database 
            $user =  User::find(Auth::id());
             $sale = sale::create([
                'amount' => $request['price'],
                'film_id' => $request['film_id'],
                'user_id' =>$user->id,
                'time'=>Carbon::now(),
            ]);

            return redirect()->route('purchased')->with('success','Film added successfully'); 

        }
}
