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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    if(isset($_REQUEST['code'])){
        $task = $_SESSION['tl']->getByCode($_REQUEST['code']);

        if(isset($_REQUEST['action']))
            if($_REQUEST['action'] == "close") {
                $_SESSION['tl']->closeByCode($_REQUEST['code']);
                header('Location: taskList.php');
            }
            
        echo "kod zadania: ".$task['code'].'<br>';
        echo "Tytuł zadania: ".$task['title'].'<br>';
        echo "treść zadania: ".$task['content'].'<br>';
        if($task['resolvedTimestamp'] == 0 ) {
            echo "Status zadania: w toku<br>";
        } else {
            echo " zadanie zakończone: ".$task['resolved']."<br>";
        }
        echo '<a href="task.php?code='.$task['code'].'&action=close">Zamknij zadanie</a><br>';
        echo '<a href="taskList.php">Wróc do listy zadań</a>';
        //var_dump($task);
    }
    
    ?>
</body>
</html>