<pre>

<?php
require "class/task.class.php";

$t = new Task("zadanie testowe","treść zadania testowego");
var_dump($t->getAsArray());
//print_r($t);

?>
</pre>