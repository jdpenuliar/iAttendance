<?php
    session_start();

    unset($_SESSION['sessionInternEditorActivation']);
    require_once("../include/DBConfigs.php");
    if(!empty($_SESSION['userID'])){
        $userIDSX = $_SESSION['userID'];

        $result = $classDBRelatedFunctions->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userIDSX'")->fetch(PDO::FETCH_OBJ);
        $userID = $result->userID;
        $userFirstName = $result->userFirstName;
        $userLastName = $result->userLastName;


        $classDBRelatedFunctions->functionUserLog($userID, $userFirstName, $userLastName);
        session_destroy();
        header("Location: ../../");
    }
?>