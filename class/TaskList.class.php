<?php
require "Task.class.php";
//require "../connect.php";
class TaskList {

    private $taskList;

    function __construct()
    {
        $this->taskList = array();
    }
    function syncToDB() {
        $db = new mysqli('localhost', 'root','','taskList');
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);}
        foreach ($this->taskList as $task) {
            $taskArray = $task->getAsArray();
            $code = $taskArray['code'];
            $q = $db->prepare("SELECT * FROM task WHERE code = ?");
            $q->bind_param('s', $code);
            $q->execute();
            $result = $q->get_result();
            $createdTimestamp = date('Y-m-d H:i:s',$taskArray['createdTimestamp']);
            $resolvedTimestamp = date('Y-m-d H:i:s',$taskArray['resolvedTimestamp']);
            if($result->num_rows > 0) 
            {
                //zadanie juz istnieje w bazie danych - zaktualizuj
                $q = $db->prepare("UPDATE task SET created = ?, resolved = ?, title = ?, content = ?, priority = ? WHERE code = ?");
                $q->bind_param('ssssis', $createdTimestamp, $resolvedTimestamp, $taskArray['title'], $taskArray['content'], $taskArray['priority'], $taskArray['code']);
                $q->execute();
            } else {
                //zadania nie ma w bazie danych - dodaj
                $q = $db->prepare("INSERT INTO task (code, created, resolved, title, content, priority) VALUES (?, ?, ?, ?, ?,?)");
                $q->bind_param('sssssi', $taskArray['code'], $createdTimestamp, $resolvedTimestamp, $taskArray['title'],$taskArray['content'],$taskArray['priority']);
                $q->execute();
            }
        }
        

    }

    function syncFromDB() {
        $db = new mysqli('localhost', 'root','','taskList');
        $q = $db->prepare("SELECT * FROM task ORDER BY created DESC");
        $q->execute();
        $result = $q->get_result();
        $this->taskList = array();
        while($row = $result->fetch_assoc()) {
            $t = new Task($row['title'], $row['content'], $row['priority']);
            $t->assignCode($row['code']);
            $t->setTimestamps(strtotime($row['created']), strtotime($row['resolved']));
            array_push($this->taskList, $t);
        }
    }

    function addTask(Task $task) 
    {
        $task->assignCode($this->generateNewCode());
        array_push($this->taskList, $task);
    }

    function generateNewCode() : string 
    {
        $code = "";
        for($i = 0; $i < 11; $i++) {
            if($i == 3 || $i == 7) {
                $code .= "-";
            } else {
                $char = chr(rand(65,90)); // generuje losowa litere A-Z z tablicy ASCII
                $code .= $char; 
            }
        }
        //TODO check from duplicate codes


        return $code;
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
        $buffor .= '<table class="table table-hover" style="width: 90%; margin: 0 auto; ">';
        $buffor .='<tr>';
/*         $buffor .='<td >ID sprawy</td>';  */
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
/*             $buffor .= '<td>';
            $buffor .= $taskArray['code'];
            $buffor .= '</td>';    */            
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
            $buffor .= '<a href="task.php?code='.$taskArray['code'].'">';
            $buffor .= $taskArray['title'];
            $buffor .= '</a>';
            $buffor .= '</td>';        
            $buffor .= '<td>';        
            if($taskArray['resolvedTimestamp'] == 0) {
                //sprawa nie rozwiazana
                $buffor .= "w toku";
            } else {
                //sprawa rozwiązana
                $buffor .= "zakończone: ";
                $buffor .= $taskArray['resolved'];
            }
            $buffor .='</td>';
            $buffor .='</tr>';
        }
        $buffor .= '</table>';
        return $buffor;
    }

    function getByCode(string $code) { 
        foreach ($this->taskList as $task) { //przejdz przez wszystkie zapisane zadania
            $taskArray = $task->getAsArray(); //pobierz całe zadanie jakos tablice
            if($taskArray['code'] == $code) // sprawdz czy kod zadania jest zgodny z poszukiwanym
                return $taskArray; // jeśli jest zwróć zgodną tablicez zadaniem
        }
        return NULL; // jeśli doszło tu to nie znaleźlismy zadania w liscie 
    }
    function closeByCode(string $code) { 
        foreach ($this->taskList as $task) {
            $task->close($code);
        }


    }
}

?>

