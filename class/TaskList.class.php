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
        $buffor .='<tr>';
        $buffor .='<td>Data zgłoszenia</td>'; 
        $buffor .='<td>Priorytet</td>'; 
        $buffor .='<td>Tytuł</td>'; 
        $buffor .='<td>Data zakończenia</td>'; 
        $buffor .='</tr>';
        foreach ($this->taskList as $task) {
            $buffor .='<tr>';
            $taskArray = $task->getAsArray();
/*             foreach ($taskArray as $key =>$value) {
                $buffor .= '<td>';
                $buffor .= $value;
                $buffor .= '<td>';
            } */
            $buffor .= '<td>';
            $buffor .= $taskArray['created'];
            $buffor .= '</td>';        
            $buffor .= '<td>';
            switch ($taskArray['priority']) {
                case 1:
                    $buffor .= "Niski";
                    break;
                case 2:
                    $buffor .= "Średni";
                    break;
                case 3:
                    $buffor .= "Wysoki";
                    break;                    
            }
            $buffor .= '</td>';    
            $buffor .= '<td>';
            $buffor .= $taskArray['title'];
            $buffor .= '</td>';        
            if($taskArray['resolvedTimestamp'] == 0) {
                //sprawa nie rozwiazana
                $buffor .= "<td>w toku</td>";
            } else {
                //sprawa rozwiązana
                $buffor .= $taskArray['resolved'];
            }
            $buffor .='</tr>';
        }
        $buffor .= '</table>';
        return $buffor;
    }
}

?>

