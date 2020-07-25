<?php

namespace App\Http\Controllers;

use App\User;
use App\Wallet;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WithdrawalController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPublisherWithdrawal()
    {
        return view('publisher.request-payment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePublisherWithdrawal(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $wallet = Wallet::where('user_id', $user->id)->get();
            // Check if withdrawal request amount is greater than wallet balance
            if ($request->amount > $wallet->amount) {
                return redirect()->back()->with('amount_error', 'Withdrawal amount cannot be more than wallet balance.');
            }
            $withdrawal_info = [
                'amount' => $request->amount,
                'user_id' => $user->id,
                'status' => 'pending'
            ];

            if ($request->amount < 1) {
                return redirect()->back()->with('amount_error', 'Please enter a valid amount');
            }

            if (Withdrawal::create($withdrawal_info)) {
                return redirect()->back()->with('request_success', 'Withdrawal request created successfully.');
            } else {
                return redirect()->back()->with('request_error', 'Oops! Withdrawal request failed.');
            }
        }
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
}
