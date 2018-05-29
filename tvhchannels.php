<?php
	/* First, download channel list of Tvheadend (tvh) server:
	http://<username>:<password>@<IP of tvh server>:<port>/playlist/channels
	You will obtain the file channels.m3u with the following structure:

	#EXTM3U
	#EXTINF:-1 logo="<URI to channel logo>" tvg-id="<a hash value>",<channel name>
	http://<IP of tvh server>:<port>/stream/channelid/<a number>?ticket=<a hash>&profile=pass

	To access a video stream, you have to create an HTML link of the following kind (per channel):

	<a href="http://<username>:<password>@<IP/dyndns of tvh server>:<port>/stream/channelid/<a number>?ticket=<a hash>&profile=pass" title="<channel name>"><channel name></a>
	*/
	$tvhlocaladdress = "192.168.178.10:9981"; // change this to your needs
	$extport = "9981"; // change this to your needs
	$dyn = "foo.dyn.net"; // or local IP of tvh server, according to your needs
	$username = "tvhuser"; // change this to your needs
	$pw = "theSecretPassword"; // change this to your needs
	$channels = file("channels.m3u"); // read channels.m3u
	for($i=1;$i < count($channels); $i+=2) { // count($channels): number of rows in m3u, starting at 0.
		$poschannelname = strpos ($channels[$i], ','); // channel name can be found in even-numbered rows after the comma, strpos searches its position
		$channelname = trim(substr($channels[$i], $poschannelname+1)); // gives back the substring AFTER the comma (= channel name), trim deletes space characters and line breaks.
		echo "<a href=\"".str_replace($tvhlocaladdress, $username.":".$pw."@".$dyn.":".$extport, trim($channels[$i+1])) ."\" title=\"".$channelname."\">".$channelname."</a><br /><br />\n";
	}
?>
