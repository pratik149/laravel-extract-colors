

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel RGB</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{-- CSRF Token --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- Bootstrap --}}
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
		<div class="mt-5">
	        @yield('content')
		</div>
    </div>

</body>

</html>
