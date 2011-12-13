<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : FronzenAge
Description: A two-column, fixed-width template suitable for business sites and blogs.
Version    : 1.0
Released   : 20071108

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<SCRIPT LANGUAGE="JavaScript">	
		
	<!-- This script and many more are available free online at -->
	<!-- The JavaScript Source!! http://javascript.internet.com -->
	
	<!-- Begin
	// Set up the image files to be used.
	var theImages = new Array() // do not change this
	// To add more image files, continue with the
	// pattern below, adding to the array.
	
	theImages[0] = 'images/header1.jpg'
	theImages[1] = 'images/header2.jpg'
	theImages[2] = 'images/header3.jpg'
	theImages[3] = 'images/header4.jpg'
	theImages[4] = 'images/header5.jpg'
	theImages[5] = 'images/header6.jpg'
	theImages[6] = 'images/header7.jpg'
	theImages[7] = 'images/header8.jpg'
	
	// do not edit anything below this line
	
	var j = 0
	var p = theImages.length;
	var preBuffer = new Array()
	for (i = 0; i < p; i++){
	   preBuffer[i] = new Image()
	   preBuffer[i].src = theImages[i]
	}
	var whichImage = Math.round(Math.random()*(p-1));
	function showImage(){
	document.write('<img src="'+theImages[whichImage]+'" alt="" width="960" height="147" />');
	}
	
	//  End -->
	</script>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>gpa:: grupo de procesamiento de audio</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE]>
<style type="text/css">
#sidebar #calendar {
	background-position: 0px 20px;
}
</style>
<![endif]-->
</head>
<body>
<div id="logo">
<!--
	<h1><a href="index.html">gpa:: grupo de procesamiento de audio</a></h1>
-->
	<!-- <h2>última actualización: <script type="text/javascript">document.write(new Date(document.lastModified).toLocaleString())</script></h2> -->
<!--	
	<h2> (logo udelar) </h2>
-->
	<table cellspacing="0" cellpadding="2" width="870" border="0" align="center"> <tbody> 
		<tr>
		<td align="left" valign="middle" width="354"> <a href="index.html" target="blank"><img src="images/gpa.png" alt="Grupo de Procesamiento de Audio" width="354"/></a></td>
		<td align="right" valign="right" width="226"> <a href="http://www.universidad.edu.uy" target="blank"><img src="images/udelar_gray.png" alt="Universidad de la República" width="226"/></a></td>
		</tr>
	</tbody></table>

</div>
<div id="menu">
	<ul>
		<li class="first"><a href="index.html" accesskey="1" title="">Inicio</a></li>
		<li><a href="integrantes.html" accesskey="2" title="">Integrantes</a></li>
		<li><a href="investigacion.html" accesskey="3" title="">Investigación</a></li>
		<li><a href="publicaciones.php" accesskey="3" title="">Publicaciones</a></li>
		<li><a href="actividades.html" accesskey="6" title="">Actividades</a></li>
		<li><a href="blog.html" accesskey="4" title="">Blog</a></li>
	</ul>
	<div id="search">

	<!--
		<form method="get" action="http://www.google.com/search">
			<fieldset>
			<input id="s" type="text" name="s" value="" />
			<input id="x" type="image" name="imageField" src="images/img10.jpg" />
			</fieldset> 
		-->
			<div id="cse" style="width: 100%;">Loading</div>
			<script src="http://www.google.com/jsapi" type="text/javascript"></script>
			<script type="text/javascript"> 
			  google.load('search', '1', {language : 'es', style : google.loader.themes.MINIMALIST});
			  google.setOnLoadCallback(function() {
			    var customSearchControl = new google.search.CustomSearchControl(
			      '004219259474104110725:pdip9-miuoq');

			    customSearchControl.setResultSetSize(google.search.Search.SMALL_RESULTSET);
			    customSearchControl.draw('cse');
			  }, true);
			</script>
			 <style type="text/css">
			  .gsc-control-cse {
			    font-family: Arial, sans-serif;
			    border-color: #FFFFFF;
			    background-color: #FFFFFF;
			  }
			  input.gsc-input {
			    border-color: #777777;
			  }
			  input.gsc-search-button {
			    border-color: #333333;
			    background-color: #333333;
			  }
			  .gsc-tabHeader.gsc-tabhInactive {
			    border-color: #777777;
			    background-color: #777777;
			  }
			  .gsc-tabHeader.gsc-tabhActive {
			    border-color: #333333;
			    background-color: #333333;
			  }
			  .gsc-tabsArea {
			    border-color: #333333;
			  }
			  .gsc-webResult.gsc-result,
			  .gsc-results .gsc-imageResult {
			    border-color: #FFFFFF;
			    background-color: #FFFFFF;
			  }
			  .gsc-webResult.gsc-result:hover,
			  .gsc-imageResult:hover {
			    border-color: #000000;
			    background-color: #FFFFFF;
			  }
			  .gs-webResult.gs-result a.gs-title:link,
			  .gs-webResult.gs-result a.gs-title:link b,
			  .gs-imageResult a.gs-title:link,
			  .gs-imageResult a.gs-title:link b {
			    color: #444444;
			  }
			  .gs-webResult.gs-result a.gs-title:visited,
			  .gs-webResult.gs-result a.gs-title:visited b,
			  .gs-imageResult a.gs-title:visited,
			  .gs-imageResult a.gs-title:visited b {
			    color: #444444;
			  }
			  .gs-webResult.gs-result a.gs-title:hover,
			  .gs-webResult.gs-result a.gs-title:hover b,
			  .gs-imageResult a.gs-title:hover,
			  .gs-imageResult a.gs-title:hover b {
			    color: #444444;
			  }
			  .gs-webResult.gs-result a.gs-title:active,
			  .gs-webResult.gs-result a.gs-title:active b,
			  .gs-imageResult a.gs-title:active,
			  .gs-imageResult a.gs-title:active b {
			    color: #777777;
			  }
			  .gsc-cursor-page {
			    color: #444444;
			  }
			  a.gsc-trailing-more-results:link {
			    color: #444444;
			  }
			  .gs-webResult .gs-snippet,
			  .gs-imageResult .gs-snippet,
			  .gs-fileFormatType {
			    color: #333333;
			  }
			  .gs-webResult div.gs-visibleUrl,
			  .gs-imageResult div.gs-visibleUrl {
			    color: #000000;
			  }
			  .gs-webResult div.gs-visibleUrl-short {
			    color: #000000;
			  }
			  .gs-webResult div.gs-visibleUrl-short {
			    display: none;
			  }
			  .gs-webResult div.gs-visibleUrl-long {
			    display: block;
			  }
			  .gsc-cursor-box {
			    border-color: #FFFFFF;
			  }
			  .gsc-results .gsc-cursor-box .gsc-cursor-page {
			    border-color: #777777;
			    background-color: #FFFFFF;
			    color: #444444;
			  }
			  .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
			    border-color: #333333;
			    background-color: #333333;
			    color: #444444;
			  }
			  .gs-promotion {
			    border-color: #CCCCCC;
			    background-color: #E6E6E6;
			  }
			  .gs-promotion a.gs-title:link,
			  .gs-promotion a.gs-title:link *,
			  .gs-promotion .gs-snippet a:link {
			    color: #000044;
			  }
			  .gs-promotion a.gs-title:visited,
			  .gs-promotion a.gs-title:visited *,
			  .gs-promotion .gs-snippet a:visited {
			    color: #000044;
			  }
			  .gs-promotion a.gs-title:hover,
			  .gs-promotion a.gs-title:hover *,
			  .gs-promotion .gs-snippet a:hover {
			    color: #444444;
			  }
			  .gs-promotion a.gs-title:active,
			  .gs-promotion a.gs-title:active *,
			  .gs-promotion .gs-snippet a:active {
			    color: #004400;
			  }
			  .gs-promotion .gs-snippet,
			  .gs-promotion .gs-title .gs-promotion-title-right,
			  .gs-promotion .gs-title .gs-promotion-title-right *  {
			    color: #333333;
			  }
			  .gs-promotion .gs-visibleUrl,
			  .gs-promotion .gs-visibleUrl-short {
			    color: #004400;
			  }
			</style>
		<!-- </form> -->
	</div>
</div>
<hr />
<div id="banner"><script languaje="JavaScript">showImage();</script></div>
<!-- start page -->
<div id="page">
	<!-- start content -->
	<div id="content">
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
require( $_SERVER['DOCUMENT_ROOT'] . "/publicaciones/utils.php");
// require( $_SERVER['DOCUMENT_ROOT'] . "/publicaciones/publiUtils.php");
require("publiUtils_es.php");
sqlConnect();
//unset($title); // interfers with form parameters
$result = bibQueryResults($option);
displayResults($result, $option);

?>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<center>
				<table cellspacing="0" cellpadding="2" width="200" border="0" align="center"> <tbody> 
				<tr>
		<!--
				<td valign="middle" width="70"> <a href="http://iie.fing.edu.uy" target="blank"><img src="images/iie.png" alt="Instituto de Ingeniería Eléctrica" width="70"/></a></td>
		-->
				<td valign="middle" width="80"> <a href="http://www.fing.edu.uy" target="blank"><img src="images/fing.png" alt="Facultad de Ingeniería" width="80"/></a></td>
				<td valign="middle" width="80"> <a href="http://www.eumus.edu.uy/" target="blank"><img src="images/eum.png" alt="Escuela Universitaria de Música" width="80"/></a></td>
		<!--
				<td valign="middle" width="46"> <a href="http://www.universidad.edu.uy/" target="blank"><img src="images/udelar.png" alt="Universidad de la República" width="46"/></a></td>
		-->
				</tr>
				</tbody></table>
				</center>
			</li>		
			<li>
				<h2>Enlaces</h2>
				<ul>
					<li><a href="actividades.html#seminario">Seminario de audio</a></li>
					<li><a href="http://aeslac2011.fing.edu.uy/" target="blank">Congreso AES LAC 2011</a></li>
					<!-- <li><a href="http://www.eumus.edu.uy/eme/" target="blank">Estudio de música electroacústica</a></li> -->
					<li><a href="investigacion.html#software">Software</a></li>
					<li><a href="http://iie.fing.edu.uy/twiki/bin/viewauth.cgi/Audio/WebHome" target="blank">Wiki</a></li>
					<!-- <li><a href="#">Enlace #5</a></li>
					<li><a href="#">Enlace #6</a></li>
					<li><a href="#">Enlace #7</a></li>
					<li><a href="#">Enlace #8</a></li> -->
				</ul>
			</li>

			<li>
				<h2><a href="blog.html">Noticias</a></h2>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
</div>
<!-- end page -->
<div id="footer">
	<p class="legal">Copyright (c) 2011 Audio Processing Group (FING|EUM). All rights reserved.</p>
	<p class="credit">Designed by <a href="http://www.nodethirtythree.com/">NodeThirtyThree</a> + <a href="http://www.freecsstemplates.org/">Free CSS Templates</a></p><br>
	<p class="credit">Free JavaScripts provided by <a href="http://javascriptsource.com">The JavaScript Source</a></p>
</div>
</body>
</html>
