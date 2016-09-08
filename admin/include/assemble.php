<?php
	//outputs the skeleton of the site

	class classAssemble{
		function functionOrderForm(){
			if(isset($_SESSION['transactionStatus'])){
				$placeholderLastName = $_SESSION['lastName'];
				$placeholderFirstName = $_SESSION['firstName'];
				$placeholderMiddleName = $_SESSION['middleName'];
				$placeholderContactNumber = $_SESSION['contactNumber'];
				$placeholderEmail = $_SESSION['email'];
				$placeholderTitle = $_SESSION['title'];
				$placeholderAuthor = $_SESSION['author'];
				$placeholderBookEdition = $_SESSION['bookEdition'];
				$placeholderNumberOfOrders = $_SESSION['numberOfOrders'];
				$placeholderModeOfPayment = $_SESSION['modeOfPayment'];
				$placeholderDeliveryAddress = $_SESSION['deliveryAddress'];
				$placeholderUnitNumberHouseBuildingStreet = $_SESSION['unitNumberHouseBuildingStreet'];
				$placeholderBarangayDistrictSubdivisionVillage = $_SESSION['barangayDistrictSubdivisionVillage'];
				$placeholderCityMunicipalityProvince = $_SESSION['cityMunicipalityProvince'];
				$placeholderPostalCode = $_SESSION['postalCode'];
			}else{
				$placeholderLastName = "Last name...";
				$placeholderFirstName = "First name...";
				$placeholderMiddleName = "Middle name...";
				$placeholderContactNumber = "Contact number";
				$placeholderEmail = "Email...";
				$placeholderTitle = "Title";
				$placeholderAuthor = "Author";

				//select radio button
				//$placeholderBookEdition = $_SESSION['bookEdition'];

				//sellect <option>
				//$placeholderNumberOfOrders = $_SESSION['numberOfOrders'];

				//select <option>
				//$placeholderModeOfPayment = $_SESSION['modeOfPayment'];

				//select <radio>
				//$placeholderDeliveryAddress = $_SESSION['deliveryAddress'];

				$placeholderUnitNumberHouseBuildingStreet = "Unit number, house/building/street";
				$placeholderBarangayDistrictSubdivisionVillage = "Barangay/Destrict/Subdivision/Village";
				$placeholderCityMunicipalityProvince = "City/Municipality";
				$placeholderPostalCode = "Postal Code";
			}
			if(isset($_SESSION['transactionStatus']) and $_SESSION['transactionStatus'] == 1){
				echo '
					<form role="form" action="./" method="post" class="registration-form">
						<div class="form-group">
							<label class="sr-only" for="form-last-name">Last name</label>
							<input type="text" name="formLastName" placeholder="'.$placeholderLastName.'" class="form-last-name form-control" id="formLastName" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-first-name">First name</label>
							<input type="text" name="formFirstName" placeholder="'.$placeholderFirstName.'" class="form-first-name form-control" id="formFirstName" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-first-name">Middle name</label>
							<input type="text" name="formMiddleName" placeholder="'.$placeholderMiddleName.'" class="form-middle-name form-control" id="formMiddleName" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Contact Number<small>(Must be registered in Viber)</small></label>
							<input type="text" name="formContactNumber" placeholder="'.$placeholderContactNumber.'" class="form-contact-number form-control" id="formContactNumber" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-email">Email</label>
							<input type="text" name="formEmail" placeholder="'.$placeholderEmail.'" class="form-email form-control" id="form-email" >
						</div>

						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Order/s</label>
							<label>Order/s</label>
							<input type="text" name="formTitle" placeholder="'.$placeholderTitle.'" class="form-contact-number form-control" id="formTitle" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number"></label>
							<input type="text" name="formAuthor" placeholder="'.$placeholderAuthor.'" class="form-contact-number form-control" id="formAuthor" >
						</div>
						<div class="form-group">
							<select class="form-contact-number form-control" name="formBookEdition" >';
						if($placeholderBookEdition == "paperBack"){
							echo '<option value="" >Edition</option>
									<option value="paperBack" selected>Paperback</option>
									<option value="hardCover">Hardcover</option>';
						}else if($placeholderBookEdition == "hardCover"){
							echo '<option value="" >Edition</option>
									<option value="paperBack" >Paperback</option>
									<option value="hardCover" selected>Hardcover</option>';
						}else{
							echo '<option value="" selected>Edition</option>
									<option value="paperBack">Paperback</option>
									<option value="hardCover">Hardcover</option>';
						}

						echo	'</select>
						</div>
						<div class="form-group">
							<select class="form-contact-number form-control" name="formNumberOfOrders" >';
						if($placeholderNumberOfOrders == "1"){
							echo '<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "2"){
							echo '<option value="1" >1</option>
									<option value="2"selected>2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "3"){
							echo '<option value="1" >1</option>
									<option value="2">2</option>
									<option value="3"selected>3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "4"){
							echo '<option value="1" >1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4"selected>4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "5"){
							echo '<option value="1" >1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5"selected>5</option>';
						}else{
							echo '<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}

						echo	'</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="formModeOfPayment" >';
						if($placeholderModeOfPayment == "LBC"){
							echo '<option value="" >Mode of Payment</option>
								<option value="LBC"selected>LBC</option>
								<option value="BPICashDeposit">BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer">BPI Online Transfer</option>';
						}else if($placeholderModeOfPayment == "BPICashDeposit"){
							echo '<option value="" >Mode of Payment</option>
								<option value="LBC">LBC</option>
								<option value="BPICashDeposit"selected>BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer">BPI Online Transfer</option>';
						}else if($placeholderModeOfPayment == "BPIOnlineTransfer"){
							echo '<option value="" >Mode of Payment</option>
								<option value="LBC">LBC</option>
								<option value="BPICashDeposit">BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer"selected>BPI Online Transfer</option>';
						}else{
							echo '<option value="" selected>Mode of Payment</option>
								<option value="LBC">LBC</option>
								<option value="BPICashDeposit">BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer">BPI Online Transfer</option>';
						}

						echo 	'</select>
						</div>
						<div class="form-group">
							<label>Delivery Address</label><br>';
						if(isset($placeholderDeliveryAddress)){
							if($placeholderModeOfPayment == "Metro Manila"){
								echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" checked>Metro Manila
									<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()">Provincial<br>';
							}else if($placeholderModeOfPayment == "Provincial"){
								echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" >Metro Manila
									<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()" checked>Provincial<br>';
							}else{
								echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" checked>Metro Manila
									<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()">Provincial<br>';
							}
						}else{
							echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" checked>Metro Manila
								<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()">Provincial<br>';
						}

						echo'</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Unit number, house/building/street</label>
							<input type="text" name="formUnitNumberHouseBuildingStreet" placeholder="'.$placeholderUnitNumberHouseBuildingStreet.'" class="form-contact-number form-control" id="unitNumberHouseBuildingStreet" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Barangay/Destrict/Subdivision/Village</label>
							<input type="text" name="formBarangayDistrictSubdivisionVillage" placeholder="'.$placeholderBarangayDistrictSubdivisionVillage.'" class="form-contact-number form-control" id="barangayDistrictSubdivisionVillage" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">City/Municipality</label>
							<input type="text" name="formCityMunicipalityProvince" placeholder="'.$placeholderCityMunicipalityProvince.'" class="form-contact-number form-control" id="formCityMunicipalityProvince" >
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">City/Municipality</label>
							<input type="text" name="formPostalCode" placeholder="'.$placeholderPostalCode.'" class="form-contact-number form-control" id="formPostalCode" >
						</div>

						<button type="submit" name="btnLMCMD" class="btn">Let me check my deets!</button>
					</form>
				';
			}else{
				echo '
					<form role="form" action="./" method="post" class="registration-form">
						<div class="form-group">
							<label class="sr-only" for="form-last-name">Last name</label>
							<input type="text" name="formLastName" placeholder="'.$placeholderLastName.'" class="form-last-name form-control" id="formLastName" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-first-name">First name</label>
							<input type="text" name="formFirstName" placeholder="'.$placeholderFirstName.'" class="form-first-name form-control" id="formFirstName" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-first-name">Middle name</label>
							<input type="text" name="formMiddleName" placeholder="'.$placeholderMiddleName.'" class="form-middle-name form-control" id="formMiddleName" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Contact Number<small>(Must be registered in Viber)</small></label>
							<input type="text" name="formContactNumber" placeholder="'.$placeholderContactNumber.'" class="form-contact-number form-control" id="formContactNumber" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-email">Email</label>
							<input type="text" name="formEmail" placeholder="'.$placeholderEmail.'" class="form-email form-control" id="form-email" required>
						</div>

						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Order/s</label>
							<label>Order/s</label>
							<input type="text" name="formTitle" placeholder="'.$placeholderTitle.'" class="form-contact-number form-control" id="formTitle" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number"></label>
							<input type="text" name="formAuthor" placeholder="'.$placeholderAuthor.'" class="form-contact-number form-control" id="formAuthor" required>
						</div>
						<div class="form-group">
							<select class="form-contact-number form-control" name="formBookEdition" required>';
						if($placeholderBookEdition == "paperBack"){
							echo '<option value="Edition" >Edition</option>
									<option value="paperBack" selected>Paperback</option>
									<option value="hardCover">Hardcover</option>';
						}else if($placeholderBookEdition == "hardCover"){
							echo '<option value="Edition" >Edition</option>
									<option value="paperBack" >Paperback</option>
									<option value="hardCover" selected>Hardcover</option>';
						}else{
							echo '<option value="Edition" selected>Edition</option>
									<option value="paperBack">Paperback</option>
									<option value="hardCover">Hardcover</option>';
						}

						echo	'</select>
						</div>
						<div class="form-group">
							<select class="form-contact-number form-control" name="formNumberOfOrders" required>';
						if($placeholderNumberOfOrders == "1"){
							echo '<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "2"){
							echo '<option value="1" >1</option>
									<option value="2"selected>2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "3"){
							echo '<option value="1" >1</option>
									<option value="2">2</option>
									<option value="3"selected>3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "4"){
							echo '<option value="1" >1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4"selected>4</option>
									<option value="5">5</option>';
						}else if($placeholderNumberOfOrders == "5"){
							echo '<option value="1" >1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5"selected>5</option>';
						}else{
							echo '<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>';
						}

						echo	'</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="formModeOfPayment" required>';
						if($placeholderModeOfPayment == "LBC"){
							echo '<option value="" >Mode of Payment</option>
								<option value="LBC"selected>LBC</option>
								<option value="BPICashDeposit">BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer">BPI Online Transfer</option>';
						}else if($placeholderModeOfPayment == "BPICashDeposit"){
							echo '<option value="" >Mode of Payment</option>
								<option value="LBC">LBC</option>
								<option value="BPICashDeposit"selected>BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer">BPI Online Transfer</option>';
						}else if($placeholderModeOfPayment == "BPIOnlineTransfer"){
							echo '<option value="" >Mode of Payment</option>
								<option value="LBC">LBC</option>
								<option value="BPICashDeposit">BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer"selected>BPI Online Transfer</option>';
						}else{
							echo '<option value="" selected>Mode of Payment</option>
								<option value="LBC">LBC</option>
								<option value="BPICashDeposit">BPI Cash Deposit</option>
								<option value="BPIOnlineTransfer">BPI Online Transfer</option>';
						}

						echo 	'</select>
						</div>
						<div class="form-group">
							<label>Delivery Address</label><br>';
						if(isset($placeholderDeliveryAddress)){
							if($placeholderModeOfPayment == "Metro Manila"){
								echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" checked>Metro Manila
									<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()">Provincial<br>';
							}else if($placeholderModeOfPayment == "Provincial"){
								echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" >Metro Manila
									<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()" checked>Provincial<br>';
							}else{
								echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" checked>Metro Manila
									<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()">Provincial<br>';
							}
						}else{
							echo '<input type="radio" name="formDeliveryAddress" value="Metro Manila" onclick="updatePlaceHolderMetroManila()" checked>Metro Manila
								<input type="radio" name="deliveryAddress" value="Provincial" onclick="updatePlaceHolderProvincial()">Provincial<br>';
						}

						echo'</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Unit number, house/building/street</label>
							<input type="text" name="formUnitNumberHouseBuildingStreet" placeholder="'.$placeholderUnitNumberHouseBuildingStreet.'" class="form-contact-number form-control" id="unitNumberHouseBuildingStreet" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">Barangay/Destrict/Subdivision/Village</label>
							<input type="text" name="formBarangayDistrictSubdivisionVillage" placeholder="'.$placeholderBarangayDistrictSubdivisionVillage.'" class="form-contact-number form-control" id="barangayDistrictSubdivisionVillage" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">City/Municipality</label>
							<input type="text" name="formCityMunicipalityProvince" placeholder="'.$placeholderCityMunicipalityProvince.'" class="form-contact-number form-control" id="formCityMunicipalityProvince" required>
						</div>
						<div class="form-group">
							<label class="sr-only" for="form-contact-number">City/Municipality</label>
							<input type="text" name="formPostalCode" placeholder="'.$placeholderPostalCode.'" class="form-contact-number form-control" id="formPostalCode" required>
						</div>

						<button type="submit" name="btnLMCMD" class="btn">Let me check my deets!</button>
					</form>
						';

						//<input type="radio" name="gender" value="male" checked> Male<br>

			}

		}

		function functionCheckOutForm(){
			echo '
				<form role="form" action="./" method="post" class="registration-form">
					<div class="form-group">
						<label class="form-control">Last Name: '. $_SESSION['lastName'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">First Name: '. $_SESSION['firstName'] .'</label>
					</div>
					<div class="form-group">
						<label  class="form-control">Middle Name: '. $_SESSION['middleName'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Contact Number: '. $_SESSION['contactNumber'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Email: '. $_SESSION['email'] .'</label>
					</div>

					<div class="form-group">
						<label class="sr-only" for="form-contact-number">Order/s</label>
						<label >Order/s</label>
						<label class="form-control">Title: '. $_SESSION['title'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Author: '. $_SESSION['author'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Book Edition: '. $_SESSION['bookEdition'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Number of Orders: '. $_SESSION['numberOfOrders'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Mode of Payment: '. $_SESSION['modeOfPayment'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Delivery Address: '. $_SESSION['deliveryAddress'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Unit/Number/House/Building/Street: '. $_SESSION['unitNumberHouseBuildingStreet'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Barangay/District/Subdivision/Village: '. $_SESSION['barangayDistrictSubdivisionVillage'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">City/Municipality/Province: '. $_SESSION['cityMunicipalityProvince'] .'</label>
					</div>
					<div class="form-group">
						<label class="form-control">Postal Code: '. $_SESSION['postalCode'] .'</label>
					</div>
					<div class="form-group">
						<button class="btn" name="btnCheckOut">Check out</button>
					</div>
					<div class="form-group">
						<button class="btn" name="btnGoBack">Wait! Something is wrong</button>
					</div>

				</form>
					';

			//<input type="radio" name="gender" value="male" checked> Male<br>

		}

		function functionThankYouForm(){
			echo '
				<form role="form" action="./" method="post" class="registration-form">
					<div class="form-group">
						<label class="form-control">Thank you for using our services! We will get back to you soon</label>
					</div>
					<div class="form-group">
						<button class="btn" name="newOrder">New Order</button>
					</div>

				</form>
					';

			//<input type="radio" name="gender" value="male" checked> Male<br>

		}
	}
	
?>
