<!DOCTPE html>
<html>
<head>
<title>View Post</title>
</head>
<body>
<table border = "1">
<tr>
<td>Id</td>
<td>amount</td>
<td>currency</td>
<td>currency</td>
<td>Time Payed</td>
</tr>
@foreach ($history as $transactions)
<tr>
<td>{{ $transactions->user_id }}</td>
<td>{{ $transactions->amount }}</td>
<td>{{ $transactions->currency }}</td>
<td>{{ $transactions->transaction_desc }}</td>
<td>{{ $transactions->created_at }}</td>
</tr>
@endforeach
</table>
{{ $history->links() }}
</body>
</html>



