<?php
// Enable better php debugginh
ini_set('display_errors', 'On');
//error_reporting(E_ALL | E_STRICT);
error_reporting(E_ALL);

// Credit
$author_name = 'AlphaMusk';
$author_version = 'v1.1';
$author_email = 'alphamusk@networkpulse.com';
$author_project = 'AWS Metadata PHP Page';

// Dont use dashes - in declaring variables, break them, no idea.
// Be sure to end all http URLs with /, or some wont render data.
// We build array and the order below is how it builds the table
$curl_cmd = 'curl --connect-timeout 1';
$meta_host = '169.254.169.254';
$meta_data['ami-id'] = $ami_id = exec($curl_cmd." http://".$meta_host."/latest/meta-data/ami-id/");
$meta_data['instance-id'] = $instance_id = exec($curl_cmd." http://".$meta_host."/latest/meta-data/instance-id/");
$meta_data['placement/availability-zone'] = $reg_az = exec($curl_cmd." http://".$meta_host."/latest/meta-data/placement/availability-zone/");
$meta_data['public-hostname'] = $public_hostname = exec($curl_cmd." http://".$meta_host."/latest/meta-data/public-hostname/");
$meta_data['public-ipv4'] = $public_ipv4 = exec($curl_cmd." http://".$meta_host."/latest/meta-data/public-ipv4/");
$meta_data['local-hostname'] = $local_hostname = exec($curl_cmd." http://".$meta_host."/latest/meta-data/local-hostname/");
$meta_data['local-ipv4'] = $local_ipv4 = exec($curl_cmd." http://".$meta_host."/latest/meta-data/local-ipv4/");
$S3_url = "https://s3-us-west-1.amazonaws.com/networkpulse/com/public/images";
$S3_image = "$S3_url.aws.png";
$server_name = $_SERVER['SERVER_NAME'];
$server_ip = $_SERVER['SERVER_ADDR'];
$server_software = $_SERVER['SERVER_SOFTWARE'];
$client_ip = $_SERVER['REMOTE_ADDR'];
$client_agent = $_SERVER['HTTP_USER_AGENT'];
$page_title =  'AWS Cloud - ' . $server_name;
$php_self = $_SERVER['SCRIPT_NAME'];

// Check for page refresh, defaults to 5 mins
if (empty($_GET['refresh'])) {
	 $page_refresh = 3600;
	} else {
	 $page_refresh = $_GET['refresh'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<title><?php echo $author_project.' '.$author_version; ?></title>
	<meta http-equiv="Content-Language" content="en-us" />
	
	<meta http-equiv="imagetoolbar" content="no" />
	<meta name="MSSmartTagsPreventParsing" content="true" />
	
	<meta name="description" content="Description" />
	<meta name="keywords" content="Keywords" />
	
	<meta name="author" content="<?php echo $author_name; ?>" />
	
	<style type="text/css" media="all">@import "css/master.css";</style>
</head>

<body class="about">

<div id="page-container">

	<div id="main-nav">
		<ul>
			<li id="about"><a href="#">About</a></li>
			<li id="services"><a href="#">Services</a></li>
			<li id="portfolio"><a href="#">Portfolio</a></li>
			<li id="contact"><a href="#">Contact Us</a></li>
		</ul>
	</div>
	
	<div id="header">
		<h1><img src="<?php echo $S3_image; ?>" width="236" height="36" alt="<?php echo $author_project; ?>" border="0" /></h1>
	</div>
	
	<div id="sidebar-a">
		<h2>Region</h2>
			<p>US-x-x</p>
		<h3>Availability Zone</h3>
			<p>us-xxx-x-abc
	</div> <!-- End sidebar-a -->
	
	<div id="content">
		<div class="padding">
			<h2>About</h2>
			  <?php
			    //metadata table
			    echo '<table border="1" bgcolor="#ffffff" cellpadding="10" cellspacing="0">';
			    echo '<tr><th bgcolor="#cccccc" align="left">Metadata</th><th bgcolor="#cccccc" align="left">Value</th></tr>';
			    foreach($meta_data as $x=>$x_value) {
			       echo '<tr>';
			    	echo '<td><span class="key">'. $x . '</span></td>';
			            echo '<td><span class="value">'. $x_value . '</span></td>';
			       echo '</tr>';
			    }
			    echo '</table>';
		    ?>
		</div>
	</div> <!-- End Content -->
	
	<div id="footer">

		<div id="altnav">
			<a href="#">About</a> | 
			<a href="#">Services</a> | 
			<a href="#">Portfolio</a> | 
			<a href="#">Contact Us</a> | 
			<a href="#">Terms of Trade</a>
		</div>
		<div id="copyleft">Copyright &copy; <?php echo $author_project.' '.$author_version;?><br />
		Powered by <a href="http://www.php.net/">PHP5</a> and <a href="<?php echo $author_email; ?>"><?php echo $author_name.' Development''; ?></a>
		</div>
	</div> <!-- End Footer -->

</div> <!-- End Page Container -->

</body>
</html>