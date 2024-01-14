<?php
try {
	// include the file for the database connection
	require_once('functions.php');
	// get database connection
	$dbConn = getConnection();

	// echo what getJSONOffer returns
	echo getJSONOffer($dbConn);
} catch (Exception $e) {
	echo "Error " . $e->getMessage();
}

function getJSONOffer($dbConn)
{
	header("Content-Type: application/json; charset=UTF-8");

	try {
		$sql = "select eventID, eventTitle, catDesc, eventPrice FROM EGN_special_offers INNER JOIN EGN_categories ON EGN_special_offers.catID = EGN_categories.catID ORDER BY rand() limit 1";
		$rsOffer = $dbConn->query($sql);
		if (is_array($rsOffer) && count($rsOffer) > 0) {
			foreach ($rsOffer as $Offers) {
			return json_encode($Offers);
			}
		}
	} catch (Exception $e) {
		throw new Exception("problem: " . $e->getMessage());
	}
}
