<?php

namespace DOSBox\Command\Library;

use DOSBox\Interfaces\IDrive;
use DOSBox\Interfaces\IOutputter;
use DOSBox\Filesystem\Directory;
use DOSBox\Command\BaseCommand as Command;

class CmdHelp extends Command {

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
        $help   = array();
        $help['cd']     = array('Displays the name of or changes the current directory');
        $help['dir']    = array('Displays a list of files and subdirectories in a directory');
        $help['exit']   = array('Quits the CMD.EXE program (command interpreter)');
        $help['format'] = array('Formats a disk for use with Windows');
        $help['help']   = array('Provide help information for windows commands');
        $help['label']  = array('Creates,changes, or deletes the volume label of a disk');
        $help['mkdir']  = array('Creates a directory');
        $help['mkfile'] = array('Created a file');
        $help['move']   = array('Moves one or more files from one directory to another directory');
        if($this->getParameterCount() == 0)
        {
            foreach($help as $key=>$value) {
                $outputter->printLine($key."\t".$value[0]);
            }
        }
        else {
            $kunci  = trim($this->getParameterAt(0));
            if (array_key_exists($kunci, $help)) {
                $outputter->printLine($kunci."\t".$help[$kunci][0]);
            }
            else{
                $outputter->printLine("Error : This command is not supported by the help utility");
            }
        }/*
        else{
            $outputter->printLine("Error : This command is not supported by the help utility as well");
        }*/
    }
}