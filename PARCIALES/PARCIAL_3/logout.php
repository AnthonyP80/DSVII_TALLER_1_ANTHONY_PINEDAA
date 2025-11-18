<?php
session_start();

session_unset();

header(header: "Location: index.php");
exit;

