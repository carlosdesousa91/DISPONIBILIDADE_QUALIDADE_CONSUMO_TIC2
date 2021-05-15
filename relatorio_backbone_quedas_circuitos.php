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
	//echo("<br/><br/>Token de acesso:<br/><br/>");
	//echo($access_token_decoded);
	$embedded_token = embeddedToken($access_token_decoded);
	//echo("<br/><br/>Token de embedded:<br/><br/>");
	//echo($embedded_token);

?>

<div id="reportContainer" >
</div>

<script>

// Get models. models contains enums that can be used.
var models = window['powerbi-client'].models;

var embedConfiguration = {
	type: 'report',
	id: '0837ef15-c683-4ccf-ab33-9e2e8a363b6a',
	//embedUrl: 'https://app.powerbi.com/reportEmbed',
	embedUrl: 'https://app.powerbi.com/reportEmbed?reportId=0837ef15-c683-4ccf-ab33-9e2e8a363b6a&groupId=63df1a7f-98af-4f6d-9639-a1f3d011e5e2',
	tokenType: models.TokenType.Embed,
	accessToken: "<?php echo $embedded_token; ?>",
	permissions: models.Permissions.All /*gives maximum permissions*/,
    viewMode: models.ViewMode.Edit,
	settings: {
		filterPaneEnabled: true,
		navContentPaneEnabled: true,
		pageName:true
	}

};

var $reportContainer = $('#reportContainer');
var report = powerbi.embed($reportContainer.get(0), embedConfiguration);
</script>

</body>
</html>