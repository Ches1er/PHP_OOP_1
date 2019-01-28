<?php

class Logger{
    private $path; //путь к файлу

    //объявим константы
    const INFO ="i";
    const WARN ="w";
    const ERR ="e";

/*    private const LEVELS = [
      self::INFO=>"i",
      self::WARN=>"w",
      self::ERR=>"e",
    ];*/

    public function __construct($path)
    { $this->path=$path;
    }

    private static function logTime(){
        return strftime("%y-%m-%d %H:%M:%S");
    }
    public function log(string $level,string $text){
        $t = self::logTime();
        file_put_contents($this->path,"{$level} {$t} {$text}\r\n",FILE_APPEND);
    }
}

$l = new Logger("1.log");
$l->log(Logger::WARN,"Warning!");