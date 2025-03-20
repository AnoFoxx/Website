<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<script type="text/javascript">
		fetch("http://localhost/public/api/rest.php?year=2025&month=2")
			.then(r => r.json())
			.then(data => console.log(data));
	</script>
</body>
</html>
