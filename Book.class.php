<?php
require_once 'Json.class.php';

class Book{

    # private variables
    private $isbn;
    private $title;
    private $pages;
    private $author;
    private $available;

    # constructors and destructors

    public function __construct(
        string $title, string $author, int $pages, int $available = 0, int $isbn)
    {
        $this->title = $title;
        $this->author = $author;
        $this->available = $available;
        $this->pages = $pages;
        $this->isbn = $isbn;
    }

    # private functions
    
    # public functions

    public function getCopy(){
        if($this->available < 1){
            return false;
        }
        
        $db = new Json();
        $update = $db->update(array($this->available), $this->isbn);
        return $update;
    }
    public function addCopy(){
        $db = new Json();
        $update = $db->update(array($this->available), $this->isbn);
        return $update;
    }


    # getter and setters

    public function getTitle(): string{
        return $this->title;
    }
    public function getPages(): int{
        return $this->pages;
    }
    public function getAuthor(): string{
        return $this->author;
    }
    public function getAvailable(): int{
        return $this->available;
    }
    public function getIsbn(): string{
        return $this->isbn;
    }

    # to string
    public function __toString() {
        $result = '<i>' . $this->title . '</i> - ' . $this->author;
        if (!$this->available) {
            $result .= ' <b>Not available</b>';
        }
        return $result;
    }

}