<?php
    /*
     *  License:     AGPLv3
     *  Author:      THomas Martin <tenach@whube.com>
     *  Description:
     *    This is where you POST a new registration
     */
session_start();

$app_root        = dirname(  __FILE__ ) . "/../../";

include( $app_root . "libs/php/globals.php" );
include( $app_root . "conf/site.php" );
include( $app_root . "model/user.php" );
include( $app_root . "model/project.php" );
include( $app_root . "model/events.php" );

if (
	isset ( $_POST['project-name'] ) &&
	isset ( $_POST['descr'] )
) {

	$r = $PROJECT_OBJECT;
	$u = $USER_OBJECT;
	
	// Let's verify!

	$pname	= htmlentities( $_POST['project-name'], ENT_QUOTES);
	$descr  = htmlentities( $_POST['descr'], ENT_QUOTES);
	

	$i=0;
	$numProjects = count( $pname );

	$vproj = FALSE;
	foreach( $projects as $project ) {
		if( $_POST['project-name'] == $project['project_name'] ) {
			$_SESSION['err'] = "Hey hey, whaddya trying to pull? That project's already registered. :|";
			header("Location: $SITE_PREFIX" . "t/new-project");
		} else {
			$vproj = TRUE;
		}
	}
	
	if( $vuser == TRUE ) {
		$locale = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
		$fields = array(
			"project_name" => $_POST['project-name'],
			"descr"  => $_POST['descr'],
			"owner"	 => $_SESSION['id'],
			"active"	=> '1',
			"startstamp"  => time(),
			"trampstamp"  => time()
		);
		$newproj = $r->createNew( $fields );
		
		if ( $BUILTIN_EMAIL_ENABLE ) {

$message = '';


"Hey there!

Thanks for registering " . $fields['project_name'] . "!

You're a fantastic person, and this email is to just
to assure you that the administrators over at " . $SITE_PREFIX . "
love you and your contributions very much.

Thanks for feeding another project to the wolves!

" . $BUILTIN_EMAIL_SIG; // Temporarily disabled below.
		    //sendEmail( $BUILTIN_EMAIL_ADDR, $fields['email'], "Welcome to Whube, " . $fields['username'] . "!", $message );
		}
		
		
		$_SESSION['msg'] = "All registered! Don'tcha feel like a big kid now?";
		header("Location: $SITE_PREFIX" . "t/project-list");
		exit(0);
	} else {
		$_SESSION['err'] = "Please fill in all the forms!";
		header("Location: $SITE_PREFIX" . "t/new-project");
		exit(0);
	}
}

?>