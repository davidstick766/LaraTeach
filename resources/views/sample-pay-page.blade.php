@php
// $array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
//                 array('metaname' => 'size', 'metavalue' => 'big'));

@endphp
<h3>Buy Movie Tickets N500.00</h3>
{{$message ?? ''}}
<form method="POST" action="{{ route('pay') }}" id="paymentForm">
    {{ csrf_field() }}
    <input type="hidden" name="amount" value="500" /> <!-- Replace the value with your transaction amount -->
    <input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
    <input type="hidden" name="description" value="Beats by Dre. 2017" /> <!-- Replace the value with your transaction description -->
    <input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
    <input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
    <input type="hidden" name="email" value="test@test.com" /> <!-- Replace the value with your customer email -->
    <input type="hidden" name="firstname" value="Oluwole" /> <!-- Replace the value with your customer firstname -->
    <input type="hidden" name="lastname" value="Adebiyi" /> <!-- Replace the value with your customer lastname -->
    <input type="hidden" name="metadata" value="" > <!-- Meta data that might be needed to be passed to the Rave Payment Gateway -->
    <input type="hidden" name="phonenumber" value="090929992892" /> <!-- Replace the value with your customer phonenumber -->
    <input type="hidden" name="type" value="card"/>
    <input type="hidden" name="status" value="pending"/> 
    {{-- <input type="hidden" name="paymentplan" value="362" /> <!-- Ucomment and Replace the value with the payment plan id --> --}}
    <input type="hidden" name="ref" value="{{Str::random(40)}}" /> <!-- Ucomment and  Replace the value with your transaction reference. It must be unique per transaction. You can delete this line if you want one to be generated for you. -->
    <input type="submit" value="Fund Account"  />
</form>