<?php
	if ($_SERVER['REQUEST_METHOD'] != 'PUT') {
		header("HTTP/1.1 403 Bad request");
		exit;
	}

	function checkTarget($target) {
		return $target == "data.json";
	}

	$target = "data.json"; // $_SERVER["REQUEST_URI"];
	if (!checkTarget($target)) {
		header("HTTP/1.1 404 Not found");
		exit;
	}

	/* PUT data comes in on the stdin stream */
	$putdata = fopen("php://input", "r");

	/* Open a file for writing */
	// $temp = tempnam("data/", "puthandler-");
	$temp = "data/$target";
	$fp = fopen($temp, "w");

	/* Read the data 65 KB at a time and write to the file */
	while ($data = fread($putdata, 65535)) {
		fwrite($fp, $data);	
		echo $data;
	}

	/* Close the streams */
	fclose($fp);
	fclose($putdata);

	/* Create dirs if needed */

	/* Put the file in place */

	// rename($temp, "data/$target");
?>