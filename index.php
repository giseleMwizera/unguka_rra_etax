<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
putenv("TZ=Africa/Kigali");
date_default_timezone_set("Africa/Kigali");

ini_set("display_errors", "On");

error_reporting(error_reporting() & ~E_NOTICE);

include("config/sess.php");
include("config/config.php");
include("helpers/functions.php");

if (!isset($_SESSION['loggedin'])) {
    include("views/forms/login_form.php");
} else {
    include("views/dashboard.php");
}

if ($db_mysql) {
    mysqli_close($db_mysql);
}
