<?php


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<form action="{{route('deletelesson', ['id' => 3])}}" method="POST">
			{{method_field('DELETE')}}
			{{csrf_field()}}
			<input type="submit" name="submit">
		</form>
		<form action="{{route('addlesson')}}" method="POST">
				<input type="text" name="title">
				<input type="text" name="body">
				{{csrf_field()}}
				<input type="submit" name="submit">
		</form>
</body>
</html>>