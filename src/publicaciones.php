<h1 class="title">Publicaciones</h1>

<!--
<iframe src="./publications.php" width="603px" height="1000px" style="border:0;font-size:12px;color:#6E6E6E;"></iframe>
-->

<?php

// cambiar el apellido del autor a buscar.
$option["author"]  = "Rocamora";

// No tocar, a menos que sepa lo que hace.
$option["display"] = "list";
$option["pg"] = "-1";
$option["year"] = "-1";
$option["lg"] = "fr";
require( $_SERVER['DOCUMENT_ROOT'] . "/publicaciones/utils.php");
// require( $_SERVER['DOCUMENT_ROOT'] . "/publicaciones/publiUtils.php");
require("publiUtils.php");
sqlConnect();
//unset($title); // interfers with form parameters
$result = bibQueryResults($option);
displayResults($result, $option);

?>
