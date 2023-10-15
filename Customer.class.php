<?php
class Customer{

    private $id;
    private $firstName;
    private $surName;
    private $email;

    public function __construct(
        int $id,
        string $firstName,
        string $surName,
        string $email
        ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->surName = $surName;
        $this->email = $email;
    }
}

