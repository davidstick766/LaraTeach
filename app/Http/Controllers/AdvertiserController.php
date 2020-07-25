<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Rave;
use App\Transaction;
use App\Card;
use App\User;


class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function paymentHistory($id, Request $request)
    {
        //Auth::user()->id;

        $history = Transaction::where('user_id', $request->id)->paginate(1);
         
        return view('transaction-history', compact('history'));
    }
     public function paycheck($id, Request $request)
    {
        //Auth::user()->id;

        $history = Transaction::where('user_id', $request->id)->paginate(1);
         
        return view('transaction-check', compact('history'));
    }


    public function pay()
    {
        // $user = Auth::user();  //needs auth to function with this
        // $request = User::where('id', $id)->with('user')->first();
        // $metadata = [
        //     'user_id' => $user->id,
        //     'campaign_id' => $id
        // ];
        return view('sample-pay-page'); //sample pay page
    }


    public function initialize(Request $request)
    {
        //Initialize Rave Payment 

        $validator = Validator::make($request->all(),
            [
                'type' => 'required',
                'ref' => 'required',
                'amount' => 'required|numeric',
                'status' => 'required',
            ]);
        if ($validator->fails()) {
            return view('sample-pay-page')->with('message', 'Validation failed');
        }

        $transaction =  new Transaction();
        //$transaction->user_id = $request->user_id; //User ID gotten from Auth
        $transaction->user_id = 20; //Just for testing
        $transaction->type = 'sent';
        $transaction->transaction_ref = $request->ref;
        $transaction->transaction_desc = $request->description;
        $transaction->payment_type = $request->type;
        $transaction->amount = $request->amount;
        $transaction->currency = $request->currency;
        $transaction->transaction_status= $request->status;
        $trans = $transaction->save();

        if($trans){
            Rave::initialize(route('callback'));
        }

        /*Logic if we were doing Direct Payment
        *
        * switch ($paymentMode){
            case "card":
                //code here;
                if ($request->query('txref')) {

                    $ref = $request->query('txref');
                    $currency = "NGN";
        
                    $user = Auth::user()->id;
                    $user_email = $user->email;

                    $card = Card::where('user_id', $request->id);
                    $number = Crypt::decrypt($card->number) ?? $request->number;
                    $name = $card->name ?? $request->cardname;
                    $month = $card->month ?? $request->expirymonth;
                    $year = $card->year ?? $request->expiryyear;
                    $cvv = Crypt::decrypt($card->cvv) ?? $request->cvv;

                    $data = array(
                        "SECKEY" => env('RAVE_SECRET_KEY'),
                        "card_number"=> $number,
                        "cvv"=> $cvv,
                        "expiry_month"=> $month,
                        "expiry_year"=> $year,
                        "currency"=> $currency,
                        "amount"=> $request->amount,
                        "email"=> $request->email ?? $user_email,
                        "tx_ref"=> $ref,
                        "redirect_url"=> url('http://localhost:8000/pay/callback'),
                        "type"=> "card"
                    );
                    $data_string = json_encode($query);

                    $payload = new encrypt3Des($data_string);

                    
                    $ch = curl_init('https://api.flutterwave.com/v3/charges?type=card');
                    
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
                    $response = curl_exec($ch);
        
        
                    curl_close($ch);
        
                    $resp = json_decode($response, true);
        
                    $paymentStatus = $resp['data']['status'];
                    $chargeResponsecode = $resp['data']['chargecode'];
                    $chargeAmount = $resp['data']['amount'];
                    $chargeCurrency = $resp['data']['currency'];
        
                    $query = array(
        
                        "user_id" => $user_id,
                        "transaction_ref" => $ref,
                        "description" => $ref,
                        "type" => 'card',
                        "amount" => $chargeAmount,
                        "status" => $paymentStatus                        
        
                    );
                    $data_string = json_encode($query);

                    if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeCurrency == $currency)) {
                        $store = curl_init(url('transaction/store/' . $user_id));
                        curl_setopt($store, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($store, CURLOPT_POSTFIELDS, $data_string);
                        curl_setopt($store, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($store, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($store, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                        $response = curl_exec($store);
                        curl_close($store);
                        if (json_decode($response, 1)['message'] == 'transaction record created')
                            return view('transaction-status')->with('message', 'Transaction successful !');
                        else {
                            return view('transaction-status')->with('message', 'Transaction recording failed !');
                        }
                    } else {
                        return view('transaction-status')->with('message', 'Transaction failed !');
                    }
                }
            break;

            case "bank":
                //code here
            break;

            case "USSD":
                //Code here
            break;
        }
        *
        */
        
            
    }

    public function callback(Request $request)
    {


        //Get the Pending Transaction from DB 

        $query = Transaction::where([
            'user_id' => '20',
            'transaction_status' => 'pending',
            'type' => 'received'
        ])->first();

        $txref = $query->transaction_ref;
        $currency = $query->currency;

        //$user = Auth::user()->id;

         $data = Rave::verifyTransaction($txref);
         //$datarr = json_decode($data);

        $paymentStatus = $data->data->status;
        $chargeResponsecode = $data->data->chargecode;
        $chargeAmount = $data->data->amount;
        $chargeCurrency = $data->data->currency;

        //dd($data);

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeCurrency == $currency)) {

            $transs = Transaction::where('transaction_ref', $txref)->first();
            $transs->transaction_status = 'paid';
            $saved = $transs->save();
            
            if ($saved)
                return view('transaction-status')->with('message', 'Transaction successful !');
            else {
                return view('transaction-status')->with('message', 'Transaction recording failed !');
            }
        } else {

            $transs->status = 'rejected';
            $transs->save();

            return view('transaction-status')->with('message', 'Transaction failed !');
        }
    }

    // public function encrypt3Des($data){

    //     $encData = openssl_encrypt($data, 'DES-EDE3', env('APP_KEY'), OPENSSL_RAW_DATA);
        
    //     return base64_encode($encData); 
      
    //    }


}
