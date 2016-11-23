<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdTime extends Command {
    
    public function __construct($commandName, IDrive $drive){
        parent::__construct($commandName, $drive);
    }

    public function checkNumberOfParameters($numberOfParametersEntered) {
        return $numberOfParametersEntered <= 1 ? true : false;
    }

    public function checkParameterValues(IOutputter $outputter) {
        return true; //$this->getParameterAt(0) == "/w" ? true : false;
    }

    public function execute(IOutputter $outputter){
        if($this->getParameterCount() == 0)
        {
            //$t = time();
            $outputter->printLine(date("h:i:s"));   
        }
        else if($this->getParameterCount() == 1){
            if(preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9]):([0-5][0-9])/", $this->getParameterAt(0))) {
                //$outputter->printLine(" betul" );
            }
            else $outputter->printLine("Unaccepted Time Value" );  
        }
        else{
            $outputter->printLine("error" );    
        }
    } 
}