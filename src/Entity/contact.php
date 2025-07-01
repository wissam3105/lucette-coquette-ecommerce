<?php

namespace App\Entity;
class contact {

    protected $name;
    protected $email;

    public function getname()
    {
        return $this->name;
    }
    public function setname($name)
    {
        $this->name=$name;
    }
    public function getemail()
    {
        return $this->email;
    }
    public function setemail($email)
    {
        $this->email=$email;
    }
}