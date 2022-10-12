<pre>

<?php
require "class/TaskList.class.php";

$tl = new TaskList();
$tl->loadTestData();


//var_dump($tl);
//print_r($t);

echo $tl->getHTMLTable();

?>
</pre>