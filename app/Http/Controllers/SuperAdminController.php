<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //super admin actions view page
        return view('super-admin.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //create an admin
            $user_email = $request->get('user_email');
            if(!isset($user_email)){
                return redirect(action('SuperAdminController@showAll'))->with('error', 'Field cannot be empty');
            }
            $fetch_user_email = User::where('email', $user_email)->first();
            if($fetch_user_email){
                $fetch_user_email->role_id = 2;
                $fetch_user_email->save();
                return redirect(action('SuperAdminController@showAll'))->with('status', 'User with email '.$user_email.' set as Admin Sucessfully');
            } else {
                return redirect(action('SuperAdminController@showAll'))->with('error', 'User does not exist');
            }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            //view all admin by id
            $show_admin_id = User::where(['id' => $id])->first();
            if(!$show_admin_id){
               return redirect(action('SuperAdminController@index'))->with('error', 'User does not exist'); 
            }
            $show_admin_id_role = $show_admin_id->role_id;
            if($show_admin_id_role == 2){
            return view('super-admin.admin-one', compact('show_admin_id'));
            } else {
                return redirect(action('SuperAdminController@index'))->with('error', 'User is not an Admin');
            }
        
        
    }

    public function showAll()
    {
        //view all admin
        $show_admins = User::where('role_id', 2)->get();
        return view('super-admin.admin', compact('show_admins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete an admin
        if(isset($id)){
            $get_admin = User::where('id', $id)->first();
            if($get_admin){
                    $get_admin_role = $get_admin->role_id;
                if($get_admin_role == 2){
                    $get_admin->role_id = 4;
                    $get_admin->save();
                    return redirect(action('SuperAdminController@showAll'))->with('status', 'User has been removed as Admin');
                } else {
                    return redirect(action('SuperAdminController@showAll'))->with('error', 'User is not an Admin');
                }
            } else {
                return redirect(action('SuperAdminController@showAll'))->with('error', 'User cannot be found');
            }
        } else {
            return redirect(action('SuperAdminController@showAll'))->with('error', 'User cannot be found');
        }
    }
}
