<?php
    include_once 'removeUser.php';
    include_once 'User.php';
    include_once 'Database.php';
	if( isset($_GET['email']) )
	{
        
        $database = new Database();
        $db = $database->connect();
        $user = new User($db);
        $user->email = $_GET['email'];
        $user->fname = $_GET['nume'];
        $user->lname = $_GET['prenume'];
        $user->address = $_GET['adresa'];
        $user->RemoveUser();
		echo "<meta http-equiv='refresh' content='0;url=removeUser.php'>";
	}
?>