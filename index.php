<!DOCTYPE HTML>
<html>
	<head>
		<title>Krycí jména</title>
		<link rel="stylesheet" href="main.css">
	</head>
	<body>
		<table id="content"></table>
		<script src="jquery.min.js"></script>
		<script src="main.js"></script>
		<script>
			setInterval(function () {
				$.get("content.php", function (data) {
					$("#content").html(data);
				});
			}, 1000);
		</script>
	</body>
</html>