<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Campaign;
use App\CampaignCategory;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublisherController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Fetch all publisher transactions
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewAllTransactions()
    {
        // get the logged user id
//        $user_id = Auth::user()->id;
        $user_id = 17;
        $transactions = Transaction::with('user', 'publisher')->where('user_id', $user_id)->get();
        return view('publisher.all-transactions', compact('transactions'));
    }

    /**
     * Show a particular transaction resource
     * @param Transaction $transaction
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewTransaction(Transaction $transaction)
    {
        return view('publisher.single-transaction', compact('transaction'));
    }

    /**
     * show update profile form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createBankAccountInfo(){
        return view('publisher.update-profiler');
    }

    /**
     * Store publisher bank account information
     * @param Request $request
     */
    public function storeBankAccountInfo(Request $request)
    {
        // get the logged user id
//        $user_id = Auth::user()->id;
        $user_id = 17;
        $validator = Validator::make($request->all(), [
            'bankName' => 'required',
            'bankCountry' => '',
            'accountName' => 'required',
            'accountNumber' => 'required|min:10',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $bank_account_info = [
                'user_id' => $user_id,
                'bank_name' => $request->bankName,
                'bank_country' => $request->bankCountry,
                'account_name' => $request->accountName,
                'account_number' => $request->accountNumber
            ];

            $bank_details_exist = BankAccount::query()->where('user_id', $user_id)->exists();
            if($bank_details_exist) {
                // Update bank account information record
                if (BankAccount::query()->where('user_id', $user_id)->update($bank_account_info)) {
                    return redirect()->back()->with('update_success', 'Bank account information updated successfully');
                } else {
                    return redirect()->back()->with('update_error', 'Bank account information could not be updated');
                }
            } else {
                    // Create bank account information record
                    if (BankAccount::query()->create($bank_account_info)) {
                        return redirect()->back()->with('create_success', 'Bank account information uploaded successfully');
                    } else {
                        return redirect()->back()->with('create_error', 'Bank account information upload failed');
                    }
            }
        }
    }

    /**
     * show profile update form
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createUpdateProfile(){
        return view('publisher.update-profile');
    }

    /**
     * update profile
     * @param Request $request
     * @param User $user
     */
    public function updateProfile(Request $request, User $user){

        $user_info = [
           'photo_url' => $request->photoUrl ?? $user->photo_url,
           'address' => $request->address ?? $user->address,
           'state' => $request->state ?? $user->state,
            'country' => $request->publisherCountry ?? $user->country,
            'phone_number' => $request->phoneNumber ?? $user->phone_number
        ];

        if(User::where('id', $user->id)->update($user_info)){
            return redirect()->back()->with('profile_update_success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->with('profile_update_error', 'Oops! profile update failed.');
        }
    }


    public function createFilterCampaignCategory(){
        return view('publisher.filter-campaign-category');
    }

    public function filterCampaignCategory(CampaignCategory $campaignCategory){
        $campaign_category = Campaign::with('campaignCategory')->where('category_id', $$campaignCategory->id)->where('campaign_type', 'Public')->get();
        return view('filter-campaign-category', compact('campaign_category'));
    }
}
