<!DOCTYPE HTML> 

<!-- Important, keep doctype: -->


<!-- Function to proxy and set the necessary head, header and footer includes: -->

<!-- Remember to change the cc + lc values on the includes for correct country and language: -->


	<?php

	function includeURL($url)
	{

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); // URL to fetch
	curl_setopt($ch, CURLOPT_PROXY, 'seldprx06.corpextra.net:8080'); // Proxy to use
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the content, not just an OK

	$content = curl_exec ($ch);
	curl_close($ch);
	return $content;
	}

	$headURL = "http://www.sonyericsson.com/cws/includes/v2/head?cc=se&lc=sv";
	$headerURL = "http://www.sonyericsson.com/cws/includes/v2/header?cc=se&lc=sv";
	$footerURL = "http://www.sonyericsson.com/cws/includes/v2/footer?cc=se&lc=sv";

	?>



	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
<!-- swf tag -->
        
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject_src.js"></script>

<script type="text/javascript">
	var flashvars = {
			xmlpath 	: "mainStructure.xml",
			swfpath 	: "../",
			sharepath 	: "http://www.sonyericsson.com/clcompetition/facebook/shareSE.html",
			moviepath 	: "http://www.sonyericsson.com/clcompetition/movies/",
			soundpath 	: "../",
			gaaccount 	: "UA-21165699-1",
			gamode 		: "AS3",
			gadebug 	: "false"
	};
		
	var params = { 
			quality 			: "high",
			bgcolor 			: "#ffffff",
			play 				: "true",
			loop 				: "true",
			wmode 				: "window",
			menu 				: "false",
			devicefont 			: "false",
			salign 				: "",
			allowscriptaccess 	: "sameDomain"
	};
	
	var attributes = {  
		id:"siteContent",
		name:"siteContent",
		align :"middle"
	};
	
	swfobject.embedSWF("../ChampionsLeague.swf", "siteContent", "838", "591", "9.0.0", null, flashvars, params, attributes);
	
</script>
	<meta charset=utf-8" />
	<title>Sony Ericsson Football Challenge</title>

	<meta name="description" content="Welcome to Sony Ericsson! You'll find product and support information for our mobile phones and accessories, Fun &amp; downloads and information about our company." />
	<meta name="keywords" content="mobile phones, accessories, Mobile Broadband," />



<!-- Head include contains all necessary css and javascripts: -->

<?php echo includeURL($headURL); ?>

<link href="../css/global.css" rel="stylesheet" type="text/css">


<!-- Remember to change the cc + lc values below for the correct localized plugins: -->

	<link  href="http://www.sonyericsson.com/cws/includes/v2/plugins?absoluteresources=true&amp;cc=gb&amp;lc=en&amp;plugins=facebooklike,locationselector,registration,searchbox,sharethis&amp;type=css" type="text/css" rel="stylesheet"/>
	<script src="http://www.sonyericsson.com/cws/includes/v2/plugins?absoluteresources=true&amp;cc=gb&amp;lc=en&amp;plugins=facebooklike,locationselector,registration,searchbox,sharethis&amp;type=javascript" type="text/javascript"></script>
    


	</head>



	<body class="lime" style: text-align="center" >


<!-- If no body class is specified, colour theme will cycle automatically. Or choose from hard coded colours below: -->

	<!-- <body class="lime"> -->
	<!-- <body class="blue"> -->
	<!-- <body class="cherry"> -->
	<!-- <body class="orange"> -->
	<!-- <body class="purple"> -->
	<!-- <body class="red"> -->
	<!-- <body class="xperiablue"> -->



<!-- Header include: -->

<?php echo includeURL($headerURL); ?>



<!-- Main site content goes here: -->

<div id="siteContainer" align="center"> 
    <div id="siteContent"> 
    </div>
</div>

<!-- Footer include: -->

<? echo includeURL($footerURL); ?>



<script language="javascript" type="text/javascript" src="js/s_code.js <http://www.sonyericsson.com/androidskolan/se/siba/js/s_code.js> ">
</script> <script language="javascript" type="text/javascript"> 
s.pageName= ('championsleague_we_201102:Microsite'); s.server= ('SELDWEBE11'); s.channel= ('championsleague_we_201102'); s.campaign= (''); s.prop1 = (''); s.prop2 = (''); s.prop12 = ('se_sv');
 s.prop13 = ('se'); s.prop14 = (''); s.eVar26 = ('championsleague_we_201102'); /* should always contain same value as s.channel*/ /******** DO NOT ALTER ANYTHING BELOW THIS LINE! ******/
  var s_code= s.t(); if(s_code) document.write(s_code)//--> </script>
	</body>

	</html>
