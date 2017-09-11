<?php



?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<form action="{{route('editlesson', ['id' => $id])}}" method="POST">
			<input type="text" name="title" value="{{$title}}">
			<input type="text" name="body" value="{{$body}}">
			<input type="submit" name="submit">
			{{csrf_field()}}
			{{method_field('put')}}
		</form>>
</body>
</html>>