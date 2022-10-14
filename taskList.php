<?php 
    require "class/TaskList.class.php";
    session_start();
    if(!isset($_SESSION['tl'])){

        $tl = new TaskList();
        $tl->loadTestData();
        $_SESSION['tl'] = $tl;
    } else {
        $tl = $_SESSION['tl'];
        $tl->syncFromDB();
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Zadań</title>
    <link type="text/css" rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

    <h2>Lista Zadań:</h2>
    <button type="submit" id="addTask">Dodaj nowe zadanie</button>        
    <?php
    echo $tl->getHTMLTable();
    ?>

<script>
   let a = document.querySelector('#addTask');
   a.addEventListener("click", function() {
    location.replace('new.php');
   })
</script>
</body>
</html>