<?php

require_once '../utilities/session.php';

$session=new Session();

$session->destroySession();

header('Location: articles.php');

?>