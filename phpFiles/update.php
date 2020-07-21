<?php
    session_start();

    set_include_path('phpFiles');

    $config = parse_ini_file('config.ini.php');

    include ("connect.php");    

    $db = new Db();

    if (array_key_exists("content", $_POST)) {
        
        $note = $db -> quote($_POST['content']);

        $insert = $db -> query("INSERT INTO note (note) VALUES (" . $note . ")");
        
        $arr = $_POST;
        $msg = implode(" ", $arr);
        $msg = wordwrap($msg, 70);
        mail("domainadmin@seasonedsocks.com", "Test Order", $msg);
        echo "Note contents: ";
        echo "<br>";
        var_dump($note);
        echo "<br>";
        echo "Session: ";
        var_dump($_POST);
        
        if ($note) {
            echo "Success";
        } else
            echo "No bueno";
    }
?>