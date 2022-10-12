<?php
class Task {
    private $createdTimestamp; //data i czas utworzenia
    private $resolvedTimestamp; //data i czas zamkniecia
    private $title;
    private $content;
    private $priority; // priorytet zadania (1=>low,2=> med,3=> high)


    function __construct(string $title, string $content, int $priority = 2)
    {
       $this->createdTimestamp = time();
       $this->resolvedTimestamp = 0; // 0 oznacza spawe nierozwiazana
       $this->title = $title;
       $this->content = $content;
       if ($priority <1 || $priority > 3 ) {
        $this->priority = 2;
       } else {
        $this->priority = $priority;
       }
    }

    function getAsArray() {
        $result = array(); // tworzy pustą tablice
        // zapisz kolejno właściwości zadania do tej tabeli pod indeksami
        //(kluczami) zgodnymi z ich nazwa
        $result['createdTimestamp'] = $this->createdTimestamp;
        $result['created'] = date('d M Y H:i:s', $this->createdTimestamp);
        $result['resolvedTimestamp'] = $this->resolvedTimestamp;
        $result['title'] = $this->title;
        $result['content'] = $this->content;
        $result['priority'] = $this->priority;
        //zwróc tablice
        return $result;

    }


}


?>