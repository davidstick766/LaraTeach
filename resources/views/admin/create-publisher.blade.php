{{-- Just for test --}}
<h3>Second page {{$user_id}}</h3>
<form method="POST" action="{{ route('create-publisher2') }}" id="createpublisherForm">
    {{ csrf_field() }}
<input type="hidden" name="user_id" value="{{$user_id}}">
    <input type="text" name="account_type" value="Individual" />
    <input type="text" name="followers_amount" value="100" />
    <input type="text" name="niche" value="Entertainment" />

    <button type="submit">Create Publisher</button>
</form>

