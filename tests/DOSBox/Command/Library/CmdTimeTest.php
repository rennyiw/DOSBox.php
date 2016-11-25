<?php

//use DOSBox\Filesystem\Directory;
//use DOSBox\Command\Library\CmdMkDir;
//use DOSBox\Filesystem\Drive;

class CmdTimeTest extends DOSBoxTestCase {
	private $command;
	//private $time;
    //private $numbersOfDirectoriesBeforeTest;

	protected function setUp() {
    	parent::setUp();
        $this->commandInvoker->addCommand($this->command);
    }

    public function testTimeValue(){
    	$this->executecommand("time");

        $this->assertContains(date("h:i:s"), $this->mockOutputter->getOutput());
    }
}