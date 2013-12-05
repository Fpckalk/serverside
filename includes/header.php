<?
	session_start();
	ob_start();
	include_once("settings.php");
	include_once("functions.php");
?>
<!DOCTYPE html>
<html lang="<?= $language ?>">
<!--<?= $copyright ?>-->

	<head>

		<title><?= $title ?></title>   
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="author" content="<?= $author . $copyright ?>" />
		<meta name="description" content="<?= $desc ?>" />
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
		<link type="text/css" rel="stylesheet" media="screen" href="css/css.css" />
		<link type="image/ico" rel="icon" href="favicon.ico" />
		<script src="js/jquery-1.7.2.min.js"></script>
		<script src="js/js.js"></script>

	</head>

	<body>
		<div id="wrapper">