<?php
$json="";
if(isset($_GET['base']) !="" and isset($_GET['amount']) !="" )
{
	$error="Please Fill are Filled";
	$base=$_GET['base'];
	$amount=$_GET['amount'];
	if(empty($base) and empty($amount))
	{
		$json="Please Fill are Filled";

	}
	else
	{
		

		$string = file_get_contents("http://www.google.com/finance/converter?a=$base");
        $json = json_decode($string, true);

	}



}
else
{
	$json="";
}



?>




<!DOCTYPE html>
<html>
<head>
	<title>International Currency Rate</title>
</head>
<body>
	<div>
		<form>
			Select Base Currency:
			<select name="base">
				<option>USD</option>
				<option>EUR</option>
				<option>GBP</option>
				<option>AUS</option>
				<option>JPY</option>
			</select>
	
		<br/>
		Enter Amount:
		<input type="text" name="amount">
		<br/>
		<input type="submit" name="" value="Check">
			</form>
			<br/>
			<?php print_r($json);?>
	</div>


</body>
</html>