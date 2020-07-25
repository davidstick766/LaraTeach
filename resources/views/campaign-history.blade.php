<!DOCTPE html>
<html>
<head>
<title>View Post</title>
</head>
<body>
<table border = "1">
<tr>
<td>Id</td>
<td>Type</td>
<td>Name</td>
<td>About</td>
</tr>
@foreach ($campaignhistory as $campaign)
<tr>
<td>{{ $campaign->user_id }}</td>
<td>{{ $campaign->campaign_type }}</td>
<td>{{ $campaign->campaign_name }}</td>
<td>{{ $campaign->campaign_about }}</td>
</tr>
@endforeach
{{ $campaignhistory->links() }}
</table>
</body>
</html>



