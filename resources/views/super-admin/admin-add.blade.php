<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<h1>Super Admin Home</h1>
@if (session('status'))
            <p class="alert alert-success">{{ session('status') }}
            </p>
            @endif
            @if (session('error'))
            <p class="alert alert-danger">{{ session('error') }}
            </p>
            @endif
<h3>Add a new Admin:</h3>
<br>

<a href="{!! action('SuperAdminController@showAll') !!}">View All Admin</a>
<br>
<a href="{!! action('SuperAdminController@showAll') !!}">Add a new Admin</a>
</html>