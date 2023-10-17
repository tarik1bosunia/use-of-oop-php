<?php


// include and initialize Json Class
require_once 'Json.class.php';
require_once 'Book.class.php';


class Library{
    private $books;

    public function __construct() {
        $db = new Json();
        $data = $db->getRows();
        foreach ($data as $key => $value) {
            $this->books[$key] = new Book(
                $value['title'],
                $value['author'],
                $value['pages'],
                $value['available'],
                $value['isbn'],
            );

        }
        // var_dump($this->books);
    }

    // public function addBook(Book $book) {
    //     $this->books[] = $book;
    // }
    public function getBooks(): array {
        return $this->books;
    }
}