<?
include("../config.php");
if($site->maintenance == 0){
echo "<script>document.location.href='../index.php'</script>";
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><title>Under Construction</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

        <!-- Load styles -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />
        <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="css/style.ie.css" />
        <![endif]-->
        
		<script type="text/javascript" src="scripts/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="scripts/bar.js"></script>
		<script type="text/javascript" src="scripts/countdown.js"></script>
        <script type="text/javascript" src="scripts/twitter.js"></script>
		<script type="text/javascript" src="scripts/jquery.toggleval.js"></script>
        <script type="text/javascript" src="scripts/jquery.form.js"></script>
        <script type="text/javascript" src="scripts/jquery.textshadow.js"></script>
        <script type="text/javascript" src="scripts/custom.js.php"></script>
		<script type="text/javascript">
		// <![CDATA[
			jQuery(document).ready(function(){
			 jQuery("h1, h2, .progress").textShadow();
			})
		 // ]]>
		</script>
	</head>
	<body>
    <div class="layer">		
        <div id="main">
        
        	<!--[if lte IE 6]>
				<h1>You use Internet Explorer 6 or older, please update your browser!</h1>
			<![endif]-->
            <div class="company_name"><a href="index.php" title="">Under Maintenance</div>

			<!--[if lte IE 8]>
            	<div class="light_top"></div>
            <![endif]-->

			<div class="main_box">

				<h1>LikesASAP is under maintenance!</h1>
				
				<div class="blackbox">
                	<div class="in">

    					<div id="bar">
                        	<div class="progress"><span class="progressBar" id="pb1"><? echo $site->m_progress;?></span></div>

                            <p>Both (LikesASAP.com) (LikesASAP.net) will be back within 3 minutes only.</p>
                          
						</div>

                		<div class="notify_but">
						</div>

                	</div>
				</div>
			</div>
		</div>
	</div>
    <script type="text/javascript" src="scripts/init_form.js"></script>
	</body>
</html>