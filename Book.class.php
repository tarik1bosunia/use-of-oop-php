<?php
require_once 'Json.class.php';

class Book extends Json{
    public $isbn;
    public $title;
    public $author;
    public $available;

    public function __construct(int $isbn, string $title, string $author, int $available = 0){
        $this->isbn = $isbn;
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
    }

    public function __toString() {
        $result = '<i>' . $this->title . '</i> - ' . $this->author;
        if (!$this->available) {
            $result .= ' <b>Not available</b>';
        }
        return $result;
    }

    // function getCopy() :  bool{
    //     if($this->available < 1){
    //         return false;
    //     }else{
    //         $this->available = $this->available - 1;
    //         $this->update(array($this), $this->isbn);
    //         return true;
    //     }
        
    // }

    // public function addCopy() {

    //     $this->available++;
    // }

    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
    
}