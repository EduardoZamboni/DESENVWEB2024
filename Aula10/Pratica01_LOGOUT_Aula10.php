<?php
session_start();

session_unset();

session_destroy();

header("Location: Pratica01_INDEX_Aula10.php");
exit();
