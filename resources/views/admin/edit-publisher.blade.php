{{-- Just for test --}}
<h3>Edit Publisher</h3>
<div>
    @if(session('success'))
        <div class="alert alert-success myalert success" id="success" onshow="show()">
            {{session('success')}}
        </div>
    @endif
</div>
<form method="POST" action="{{ route('edit-publisher', $publisher->id) }}" id="editpublisherForm">
    {{ csrf_field() }}
    <input type="text" name="account_type" value="{{$publisher->account_type}}">
    <input type="text" name="followers_amount" value="{{$publisher->followers_amount}}" />
    <input type="text" name="niche" value="{{$publisher->niche}}" />

    <button type="submit">Update Publisher</button>
</form>

