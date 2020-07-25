{{-- Just for test --}}
<div>
    @if(session('success'))
        <div class="alert alert-success myalert success" id="success" onshow="show()">
            {{session('success')}}
        </div>
    @endif
</div>
<form method="POST" action="{{ route('create-publisher1') }}" id="createpublisherForm">
    {{ csrf_field() }}
    <input type="text" name="firstname" value="Favour" />
    <input type="text" name="lastname" value="obasi" />
    <input type="email" name="email" value="favourobasi6@gmail.com" />
    <input type="text" name="gender" value="male" />
    <input type="password" name="password" value="12345" />
    <input type="number" name="role_id" value="4" />
    <input type="text" name="address" value="no. 5 Oluwole str." />
    <input type="text" name="state" value="Kaduna" />
    <input type="text" name="country" value="Nigeria" >
    <input type="text" name="phone_number" value="090929992892" />

    <button type="submit">Next</button>
</form>
