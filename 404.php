<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">

<link rel="stylesheet" href="/tmpl/theme_basic/css/main.css">
<link rel="stylesheet" href="/tmpl/theme_basic/css/sub.css">
<link rel="stylesheet" href="/tmpl/theme_basic/css/font-awesome.css">

<?php
$mobile = !!(FALSE !== strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile'));
?>

<?php if ($mobile) {
$action_url = "/bbs/search.php?page=1&card_page=1";
}else{

$action_url = "/bbs/search_ktc.php?page=1&card_page=1";
}?>





<title>Error 404 Not Found</title>
</head>
<body>

<div class="error_wrap">
	<div class="error_container">
		<div class="error_head">
			<h1><a href="index.php"><img src="/img/main/logo_us.png" alt="logo"></a></h1>
			<p><a href="index.php">Hompage</a></p>
		</div>

		<div class="error_txt">
			<h3>Sorry, but the page you were trying to view does not exist.</h3>
			<p class="er_txt1">The address of the page you want to visit is entered incorrectly. Unable to find the requested page because it has been changed or deleted.</p>
			<p class="er_txt2">Please confirm that the address of the page entered is correct again.</p>
		</div>

		<div class="error_form">
			<form action="<?=$action_url;?>">
				<input type="hidden" name="page" value=1 >
				<input type="hidden" name="card_page" value=1 >
				<fieldset>
					<ul>
						<li class="input">
							<label for="" class="hide">검색창</label>
							<input type="text" class="" name="word" id="" placeholder="Enter ketwords" value=''>
						</li>
						<li class="btn">
							<input type="submit" value="Search" class="" id="" title="Search" />
						</li>
					</ul>
				</fieldset>
			</form>
		</div>
	</div>
</div>


</body>
</html>
