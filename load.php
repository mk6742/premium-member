<?php
require_once('init.php');

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;

include('customer-query.php');

?>
<?php include('customer-list-item.php'); ?>
