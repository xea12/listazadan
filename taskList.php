<?php 
    require "class/TaskList.class.php";
    session_start();
    if(!isset($_SESSION['tl'])){

        $tl = new TaskList();
        $tl->loadTestData();
        $_SESSION['tl'] = $tl;
    } else {
        $tl = $_SESSION['tl'];
    }
?>

<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Zadań</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
<h1>Lista Zadań:</h1>
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