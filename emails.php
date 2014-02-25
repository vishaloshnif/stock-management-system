<?php
$q = strtolower($_GET["q"]);
if (!$q) return;
$items = array(
	"Wasim"=>"wasim@abc.com"
);

$result = array();
foreach ($items as $key=>$value) {
	if (strpos(strtolower($key), $q) !== false) {
		array_push($result, array(
			"name" => $key,
			"to" => $value
		));
	}
}
echo json_encode($result);
?>