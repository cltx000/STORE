<?php
// Inside index.php or logout.php
session_start();
session_destroy();
header("Location: index.php");
exit();
?>
