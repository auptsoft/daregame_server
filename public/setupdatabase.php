<?php

$dbCon = new mysqli("localhost", "root", "");
   $databaseName = "daregame_database";
   $createdatabase = "CREATE DATABASE ".$databaseName;

   $dbCon->query($createdatabase);

   echo 'done';