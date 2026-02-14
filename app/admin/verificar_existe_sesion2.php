<?php
session_start();
//Si existe una session iniciada, devuelve 1
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    die(1);
}
// De lo contrario, devuelve cero
die(0);
?>