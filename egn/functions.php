<?php
include("php/classes.php");
function getConnection()
{
    $DB = new Database();
    return $DB;
}
