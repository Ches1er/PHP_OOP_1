<?php

class Mobile{
    private $model;
    private $manufacturer;

    public function __construct(string $model, string $manufacturer)
    {
        $this->model = $model;
        $this->manufacturer = $manufacturer;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @param string $manufacturer
     */
    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }

    public function equals(Mobile $p){
        return $p->model===$this->model && $p->manufacturer===$this->manufacturer;

    }
}

class Package{
    private $phone;
    private $count;

    /**
     * Package constructor.
     * @param $phone
     * @param $count
     */
    public function __construct(Mobile $phone,int $count)
    {
        $this->phone = $phone;
        $this->count = $count;
    }

    /**
     * @return Mobile
     */
    public function getPhone(): Mobile
    {
        return $this->phone;
    }

    /**
     * @param Mobile $phone
     */
    public function setPhone(Mobile $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
    }
}

class Storekeeper{
    private $name;
    private $surname;

    /**
     * Storekeeper constructor.
     * @param $name
     * @param $surname
     */
    public function __construct(string $name,string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }




}

class Warehouse{
    private $packages = [];
    private $storekeepers = [];
    private $active_sk = NULL;

    /**
     * Warehouse constructor.
     * @param array $packages
     */
    public function __construct(Storekeeper $s)
    {
        $this->storekeepers[]=$s;
        $this->active_sk = $s;
    }

    public function addPhones(Mobile $phone,int $count){
        foreach ($this->packages as &$package) {
            if ($package->getPhone()->equals($phone)){
                $package->setCount($package->getCount()+$count);
                return;
            }
        }
        $this->packages[]=new Package($phone,$count);
    }

    public function getPackages():array {
        return $this->packages;
    }
}

class App{
    private $wh;

    public function __construct()
    {
        $this->wh = new Warehouse(new Storekeeper("Vasia","Pupkin"));
    }

    public function run(){
        $this->wh->addPhones(new Mobile("1100","Nokia"),5);
        $this->wh->addPhones(new Mobile("1200","Nokia"),15);
        $this->wh->addPhones(new Mobile("1100","Nokia"),50);

        foreach ($this->wh->getPackages() as $package){
            echo $package->getPhone()->getModel()."  ".$package->getCount()."</pre>";
        }
    }
}

$app = new App();
$app->run();