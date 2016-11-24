<?php
/**
 * Created by PhpStorm.
 * User: BPSAdmin
 * Date: 11/24/2016
 * Time: 2:54 PM
 */
use DOSBox\Filesystem\Directory;
use DOSBox\Filesystem\File;
use DOSBox\Command\Library\CmdVer;
use DOSBox\Filesystem\Drive;

class CmdVerTest extends DOSBoxTestCase {
    private $command;
    private $drive;
    private $rootDir;
    private $subDir1;
    private $subDir2;
    private $file1;
    private $file2InDir1;

    protected function setUp() {
        parent::setUp();
        $this->drive = new Drive("D");
        $this->rootDir = $this->drive->getRootDir();

        $this->command = new CmdVer("ver", $this->drive);
        $this->commandInvoker->addCommand($this->command);
    }

    public function testCmdVer_WithoutParameter_PrintVersion() {
        //$this->drive->changeCurrentDirectory($this->rootDir);
        $this->executeCommand("ver");
        $this->assertContains(" Microsoft Windows XP [Version 5.1.2600]" , $this->mockOutputter->getOutput());
    }

    public function testCmdVer_WIthParameter_PrintVersionAuthor(){
        //$this->drive->changeCurrentDirectory($this->rootDir);
        $this->executeCommand("ver /w");
        $this->assertContains(" Microsoft Windows XP [Version 5.1.2600]" , $this->mockOutputter->getOutput());
        $this->assertContains(" Renny Indah Wardhani, rennyindah@bps.go.id" , $this->mockOutputter->getOutput());
        $this->assertContains(" Hardian Indrajati, hardian.indrajati@bps.go.id"  , $this->mockOutputter->getOutput());
        $this->assertContains(" Decy Restyan, decy@bps.go.id" , $this->mockOutputter->getOutput());
        $this->assertContains(" Suryono Hadi Wibowo, hadi_wibowo@bps.go.id" , $this->mockOutputter->getOutput());
    }

    public function testCmdVer_OtherParameter_PrintsError(){
        $this->executeCommand("ver /c");
        $this->assertContains("error parrameter", $this->mockOutputter->getOutput());
    }

    /*public function testCmdVer_ManyParameter_PrintsError(){
        $this->executeCommand("ver 1");
        $this->assertContains("error", $this->mockOutputter->getOutput());
    }
    */
}

