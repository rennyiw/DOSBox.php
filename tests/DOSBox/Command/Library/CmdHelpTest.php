<?php

use DOSBox\Filesystem\Directory;
use DOSBox\Filesystem\File;
use DOSBox\Command\Library\CmdHelp;
use DOSBox\Filesystem\Drive;

class CmdHelpTest extends DOSBoxTestCase {
    private $command;
    private $drive;
    private $rootDir;
    private $subDir1;
    private $subDir2;
    private $file1;
    private $file2InDir1;

    protected function setUp() {
        parent::setUp();
        $this->drive = new Drive("C");
        $this->rootDir = $this->drive->getRootDir();
        // C:\subdir1
        $this->subDir1 = new Directory("subdir1");
        $this->rootDir->add($this->subDir1);

        // C:\subdir1\file1.txt
        $this->file1InDir1 = new File("file1.txt", "");
        $this->subDir1->add($this->file1InDir1);
        // C:\subdir1\file2.txt
        $this->file2InDir1 = new File("file2.txt", "");
        $this->subDir1->add($this->file2InDir1);

        // C:\file1.txt
        $this->file1 = new File("file1.txt", "");
        $this->rootDir->add($this->file1);

        $this->subDir2 = new Directory("subdir2");
        $this->rootDir->add($this->subDir2);

        $this->command = new CmdHelp("help", $this->drive);
        $this->commandInvoker->addCommand($this->command);
    }

    public function testCmdHelp0() {
        $this->executeCommand("help");
        $this->assertContains("cd"."\t"."Displays the name of or changes the current directory", $this->mockOutputter->getOutput());
        $this->assertContains("dir"."\t"."Displays a list of files and subdirectories in a directory", $this->mockOutputter->getOutput());
        $this->assertContains("exit"."\t"."Quits the CMD.EXE program (command interpreter)", $this->mockOutputter->getOutput());
        $this->assertContains("format"."\t"."Formats a disk for use with Windows", $this->mockOutputter->getOutput());
        $this->assertContains("help"."\t"."Provide help information for windows commands", $this->mockOutputter->getOutput());
        $this->assertContains("label"."\t"."Creates,changes, or deletes the volume label of a disk", $this->mockOutputter->getOutput());
        $this->assertContains("mkdir"."\t"."Creates a directory", $this->mockOutputter->getOutput());
        $this->assertContains("mkfile"."\t"."Created a file", $this->mockOutputter->getOutput());
        $this->assertContains("move"."\t"."Moves one or more files from one directory to another directory", $this->mockOutputter->getOutput());
    }
    public function testCmdHelp1() {
        $this->executeCommand("help cd");
        $this->assertContains("cd"."\t"."Displays the name of or changes the current directory", $this->mockOutputter->getOutput());
    }

    public function testCmdHelp2() {
        $this->executeCommand("help decy");
        $this->assertContains("Error : This command is not supported by the help utility", $this->mockOutputter->getOutput());
    }

/*    public function testCmdHelp3() {
        $this->executeCommand("help cd dir");
        $this->assertContains("Error : This command is not supported by the help utility as well", $this->mockOutputter->getOutput());
    }*/
} 
