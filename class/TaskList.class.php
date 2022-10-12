<?php
require "Task.class.php";
class TaskList {

    private $taskList;

    function __construct()
    {
        $this->taskList = array();
    }

    function addTask(Task $task) 
    {
        array_push($this->taskList, $task);
    }

    function loadTestData()
    {
        $t = new Task("zadanie testowe","treść zadania testowego");
        $this->addTask($t);
        $t = new Task("zadanie testowe1","treść zadania testowego1");
        $this->addTask($t);
        $t = new Task("zadanie testowe2","treść zadania testowego2");
        $this->addTask($t);
    }

    function getHTMLTable()
    {
        $buffor = '';
        $buffor .= '<table>';
        foreach ($this->taskList as $task) {
            $buffor .='<tr>';
            $taskArray = $task->getAsArray();
            foreach ($taskArray as $key =>$value) {
                $buffor .= '<td>';
                $buffor .= $value;
                $buffor .= '<td>';
            }
            $buffor .='</tr>';
        }
        $buffor .= '</table>';
        return $buffor;
    }
}

?>

