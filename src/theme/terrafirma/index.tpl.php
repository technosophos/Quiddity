<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	terrafirma1.0 by nodethirtythree design
	http://www.nodethirtythree.com

-->
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Arthritis-Health.com</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="/<?php print $basePath; ?>default.css" />
</head>
<body>

<div id="outer">

	<div id="upbg"></div>

	<div id="inner">

		<div id="header">
			<h1><span>Arthritis</span>-Health<sup>beta</sup></h1>
			<h2>Trusted information about osteoarthritis</h2>
		</div>
	
		<div id="splash"></div>
	
		<div id="menu">
			<ul>
				<li class="first"><a href="#">Home</a></li>
				<li><a href="#">Conditions</a></li>
				<li><a href="#">Treatment</a></li>
				<li><a href="#">Wellness</a></li>
				<li><a href="#">News</a></li>
			</ul>

		<div id="date"><?php print date('M. d, Y')?></div>
		</div>
	

		<div id="primarycontent">
		
			<!-- primary content start -->
		
			<?php print $primaryContent; ?>
		
			<!-- primary content end -->
	
		</div>
		
		<div id="secondarycontent">

			<!-- secondary content start -->
		
			<?php print $secondaryContent; ?>

			<!-- secondary content end -->

		</div>
	
		<div id="footer">
		
			&copy; Veritas Health, LLC. All rights reserved. Design by <a href="http://www.nodethirtythree.com/">NodeThirtyThree</a>.
		
		</div>

	</div>

</div>

</body>
</html>