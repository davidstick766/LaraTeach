<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<h1>Super Admin Home</h1>
<h3>All Admins:</h3>
@if (session('status'))
            <p class="alert alert-success">{{ session('status') }}
            </p>
            @endif
            @if (session('error'))
            <p class="alert alert-danger">{{ session('error') }}
            </p>
            @endif
@if(count($show_admins) == 0)
    <p class="alert alert-danger">
    No Admins Set Yet
    </p>
@endif
 @foreach ($show_admins as $show)
            <p class="alert alert-danger"><b>email</b>: {{ $show->email}}, <b>name</b>: {{ $show->first_name}} {{ $show->last_name}} ** <a href="{!! action('SuperAdminController@show', $show->id) !!}">View this admin</a> ... <a href="{!! action('SuperAdminController@destroy', $show->id) !!}">Remove as Admin</a> 
            </p>
@endforeach
<b>Add a new Admin</b>
<br>
<p>Enter user email below to add as admin</p>
<form action="" method="post">
{!! csrf_field() !!}
<input name="user_email" type="email" required>
<br>
<input type="submit" value="submit">
</form>
</html>