<?php

session_start();
if (!$_SESSION['ss']) {
    $_SESSION['ss'] = $_SERVER['HTTP_HOST'];
}
echo $_SESSION['ss'];

?>