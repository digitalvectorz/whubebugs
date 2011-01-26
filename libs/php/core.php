<?php

    /*
     *  License:     AGPLv3
     *  Author:      Paul Tagliamonte <paultag@whube.com>
     *  Description:
     *    Core app data
     */


$VERSION         = "3.14.1";
$VERSION_NAME	 = "Dopey Donut";
$VERSION_STRING  = "v$VERSION '$VERSION_NAME'";

$API_COMPATV     = 0x1;
$API_VERSION     = 0x3;

$WHUBE_PROJECT_LEAD   =  "Paul Tagliamonte";
$WHUBE_PROJECT_URL    =  "http://whube.com/";

$yell = "You should run install/install.sh or install/jquery.sh
	to obtain the latest jQuery!";

if( file_exists( $app_root . "libs/js/jQuery.js" ) ) {
	$yell = "TURN ON JAVASCRIPT! Don't be such a lamer";
}

$ABOUT_WHUBE = <<<EOF

<h1>Namaste, and Welcome. This is Whube</h1>

<b>Whube</b> is a hip bug tracker. Not hip in the way
that old people use it, but hip as in I think multitouch
and acceleromters are hip. It's a bit rough around the 
edges and is really not stable enough for corporate use.
Not to mention I don't think it will scale well. But that
is neither here nor there. <br />
<br />
There is lots of AJAX and Javascript. To be sure, let me test
to ensure there is no dumb stuff going on.<br />
<div class = 'shit' id = 'remove-me' >
	<div class = 'content' >
		Dude! YELLATMEOK
	</div>
</div>
<script type = 'text/javascript' >
	$('#remove-me').hide();
</script>
<br />
Do you see the big red scary text above? No? w00t. That's a good thing.
<br />
Oh, by the way, this is Whube $VERSION_STRING;
<br />
<br />
Peace, Love and PHP<br />
EOF;

$ABOUT_WHUBE = str_replace("YELLATMEOK", $yell, $ABOUT_WHUBE);

?>
