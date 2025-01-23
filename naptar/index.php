<!DOCTYPE html>
<html>
<head>
	<title>naptar test</title>
	<style>
		iframe {
			width: 370px;
			height: 370px;
		}
	</style>
</head>
<body>
	<iframe src="naptar.php"></iframe>
	<script type="text/javascript">
		sessionStorage.setItem("starterDate", null);
		sessionStorage.setItem("endingDate", null);
		setInterval(()=>{
			console.log(sessionStorage.getItem("starterDate"), sessionStorage.getItem("endingDate"))
		}, 1000);
	</script>
</body>
</html>