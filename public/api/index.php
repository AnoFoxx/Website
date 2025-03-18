<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<script type="text/javascript">
		fetch("http://localhost/Website/api/rest.php?year=2025&month=2&apartman=1&token=3e0c89ad3cb8077143ee8eeeb1359587e1cc2aa2")
			.then(r => r.json())
			.then(data => console.log(data));
	</script>
</body>
</html>
