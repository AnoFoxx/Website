<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<script type="text/javascript">
		fetch("http://localhost/naptar/api/rest.php?year=2025&month=2&apartman=1")
			.then(r => r.json())
			.then(data => console.log(data));
	</script>
</body>
</html>