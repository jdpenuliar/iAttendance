<?php
/**
 * Created by PhpStorm.
 * User: MrTechno
 * Date: 3/30/2016
 * Time: 11:47 AM
 */
    //require_once("../include/DBConfigs.php");
    //$classDBRelatedFunctions->functionUserSignup('05181995','abmkss','abmkss','abmkss',0,1,'abmkss','abmkss');

    require_once("../include/DBConfigs.php");
    echo $classDBRelatedFunctions->functionInternLogWeekTimeTotalAbsent(18,'2016-05-9 00:00:00','2016-05-11 23:59:00');
    break;
    $now = new DateTime();
    echo $now->add(new DateInterval('P1W'))->format('Y-m-d h:i:s');

    break;


    $to_time = strtotime("2008-1-13 10:42:00");
    $from_time = strtotime("2008-1-12 10:42:30");
    echo round(abs($to_time - $from_time) / 60,4)/60 . " hours";


    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    require_once("../include/DBConfigs.php");
    $userIDxxxxxx = 18;
    $classDBRelatedFunctions->functionInternLogListTimeDifference($userIDxxxxxx);

    break;
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=iattendance", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

    /*$sql = 'SELECT * FROM tbluser';
    foreach ($conn->query($sql) as $row) {
        print $row['userID'] . "\t";
        print $row['userName'] . "\t";
        print $row['userPassword'] . "\n";

    }*/



    require_once("../include/DBConfigs.php");
    $classDBRelatedFunctions->functionAddIntern("supervisor","supervisor","supervisor","0","supervisor","supervisor","supervisor","123","123","1");
?>