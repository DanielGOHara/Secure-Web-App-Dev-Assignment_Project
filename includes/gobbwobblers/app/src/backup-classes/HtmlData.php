<?php

/**
* Name: HtmlData
* Description: Retrieves data from SQL server and returns it as an array.
* Author: Daniel O'Hara @ P2435725
**/

namespace Gobbwobblers;

/*
use Graph;
use ScatterPlot;
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_scatter.php');
require_once ('jpgraph/src/jpgraph_date.php');
*/

class HtmlData
{

    public $simNo, $heater1, $name, $email, $keypad, $timeStamp, $rowSize, $username, $password, $servername, $dbname;
    public $switches;

    function __construct() {
        $this->simNo = 12345;
        $this->heater1 = 22;
        $this->name = "TempName";
        $this->email = "TempEmail";
        $this->keypad = 54321;
        $this->timeStamp = "12:34:56";
        $this->switches = 'On' . 'Off' . 'On' . 'Off' . 'On';
        $this->rowSize = $this->getRowSize();
        $this->username = 'admin';
        $this->password = 'root';
        $this->servername = 'localhost';
        $this->dbname = 'myDB';
    }

    public function getData(): array {

        $rowArray = [];
        $key = 0; $arrayNo = 1;

        for ($row = 0; $row < $this->rowSize; $row++) {
            $tempArray = $this->getArray($arrayNo);;
                array_push($rowArray, $tempArray);
            $key++; $arrayNo++;

            if($arrayNo == 5) {
                $arrayNo = 1;
            }
        }
        return $rowArray;
    }

	//redundant - outdated (for testing only)
    public function getDatabase() {
        $tempArray = [];
        $rowArray =[];
        //$chartArray =[];

        // Create connection
        $conn = new DatabaseWrapper();
        $conn->setProcedure("getAllMessages");
        $result = $conn->execute();
        if (is_array($result) && sizeof($result) > 0) {
            // Output data from each row
            for($row = 0; $row < sizeof($result); $row++) {
                $this->timeStamp = $result[$row]['timestamp'];
                $this->simNo = $result[$row]['phonenumber'];
                $this->heater1 = $result[$row]['heater1'];
                $this->name = $result[$row]['name'];
                $this->email = $result[$row]['email'];
                $this->switches = $result[$row]['sw1'] . ", " .  $result[$row]['sw2'] . ", " .  $result[$row]['sw3'] . ", " .  $result[$row]['sw4'] . ", " .  $result[$row]['fan1'];
                $this->keypad = $result[$row]['keypad'];
                $tempArray = ['simNo' => $this->simNo, 'timeStamp' => $this->timeStamp, 'heater1' => $this->heater1,
                               'name' => $this->name, 'email' => $this->email,
                               'switches' => $this->switches, 'keypad' => $this->keypad];
                array_push($rowArray, $tempArray);
                //array_push($chartArray, $tempArray);
            }
        } else {
            // Return string if no results are in the database
            return "0 Results";
        }
        /*$this->createGraph($chartArray);*/
        return $rowArray;
    }

    /*public function createGraph($array): Graph {
        $dataXArray = [];
        $dataYArray = [];
        $index = 0;

        for($row = 0; $row < sizeOf($array); $row++) {
            $dataXArray[$index] = $array->heater1;
            $dataYArray[$index] = $array->timeStamp;
        }

        $graph = new Graph(300,200);
        $graph->SetScale("datlin",0 ,100);

        $graph->img->SetMargin(40,40,40,40);
        $graph->SetShadow();

        $graph->title->Set("A simple scatter plot");
        $graph->title->SetFont(FF_FONT1,FS_BOLD);

        $chart = new ScatterPlot($dataYArray,$dataXArray);

        $graph->Add($chart);
        $graph->Stroke();
        return $graph;
    }*/

    public function getRowSize() {
        $rowSize = 5;
        if ($rowSize == 0) {
            $rowSize = "Error Database Empty.";
            return $rowSize;
        } else {
            $rowSize = 10;
            return $rowSize;
        }
    }

    public function getArray($int): array {
        switch($int) {
            case 1:
                return ['simNo' => 54321, 'name' => 'John', 'email' => 'John@chrome.com', 'switches' =>
                    $this->convBool(false) . $this->convBool(true) . $this->convBool(false)
                    . $this->convBool(true) . $this->convBool(false) . $this->convBool(true),
                    'heater1' => 432, 'keypad' => 'KeypadTemp', 'timeStamp' => "65:43:21"];
            case 2:
                return ['simNo' => 99999, 'name' => 'Daniel', 'email' => 'Daniel@hotmail.com', 'switches' =>
                    $this->convBool(false) . $this->convBool(false) . $this->convBool(false) .
                    $this->convBool(false) . $this->convBool(false) . $this->convBool(true),
                    'heater1' => 666, 'keypad' => 'TempPadPad', 'timeStamp' => "66:33:66"];
            case 3:
                return ['simNo' => 16561, 'name' => 'Jack', 'email' => 'Jack@hotmail.co.uk', 'switches' =>
                    $this->convBool(true) . $this->convBool(true) . $this->convBool(true) .
                    $this->convBool(true) . $this->convBool(true) . $this->convBool(false),
                    'heater1' => 111, 'keypad' => 'KeyTempPad', 'timeStamp' => "33:66:33"];
            case 4:
                return ['simNo' => 89898, 'name' => 'Josh', 'email' => 'Josh@chrome.com', 'switches' =>
                    $this->convBool(true) . $this->convBool(true) . $this->convBool(false) .
                    $this->convBool(true) . $this->convBool(true) . $this->convBool(true),
                    'heater1' => 232, 'keypad' => 'KeypadTemp', 'timeStamp' => "11:11:11"];
            case 5:
                return ['simNo' => 998877, 'name' => 'Lauren', 'email' => 'Lauren@gmail.com', 'switches' =>
                    $this->convBool(true) . $this->convBool(true) . $this->convBool(false) .
                    $this->convBool(true) . $this->convBool(true) . $this->convBool(true),
                    'heater1' => 999, 'keypad' => 'KeyKeyPad', 'timeStamp' => date('d,m,yy', '12122020')];
                echo 'timeStamp';
        }
    }

    public function convBool($bool): string {
        if($bool == true) {
            return "True ";
        } else if($bool == false) {
            return "False ";
        } else {
            echo 'Error';
        }
    }
}