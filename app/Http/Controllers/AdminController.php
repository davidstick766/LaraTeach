<?php

namespace App\Http\Controllers;

use App\Advertiser;
use Illuminate\Http\Request;

use App\Advertiser;
use App\Role;
use Illuminate\Support\Facades\Hash;

use App\Publisher;
use App\User;

class AdminController extends Controller
{

    //Initialize Admin Middleware
    public function __construct()
    {
        $this->middleware('admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all the advertisers
        $advertisers = Advertiser::all();
        $users = User::all();
        return view('admin.index',compact('advertisers','users'));
    }


    public function indexPublisher()
    {
        $publisher = User::where('role_id', '4')->paginate(2);
        //role_id '4' indicates that the user is a publisher

        return view('admin.publisher-index', compact('publisher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /* When an admin wants to create a publisher, he would
        first have to create as a regular user */
    public function createPublisherAsUser()
    {
        return view('admin.create-publ-as-user');
    }
    /*
    public function createPublisher()
    {
        return view('admin.create-publisher');
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //If the request has company details
        if($request->input('company')){
            $user_id = request('user_id');
            $type = request('type');
            $company_name = request('company_name');
            $company_address = request('company_address');
            $company_email = request('company_email');
            $company_phone = request('company_phone');
            $company_state = request('company_state');
            $company_country = request('company_country');
            $company_size = request('company_size');
            $company_position = request('company_position');
            $account_type = request('account_type');

         //Initialize the model
         $advertiser = new Advertiser;

         //Assign the data to respective  columns
         $advertiser->user_id = $user_id;
         $advertiser->type = $type;
         $advertiser->company_name = $company_name;
         $advertiser->company_address = $company_address;
         $advertiser->company_email = $company_email;
         $advertiser->company_phone = $company_phone;
         $advertiser->company_state = $company_state;
         $advertiser->company_country = $company_country;
         $advertiser->company_size = $company_size;
         $advertiser->company_position = $company_position;
         $advertiser->account_type = $account_type;

         //Save
         $advertiser->save();

         return redirect('/admin');
        }

        //If the request has user details
        if($request->input('individual')){
            $first_name = request('first_name');
            $last_name = request('last_name');
            $email = request('email');
            $gender = request('gender');
            $photo_url = request('photo_url');
            $password = request('password');
            $role_id = request('role_id');
            $address = request('address');
            $state = request('state');
            $country = request('country');
            $phone_number = request('phone_number');


        $user = new User;

         //Assign the data to respective  columns
         $user->first_name = $first_name;
         $user->last_name = $last_name;
         $user->email = $email;
         $user->email_verify_token = '';
         $user->gender = $gender;
         $user->photo_url = $photo_url;
         $user->password = $password; //not hashed yet
         $user->role_id = $role_id;
         $user->address = $address;
         $user->state = $state;
         $user->country = $country;
         $user->phone_number = $phone_number;

         $user->save();

         return redirect('/admin');
        }

    }

    /**
     * Store a newly created user in storage.
     * This function returns the id of the newly created user
     * to the next function where other publisher specific details
     * would be added
     */
    public function storePublisherAsUser(Request $request)
    {
        $user = new User;
        $user->first_name = $request->input('firstname');
        $user->last_name = $request->input('lastname');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');
        $user->address = $request->input('address');
        $user->state = $request->input('state');
        $user->country = $request->input('country');
        $user->phone_number = $request->input('phone_number');
        $user->save();

        return view('admin.create-publisher')->with('user_id', $user->id);
    }

    /**
     * Store publisher specific data in storage
     */
    public function storePublisher(Request $request)
    {
        $publisher = new Publisher;
        $publisher->user_id = $request->input('user_id');
        $publisher->account_type = $request->input('account_type');
        $publisher->followers_amount = $request->input('followers_amount');
        $publisher->niche = $request->input('niche');
        $publisher->save();

        return view('admin.create-publ-as-user')->with('success', 'Publisher created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advertiser = Advertiser::findorfail($id);
        $user = User::findorfail($id);
        return view('admin.show',compact('advertiser','user'));
    }

    public function showPublisher($id)
    {
        $publisher = Publisher::find($id);
        return view('admin.show-publisher')->with('publisher', $publisher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertiser = Advertiser::findorfail($id);
        //$user = User::findorfail($id);
        return view('admin.edit',compact('advertiser'));
    }

    public function editPublisher($id)
    {
        $publisher = Publisher::find($id);
        return view('admin.edit-publisher')->with('publisher', $publisher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate the requests
        //request()->validate([
           // 'user_id' => 'required',
            //'type' => 'required',
            //'account_type' => 'required',
        //]);


        //Initialize the model for the specific id
        $advertiser = Advertiser::findorfail($id);

        //Assign the data to respective  columns

        $advertiser->user_id = request('user_id');
        $advertiser->type = request('type');
        $advertiser->account_type = request('account_type');
        $advertiser->company_name = $request->company_name;
        $advertiser->company_address = $request->company_address;
        $advertiser->company_email = $request->company_email;
        $advertiser->company_phone = $request->company_phone;
        $advertiser->company_state = $request->company_state;
        $advertiser->company_country = $request->company_country;
        $advertiser->company_size = $request->company_size;
        $advertiser->company_position = $request->company_position;

        //Save
        $advertiser->save();

        //Redirect to the show view
        return view('admin.show',compact('advertiser'));
    }
    public function addCredits(Request $request, Advertiser $id){
        $request->validate([
            'amount' => 'required|numeric|min:0'
        ]);
        $new_amount = floatval($id->user->wallet->amount) + $request->amount;
        $id->user->wallet->amount = $new_amount;
        $id->user->wallet->update();
        return response()->json(['user'=>$id->user,'role'=>'Advertiser']);
    }

    public function updatePublisher(Request $request, $id)
    {
        $publisher = Publisher::find($id);
        $publisher->account_type = $request->input('account_type');
        $publisher->followers_amount = $request->input('followers_amount');
        $publisher->niche = $request->input('niche');
        $publisher->save();

        return redirect()->back()->with('success', 'Publisher Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advertiser = Advertiser::findorfail($id);

        $advertiser->delete();
        return redirect('/admin');
    }

    public function destroyPublisher($id)
    {
        $publisher = Publisher::findorFail($id);
        $publisher->delete();

        return back()->with('success', 'Publisher Deleted');
    }
}
