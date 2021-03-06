<?php
/////////////////////////////////////////////////
// ------------------------------------------- //
// -      THIS SCRIPT WILL:                  - //
// -      1. FIND USER BY KEY                - //
// -      2. UPDATE USER TO ACTIVE           - //
// ------------------------------------------- //
/////////////////////////////////////////////////

require 'common.php';

/////////////////////////////////////////////////
// -------------- TABLE DETAILS -------------- //
/////////////////////////////////////////////////
$usersTable  = "users";
$idCol       = "userID";
$keyCol      = "activationKey";
$isActiveCol = "isActive";

/////////////////////////////////////////////////
// ----------------- GET KEY ----------------- //
/////////////////////////////////////////////////
$key = $_GET["key"];

/////////////////////////////////////////////////
// ----------- CONNECT TO DATABASE ----------- //
/////////////////////////////////////////////////

$conn = conn("localhost","a1","alex","alex");//conn($host,$db,$user,$pass)

/////////////////////////////////////////////////
// -------- SELECT USER ID FROM TABLE -------- //
/////////////////////////////////////////////////
$select = $conn->query("SELECT * 
                        FROM   $usersTable 
                        WHERE  $keyCol = $key");

$cUser =  $select->fetch();

$id = $cUser[$idCol];

if(!$cUser)
{
    $errors = logError($errors, 404 ,"Key not reconised", "1");
    relayError($errors);
}

/////////////////////////////////////////////////
// ----------- UPDATE USERS TABLE ------------ //
/////////////////////////////////////////////////
$update = $conn->query(" UPDATE $usersTable
                            SET $isActiveCol = 1
                          WHERE $idCol = $id ");

?>