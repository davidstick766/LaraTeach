<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<h1>Super Admin Home</h1>

<h3>Admin: {{ $show_admin_id->first_name }}'s Details</h3>

<p class="alert alert-danger">**<b>email</b>: {{ $show_admin_id->email}} <br>
**<b>full name</b>: {{ $show_admin_id->first_name}} {{ $show_admin_id->last_name}} 


</html>