<?php

class People{
    private $name;
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }
    private $surname;

    public function get_FullName(){
        return $this->name."  ".$this->surname;
    }

    public function __construct(?string $name="anonim",?string $surname="anonim")
    {
        $this->name=$name;
        $this->surname=$surname;
    }
}

class _Class{
    private $class;
    private $people;

    public function get_ClassPeoples(){
        return $this->class."   ".$this->people;
    }
    public function __construct(string $class,string $people)
    {
        $this->class=$class;
       $this->people=$people;

    }
}

class Compare_Pupils{
    private $p1;
    private $p2;

    public function p_compare() {
        If ($this->p1->getName()===$this->p2->getName() &&
            $this->p1->getSurname()===$this->p2->getSurname()) return "same pupil";
        return "not same pupil";
    }

    public  function __construct(People $p1,People $p2)
    {
        $this->p1=$p1;
        $this->p2=$p2;
    }
}

$compare = new Compare_Pupils(new People("Ivan","Ivanov"),new People("Ivan","Ivanov"));
echo $compare->p_compare();




