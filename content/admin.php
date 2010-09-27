<?php

include( "model/user.php" );
include( "libs/php/core.php" );

// !include("tablehover.js"); - Will make things look funny.

requireLogin();

// Need to convert this to divs so that tablehover.js can be used. -Tenach
$adminMenu = "<table>
	<tr class = 'center'>
		<td><h2><a href = '" . $SITE_PREFIX . "t/admin/user'>User Administration</a></h2></td>
		<td><h2><a href = '" . $SITE_PREFIX . "t/admin/project'>Project Administration</a></h2></td>
		<td><h2><a href = '" . $SITE_PREFIX . "t/admin/team'>Team Administration</a></h2></td>
	</tr>
</table>";

$users = $USER_OBJECT->getAllUsers();

if( sizeof($argv) > 1 ) {
	$TITLE = ucwords( $argv[1] );
	
	if( isset( $argv[2]) ) $TITLE .= " " . $argv[2];
	
	$CONTENT = $adminMenu;
	$CONTENT .= "<br /><h1>" . $TITLE . "</h1><br />\n";
	
	if( isset( $argv[2] ) ) {
		$USER_OBJECT->getByCol("username", $argv[2]);
		$user = $USER_OBJECT->getNext();
		$CONTENT = $adminMenu;
		$CONTENT .= "<h1>" . $TITLE . "</h1>";
		
		if( $user['private'] == 0 ) $private = "No";
		if( $user['private'] == 1 ) $private = "Yes";
		
		// Getting exposed like a naked monkey
		// and tabled like a bad hand of cards
		$CONTENT .= "User ID: " . $user['uID'] ."<br />
		Real Name: " . $user['real_name'] ."<br />
		Username: " . $user['username'] ."<br />
		Email: " . $user['email'] ."<br /> 
		Locale: " . $user['locale'] ."<br />
		Timezone: " . $user['timezone'] ."<br />
		Private: " . $private ."<br />
		Password: " . $user['password'] ."<br />";
		
		if( $argv[2] == "create" ) {
			$_SESSION['err'] = "You shouldn't specify a name in a URL when creating.";
			header("Location: " . $SITE_PREFIX . "t/admin/" . $argv[1] . "/create" );
			exit(0);
		}	
	}	else if( isset( $argv[1] ) ) {
		$list = '';
		
		if( $argv[1] == "user" ) {
			$numUsers = count( $users );
			$i = 0;

			while( $i < $numUsers ) {
				$list .= "<tr style = 'cursor:pointer' onclick=\"document.location.href = '" . $SITE_PREFIX . "t/admin/user/" . $users[$i]['username'] . "'\">
										<td>" . $users[$i]['uID'] ."</td> <td><a href = '" . $SITE_PREFIX . "t/admin/user/" . $users[$i]['username'] . "'>" . $users[$i]['real_name'] ."</a></td> <td>" . $users[$i]['username'] ."</td> <td>" . $users[$i]['email'] ."</td> 
									</tr>";
				$i++;
			}
		}
		
		if( $argv[1] == "project" ) {
			$projects = $PROJECT_OBJECT->getAllProjects();
			$numProjects = count( $projects );
			$i = 0;
			
			while( $i < $numProjects ) {
				$USER_OBJECT->getByCol( "uID", $projects[$i]['pID'] );
				$projectOwner = $USER_OBJECT->getNext();
				$projectOwner = $projectOwner['real_name'] . " (" . $projectOwner['username'] . ")";
				$projectLink = $projects[$i]['project_name'];
				
				if ( strpos ( $projects[$i]['project_name'], ' ' ) ) {
					$projectLink = str_replace ( ' ', '-', $projects[$i]['project_name'] );
				}
				
				$list .= "<tr style = 'cursor:pointer' onclick=\"document.location.href = '" . $SITE_PREFIX . "t/admin/project/" . $projects[$i]['project_name'] . "'\">
										<td>" . $projects[$i]['pID'] ."</td> <td><a href = '" . $SITE_PREFIX . "t/admin/project/" . $projectLink . "'>" . $projects[$i]['project_name'] ."</a></td> <td>" . $projects[$i]['descr'] ."</td> <td>" . $projectOwner ."</td> 
									</tr>";
				$i++;
			}
		}
		
		if( $argv[1] == "team" ) {
			$list .= "<tr>OHGODNOTEAMSYETWTFISTHISSHIT</tr>";
		}
		$CONTENT .= "<table class = 'sortable' >";
		$CONTENT .= $list;
		$CONTENT .="</table>";
	}
} else {
	$TITLE    = "Time to do the dirty!";

	$CONTENT .= $adminMenu;
	$CONTENT .= "<br /><h1>Heyya, " . $_SESSION['real_name'] . "</h1>Here's your administration page. " . $TITLE . "<br />\n";
}

?>