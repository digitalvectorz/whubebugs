<?php

/*
 * This is directly copied from new-bug.php.
 * It looks like shite, I know. Please forgive
 * me fellow Whubians. <3
 * - Tenach
 */

requireLogin();

useScript( "validate-project.php" );

$TITLE = "Anotha Project!";
$CONTENT .= "
	<h1>So, you have have a project not listed here?</h1>
	<br />
	<br />
	<div id = 'images' ></div>
	<form action = '" . $SITE_PREFIX . "l/submit-project' method = 'post' >
		<table>
	<tr>
		<td>What's the project called?</td>
		<td><div id = 'project-ok' ><img src = '" . $SITE_PREFIX . "imgs/no.png' alt = '' /></div></td>
		<td><input type = 'text' id = 'project' name = 'newProject' size = '20' /></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td><div id = 'project-name' ></div></td>
	</tr>
	<tr>
		<td>And a nice description</td>
		<td></td>
		<td><textarea rows = '20' cols = '50' name = 'projDescr' ></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><img src = '" . $SITE_PREFIX . "imgs/32_space.png' alt = '' /></td>
		<td><input type = 'submit' value = 'Look, I made this for you!' /></td>
	</tr>
		</table>
	</form>
";

?>
