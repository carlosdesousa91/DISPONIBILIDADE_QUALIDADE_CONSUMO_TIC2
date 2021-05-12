<?php
    include './powerbi.php';
?>
<html>
<head>
<script src="./js/powerbi-client/dist/powerbi.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!--<script src = "https://microsoft.github.io/PowerBI-JavaScript/demo/node_modules/jquery/dist/jquery.js" ></script >
<script src ="https://microsoft.github.io/PowerBI-JavaScript/demo/node_modules/powerbi-client/dist/powerbi.js"> </script >-->
<style>
	#reportContainer iframe{
		border:none;
	}
</style>
</head>
<body>

<?php 

	$access_token = getNewUserAccessToken();
	//echo(json_encode($access_token));
	$access_token_decoded = decodeResultToken($access_token);
	echo($access_token_decoded);
	//$embedded_token = embeddedToken($access_token_decoded);
	//echo($embedded_token);

?>

<div id="reportContainer" >
</div>

<script>

// Get models. models contains enums that can be used.
var models = window['powerbi-client'].models;

var embedConfiguration = {
	type: 'report',
	id: '92293a09-3e75-4fd9-b387-32b29009f331',
	//embedUrl: 'https://app.powerbi.com/reportEmbed',
	embedUrl: 'https://app.powerbi.com/reportEmbed?reportId=92293a09-3e75-4fd9-b387-32b29009f331&groupId=63df1a7f-98af-4f6d-9639-a1f3d011e5e2&w=2&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly9XQUJJLUJSQVpJTC1TT1VUSC1CLVBSSU1BUlktcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQiLCJlbWJlZEZlYXR1cmVzIjp7Im1vZGVybkVtYmVkIjp0cnVlLCJjZXJ0aWZpZWRUZWxlbWV0cnlFbWJlZCI6dHJ1ZX19',
	tokenType: models.TokenType.Embed,
	accessToken: "<?php echo $access_token_decoded; ?>",
	settings: {
		filterPaneEnabled: true,
		navContentPaneEnabled: false,
		pageName:true
	}

};

var $reportContainer = $('#reportContainer');
var report = powerbi.embed($reportContainer.get(0), embedConfiguration);
</script>

</body>
</html>