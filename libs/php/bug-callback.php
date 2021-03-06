<?php
    /*
     *  License:     AGPLv3
     *  Author:      Paul Tagliamonte <paultag@whube.com>
     *  Description:
     *    Where you post a bug against
     */

session_start();

$app_root = dirname(  __FILE__ ) . "/../../";

include( $app_root . "conf/site.php" );
include( $app_root . "libs/php/globals.php" );

requireLogin();

include( $app_root . "model/bug.php" );
include( $app_root . "model/user.php" );
include( $app_root . "model/project.php" );

$b = new bug();

/*

 --> get shiz via $_POST all like:

Array (
	[bID] => 1
	[project] => whube_docs
	[title] => Whube is not done yet
	[status] => 1
	[severity] => 1
	[owner] => raidsong
)
 
*/

// print_r( $_POST ); // data sent to us

if ( isset ( $_POST['bID'] ) && $_POST['bID'] != "" ) {

$bugid   = clean($_POST['bID'] );       /* Bug ID. This should NEVER be fucked with */
$project = clean($_POST['project']);    /* New project of the bug ( perhaps )  */
$title   = clean($_POST['title']);      /* New title of the bug ( perhaps )    */
$status  = clean($_POST['status']);     /* New status of the bug ( perhaps )   */
$sever   = clean($_POST['severity']);   /* New severity of the bug ( perhaps ) */
$owner   = clean($_POST['owner']);      /* New owner of the bug ( perhaps )    */
$descr   = clean($_POST['descr']);      /* New descr of the bug ( perhaps )    */


if ( isset( $_POST['noassign'] ) && $_POST['noassign'] != "" ) {
	$noassign  = clean($_POST['noassign']); /* Fricken magnets */
} else {
	$noassign  = NULL;
}



$priv = false;

if ( isset( $_POST['private'] ) ) {
	$priv = true;
} else {
	$priv = false;
}

$o = new user();
$p = new project();

$o->getByCol( "username",     $owner );

//if ( $owner['uID'] ) {
//	$noassign = NULL;
//}

$p->getByCol( "project_name", $project );

$own = $o->getNext();
$pkg = $p->getNext();

$projectID = $pkg['pID'];
$ownerID   = $own['uID'];

$posted_data = array(
	"bug_severity" => $sever,
	"bug_status"   => $status,
	"package"      => $projectID,
	"title"        => $title,
	"private"      => $priv,
	"descr"        => $descr
);


if ( ! isset( $noassign ) ) {
	$posted_data['owner'] = $ownerID;
} else {
	$posted_data['owner'] = NULL;
}

// print_r( $posted_data );

$b->getAllByPK( $bugid );
$row = $b->getNext();

// print_r( $row ); // searched bug

/*
 --> $row should look like:

   ** NOTE: IGNORE THE [n] ETC! THEY ARE STUPID IF YOU DON'T QUERY FUR THEM **

Array (
	[bID] =>              1                        <-- PK, bug ID
	[bug_status] => 1                              <-- FK, status table by ID
	[bug_severity] => 1                            <-- FK, severity table by ID
	[package] => 1                                 <-- FK, project table by pID
	[reporter] => 1                                <-- FK, user table by uID
	[owner] => 0                                   <-- FK, user table by uID
	[title] => Whube is not done yet               <-- Title
	[descr] => Whube is not done yet, of course!   <-- Description
)

*/

$b->updateByPK( $bugid, $posted_data );

// /*

$_SESSION['msg'] = "Bug #$bugid updated!";
header( "Location: " . $SITE_PREFIX . "t/bug/" . $bugid );
exit(0);

// */

} else {
	$_SESSION['msg'] = "Wtf, really";
	header( "Location: " . $SITE_PREFIX . "t/bug-list/" . $bugid );
	exit(0);
}

?>
