<?php
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$gender = $_POST['gender'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$number = $_POST['number'];

	// Database connection
	$conn = new mysqli('localhost', 'root', '', 'test2', 3307); // Specify port 3307
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("INSERT INTO registration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $password, $number);
		$execval = $stmt->execute();
		
		if ($execval) {
			echo "
			<div style='text-align: center; margin-top: 50px;'>
				<h2>Registration Successful!</h2>
				<button onclick='window.location.href=\"next_page.php\"' style='padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 16px; border-radius: 5px;'>Continue</button>
			</div>";
		} else {
			echo "Registration failed. Please try again.";
		}
		
		$stmt->close();
		$conn->close();
	}
	
?>
