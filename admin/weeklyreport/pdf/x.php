<?php
    session_start();
    unset($_SESSION['sessionCompanyEditorActivation']);
    if(!isset($_SESSION['userID'])){
        header("Location: ../../../");
    }/*else{
        if(isset($_POST['btnSubmit'])){
            require_once("../include/DBConfigs.php");
            if($classDBRelatedFunctions->functionCheckUserLevel($_SESSION['userID']) == 2){
                $classDBRelatedFunctions->functionAddIntern($_POST['userName'],$_POST['userPassword'],$_POST['userReTypePassword'],$_POST['companyID'],$_POST['userFirstName'],$_POST['userMiddleName'],$_POST['userLastName'],$_POST['userPrimaryContact'],$_POST['userSecondaryContact'],$_POST['userEmailAddress'],$_POST['userAccountStatus']);
            }else{
                echo '<script language="javascript">';
                    echo 'alert("Invalid Supervisor credentials")';
                echo '</script>';
            }
        }
    }*/

?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>iAttendance</title>

        <link rel="shortcut icon" href="../assets/ico/favicon.png">
        <!-- Core CSS - Include with every page -->
        <link href="../../assets/css/pdf.css" rel="stylesheet" />
    </head>

    <body>
        
        <?php
            include("../../include/DBConfigs.php");
            // echo $_SESSION['sessionViewWeeklyReportUserID'];
            // echo "<br>";
            // echo $_SESSION['sessionViewWeeklyReportStartDate'];
            // echo "<br>";
            // echo $_SESSION['sessionViewWeeklyReportEndDate'];
            //echo "<script>window.close();</script>";
            $classDBRelatedFunctions->functionReportPDF($_SESSION['sessionViewWeeklyReportUserID'],$_SESSION['sessionViewWeeklyReportStartDate'],$_SESSION['sessionViewWeeklyReportEndDate']);
        ?>
        

    </body>

</html>
