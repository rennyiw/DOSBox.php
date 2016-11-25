<?php
namespace DOSBox\Command\Library;
use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;
class CmdMkDir extends Command {

    const PARAMETER_CONTAINS_BACKLASH = "At least one parameter denotes a path rather than a directory name.";
    public function __construct($commandName, IDrive $drive){
        parent::__construct($commandName, $drive);
    }
    public function checkNumberOfParameters($numberOfParametersEntered) {
        return $numberOfParametersEntered >= 1 ? true : false;
    }
    public function checkParameterValues(IOutputter $outputter) {
        for($i=0; $i< $this->getParameterCount(); $i++) {
            if ($this->parameterContainsBacklashes($this->getParameterAt($i), $outputter))
                return false;
        }
        return true;
    }
    // TODO: Unit test
    public static function parameterContainsBacklashes($parameter, IOutputter $outputter) {
        // Do not allow "mkdir c:\temp\dir1" to keep the command simple
        if (strstr($parameter, "\\") !== false || strstr($parameter, "/") !== false) {
            $outputter->printLine(self::PARAMETER_CONTAINS_BACKLASH);
            return true;
        }
        return false;
    }
    public function execute(IOutputter $outputter){
        date_default_timezone_set("Asia/Bangkok");
        $d                      = date('m/d/Y h:i:s a');
        $currentDirectoryItems  = $this->getDrive()->getCurrentDirectory()->getContent();
        $isExist                = false;
        foreach ($currentDirectoryItems as $item) {
            $exp    = explode(' ',$item->getName());
            $nmfile = $exp[0];
            if($item->isDirectory()){
                if($nmfile == $this->params[0]){
//                if($item->getName() == $this->params[0]){
                    $isExist=true;
                }
            }
        }
        if($isExist==true){
            $outputter->printLine("Sorry, the directory is already exist, choose other directory name" );
        }
        else{
            for($i=0; $i < $this->getParameterCount(); $i++) {
                $this->createDirectory($this->params[$i]." ".$d, $this->getDrive());
//                $this->createDirectory($this->params[$i], $this->getDrive());
            }
        }

    }
    public function createDirectory($newDirectoryName, IDrive $drive) {
        $newDirectory = new Directory($newDirectoryName);
        $drive->getCurrentDirectory()->add($newDirectory);
    }
}



