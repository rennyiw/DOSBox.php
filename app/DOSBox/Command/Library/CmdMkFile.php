<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\File;
use DOSBox\Command\BaseCommand as Command;

class CmdMkFile extends Command {
    public function __construct($commandName, IDrive $drive){
        parent::__construct($commandName, $drive);
    }

    public function checkNumberOfParameters($numberOfParametersEntered) {
        return true;
    }

    public function checkParameterValues(IOutputter $outputter) {
        return true;
    }

    public function execute(IOutputter $outputter){

        $currentDirectoryItems = $this->getDrive()->getCurrentDirectory()->getContent();
        $isExist=false;
        foreach ($currentDirectoryItems as $item) {

            if($item->isDirectory() == false){
                if($item->getName() == $this->params[0]){
                $isExist=true;
                }
            }
            
            
        }



        if($isExist==true){
            $outputter->printLine("Sorry, the file name is already exist, choose other file name" );
            
        } else{

            $fileName = $this->params[0];
            $fileContent = null;

            /*if($this->params[1] != null){
                $fileContent = $this->params[1];
            }else{
                $fileContent = null;
            }*/
            
            $newFile = new File($fileName, $fileContent);
            $this->getDrive()->getCurrentDirectory()->add($newFile);

        }


        
    }
}