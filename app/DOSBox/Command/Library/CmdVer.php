<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdVer extends Command {
    
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
            $outputter->printLine(" Microsoft Windows XP [Version 5.1.2600]" );   
        }
        else if($this->getParameterCount() == 1){
            if($this->getParameterAt(0) == "/w"){
                $outputter->printLine(" Microsoft Windows XP [Version 5.1.2600]" );
                $outputter->printLine(" Renny Indah Wardhani, rennyindah@bps.go.id" );
                $outputter->printLine(" Hardian Indrajati, hardian.indrajati@bps.go.id" );
                $outputter->printLine(" Decy Restyan, decy@bps.go.id" );
                $outputter->printLine(" Suryono Hadi Wibowo, hadi_wibowo@bps.go.id" );
            }
            else $outputter->printLine("error parrameter" );  
        }
        else{
            $outputter->printLine("error" );
        }
    } 
}