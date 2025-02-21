<?php include "error_handeler.php" ?>
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
	<iframe src="naptar.php?apartman=1"></iframe>
	<script type="text/javascript">
		sessionStorage.setItem("starterDate", null);
		sessionStorage.setItem("endingDate", null);
		console.log(sessionStorage.getItem("starterDate"), sessionStorage.getItem("endingDate"))
	</script>
</body>
</html>