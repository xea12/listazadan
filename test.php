<?php 
    require "class/TaskList.class.php";
    session_start();
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <pre>

    <?php

        if(!isset($_SESSION['tl'])){

            $tl = new TaskList();
            $tl->loadTestData();
            $_SESSION['tl'] = $tl;
        } else {
            $tl = $_SESSION['tl'];
        }

    


    //var_dump($tl);
    //print_r($t);

    echo $tl->getHTMLTable();

    ?>
    </pre>
</body>
</html>


