<h2>Request Data</h2>

<?php print_r($requestData); ?>


	@if($responseData["CmdStatus"] <> "" && $responseData["CmdStatus"] == "Approved")
		<font color="green">
			<h2>Approved Response Data</h2>
			<?php print_r($responseData); ?>
		</font>
	@else
		<font color="red">
			<h2>Declined/Error Response Data</h2>
			<?php print_r($responseData); ?>
		</font>
	@endif