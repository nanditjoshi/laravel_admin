<!DOCTYPE html>
<html>
<head>
    <title>Welcome Email</title>
</head>

<body>
<h2>Welcome to the site {{$user->name}}</h2>
<br/>
Your registered email-id is {{$user->email}}
@if(isset($password) && $password != '')
<br/>
Your password is {{$password}}
@endif
</body>

</html>