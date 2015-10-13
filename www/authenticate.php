<?php
/*** begin our session ***/
session_start();
require 'connectdb.php';

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//4 entry points -
  // 1) from facebook login - 
if(isset($_POST['fbusr']) && $_POST['fbusr'] == TRUE )
{
 	//email id will be always set
	email = $_POST['email'];
 	name = $_POST['name'];
 	try
 	{
		$stmt = $dbh->prepare("SELECT usrid from user_table where email = :email ");
 		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
    	$stmt->execute();
    	$usrid = $stmt->fetchColumn();	
 		if(!usrid == FALSE)// case 1: add the facebook user to the table
 		{
	 		$stmt = $dbh->prepare("INSERT INTO user_table(fbusr,name,email) VALUES (:fbusr,:name,:email)");

		 	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	 		$stmt->bindParam(':name', $email, PDO::PARAM_STR);
	   		$stmt->bindParam(':fbusr', $fbusr, PDO::PARAM_BOOL);
	   		 $stmt->execute();
			$message = 'New fb user added';
			echo $message 
 		} 
 		else  //case 2: the facebook user existing in table
 		{
 	  		$_SESSION['usrid'] = $usrid;
    	/*** tell the user we are logged in ***/
     		$message = 'You are now logged in';
			echo $message;
 		}	
	}
	catch(Exception $e)
	{
		// do Exception handling
	}	
}
else if ( !isset($_POST['fbusr']) )
{
// 2) sysadmin login 	OR 3) existing usr login
	if( isset($_POST['usr_password']))
	{
		$email = $_POST['email'];
		$upassword = sha1( $_POST['usr_password'] );
		try
		{
			//sysadmin login
			if( $email == 'sysadmin')
			{
				$stmt = $dbh->prepare("SELECT usr_password from user_table where name = :name ");
				$stmt->bindParam(':name', $email, PDO::PARAM_STR);
			}
			else
			{
				$stmt = $dbh->prepare("SELECT usr_password from user_table where email = :email ");
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			}
			$stmt->execute();
	    	$usr_password = $stmt->fetchColumn();
	    	//assumption: usr_password is sha1 encrypted
			if($upassword != $usr_password)
			{
				$message='invalid password';
				echo $message;	
			}
			else
			{
				$message='successfully logged in';
				// if sysad go to sysd screen
				echo $message;	
			}
		}
	 	catch(Exception $e)
    	{
     	//add exception handling
    	}	
	}
	// 4 new user addition
	else
	{
		$name= $_POST['name']; $surname= $_POST['surname'];	$email= $_POST['email'];
		$location= $_POST['location']; $photo= $_POST['photo']; $birthdate= $_POST['birthdate'];
		$gender= $_POST['gender'];$sec_qun= $_POST['sec)qun'];$sec_ans= $_POST['sec_ans'];
		$rating = 0;$desp= $_POST['desp'];
		
		$usr_password = sha1($_POST['usr_password']);
    
		try
		{		
			$stmt = $dbh->query("INSERT INTO user_table (fbusr,name,surname,usr_password,email,phone,photo,location,birthdate,gender,sec_qun,sec_ans,rating,desp ) VALUES (:fbusr,:name,:surname,:usr_password,:email,:phone,:photo,:location,:birthdate,:gender,:sec_qun,:sec_ans,:rating,:desp )");

        	
        /*** execute the prepared statement ***/
        	$stmt->execute();

        
        /*** if all is done, say thanks ***/
        	$message = 'New user added';
        }	
        catch(Exception $e)
    	{
        // do Exception handling
    	}	
	}
}
?>


