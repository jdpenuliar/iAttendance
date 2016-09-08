<?php
	//Database connected functions
	$classDBRelatedFunctions = new classDBRelatedFunctions;
	//$classPDORelatedFunctions = new classPDORelatedFunctions;
	
	class classDBRelatedFunctions extends ZipArchive {
		private $saltChars;
		public $errorMessage;
		private $passwordFromDB;
		private $saltFromDB;
		function functionError(){
			if(!empty($this->errorMessage)){
				echo $this->errorMessage;
			}elseif(empty($this->errorMessage)){
				return "no error";	
			}
		}
		/*function functionDBConnect(){
			/*
			$host = "localhost";
			$database = "1097353";
			$username = "1097353";
			$password = "kajjeandagnes";



			 	$host = "localhost";
				$database = "iAttendance";
				$username = "root";
				$password = "";

			$host = "localhost";
			$database = "uaiatten_iattendance";
			$username = "uaiatten_admin";
			$password = "~ukNTcX^Hn+m";

			$DBConnection = mysql_connect("$host","$username","$password");
			$DBSelect = mysql_select_db($database, $DBConnection);
			if(!$DBSelect){
				die("Database selection failed: " . mysql_error());
			}
			return $DBConnection;
		}*/
		function functionDBConnectx(){
			$servername = "localhost";
			$username = "uaiatten_admin";
			$password = "uaiattendance";

			try {
				$conn = new PDO("mysql:host=$servername;dbname=uaiatten_iattendance", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e)
			{
				echo "Connection failed: " . $e->getMessage();
			}
			return $conn;
		}
		function functionDBDisconnect(){
			mysql_close($this->functionDBConnect());
		}
		function functionGenerateSalt(){
			return dechex(mt_rand(0,2147483647)).(mt_rand(0,2147483647));
		}
		function functionGenerateConfirmCode(){
			return dechex(mt_rand(0,2147483647)).(mt_rand(0,2147483647));
		}
		function functionCheckUserName($userName){
			$codeResult = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE username='$userName'");
			$count = $codeResult->rowCount();
			return $count? 1 : 0;
		}

		function functionCheckNotification($userID){
			$codeResult = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID' AND adminNotification = '1'");
			$count = $codeResult->rowCount();
			return $count? 1 : 0;
		}

		function functionGenerateFileID($userID){
			$this->functionDBConnect();
			for ($x=0; $x>=0; $x++){
				$checkFileID = "file" . $userID . $x;
				if($this->functionCheckFileID($checkFileID) == 1){
					echo 'Error! Failed to insert the file';
					break;
				}else{
					echo $fileID = $checkFileID;
					break;
				}
			} 
			
			return $fileID;
		}
		function functionCheckFileID($checkFileID){
			$codeResult = mysql_query("SELECT * FROM tblfile WHERE fileID='$checkFileID'" );
			return mysql_num_rows($codeResult)? 1 : 0;
		}
		function functionCheckUserID($userID){
			$codeResult = mysql_query("SELECT * FROM tbluser WHERE userID='$userID'" );
			return mysql_num_rows($codeResult)? 1 : 0;
		}
		function functionCheckPasswordSignUp($passWord1,$passWord2){
			if($passWord1 == $passWord2){
				return true;	
			}else{
				return false;	
			}
		}
		function functionEncryptPassword($password,$salt){
			$hashedPassword = hash('sha256',$password.$salt);
			for($round = 0; $round < 65536; $round++ ){
				$hashedPassword = hash('sha256',$hashedPassword.$salt);
			}
			return $hashedPassword;		
		}
		function functionUserSignup($userID, $userName, $userPassword, $userPasswordReType, $userLevel, $userAccountStatus, $userFirstName,$userLastName){
			$this->functionDBConnect();
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserID($userID) == 1){
				$this->errorMessage = "UserID Unavailable!";
				$this->functionError();
			}
			if($this->functionCheckUserName($userName) == 1){
				$this->errorMessage = "Username Unavailable!";
				$this->functionError();
			}
			if($this->functionCheckPasswordSignUp($userPassword,$userPasswordReType) == false){
				$this->errorMessage = "Password Unmatch!";
				$this->functionError();
			}else{
				$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);
			}


			$dateToday = date('Y') . "-" . date('m')  . "-" . date('d');
			$SQLQuery = "INSERT INTO tbluser
			(userID, userName, userPassword, salt, userFirstName, userLastName, userLevel, userAccountStatus, userRegistrationDate)
			VALUES('$userID', '$userName', '$encryptedPassword', '$salt', '$userFirstName', '$userLastName', '$userLevel', '$userAccountStatus', '$dateToday')";
			if (!mysql_query($SQLQuery,$this->functionDBConnect()))
			{
				die ('Error: ' . mysql_error());
			}


			/*$dateToday = date('Y') . "-" . date('m')  . "-" . date('d'). " " . date('h')  . ":" . date('i'). ":" . date('s');
			$SQLQuery = "INSERT INTO tbluser
			(userID, userName, userPassword, salt, userFirstName, userLastName, userLevel, userAccountStatus, userRegistrationDate)
			VALUES
			('$userID','$userName','$encryptedPassword','$salt','$userFirstName','$userLastName','2','1','$dateToday')";
			if (!mysql_query($SQLQuery,$this->functionDBConnect()))
			{
				die ('Error: ' . mysql_error());
			}*/
		}


		function functionGetPasswordFromDB($userName){
			$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE username='$userName'")->fetch(PDO::FETCH_OBJ);
			$this->saltFromDB = $result->salt;
			$this->passwordFromDB = $result->userPassword;
		}

		function functionCompanyList(){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tblcompanies ")->fetchAll();
			echo '<option></option>';
			foreach ($users as $row) {
					echo '<option value="'. $row['companyID'] .'">'. $row['companyName'] . '</option>';
			}

			$this->functionDBConnectx()->null;

		}

		function functionCompanyListX(){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tblcompanies ")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				if($counter%2==0){
					echo '<tr class="even gradeC">';
				}else{
					echo '<tr class="odd gradeX">';
				}

				/*echo '<td><button value="'. $row['userID'] .'" type="button" onClick="process(value);" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View</button></td>';*/
				echo '
					<form role="form" action="./" method="post" class="registration-form">
					 	<input type="hidden" name="sessionCompanyEditorActivation" value="1">
					 	<input type="hidden" name="sessionEditCompanyID" value="'. $row['companyID'] .'">
					 	<input type="hidden" name="sessionEditCompanyName" value="'. $row['companyName'] .'">
					 	<input type="hidden" name="sessionEditCompanyAddress" value="'. $row['companyAddress'] .'">
					 	<input type="hidden" name="sessionEditCompanyContact" value="'. $row['companyContact'] .'">
						<td><button name="btnEditInfoSetter" value="'. $row['userID'] .'" class="btn btn-info btn-lg">Edit</button></td>
					</form>

				';


				echo '<td>'. $row['companyID'] . '</td>';
				echo '<td>'. $row['companyName'] . '</td>';
				echo '<td>'. $row['companyAddress'] . '</td>';
				echo '<td>'. $row['companyContact'] . '</td>';
				echo '</tr>';
				$counter++;
			}

			$this->functionDBConnectx()->null;

		}


		function functionCompanyListEditX($companyID){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tblcompanies WHERE companyID='$companyID'")->fetchAll();
			foreach ($users as $row) {
				$companyNameReturn = $row['companyName'];
			}
			$this->functionDBConnectx()->null;
			return $companyNameReturn;
		}

		function functionInternLogList(){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tbl_logs")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				$userID = $row['userID'];
				$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID' AND userLevel='3'")->fetch(PDO::FETCH_OBJ);
				$userName = $result->userName;
				$userFirstName = $result->userFirstName;
				$userLastName = $result->userLastName;
				$userLevel = $result->userLevel;
				$userCompanyID = $result->userCompanyID;
				if($userLevel == 3){
					if($counter%2==0){
						echo '<tr class="even gradeC">';
					}else{
						echo '<tr class="odd gradeX">';
					}
					echo '<td>'. $row['userID'] . '</td>';
					echo '<td>'. $userName . '</td>';
					echo '<td>'. $userFirstName . '</td>';
					echo '<td>'. $userLastName . '</td>';
					$companyResult = $this->functionDBConnectx()->query("SELECT * FROM tblcompanies WHERE companyID='$userCompanyID'")->fetch(PDO::FETCH_OBJ);
					$companyName = $companyResult->companyName;
					echo '<td>'. $companyName . '</td>';
					echo '<td>'. $row['userActivity'] . '</td>';
					echo '<td>'. $row['userDateTime'] . '</td>';
					echo '</tr>';
					$counter++;
				}


			}

			$this->functionDBConnectx()->null;

		}

		function functionInternLogWeekTimeTotal($internTotalHourUserID,$userStartDate,$userEndDate){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$totalHours = 0;
			$inShiftX = 0;
			$outShiftX = 0;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tbl_logs  WHERE userID='$internTotalHourUserID' AND userDateTime between '$userStartDate' and '$userEndDate'")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				$userID = $row['userID'];
				$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$internTotalHourUserID' AND userLevel='3'")->fetch(PDO::FETCH_OBJ);
				$userName = $result->userName;
				$userFirstName = $result->userFirstName;
				$userLastName = $result->userLastName;
				$userLevel = $result->userLevel;
				if($userLevel == 3){
					/*if($counter%2==0){
						echo '<tr class="even gradeC">';
					}else{
						echo '<tr class="odd gradeX">';
					}
					echo '<td>'. $row['userID'] . '</td>';
					echo '<td>'. $userName . '</td>';
					echo '<td>'. $userFirstName . '</td>';
					echo '<td>'. $userLastName . '</td>';
					echo '<td>'. $row['userActivity'] . '</td>';
					echo '<td>'. $row['userDateTime'] . '</td>';
					echo '</tr>';*/

					if($row['userActivity'] == "In Shift"){
						$inShiftX = strtotime($row['userDateTime']);
					}else if($row['userActivity'] == "Out Shift"){
						$outShiftX = strtotime($row['userDateTime']);
						$totalHours = $totalHours + (round(abs($outShiftX - $inShiftX) / 60,4)/60);
					}

					/*$to_time = strtotime("2008-1-13 10:42:00");
					$from_time = strtotime("2008-1-12 10:42:30");
					echo round(abs($to_time - $from_time) / 60,4)/60 . " hours";*/

					/*$counter++;*/
				}


			}
			$this->functionDBConnectx()->null;

			return $totalHours;
			//return "abmkss";
		}

		function functionReportPDF($viewWeeklyReportUserID,$viewWeeklyReportStartDate,$viewWeeklyReportEndDate){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$totalHours = 0;
			$inShiftX = 0;
			$outShiftX = 0;

			$result = $this->functionDBConnectx()->query("SELECT concat(tbluser.userFirstName, ' ', tbluser.userMiddleName, ' ', tbluser.userLastName) as 'xx',tblcompanies.companyName as 'zz' FROM tbluser JOIN tblcompanies on tbluser.userCompanyID = tblcompanies.companyID WHERE tbluser.userID = '$viewWeeklyReportUserID'")->fetch(PDO::FETCH_OBJ);
				$userNamez = $result->xx;
				$userCompanyNamez = $result->zz;
			echo "<h1>Name: ".$userNamez ."</h1>";
			echo "<h2>Company: ".$userCompanyNamez ."</h2>";
			echo "<br>";
			$users = $this->functionDBConnectx()->query("SELECT * FROM tbl_logs  WHERE userID='$viewWeeklyReportUserID' AND userDateTime between '$viewWeeklyReportStartDate' and '$viewWeeklyReportEndDate'")->fetchAll();
			echo "<table>";
				echo '<tr>
		                <th>userActivity</th>
		                <th>userDateTime</th>
		            </tr>';
				foreach ($users as $row) {
					echo "<tr>";
						echo "<td>" . $row['userActivity'] . "</td>";
						echo "<td>" . $row['userDateTime'] . "</td>";
					echo "</tr>";
				}
			echo "</table>";
	            
	            
			$this->functionDBConnectx()->null;

			//return $null;
			//return "abmkss";
		}

		function functionInternLogWeekTimeTotalAbsent($internTotalHourUserID,$userStartDate,$userEndDate){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$totalHours = 0;
			$inShiftX = 0;
			$outShiftX = 0;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tbl_logs  WHERE userID='$internTotalHourUserID' AND userDateTime between '$userStartDate' and '$userEndDate'")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				$userID = $row['userID'];
				$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$internTotalHourUserID' AND userLevel='3'")->fetch(PDO::FETCH_OBJ);
				$userName = $result->userName;
				$userFirstName = $result->userFirstName;
				$userLastName = $result->userLastName;
				$userLevel = $result->userLevel;
				if($userLevel == 3){
					/*if($counter%2==0){
						echo '<tr class="even gradeC">';
					}else{
						echo '<tr class="odd gradeX">';
					}
					echo '<td>'. $row['userID'] . '</td>';
					echo '<td>'. $userName . '</td>';
					echo '<td>'. $userFirstName . '</td>';
					echo '<td>'. $userLastName . '</td>';
					echo '<td>'. $row['userActivity'] . '</td>';
					echo '<td>'. $row['userDateTime'] . '</td>';
					echo '</tr>';*/

					
					if($row['userActivity'] == "Out Shift"){
						$outShiftX = strtotime($row['userDateTime']);
						echo $row['userDateTime'] . "outshift<br>";

					}else if($row['userActivity'] == "In Shift"){
						$inShiftX = strtotime($row['userDateTime']);
						echo $row['userDateTime'] . "inshift<br>";
						echo round(abs($outShiftX - $inShiftX) / 60,4)/60;
						echo "<br>";
						/*if(round(abs($outShiftX - $inShiftX) / 60,4)/60 ){
							echo $x = (round(abs($outShiftX - $inShiftX) / 60,4)/60) . " abmkss " . "<br>";
							//echo $x = (round(abs($outShiftX + 24)/ 60,4)/60) . " abmkss " . "<br>";
						}else{
							echo $x = (round(abs($outShiftX - $inShiftX) / 60,4)/60) . " abmkssx " . "<br>";
						}*/
						//echo (round(abs($outShiftX - $inShiftX)));
					}


					/*$to_time = strtotime("2008-1-13 10:42:00");
					$from_time = strtotime("2008-1-12 10:42:30");
					echo round(abs($to_time - $from_time) / 60,4)/60 . " hours";*/

					/*$counter++;*/
				}


			}
			$this->functionDBConnectx()->null;

			return $totalHours;
			//return "abmkss";
		}



		function functionInternLogListTimeDifference($internTotalHourUserID){
			//$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			//$userName = $result->userName;
			//$userFirstName = $result->userFirstName;
			//$userLastName = $result->userLastName;
			//$userLevel = $result->userLevel;

			$totalHours = 0;
			$inShiftX = 0;
			$outShiftX = 0;

			$users = $this->functionDBConnectx()->query("SELECT * FROM tbl_logs  WHERE userID='$internTotalHourUserID'")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				$userID = $row['userID'];
				$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$internTotalHourUserID' AND userLevel='3'")->fetch(PDO::FETCH_OBJ);
				$userName = $result->userName;
				$userFirstName = $result->userFirstName;
				$userLastName = $result->userLastName;
				$userLevel = $result->userLevel;
				if($userLevel == 3){
					/*if($counter%2==0){
						echo '<tr class="even gradeC">';
					}else{
						echo '<tr class="odd gradeX">';
					}
					echo '<td>'. $row['userID'] . '</td>';
					echo '<td>'. $userName . '</td>';
					echo '<td>'. $userFirstName . '</td>';
					echo '<td>'. $userLastName . '</td>';
					echo '<td>'. $row['userActivity'] . '</td>';
					echo '<td>'. $row['userDateTime'] . '</td>';
					echo '</tr>';*/

					if($row['userActivity'] == "In Shift"){
						$inShiftX = strtotime($row['userDateTime']);
					}else if($row['userActivity'] == "Out Shift"){
						$outShiftX = strtotime($row['userDateTime']);
						$totalHours = $totalHours + (round(abs($outShiftX - $inShiftX) / 60,4)/60);
					}

					/*$to_time = strtotime("2008-1-13 10:42:00");
					$from_time = strtotime("2008-1-12 10:42:30");
					echo round(abs($to_time - $from_time) / 60,4)/60 . " hours";*/

					/*$counter++;*/
				}


			}
			$this->functionDBConnectx()->null;

			return $totalHours;
		}

		function functionInternList($userID){
			$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			$userLevel = $result->userLevel;

			if($userLevel == 2){
				//supervisor
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel= '3'")->fetchAll();
			}else if($userLevel == 1){
				//dean
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel =  '3'")->fetchAll();
			}else if($userLevel == 0){
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel >  '0'")->fetchAll();
			}
			$counter = 1;
			foreach ($users as $row) {
				if($counter%2==0){
					echo '<tr class="even gradeC">';
				}else{
					echo '<tr class="odd gradeX">';
				}

				echo '<td><button value="'. $row['userID'] .'" type="button" onClick="process(value);" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View</button></td>';
				echo '
					<form role="form" action="./" method="post" class="registration-form">
					 	<input type="hidden" name="sessionInternEditorActivation" value="1">
					 	<input type="hidden" name="sessionEditInternUserID" value="'. $row['userID'] .'">
					 	<input type="hidden" name="sessionEditInternUserName" value="'. $row['userName'] .'">
					 	<input type="hidden" name="sessionEditInternUserFirstName" value="'. $row['userFirstName'] .'">
					 	<input type="hidden" name="sessionEditInternUserMiddleName" value="'. $row['userMiddleName'] .'">
					 	<input type="hidden" name="sessionEditInternUserLastName" value="'. $row['userLastName'] .'">
					 	<input type="hidden" name="sessionEditInternUserCompanyID" value="'. $row['userCompanyID'] .'">
					 	<input type="hidden" name="sessionEditInternUserPrimaryContact" value="'. $row['userPrimaryContact'] .'">
					 	<input type="hidden" name="sessionEditInternUserSecondaryContact" value="'. $row['userSecondaryContact'] .'">
					 	<input type="hidden" name="sessionEditInternUserEmailAddress" value="'. $row['userEmailAddress'] .'">
					 	<input type="hidden" name="sessionEditInternUserAccountStatus" value="'. $row['userAccountStatus'] .'">
						<td><button name="btnEditInfoSetter" value="'. $row['userID'] .'" class="btn btn-info btn-lg">Edit</button></td>
					</form>

				';
				echo '
					<form role="form" action="./" method="post" class="registration-form">
					 	<input type="hidden" name="sessionViewWeeklyReportActivation" value="1">
					 	<input type="hidden" name="sessionViewWeeklyReportUserID" value="'. $row['userID'] .'">
						<td><button name="btnViewWeeklyReportSetter" value="'. $row['userID'] .'" class="btn btn-info btn-lg">Report</button></td>
					</form>

				';
				echo '<td>'. $row['userID'] . '</td>';
				echo '<td>'. $row['userName'] . '</td>';
				echo '<td>'. $row['userFirstName'] . '</td>';
				echo '<td>'. $row['userLastName'] . '</td>';
				echo '<td>'. $row['userLevel'] . '</td>';
				echo '<td>'. $row['userAccountStatus'] . '</td>';
				echo '<td>'. $row['userRegistrationDate'] . '</td>';
				echo '</tr>';
				$counter++;
			}

			$this->functionDBConnectx()->null;

		}

		function functionSupervisorList($userID){
			$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			$userLevel = $result->userLevel;

			if($userLevel == 2){
				//supervisor
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel= '3'")->fetchAll();
			}else if($userLevel == 1){
				//dean
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel =  '2'")->fetchAll();
			}else if($userLevel == 0){
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel >  '0'")->fetchAll();
			}
			//$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel =  '2'")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				if($counter%2==0){
					echo '<tr class="even gradeC">';
				}else{
					echo '<tr class="odd gradeX">';
				}

				echo '<td><button value="'. $row['userID'] .'" type="button" onClick="process(value);" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View</button></td>';
				echo '
					<form role="form" action="./" method="post" class="registration-form">
					 	<input type="hidden" name="sessionSupervisorEditorActivation" value="1">
					 	<input type="hidden" name="sessionEditSupervisorUserID" value="'. $row['userID'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserName" value="'. $row['userName'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserFirstName" value="'. $row['userFirstName'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserMiddleName" value="'. $row['userMiddleName'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserLastName" value="'. $row['userLastName'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserCompanyID" value="'. $row['userCompanyID'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserPrimaryContact" value="'. $row['userPrimaryContact'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserSecondaryContact" value="'. $row['userSecondaryContact'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserEmailAddress" value="'. $row['userEmailAddress'] .'">
					 	<input type="hidden" name="sessionEditSupervisorUserAccountStatus" value="'. $row['userAccountStatus'] .'">
						<td><button name="btnEditInfoSetter" value="'. $row['userID'] .'" class="btn btn-info btn-lg">Edit</button></td>
					</form>

				';
				echo '';
				echo '<td>'. $row['userID'] . '</td>';
				echo '<td>'. $row['userName'] . '</td>';
				echo '<td>'. $row['userFirstName'] . '</td>';
				echo '<td>'. $row['userLastName'] . '</td>';
				echo '<td>'. $row['userLevel'] . '</td>';
				echo '<td>'. $row['userAccountStatus'] . '</td>';
				echo '<td>'. $row['userRegistrationDate'] . '</td>';
				echo '</tr>';
				$counter++;
			}

			$this->functionDBConnectx()->null;

		}

		function functionDeanList($userID){
			$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			$userLevel = $result->userLevel;

			if($userLevel == 2){
				//supervisor
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel= '3'")->fetchAll();
			}else if($userLevel == 1){
				//dean
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel =  '2'")->fetchAll();
			}else if($userLevel == 0){
				$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel =  '1'")->fetchAll();
			}
			//$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userLevel =  '2'")->fetchAll();
			$counter = 1;
			foreach ($users as $row) {
				if($counter%2==0){
					echo '<tr class="even gradeC">';
				}else{
					echo '<tr class="odd gradeX">';
				}

				echo '<td><button value="'. $row['userID'] .'" type="button" onClick="process(value);" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View</button></td>';
				echo '
					<form role="form" action="./" method="post" class="registration-form">
					 	<input type="hidden" name="sessionDeanEditorActivation" value="1">
					 	<input type="hidden" name="sessionEditDeanUserID" value="'. $row['userID'] .'">
					 	<input type="hidden" name="sessionEditDeanUserName" value="'. $row['userName'] .'">
					 	<input type="hidden" name="sessionEditDeanUserFirstName" value="'. $row['userFirstName'] .'">
					 	<input type="hidden" name="sessionEditDeanUserMiddleName" value="'. $row['userMiddleName'] .'">
					 	<input type="hidden" name="sessionEditDeanUserLastName" value="'. $row['userLastName'] .'">
					 	<input type="hidden" name="sessionEditDeanUserCompanyID" value="'. $row['userCompanyID'] .'">
					 	<input type="hidden" name="sessionEditDeanUserPrimaryContact" value="'. $row['userPrimaryContact'] .'">
					 	<input type="hidden" name="sessionEditDeanUserSecondaryContact" value="'. $row['userSecondaryContact'] .'">
					 	<input type="hidden" name="sessionEditDeanUserEmailAddress" value="'. $row['userEmailAddress'] .'">
					 	<input type="hidden" name="sessionEditDeanUserAccountStatus" value="'. $row['userAccountStatus'] .'">
						<td><button name="btnEditInfoSetter" value="'. $row['userID'] .'" class="btn btn-info btn-lg">Edit</button></td>
					</form>

				';
				echo '';
				echo '<td>'. $row['userID'] . '</td>';
				echo '<td>'. $row['userName'] . '</td>';
				echo '<td>'. $row['userFirstName'] . '</td>';
				echo '<td>'. $row['userLastName'] . '</td>';
				echo '<td>'. $row['userLevel'] . '</td>';
				echo '<td>'. $row['userAccountStatus'] . '</td>';
				echo '<td>'. $row['userRegistrationDate'] . '</td>';
				echo '</tr>';
				$counter++;
			}

			$this->functionDBConnectx()->null;

		}

		function functionInternInfo($userID){
			$userIDTotalTime = $userID;
			$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID = '$userID'")->fetchAll();
			foreach ($users as $row) {
				echo "<user>";
					echo "<userID>";
						if(!empty($row['userID'])){
							echo $row['userID'];
						}else{
							echo "Not Applicable";
						}
					echo "</userID>";
					echo "<userName>";
						if(!empty($row['userName'])){
							echo $row['userName'];
						}else{
							echo "Not Applicable";
						}
					echo "</userName>";
					echo "<userFirstName>";
						if(!empty($row['userFirstName'])){
							echo $row['userFirstName'];
						}else{
							echo "Not Applicable";
						}
					echo "</userFirstName>";
					echo "<userMiddleName>";
						if(!empty($row['userMiddleName'])){
							echo $row['userMiddleName'];
						}else{
							echo "Not Applicable";
						}
					echo "</userMiddleName>";
					echo "<userLastName>";
						if(!empty($row['userLastName'])){
							echo $row['userLastName'];
						}else{
							echo "Not Applicable";
						}
					echo "</userLastName>";
					echo "<userLevel>";
						if(!empty($row['userLevel'])){
							echo $row['userLevel'];
						}else{
							echo "Not Applicable";
						}
					echo "</userLevel>";
					echo "<userCompanyID>";
						if(!empty($row['userCompanyID'])){
							echo $row['userCompanyID'];
						}else{
							echo "Not Applicable";
						}
					echo "</userCompanyID>";
					echo "<userPrimaryContact>";
						if(!empty($row['userPrimaryContact'])){
							echo $row['userPrimaryContact'];
						}else{
							echo "Not Applicable";
						}
					echo "</userPrimaryContact>";
					echo "<userSecondaryContact>";
						if(!empty($row['userSecondaryContact'])){
							echo $row['userSecondaryContact'];
						}else{
							echo "Not Applicable";
						}
					echo "</userSecondaryContact>";
					echo "<userEmailAddress>";
						if(!empty($row['userEmailAddress'])){
							echo $row['userEmailAddress'];
						}else{
							echo "Not Applicable";
						}
					echo "</userEmailAddress>";
					echo "<userAccountStatus>";
						if(!empty($row['userAccountStatus'])){
							echo $row['userAccountStatus'];
						}else{
							echo "Not Applicable";
						}
					echo "</userAccountStatus>";
					echo "<userRegistrationDate>";
						if(!empty($row['userRegistrationDate'])){
							echo $row['userRegistrationDate'];
						}else{
							echo "Not Applicable";
						}
					echo "</userRegistrationDate>";
					echo "<userTotalHours>";
						echo $this->functionInternLogListTimeDifference($userIDTotalTime);
					echo "</userTotalHours>";
					echo "<userRemainingHours>";
						echo $remainingHours = 486 - $this->functionInternLogListTimeDifference($userIDTotalTime);
					echo "</userRemainingHours>";
				echo "</user>";

			}
			$this->functionDBConnectx()->null;
		}


		function functionWeeklyReport($userID,$userStartDate,$userEndDate){
			$userIDTotalTime = $userID;
			$userStartDatex = $userStartDate;
			$userEndDatex = $userEndDate;
			$users = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID = '$userID'")->fetchAll();
			foreach ($users as $row) {
				echo "<user>";
					echo "<userID>";
						echo $row['userID'];
					echo "</userID>";
					echo "<userTotalWeekTime>";
						echo $this->functionInternLogWeekTimeTotal($userIDTotalTime,$userStartDatex,$userEndDatex);
					echo "</userTotalWeekTime>";
					echo "<userFirstName>";
						echo $row['userFirstName'];
					echo "</userFirstName>";
					echo "<userMiddleName>";
						echo $row['userMiddleName'];
					echo "</userMiddleName>";
					echo "<userLastName>";
						echo $row['userLastName'];
					echo "</userLastName>";
					echo "<userLevel>";
						echo $row['userLevel'];
					echo "</userLevel>";
					echo "<userCompanyID>";
						echo $row['userCompanyID'];
					echo "</userCompanyID>";
					echo "<userPrimaryContact>";
						echo $row['userPrimaryContact'];
					echo "</userPrimaryContact>";
					echo "<userSecondaryContact>";
						echo $row['userSecondaryContact'];
					echo "</userSecondaryContact>";
					echo "<userEmailAddress>";
						echo $row['userEmailAddress'];
					echo "</userEmailAddress>";
					echo "<userAccountStatus>";
						echo $row['userAccountStatus'];
					echo "</userAccountStatus>";
					echo "<userRegistrationDate>";
						echo $row['userRegistrationDate'];
					echo "</userRegistrationDate>";
					echo "<userTotalHours>";
						echo $this->functionInternLogWeekTimeTotal($userIDTotalTime,$userStartDate,$userEndDate);
					echo "</userTotalHours>";
					echo "<userRemainingHours>";
						echo $remainingHours = 486 - $this->functionInternLogListTimeDifference($userIDTotalTime);
					echo "</userRemainingHours>";
				echo "</user>";

			}
			$this->functionDBConnectx()->null;
		}

		function functionUserLog($userID,$userFirstName,$userLastName){
			$this->functionDBConnectx();
			$result = $this->functionDBConnectx()->query("SELECT * FROM tbl_logs WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);



			$query = "SELECT * FROM tbl_logs WHERE userID='$userID'";
			$sql = $this->functionDBConnectx()->prepare($query);
			$sql->execute();
			$data = $sql->fetchAll();


			foreach($data as $row) {
				$log = $row['userActivity'];

			}

			if(empty($log)) {
				$logInput = "In Shift";
			}else if($log == "In Shift"){
				$logInput = "Out Shift";
			}else if($log == "Out Shift"){
				$logInput = "In Shift";
			}


			date_default_timezone_set("Asia/Bangkok");
			$_SESSION['message'] = $userFirstName . " " . $userLastName . " " . $logInput . " " . date("Y-m-d h:i:s A");
			$datetime = date("Y-m-d h:i:s A");

			try {
				// prepare sql and bind parameters
				$stmt = $this->functionDBConnectx()->prepare("INSERT INTO tbl_logs
				(userID, userActivity, userRemarks, userDateTime)
				VALUES(:userID, :userActivity, 'remarks', :userDateTime)");
				$stmt->bindParam(':userID', $ParamUserID);
				$stmt->bindParam(':userActivity', $ParamLogInput);
				$stmt->bindParam(':userDateTime', $ParamDatetime);

				// insert a row
				$ParamUserID = $userID;
				$ParamLogInput = $logInput;
				$ParamDatetime = $datetime;
				$stmt->execute();

			}
			catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
			//$stmt->close();
			$this->functionDBConnectx()->null;

		}

		function functionCheckUserLevel($userID){
			$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE userID='$userID'")->fetch(PDO::FETCH_OBJ);
			$userLevel = $result->userLevel;
			return $userLevel;
		}

		function functionSetNotification(){
			try {
				// prepare sql and bind parameters
				$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							adminNotification = :notification
							WHERE userLevel != :userLevel");
				$stmt->bindParam(':userLevel', $ParamUserlevel);
				$stmt->bindParam(':notification', $ParamNotification);
				// insert a row
				$ParamUserlevel = 3;
				$ParamNotification = 1;
				$stmt->execute();

			}catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
			$this->functionDBConnectx()->null;
		}

		function functionUnsetNotification(){
			try {
				// prepare sql and bind parameters
				$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							adminNotification = :notification
							WHERE userLevel != :userLevel");
				$stmt->bindParam(':userLevel', $ParamUserlevel);
				$stmt->bindParam(':notification', $ParamNotification);
				// insert a row
				$ParamUserlevel = 3;
				$ParamNotification = 0;
				$stmt->execute();

			}catch(PDOException $e)
			{
				echo "Error: " . $e->getMessage();
			}
			$this->functionDBConnectx()->null;
		}

		function functionUserAuthentication($username,$password,$loginLevel){
			if($this->functionCheckUserName($username) == 0){
				$this->errorMessage = "Username Unavailable!";
				$this->functionError();

			}
			$this->functionGetPasswordFromDB($username);
			$loginSalt = $this->saltFromDB;
			$newEncryptedPassword = $this->functionEncryptPassword($password,$loginSalt);
			$encrypt = $this->passwordFromDB;
			if($this->functionCheckPasswordSignUp($encrypt,$newEncryptedPassword) == true){
				$result = $this->functionDBConnectx()->query("SELECT * FROM tbluser WHERE username='$username' and userPassword='$newEncryptedPassword'")->fetch(PDO::FETCH_OBJ);
				$userID = $result->userID;
				$userName = $result->userName;
				$userFirstName = $result->userFirstName;
				$userLastName = $result->userLastName;
				$userLevel = $result->userLevel;

				if($userLevel < 3){
					$_SESSION['userID'] = $userID;
					$_SESSION['loginUserFirstName'] = $userFirstName;
					$_SESSION['loginUserLastName'] = $userLastName;
					if($userLevel == 2){
						$_SESSION['loginUserLevel'] = "Supervisor";
					}else if($userLevel == 1){
						$_SESSION['loginUserLevel'] = "Dean";
					}else if($userLevel == 0){
						$_SESSION['loginUserLevel'] = "Admin";
					}
				}
				if(!empty($userID) and $userLevel==3 and $loginLevel == 1){
					$this->functionUserLog($userID,$userFirstName,$userLastName);
					$this->functionSetNotification();
				}else if(!empty($userID) and $userLevel!=3 and $loginLevel == 0){
					$this->functionUserLog($userID,$userFirstName,$userLastName);
				}



				unset($_POST['GITM']);
				return $userLevel;
			}else{
				return -1;
			}

		}

		function functionAddIntern($userName,$userPassword,$userReTypePassword,$companyID,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact,$userEmailAddress,$userAccountStatus){
			//echo $userName,$userPassword,$userReTypePassword,$companyID,$userAccountStatus,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact;
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserName($userName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
					echo 'alert("Username taken")';
				echo '</script>';
			}else{
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					//$this->errorMessage = "Password Unmatch!";
					//$this->functionError();
					echo '<script language="javascript">';
						echo 'alert("Password does not match")';
					echo '</script>';
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);

					date_default_timezone_set("Asia/Bangkok");
					$datetime = date("Y-m-d h:i:s");

					try {
						// prepare sql and bind parameters
						$stmt = $this->functionDBConnectx()->prepare("INSERT INTO tbluser
						(userName, userPassword, salt, userFirstName, userMiddleName, userLastName,userLevel, userCompanyID, userPrimaryContact, userSecondaryContact, userEmailAddress, userAccountStatus, userRegistrationDate)
						VALUES(:userName, :userPassword, :salt, :userFirstName, :userMiddleName, :userLastName, :userLevel, :userCompanyID, :userPrimaryContact, :userSecondaryContact, :userEmailAddress, :userAccountStatus, :userRegistrationDate)");
						$stmt->bindParam(':userName', $ParamUserName);
						$stmt->bindParam(':userPassword', $ParamUserPassword);
						$stmt->bindParam(':salt', $ParamSalt);
						$stmt->bindParam(':userFirstName', $ParamUserFirstName);
						$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
						$stmt->bindParam(':userLastName', $ParamUserLastName);
						$stmt->bindParam(':userLevel', $ParamUserLevel);
						$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
						$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
						$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
						$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
						$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
						$stmt->bindParam(':userRegistrationDate', $ParamUserRegistrationDate);
						// insert a row
						$ParamUserName = $userName;
						$ParamUserPassword = $encryptedPassword;
						$ParamSalt = $salt;
						$ParamUserFirstName = $userFirstName;
						$ParamUserMiddleName = $userMiddleName;
						$ParamUserLastName = $userLastName;
						$ParamUserLevel = '3';
						$ParamUserCompanyID = $companyID;
						$ParamUserPrimaryContact = $userPrimaryContact;
						$ParamUserSecondaryContact = $userSecondaryContact;
						$ParamUserEmailAddress = $userEmailAddress;
						$ParamUserAccountStatus = $userAccountStatus;
						$ParamUserRegistrationDate = $datetime;
						$stmt->execute();

					}catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					$this->functionDBConnectx()->null;
				}
			}
		}

		function functionAddSupervisor($userName,$userPassword,$userReTypePassword,$companyID,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact,$userEmailAddress,$userAccountStatus){
			//echo $userName,$userPassword,$userReTypePassword,$companyID,$userAccountStatus,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact;
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserName($userName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
					echo 'alert("Username taken")';
				echo '</script>';
			}else{
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					//$this->errorMessage = "Password Unmatch!";
					//$this->functionError();
					echo '<script language="javascript">';
					echo 'alert("Password does not match")';
					echo '</script>';
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);

					date_default_timezone_set("Asia/Bangkok");
					$datetime = date("Y-m-d h:i:s");

					try {
						// prepare sql and bind parameters
						$stmt = $this->functionDBConnectx()->prepare("INSERT INTO tbluser
						(userName, userPassword, salt, userFirstName, userMiddleName, userLastName,userLevel, userCompanyID, userPrimaryContact, userSecondaryContact, userEmailAddress, userAccountStatus, userRegistrationDate)
						VALUES(:userName, :userPassword, :salt, :userFirstName, :userMiddleName, :userLastName, :userLevel, :userCompanyID, :userPrimaryContact, :userSecondaryContact, :userEmailAddress, :userAccountStatus, :userRegistrationDate)");
						$stmt->bindParam(':userName', $ParamUserName);
						$stmt->bindParam(':userPassword', $ParamUserPassword);
						$stmt->bindParam(':salt', $ParamSalt);
						$stmt->bindParam(':userFirstName', $ParamUserFirstName);
						$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
						$stmt->bindParam(':userLastName', $ParamUserLastName);
						$stmt->bindParam(':userLevel', $ParamUserLevel);
						$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
						$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
						$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
						$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
						$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
						$stmt->bindParam(':userRegistrationDate', $ParamUserRegistrationDate);
						// insert a row
						$ParamUserName = $userName;
						$ParamUserPassword = $encryptedPassword;
						$ParamSalt = $salt;
						$ParamUserFirstName = $userFirstName;
						$ParamUserMiddleName = $userMiddleName;
						$ParamUserLastName = $userLastName;
						$ParamUserLevel = '2';
						$ParamUserCompanyID = $companyID;
						$ParamUserPrimaryContact = $userPrimaryContact;
						$ParamUserSecondaryContact = $userSecondaryContact;
						$ParamUserEmailAddress = $userEmailAddress;
						$ParamUserAccountStatus = $userAccountStatus;
						$ParamUserRegistrationDate = $datetime;
						$stmt->execute();

					}catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					$this->functionDBConnectx()->null;
				}
			}
		}

		function functionAddDean($userName,$userPassword,$userReTypePassword,$companyID,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact,$userEmailAddress,$userAccountStatus){
			//echo $userName,$userPassword,$userReTypePassword,$companyID,$userAccountStatus,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact;
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserName($userName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
				echo 'alert("Username taken")';
				echo '</script>';
			}else{
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					//$this->errorMessage = "Password Unmatch!";
					//$this->functionError();
					echo '<script language="javascript">';
					echo 'alert("Password does not match")';
					echo '</script>';
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);

					date_default_timezone_set("Asia/Bangkok");
					$datetime = date("Y-m-d h:i:s");

					try {
						// prepare sql and bind parameters
						$stmt = $this->functionDBConnectx()->prepare("INSERT INTO tbluser
						(userName, userPassword, salt, userFirstName, userMiddleName, userLastName,userLevel, userCompanyID, userPrimaryContact, userSecondaryContact, userEmailAddress, userAccountStatus, userRegistrationDate)
						VALUES(:userName, :userPassword, :salt, :userFirstName, :userMiddleName, :userLastName, :userLevel, :userCompanyID, :userPrimaryContact, :userSecondaryContact, :userEmailAddress, :userAccountStatus, :userRegistrationDate)");
						$stmt->bindParam(':userName', $ParamUserName);
						$stmt->bindParam(':userPassword', $ParamUserPassword);
						$stmt->bindParam(':salt', $ParamSalt);
						$stmt->bindParam(':userFirstName', $ParamUserFirstName);
						$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
						$stmt->bindParam(':userLastName', $ParamUserLastName);
						$stmt->bindParam(':userLevel', $ParamUserLevel);
						$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
						$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
						$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
						$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
						$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
						$stmt->bindParam(':userRegistrationDate', $ParamUserRegistrationDate);
						// insert a row
						$ParamUserName = $userName;
						$ParamUserPassword = $encryptedPassword;
						$ParamSalt = $salt;
						$ParamUserFirstName = $userFirstName;
						$ParamUserMiddleName = $userMiddleName;
						$ParamUserLastName = $userLastName;
						$ParamUserLevel = '1';
						$ParamUserCompanyID = $companyID;
						$ParamUserPrimaryContact = $userPrimaryContact;
						$ParamUserSecondaryContact = $userSecondaryContact;
						$ParamUserEmailAddress = $userEmailAddress;
						$ParamUserAccountStatus = $userAccountStatus;
						$ParamUserRegistrationDate = $datetime;
						$stmt->execute();

					}catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					$this->functionDBConnectx()->null;
				}
			}
		}

		function functionAddCompany($companyName,$companyAddress,$companyContact){
			//echo $userName,$userPassword,$userReTypePassword,$companyID,$userAccountStatus,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact;
			if($this->functionCheckCompanyName($companyName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
				echo 'alert("Company name taken")';
				echo '</script>';
			}else{
				try {
					// prepare sql and bind parameters
					$stmt = $this->functionDBConnectx()->prepare("INSERT INTO tblcompanies
						(companyName, companyAddress, companyContact)
						VALUES(:companyName, :companyAddress, :companyContact)");
					$stmt->bindParam(':companyName', $companyName);
					$stmt->bindParam(':companyAddress', $ParamCompanyAddress);
					$stmt->bindParam(':companyContact', $ParamCompanyContact);

					// insert a row
					$ParamCompanyName = $companyName;
					$ParamCompanyAddress = $companyAddress;
					$ParamCompanyContact = $companyContact;
					$stmt->execute();

				}catch(PDOException $e)
				{
					echo "Error: " . $e->getMessage();
				}
				$this->functionDBConnectx()->null;
			}
		}

		function functionEditIntern($userID,$userName,$userPassword,$userReTypePassword,$companyID,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact,$userEmailAddress,$userAccountStatus){
			/*
			echo "username: " . $userName . "<br>";
			echo "password: " . $userPassword . "<br>";
			if(empty($userPassword)){
				echo "empty";
			}
			echo "userReTypePassword: " . $userReTypePassword . "<br>";
			echo "companyID: " . $companyID . "<br>";
			echo "userFirstName: " . $userFirstName . "<br>";
			echo "userMiddleName: " . $userMiddleName . "<br>";
			echo "userLastName: " . $userLastName . "<br>";
			echo "userPrimaryContact: " . $userPrimaryContact . "<br>";
			echo "userSecondaryContact: " . $userSecondaryContact . "<br>";
			echo "userEmailAddress: " . $userEmailAddress . "<br>";
			echo "userAccountStatus: " . $userAccountStatus . "<br>";
			*/
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserName($userName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
					echo 'alert("Username taken")';
				echo '</script>';
			}else{
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					//$this->errorMessage = "Password Unmatch!";
					//$this->functionError();
					echo '<script language="javascript">';
						echo 'alert("Password does not match")';
					echo '</script>';
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);
					try {
						// prepare sql and bind parameters
						if((empty($userPassword) or !isset($userPassword) or $userPassword == "" or $userPassword == " ")
						or (empty($userReTypePassword) or !isset($userReTypePassword) or $userReTypePassword == "" or $userReTypePassword == " ")){
							$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							userName = :userName,
							userFirstName = :userFirstName,
							userMiddleName = :userMiddleName,
							userLastName = :userLastName,
							userCompanyID = :userCompanyID,
							userPrimaryContact = :userPrimaryContact,
							userSecondaryContact = :userSecondaryContact,
							userEmailAddress = :userEmailAddress,
							userAccountStatus = :userAccountStatus
							WHERE userID = :userID");
							$stmt->bindParam(':userID', $ParamUserID);
							$stmt->bindParam(':userName', $ParamUserName);
							$stmt->bindParam(':userFirstName', $ParamUserFirstName);
							$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
							$stmt->bindParam(':userLastName', $ParamUserLastName);
							$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
							$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
							$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
							$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
							$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
							// insert a row
							$ParamUserID = $userID;
							$ParamUserName = $userName;
							$ParamUserFirstName = $userFirstName;
							$ParamUserMiddleName = $userMiddleName;
							$ParamUserLastName = $userLastName;
							$ParamUserCompanyID = $companyID;
							$ParamUserPrimaryContact = $userPrimaryContact;
							$ParamUserSecondaryContact = $userSecondaryContact;
							$ParamUserEmailAddress = $userEmailAddress;
							$ParamUserAccountStatus = $userAccountStatus;
							$stmt->execute();
						}else{
							$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							userName = :userName,
							userPassword = :userPassword,
							salt = :salt,
							userFirstName = :userFirstName,
							userMiddleName = :userMiddleName,
							userLastName = :userLastName,
							userCompanyID = :userCompanyID,
							userPrimaryContact = :userPrimaryContact,
							userSecondaryContact = :userSecondaryContact,
							userEmailAddress = :userEmailAddress,
							userAccountStatus = :userAccountStatus
							WHERE userID = :userID");
							$stmt->bindParam(':userID', $ParamUserID);
							$stmt->bindParam(':userName', $ParamUserName);
							$stmt->bindParam(':userPassword', $ParamUserPassword);
							$stmt->bindParam(':salt', $ParamSalt);
							$stmt->bindParam(':userFirstName', $ParamUserFirstName);
							$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
							$stmt->bindParam(':userLastName', $ParamUserLastName);
							$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
							$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
							$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
							$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
							$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
							// insert a row
							$ParamUserID = $userID;
							$ParamUserName = $userName;
							$ParamUserPassword = $encryptedPassword;
							$ParamSalt = $salt;
							$ParamUserFirstName = $userFirstName;
							$ParamUserMiddleName = $userMiddleName;
							$ParamUserLastName = $userLastName;
							$ParamUserCompanyID = $companyID;
							$ParamUserPrimaryContact = $userPrimaryContact;
							$ParamUserSecondaryContact = $userSecondaryContact;
							$ParamUserEmailAddress = $userEmailAddress;
							$ParamUserAccountStatus = $userAccountStatus;
							$stmt->execute();
						}


					}catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					$this->functionDBConnectx()->null;
				}
			}
		}

		function functionEditSupervisor($userID,$userName,$userPassword,$userReTypePassword,$companyID,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact,$userEmailAddress,$userAccountStatus){
			/*echo "userID: " . $userID . "<br>";
			echo "username: " . $userName . "<br>";
			echo "password: " . $userPassword . "<br>";
			if(empty($userPassword)){
				echo "empty";
			}
			echo "userReTypePassword: " . $userReTypePassword . "<br>";
			echo "companyID: " . $companyID . "<br>";
			echo "userFirstName: " . $userFirstName . "<br>";
			echo "userMiddleName: " . $userMiddleName . "<br>";
			echo "userLastName: " . $userLastName . "<br>";
			echo "userPrimaryContact: " . $userPrimaryContact . "<br>";
			echo "userSecondaryContact: " . $userSecondaryContact . "<br>";
			echo "userEmailAddress: " . $userEmailAddress . "<br>";
			echo "userAccountStatus: " . $userAccountStatus . "<br>";
			break;*/
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserName($userName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
				echo 'alert("Username taken")';
				echo '</script>';
			}else{
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					//$this->errorMessage = "Password Unmatch!";
					//$this->functionError();
					echo '<script language="javascript">';
						echo 'alert("Password does not match")';
					echo '</script>';
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);
					try {
						// prepare sql and bind parameters
						if((empty($userPassword) or !isset($userPassword) or $userPassword == "" or $userPassword == " ")
							or (empty($userReTypePassword) or !isset($userReTypePassword) or $userReTypePassword == "" or $userReTypePassword == " ")){
							$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							userName = :userName,
							userFirstName = :userFirstName,
							userMiddleName = :userMiddleName,
							userLastName = :userLastName,
							userCompanyID = :userCompanyID,
							userPrimaryContact = :userPrimaryContact,
							userSecondaryContact = :userSecondaryContact,
							userEmailAddress = :userEmailAddress,
							userAccountStatus = :userAccountStatus
							WHERE userID = :userID");
							$stmt->bindParam(':userID', $ParamUserID);
							$stmt->bindParam(':userName', $ParamUserName);
							$stmt->bindParam(':userFirstName', $ParamUserFirstName);
							$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
							$stmt->bindParam(':userLastName', $ParamUserLastName);
							$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
							$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
							$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
							$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
							$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
							// insert a row
							$ParamUserID = $userID;
							$ParamUserName = $userName;
							$ParamUserFirstName = $userFirstName;
							$ParamUserMiddleName = $userMiddleName;
							$ParamUserLastName = $userLastName;
							$ParamUserCompanyID = $companyID;
							$ParamUserPrimaryContact = $userPrimaryContact;
							$ParamUserSecondaryContact = $userSecondaryContact;
							$ParamUserEmailAddress = $userEmailAddress;
							$ParamUserAccountStatus = $userAccountStatus;
							$stmt->execute();
						}else{
							$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							userName = :userName,
							userPassword = :userPassword,
							salt = :salt,
							userFirstName = :userFirstName,
							userMiddleName = :userMiddleName,
							userLastName = :userLastName,
							userCompanyID = :userCompanyID,
							userPrimaryContact = :userPrimaryContact,
							userSecondaryContact = :userSecondaryContact,
							userEmailAddress = :userEmailAddress,
							userAccountStatus = :userAccountStatus
							WHERE userID = :userID");
							$stmt->bindParam(':userID', $ParamUserID);
							$stmt->bindParam(':userName', $ParamUserName);
							$stmt->bindParam(':userPassword', $ParamUserPassword);
							$stmt->bindParam(':salt', $ParamSalt);
							$stmt->bindParam(':userFirstName', $ParamUserFirstName);
							$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
							$stmt->bindParam(':userLastName', $ParamUserLastName);
							$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
							$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
							$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
							$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
							$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
							// insert a row
							$ParamUserID = $userID;
							$ParamUserName = $userName;
							$ParamUserPassword = $encryptedPassword;
							$ParamSalt = $salt;
							$ParamUserFirstName = $userFirstName;
							$ParamUserMiddleName = $userMiddleName;
							$ParamUserLastName = $userLastName;
							$ParamUserCompanyID = $companyID;
							$ParamUserPrimaryContact = $userPrimaryContact;
							$ParamUserSecondaryContact = $userSecondaryContact;
							$ParamUserEmailAddress = $userEmailAddress;
							$ParamUserAccountStatus = $userAccountStatus;
							$stmt->execute();
						}


					}catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					$this->functionDBConnectx()->null;
				}
			}
		}

		function functionEditDean($userID,$userName,$userPassword,$userReTypePassword,$companyID,$userFirstName,$userMiddleName,$userLastName,$userPrimaryContact,$userSecondaryContact,$userEmailAddress,$userAccountStatus){
			/*echo "userID: " . $userID . "<br>";
			echo "username: " . $userName . "<br>";
			echo "password: " . $userPassword . "<br>";
			if(empty($userPassword)){
				echo "empty";
			}
			echo "userReTypePassword: " . $userReTypePassword . "<br>";
			echo "companyID: " . $companyID . "<br>";
			echo "userFirstName: " . $userFirstName . "<br>";
			echo "userMiddleName: " . $userMiddleName . "<br>";
			echo "userLastName: " . $userLastName . "<br>";
			echo "userPrimaryContact: " . $userPrimaryContact . "<br>";
			echo "userSecondaryContact: " . $userSecondaryContact . "<br>";
			echo "userEmailAddress: " . $userEmailAddress . "<br>";
			echo "userAccountStatus: " . $userAccountStatus . "<br>";
			break;*/
			$salt = $this->functionGenerateSalt();
			if($this->functionCheckUserName($userName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
				echo 'alert("Username taken")';
				echo '</script>';
			}else{
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					//$this->errorMessage = "Password Unmatch!";
					//$this->functionError();
					echo '<script language="javascript">';
					echo 'alert("Password does not match")';
					echo '</script>';
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);
					try {
						// prepare sql and bind parameters
						if((empty($userPassword) or !isset($userPassword) or $userPassword == "" or $userPassword == " ")
							or (empty($userReTypePassword) or !isset($userReTypePassword) or $userReTypePassword == "" or $userReTypePassword == " ")){
							$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							userName = :userName,
							userFirstName = :userFirstName,
							userMiddleName = :userMiddleName,
							userLastName = :userLastName,
							userCompanyID = :userCompanyID,
							userPrimaryContact = :userPrimaryContact,
							userSecondaryContact = :userSecondaryContact,
							userEmailAddress = :userEmailAddress,
							userAccountStatus = :userAccountStatus
							WHERE userID = :userID");
							$stmt->bindParam(':userID', $ParamUserID);
							$stmt->bindParam(':userName', $ParamUserName);
							$stmt->bindParam(':userFirstName', $ParamUserFirstName);
							$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
							$stmt->bindParam(':userLastName', $ParamUserLastName);
							$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
							$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
							$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
							$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
							$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
							// insert a row
							$ParamUserID = $userID;
							$ParamUserName = $userName;
							$ParamUserFirstName = $userFirstName;
							$ParamUserMiddleName = $userMiddleName;
							$ParamUserLastName = $userLastName;
							$ParamUserCompanyID = $companyID;
							$ParamUserPrimaryContact = $userPrimaryContact;
							$ParamUserSecondaryContact = $userSecondaryContact;
							$ParamUserEmailAddress = $userEmailAddress;
							$ParamUserAccountStatus = $userAccountStatus;
							$stmt->execute();
						}else{
							$stmt = $this->functionDBConnectx()->prepare("UPDATE tbluser
							SET
							userName = :userName,
							userPassword = :userPassword,
							salt = :salt,
							userFirstName = :userFirstName,
							userMiddleName = :userMiddleName,
							userLastName = :userLastName,
							userCompanyID = :userCompanyID,
							userPrimaryContact = :userPrimaryContact,
							userSecondaryContact = :userSecondaryContact,
							userEmailAddress = :userEmailAddress,
							userAccountStatus = :userAccountStatus
							WHERE userID = :userID");
							$stmt->bindParam(':userID', $ParamUserID);
							$stmt->bindParam(':userName', $ParamUserName);
							$stmt->bindParam(':userPassword', $ParamUserPassword);
							$stmt->bindParam(':salt', $ParamSalt);
							$stmt->bindParam(':userFirstName', $ParamUserFirstName);
							$stmt->bindParam(':userMiddleName', $ParamUserMiddleName);
							$stmt->bindParam(':userLastName', $ParamUserLastName);
							$stmt->bindParam(':userCompanyID', $ParamUserCompanyID);
							$stmt->bindParam(':userPrimaryContact', $ParamUserPrimaryContact);
							$stmt->bindParam(':userSecondaryContact', $ParamUserSecondaryContact);
							$stmt->bindParam(':userEmailAddress', $ParamUserEmailAddress);
							$stmt->bindParam(':userAccountStatus', $ParamUserAccountStatus);
							// insert a row
							$ParamUserID = $userID;
							$ParamUserName = $userName;
							$ParamUserPassword = $encryptedPassword;
							$ParamSalt = $salt;
							$ParamUserFirstName = $userFirstName;
							$ParamUserMiddleName = $userMiddleName;
							$ParamUserLastName = $userLastName;
							$ParamUserCompanyID = $companyID;
							$ParamUserPrimaryContact = $userPrimaryContact;
							$ParamUserSecondaryContact = $userSecondaryContact;
							$ParamUserEmailAddress = $userEmailAddress;
							$ParamUserAccountStatus = $userAccountStatus;
							$stmt->execute();
						}


					}catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					$this->functionDBConnectx()->null;
				}
			}
		}



		function functionCheckCompanyName($companyName){
			$codeResult = $this->functionDBConnectx()->query("SELECT * FROM tblcompanies WHERE companyName='$companyName'");
			$count = $codeResult->rowCount();
			return $count? 1 : 0;
		}

		function functionEditCompany($companyID,$companyName,$companyAddress,$companyContact){
			/*echo "companyID: " . $companyID . "<br>";
			echo "companyName: " . $companyName . "<br>";
			echo "companyAddress: " . $companyAddress . "<br>";
			echo "companyContact: " . $companyContact . "<br>";
			break;*/
			if($this->functionCheckCompanyName($companyName) == 1){
				//$this->errorMessage = "Username Unavailable!";
				//$this->functionError();
				echo '<script language="javascript">';
				echo 'alert("Company name taken")';
				echo '</script>';
			}else{
				try {
					// prepare sql and bind parameters
					$stmt = $this->functionDBConnectx()->prepare("UPDATE tblcompanies
							SET
							companyName = :companyName,
							companyAddress = :companyAddress,
							companyContact = :companyContact
							WHERE companyID = :companyID");
					$stmt->bindParam(':companyID', $ParamCompanyID);
					$stmt->bindParam(':companyName', $ParamCompanyName);
					$stmt->bindParam(':companyAddress', $ParamCompanyAddress);
					$stmt->bindParam(':companyContact', $ParamCompanyContact);

					// insert a row
					$ParamCompanyID = $companyID;
					$ParamCompanyName = $companyName;
					$ParamCompanyAddress = $companyAddress;
					$ParamCompanyContact = $companyContact;
					$stmt->execute();
				}catch(PDOException $e)
				{
					echo "Error: " . $e->getMessage();
				}
				$this->functionDBConnectx()->null;
			}
		}



		function sessionEditUserInfo($userID){
			$this->functionDBConnect();
			$SQLQuery = mysql_query("SELECT * FROM tbluser WHERE userID='$userID'") or die(mysql_error());
			if(mysql_num_rows($SQLQuery)>0){
				while($row = mysql_fetch_array($SQLQuery)){
					$_SESSION['userIDx'] = $row['userID'];
					$_SESSION['userNamex'] = $row['userName'];
					$_SESSION['userPasswordx'] = $row['userPassword'];
					$_SESSION['userFirstNamex'] = $row['userFirstName'];
					$_SESSION['userLastNamex'] = $row['userLastName'];
					$_SESSION['userLevelx'] = $row['userLevel'];
					$_SESSION['userAccountStatusx'] = $row['userAccountStatus'];
					$_SESSION['userRegistrationDatex'] = $row['userRegistrationDate'];
					$_SESSION['userStorageCapacityx'] = $row['userStorageCapacity'];
				}
			}
		}
		function functionUpdateUser($userID, $userName, $userPassword, $userFirstName, $userLastName, $userLevel, $userAccountStatus, $userRegistrationDate, $userStorageCapacity){

			/*$_SESSION['userIDx'] = $row['userID']; //license number
			$_SESSION['userNamex'] = $row['userName'];
			$_SESSION['userPasswordx'] = $row['userPassword'];
			$_SESSION['saltx'] = $row['salt'];
			$_SESSION['userLevelx'] = $row['userLevel'];
			$_SESSION['userAccountStatusx'] = $row['userAccountStatus'];
			$_SESSION['userRegistrationDatex'] = $row['userRegistrationDate'];
			$_SESSION['userFirstNamex'] = $row['userFirstName'];
			$_SESSION['userMiddleNamex'] = $row['userMiddleName'];
			$_SESSION['userLastNamex'] = $row['userLastName'];
			$_SESSION['DOBx'] = $row['DOB'];
			$_SESSION['genderx'] = $row['gender'];
			$_SESSION['addressx'] = $row['address'];
			$_SESSION['contactNumberx'] = $row['contactNumber'];*/
			$this->functionDBConnect();
			if(empty($userPassword) or $userPassword == " "){
				$SQLQuery = "UPDATE tbluser
							SET
								userName='$userName',
								userLevel='$userLevel',
								userAccountStatus='$userAccountStatus',
								userRegistrationDate='$userRegistrationDate',
								userFirstName='$userFirstName',
								userLastName='$userLastName',
								userStorageCapacity = '$userStorageCapacity'
							WHERE userID='$userID'";
				if (!mysql_query($SQLQuery,$this->functionDBConnect()))
				{
					die ('Error: ' . mysql_error());
				}
				/*$SQLQuery = "UPDATE tbluser
				(userID, userName, userPassword, salt, userLevel, userAccountStatus, userRegistrationDate, userFirstName, userMiddleName, userLastName, DOB, gender, address, contactNumber)
				VALUES
				('$userID','$userName','$encryptedPassword','$salt','$userLevel','$userAccountStatus','$dateToday','$userFirstName','$userMiddleName','$userLastName','$DOBx','$gender','$address','$contactNumber')";*/

			}else{
				$salt = $this->functionGenerateSalt();
				$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);

				$SQLQuery = "UPDATE tbluser
							SET
								userName='$userName',
								userPassword = '$encryptedPassword',
								salt = '$salt',
								userLevel='$userLevel',
								userAccountStatus='$userAccountStatus',
								userRegistrationDate='$userRegistrationDate',
								userFirstName='$userFirstName',
								userLastName='$userLastName',
								userStorageCapacity = '$userStorageCapacity'
							WHERE userID='$userID'";
				if (!mysql_query($SQLQuery,$this->functionDBConnect()))
				{
					die ('Error: ' . mysql_error());
				}
			}
		}

		function functionAcceptEULA($userID){
			$this->functionDBConnect();
			$SQLQuery = "UPDATE tbluser
							SET
								userEULA='1'
							WHERE userID='$userID'";
					if (!mysql_query($SQLQuery,$this->functionDBConnect()))
					{
						die ('Error: ' . mysql_error());
					}
		}

	}
?>
