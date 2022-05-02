<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ isset($title)?$title:"Laravel" }}</title>
</head>
<body>
    <h1>{{ $details->details['title'] }}</h1>
    <p>{{ $details->details['body'] }}</p>
    <a class="btn btn-success" href="http://localhost:8000/set-default-password?code={{ $details->details['verification_code'] }}" role="button">Set default password</a>
    <p>Thank you !</p>
</body>
</html>