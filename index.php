<?php

//1 berarti file connection.php ada
if (file_exists("web/connection.php") == 1) {
	echo "<script>location.href='web/';</script>\n";
} else {
	echo "<script>location.href='config.php';</script>\n";
}

?>