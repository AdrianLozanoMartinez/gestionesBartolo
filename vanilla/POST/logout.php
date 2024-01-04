<?php
	session_start();    
	unset($_SESSION['employeeNumber']); 
	header("Location: index.php");