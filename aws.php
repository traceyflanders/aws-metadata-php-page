
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
$meta_host = '169.254.169.254';
$meta_data['ami-id'] = $ami_id = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/ami-id/");
$meta_data['instance-id'] = $instance_id = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/instance-id/");
$meta_data['placement/availability-zone'] = $reg_az = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/placement/availability-zone/");
$meta_data['public-hostname'] = $public_hostname = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/public-hostname/");
$meta_data['public-ipv4'] = $public_ipv4 = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/public-ipv4/");
$meta_data['local-hostname'] = $local_hostname = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/local-hostname/");
$meta_data['local-ipv4'] = $local_ipv4 = exec("curl --connect-timeout 1 http://".$meta_host."/latest/meta-data/local-ipv4/");
$S3_images = "https://s3-us-west-1.amazonaws.com/networkpulse/com/public/images/aws.png";
$server_name = $_SERVER['SERVER_NAME'];
$server_ip = $_SERVER['SERVER_ADDR'];
$server_software = $_SERVER['SERVER_SOFTWARE'];
$client_ip = $_SERVER['REMOTE_ADDR'];
$client_agent = $_SERVER['HTTP_USER_AGENT'];
$page_title =  'AWS Cloud - ' . $server_name;
$php_self = $_SERVER['SCRIPT_NAME'];

// Check for page refresh
if (empty($_GET['refresh'])) {
	 $page_refresh = 120;
	} else {
	 $page_refresh = $_GET['refresh'];
}
?>

<html>
 <head>
  <title><?php echo $page_title; ?></title>
  <meta http-equiv="refresh" content="<?php echo $page_refresh; ?>" />
  <style>
    p {color: black; font-family: arial; font-size: 14px;}
    th {color: black; font-family: arial; font-weight: bold; font-size: 15px;}
   .key {color: black; font-family: verdana; font-size: 13px;}
   .value {color: black; font-family: verdana; font-size: 13px;}
   .key2 {color: black; font-family: verdana; font-size: 13px;}
   .value2 {color: black; font-family: verdana; font-size: 13px;}
   .footertxt {color: gray; font-family: arial; font-size: 13px;}
   body {background-color: white;}

  </style>
 </head>
<body>
<!--  Main Table -->
<table border="1" align="center" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" width="800px">
  <tr>
    <td>
    <!-- // Top table -->
    <table border="0" bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" width="100%">
      <tr>
       <td width="10%" >
        <img src="<?php echo $S3_images; ?>" alt="aws cloud" height="100" width="100">
       </td>
       <td width="45%" align="center">
        <p>
         <?php echo $server_software; ?>
        </p>
       </td>
       <td width="45%">
       </td>
      </tr>

    <!-- // Nav table -->
    <table border="0" bgcolor="#ffffff" cellpadding="5" cellspacing="0" width="100%">
      <tr>
       <td><p>Page Refresh:
    	<a href="<?php echo $php_self.'?refresh=2'; ?>">2s</a> |
    	<a href="<?php echo $php_self.'?refresh=5'; ?>">5s</a> |
            <a href="<?php echo $php_self.'?refresh=10'; ?>">10s</a> |
            <a href="<?php echo $php_self.'?refresh=30'; ?>">30s</a> |
            <a href="<?php echo $php_self.'?refresh=60'; ?>">60s</a>
       </p></td>
      </tr>
    </table>

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

    <!-- //client info-->
    <br>
    <table border="1" bgcolor="#ffffff" cellpadding="10" cellspacing="0">
    <tr><th bgcolor="#cccccc" align="left">Client Info</th><th bgcolor="#cccccc" align="left">Value</th></tr>
     <tr>
       <td><span class="key2"><?php echo 'ClientIP'; ?></span></td>
       <td><span class="value2"><?php echo $client_ip; ?></span></td>
     </tr>
     <tr>
       <td><span class="key2"><?php echo 'ClientAgent'; ?></span></td>
       <td><span class="value2"><?php echo $client_agent; ?></span></td>
     </tr>
    </table>

    <!-- //page info-->
    <br>
    <table border="0" bgcolor="#ffffff" cellpadding="20" cellspacing="0">
     <tr>
       <td><span class="footertxt"><?php echo 'Open Source Software: ' .$author_project. ' ' .$author_version. '  |  Author: ' . $author_name . '  |  <a href="mailto:' . $author_email . '?subject=' . $author_project . ' '  . $author_version . '"'; ?>>Contact</a></span></td>
     </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
