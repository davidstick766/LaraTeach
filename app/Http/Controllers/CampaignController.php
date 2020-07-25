<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\User;
use App\Campaign;
use App\CampaignCategory;
use App\Advertiser;


class CampaignController extends Controller
{

    public function __constructor(){

       // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new campaign
     *
     * @return \Illuminate\Http\Response
     */
    public function createCampaign()
    {
        //fetch category_id from CampaignCategory table
        $campaignCategory = Campaign::all();

        //fetch advertiser id
        $advertiser = Advertiser::all();

        return view('campaign.advertiser-create-campaign', compact('campaignCategory','advertiser'));

    }

    /**
     * Store a newly created campaign in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCampaign(Request $request)
    {
        //$campaigns = CampaignCategory::all();

        try {
            //echo $request; die();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'advertiser_id' => 'required',
                    'campaign_about' => 'required',
                    'category_id' => 'required',
                    //'is_approved' => 'required'
                ]
            );

            if ($validator->fails()) {
                //echo $campaigns; die();
                return redirect()->back()->withErrors($validator)->withInput();
            } else {

                // get authenticated user id
                //TODO uncomment for production
                //$user_id = Auth::user()->id;
                $user_id = 11;
                $campaignObject = [
                    'user_id' => $user_id,
                    'title' => $request->title,
                    'advertiser_id' => $request->advertiser_id,
                    'compaign_about' => $request->compaign_about,
                    'is_approved' => 0
                ];

                if (Campaign::create($campaignObject)) {

                    return redirect()->back()->with('create_success', 'Campaign request created successfully.');
                } else {

                    return redirect()->back()->with('create_error', 'Campaign request creation failed.');
                }
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('create_error', 'Oops! it\'s you, it is us. Please try again.');
        }

    }

    public function campaignhistory($id, Request $request)
    {
        //Auth::user()->id;

        $campaignhistory = Campaign::where('user_id', $request->id)->paginate(1);
         
        return view('campaign-history', compact('campaignhistory'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCampaign($id)
    {
        //
        //$request = Campaign::where('id', $id)->with('user')->first();
        //return view('campaign')->with('request',$request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCampaign($id)
    {
        //
        $editcampaign = Campaign::findOrFail($id);
        //return response()->json_encode('edit Success');
        return view('campaign.advertiser-edit-campaign', compact('editcampaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCampaign(Request $request, $id)
    {
        //
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => 'required',
                    'advertiser_id' => 'required',
                    'campaign_about' => 'required',
                    'category_id' => 'required',
                    //'is_approved' => 'required'
                ]
            );
            if ($validator->fails()) {
                echo "validation error"; die();
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $update = Campaign::findorFail($id);

                if($update->is_approved == 1){
                    // get authenticated user id
                    //TODO uncomment for production
                    //$user_id = Auth::user()->id;
                    $user_id = 11;
                    $campaignObject = [
                        'user_id' => $user_id,
                        'title' => $request->title,
                        'advertiser_id' => $request->advertiser_id,
                        'compaign_type' => $request->compaign_type,
                        //'is_approved' => 1
                    ];

                    if(Campaign::where('id',$id)->update($campaignObject))
                    {
                        echo "success"; die();
                        return redirect()->back()->with('update_success', 'Campaign updated successfully.');
                    }
                    else
                    {
                        echo "failure"; die();
                        return redirect()->back()->with('update_error', 'Oops! it is us, not you. Please try again.');
                    }
                }
                else
                    return redirect()->back()->with('permission_error', 'This campaign is not approved.');

            }
        } catch (\Exception $ex) {
            echo $ex; die();
            return redirect()->back()->with('update_error', 'Oops! it\'s you, it is us. Please try again.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCampaign($id)
    {
        //

        if(Campaign::where('id',$id)->delete()){
            return redirect()->back()->with('delete_success', 'Campaign deleted successfully.');
        }else{
            return redirect()->back()->with('delete_error', 'Oops! it\'s you, it is us. Please try again');
        }


    }

}
