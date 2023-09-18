<?php

if (!isset($_SESSION)) {
    session_start();
}

//se existir sessão, vai destruí-la
session_destroy();

header("Location: ../index.html");

?>