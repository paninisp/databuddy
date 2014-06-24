<?php require_once 'basemodule/log.php'; ?>
<html>
<head>
	<title>CERP Databuddies Uploader</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<script type="text/javascript" src="javascript/cookieTester.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="http://cra.org/cerp/wp-content/themes/twentyten/style.css" />
<link rel="pingback" href="http://cra.org/cerp/xmlrpc.php" />
<link rel="alternate" type="application/rss+xml" title="CERP: The CRA Center for Evaluating  the Research Pipeline &raquo; Feed" href="http://cra.org/cerp/feed" />
<link rel="alternate" type="application/rss+xml" title="CERP: The CRA Center for Evaluating  the Research Pipeline &raquo; Comments Feed" href="http://cra.org/cerp/comments/feed" />
<link rel='stylesheet' id='meteor-slides-css'  href='http://cra.org/cerp/wp-content/plugins/meteor-slides/css/meteor-slides.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='cpsh-shortcodes-css'  href='http://cra.org/cerp/wp-content/plugins/column-shortcodes/assets/css/shortcodes.css?ver=0.6.4' type='text/css' media='all' />
<link rel="stylesheet" type="text/css" href="style.css"/>
<script type='text/javascript' src='http://cra.org/cerp/wp-includes/js/jquery/jquery.js?ver=1.11.0'></script>
<script type='text/javascript' src='http://cra.org/cerp/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<script type='text/javascript' src='http://cra.org/cerp/wp-content/plugins/meteor-slides/js/jquery.cycle.all.js?ver=3.9.1'></script>
<script type='text/javascript' src='http://cra.org/cerp/wp-content/plugins/meteor-slides/js/jquery.metadata.v2.js?ver=3.9.1'></script>
<script type='text/javascript' src='http://cra.org/cerp/wp-content/plugins/meteor-slides/js/jquery.touchwipe.1.1.1.js?ver=3.9.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var meteorslidessettings = {"meteorslideshowspeed":"2000","meteorslideshowduration":"5000","meteorslideshowheight":"198","meteorslideshowwidth":"940","meteorslideshowtransition":"fade"};
/* ]]> */
</script>
<script type='text/javascript' src='http://cra.org/cerp/wp-content/plugins/meteor-slides/js/slideshow.js?ver=3.9.1'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://cra.org/cerp/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://cra.org/cerp/wp-includes/wlwmanifest.xml" /> 
<link rel='prev' title='Our Services' href='http://cra.org/cerp/our-services' />
<link rel='next' title='Data Visualization' href='http://cra.org/cerp/data-visualization' />
<meta name="generator" content="WordPress 3.9.1" />
<link rel='canonical' href='http://cra.org/cerp/data-buddies' />
<link rel='shortlink' href='http://cra.org/cerp/?p=582' />
<script src="http://cra.org/cerp/wp-content/plugins/faq-you/js/faq-frontend.js" type="text/javascript"></script><style type="text/css" id="custom-background-css">
body.custom-background { background-color: #000000; }
</style>
	
	<script type="text/javascript">
		
		
		$(function() {
			$('tr.parent')
				.css("cursor","pointer")
				.attr("title","Click to expand/collapse")
				.click(function(){
					$(this).siblings('.child-of-'+this.id).each(function(){
						$(this).toggle();
						$(this).siblings('.child-of-'+this.id).each(function(){
							$(this).hide();
							$(this).siblings('.child-of-'+this.id).each(function(){
								$(this).hide();
								
							});
						});
					});
				});
		});
		
		
		
		
		
		
		
		
	</script>
	
</head>

<body id="body">
	
	
	
<div style="width:940px; margin:10px auto; height:100px">

								<div id="site-title">
					<span>
						<a href="http://cra.org/cerp/" title="CERP: The CRA Center for Evaluating  the Research Pipeline" rel="home"><img src="http://cra.org/cerp/wp-content/uploads/2013/07/cerp-banner.png" height="100"></a>
					</span>
				</div>
				<div id="site-description">
					
					<form method="get" id="searchform" action="http://cra.org/cerp/">
<div><input type="text" size="18" value="" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Search" class="btn" />
</div>
</form>
					
				</div>
</div>

<div id="wrapper" class="hfeed">
	<?php include "basemodule/topmenu.php" ?>
	<div id="main">

		<div id="container" class="one-column">
			<div id="content" role="main">

			<div id="container">
<div id="form">

<?php



$deleterecords = "TRUNCATE TABLE csvTestPanini"; //empty the table of its current records
mysql_query($deleterecords);

//Upload File
if (isset($_POST['submit'])) {
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$import="INSERT into csvTestPanini(Name,Phone,IdNumber,College,Place) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]')";

		mysql_query($import) or die(mysql_error());
	}

	fclose($handle);

	print "Import done";

	//view upload form
}else {

	print "Upload new csv by browsing to file and clicking on Upload<br />\n";

	print "<form enctype='multipart/form-data' action='contactimport.php' method='post'>";

	print "File name to import:<br />\n";

	print "<input size='50' type='file' name='filename'><br />\n";

	print "<input type='submit' name='submit' value='Upload'></form>";

}

?>

</div>
</div>

				

				
			

			</div><!-- #content -->
		</div><!-- #container -->

	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">



			<div id="footer-widget-area" role="complementary">

				<div id="first" class="widget-area">
					<ul class="xoxo">
						<li id="text-3" class="widget-container widget_text">			<div class="textwidget"><p align="center"><a href="http://www.nsf.gov"><img  title="nsflogo" src="http://cra.org/cerp/wp-content/uploads/2011/11/nsflogo.png" alt="nsflogo" width="" height="45" /></a><br />National Science Foundation</p></div>
		</li>					</ul>
				</div><!-- #first .widget-area -->

				<div id="second" class="widget-area">
					<ul class="xoxo">
						<li id="text-4" class="widget-container widget_text">			<div class="textwidget"><p align="center"><a href="http://www.cra.org"><img  title="cra-logo" src="http://cra.org/cerp/wp-content/uploads/2011/11/cra-logo.png" alt="cra-logo" width="" height="45" /></a><br />Computing Research Association</p></div>
		</li>					</ul>
				</div><!-- #second .widget-area -->

				<div id="third" class="widget-area">
					<ul class="xoxo">
						<li id="text-5" class="widget-container widget_text">			<div class="textwidget"><p align="center"><a href="http://www.cdc-computing.org"><img  title="crawcdc-logo" src="http://cra.org/cerp/wp-content/uploads/2013/07/logo-small-2-e1373860979397.png" alt="crawcdc-logo" width="" height="45" /></a><br />Coalition to Diversify Computing</p></div>
		</li>					</ul>
				</div><!-- #third .widget-area -->

				<div id="fourth" class="widget-area">
					<ul class="xoxo">
						<li id="text-6" class="widget-container widget_text">			<div class="textwidget">

<p align="center"><a href="http://www.cra-w.org"><img  title="CRAW" src="http://cra.org/cerp/wp-content/uploads/2013/07/CRA-W-logo-e1373861308361.gif" alt="crawcdc-logo" width="" height="45" /></a><br />Women in Computing Research</p></div>
		</li>					</ul>
				</div><!-- #fourth .widget-area -->

			</div><!-- #footer-widget-area -->

			<!-- <div id="site-info">
				<a href="http://www.cra.org" title="CRA Website" target="_blank">CRA</a> &middot; <a href="http://www.cra-w.org" title="CRA-W Website" target="_blank">CRA-W</a> &middot; <a href="http://www.cdc-computing.org" title="CDC Website" target="_blank">CDC</a>
			</div> #site-info -->

			<!-- <div id="site-generator">
				A CRA-W and CDC Initiative.
			</div> #site-generator -->

		</div><!-- #colophon -->
	</div><!-- #footer -->
</div><!-- #wrapper -->

        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-126533-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>	
	
</body>

</html>
