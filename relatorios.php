<?php
    include './powerbi.php';
?>

<?php 

	$access_token = getNewUserAccessToken();
	//echo(json_encode($access_token));
	$access_token_decoded = decodeResultToken($access_token);
	//echo("<br/><br/>Token de acesso:<br/><br/>");
	//echo($access_token_decoded);
	$reports = recuperarRelatorios($access_token_decoded);
	//echo("<br/><br/>Token de embedded:<br/><br/>");
	echo($reports);

?>