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
		function functionDBConnect(){
			/*
			$host = "localhost";
			$database = "1097353";
			$username = "1097353";
			$password = "kajjeandagnes";

			 */

			 	$host = "localhost";
				$database = "iAttendance";
				$username = "root";
				$password = "";

			$DBConnection = mysql_connect("$host","$username","$password");
			$DBSelect = mysql_select_db($database, $DBConnection);
			if(!$DBSelect){
				die("Database selection failed: " . mysql_error());
			}
			return $DBConnection;
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
			$codeResult = mysql_query("SELECT * FROM tbluser WHERE username='$userName'" );
			return mysql_num_rows($codeResult)? 1 : 0;
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




		function functionUserSignupx($userID, $userName, $userPassword, $userPasswordReType, $userLevel, $userAccountStatus, $userFirstName,$userLastName){
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
			$result = mysql_query("SELECT * FROM tbluser WHERE username='$userName'");
			while($row=mysql_fetch_array($result)){  
				$this->saltFromDB	= $row['salt']; 
				$this->passwordFromDB = $row['userPassword']; 
			}
		}
		function functionUserLog($userID,$userFirstName,$userLastName){
			$this->functionDBConnect();

			$result = mysql_query("SELECT * FROM tbl_logs WHERE userID='$userID'");
			while($row=mysql_fetch_array($result)){
				$log = $row['userActivity'];
			}

			/*$result = mysql_query("SELECT * FROM tbl_log WHERE userID='$userID'");
			while($row=mysql_fetch_array($result)){
				if($activityLogNumber < $row['activityLogNumber']){
					$activityLogNumber = $row['activityLogNumber'];
				}
			}*/

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
			$SQLQuery = "INSERT INTO tbl_logs
			(userID, userActivity, userRemarks, userDateTime)
			VALUES('$userID','$logInput','remarks' ,'$datetime')";
			if (!mysql_query($SQLQuery,$this->functionDBConnect()))
			{
				die ('Error: ' . mysql_error());
			}

		}
		function functionUserAuthentication($username,$password){
			$this->functionDBConnect();
			if($this->functionCheckUserName($username) == 0){
				$this->errorMessage = "Username Unavailable!";
				$this->functionError();
			}
			$this->functionGetPasswordFromDB($username);
			$loginSalt = $this->saltFromDB;
			$newEncryptedPassword = $this->functionEncryptPassword($password,$loginSalt);
			$encrypt = $this->passwordFromDB;
			if($this->functionCheckPasswordSignUp($encrypt,$newEncryptedPassword) == true){$result = mysql_query("SELECT * FROM tbluser WHERE userName='$username' and userPassword='$newEncryptedPassword'");
				while($row = mysql_fetch_array($result))
				{
					$userID = $row['userID'];
					$userName = $row['userName'];
					$userFirstName = $row['userFirstName'];
					$userLastName = $row['userLastName'];
					$userPassword = $row['userPassword'];
					$userLevel = $row['userLevel'];

				}
				if(!empty($userID)){
					$this->functionUserLog($userID,$userFirstName,$userLastName);
				}
				//uncomment below or put if else for admin
				/*
				if(!empty($userName)){
					//session_start();
					$_SESSION['userID'] = $userID;
					$_SESSION['userName'] = $userName;
					$_SESSION['userPassword'] = $userPassword;
					$_SESSION['userLevel'] = $userLevel;
					$_SESSION['pagePasser'] = 1;
					$_SESSION['counter'] = "0";
					$this->functionUserLog($userID);
				}else{
					echo "username or password unmatch! inner if";
				}*/
				unset($_POST['GITM']);
				return $userLevel;
			}else{
				return -1;
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
		function functionAddUser($userID, $userName, $userPassword, $userPasswordReType, $userLevel, $userAccountStatus, $userFirstName,$userLastName, $userStorageCapacity){
			//echo $userID, $userName, $userPassword, $userPasswordReType, $userLevel, $userAccountStatus, $userFirstName, $userMiddleName,$userLastName,$DOBx,$gender,$address,$contactNumber;
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
			$dateToday = date('Y') . "-" . date('m')  . "-" . date('d'). " " . date('h')  . ":" . date('i'). ":" . date('s');
			$SQLQuery = "INSERT INTO tbluser
			(userID, userName, userPassword, salt, userFirstName, userLastName, userLevel, userAccountStatus, userRegistrationDate, userStorageCapacity)
		VALUES
		('$userID','$userName','$encryptedPassword','$salt','$userFirstName','$userLastName','$userLevel','$userAccountStatus','$dateToday','$userStorageCapacity')";
			if (!mysql_query($SQLQuery,$this->functionDBConnect()))
			{
				die ('Error: ' . mysql_error());
			}
			
			
		}
		function functionUpdateUserEditProfile($userID, $userName, $userPassword, $userReTypePassword, $userFirstName, $userLastName){
			
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
								userFirstName='$userFirstName',
								userLastName='$userLastName'
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
				if($this->functionCheckPasswordSignUp($userPassword,$userReTypePassword) == false){
					$this->errorMessage = "Password Unmatch!";
					$this->functionError();
					exit;
				}else{
					$encryptedPassword = $this->functionEncryptPassword($userPassword,$salt);
					$SQLQuery = "UPDATE tbluser
							SET
								userName='$userName',
								userPassword = '$encryptedPassword',
								salt = '$salt',
								userFirstName='$userFirstName',
								userLastName='$userLastName'
							WHERE userID='$userID'";
					if (!mysql_query($SQLQuery,$this->functionDBConnect()))
					{
						die ('Error: ' . mysql_error());
					}
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


		/*
		 *
		 * $_SESSION['lastName'] = $_POST['formLastName'];
                $_SESSION['firstName'] = $_POST['formFirstName'];
                $_SESSION['middleName'] = $_POST['formMiddleName'];
                $_SESSION['contactNumber'] = $_POST['formContactNumber'];
                $_SESSION['email'] = $_POST['formEmail'];
                $_SESSION['title'] = $_POST['formTitle'];
                $_SESSION['author'] = $_POST['formAuthor'];
                $_SESSION['bookEdition'] = $_POST['formBookEdition'];
                $_SESSION['numberOfOrders'] = $_POST['formNumberOfOrders'];
                $_SESSION['modeOfPayment'] = $_POST['formModeOfPayment'];
                $_SESSION['deliveryAddress'] = $_POST['formDeliveryAddress'];
                $_SESSION['unitNumberHouseBuildingStreet'] = $_POST['formUnitNumberHouseBuildingStreet'];
                $_SESSION['barangayDistrictSubdivisionVillage'] = $_POST['formBarangayDistrictSubdivisionVillage'];
                $_SESSION['cityMunicipalityProvince'] = $_POST['formCityMunicipalityProvince'];
                $_SESSION['postalCode'] = $_POST['formPostalCode'];
		 */
		function funvnctionUnset(){

		}
		function functionNewOrder($lastName, $firstName, $middleName, $contactNumber, $email, $title, $author, $bookEdition, $numberOfOrders, $modeOfPayment, $deliveryAddress, $unitNumberHouseBuildingStreet, $barangayDistrictSubdivisionVillage, $cityMunicipalityProvince, $postalCode){
			$this->functionDBConnect();
			$dateToday = date('Y') . "-" . date('m')  . "-" . date('d');
			$SQLQuery = "INSERT INTO tbl_orders
			(lastName, firstName, middleName, contactNumber, email, title, author, bookEdition, numberOfOrders, modeOfPayment, deliveryAddress, unitNumberHouseBuildingStreet, barangayDistrictSubdivisionVillage, cityMunicipalityProvince, postalCode)
			VALUES('$lastName', '$firstName', '$middleName', '$contactNumber', '$email', '$title', '$author', '$bookEdition', '$numberOfOrders', '$modeOfPayment', '$deliveryAddress', '$unitNumberHouseBuildingStreet', '$barangayDistrictSubdivisionVillage', '$cityMunicipalityProvince', '$postalCode')";
			if (!mysql_query($SQLQuery,$this->functionDBConnect()))
			{
				die ('Error: ' . mysql_error());
			}
			$_SESSION['transactionStatus'] = 2;
			$this->functionDBDisconnect();
		}
	}
	
	
	//tbl folder status: 0 = private 1= shared 2=public 3=shared and public
?>
