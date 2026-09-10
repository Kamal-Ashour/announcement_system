<?php
require_once __DIR__ . '/../config/functions.php';

session_unset();
session_destroy();

header("Location: /announcement_system/index.php");
exit;
