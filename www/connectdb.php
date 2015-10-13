<?php
/*** begin our session ***/


	$mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'vconnect';

    /*** mysql password ***/
    $mysql_password = 'vconnect';

    /*** database name ***/
    $mysql_dbname = 'vconnect2015';

    try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $mes = 'we have connected';
		echo $mes;
	}
    catch(Exception $e)
    {
    	$mes='exception during db connect';
	}
?>



