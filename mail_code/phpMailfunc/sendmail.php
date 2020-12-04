<?php


ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
if(isset($_POST['submit']) && isset($_FILES['attachment'])) 
{ 

	$from_email		 = 'amitaajamit@gmail.com'; //from mail, sender email addrress 
	$recipient_email = 'amityadavamy19@gmail.com'; //recipient email addrress 
	
	//Load POST data from HTML form 
	$sender_name = $_POST["sender_name"]; //sender name 
	$reply_to_email = $_POST["sender_email"]; //sender email, it will be used in "reply-to" header 
	$subject	 = $_POST["subject"]; //subject for the email 
	$message	 = $_POST["message"]; //body of the email 
	

	/*Always remember to validate the form fields like this 
	if(strlen($sender_name)<1) 
	{ 
		die('Name is too short or empty!'); 
	} 
	*/
	
	//Get uploaded file data using $_FILES array 
	$tmp_name = $_FILES['attachment']['tmp_name']; // get the temporary file name of the file on the server 
	$name	 = $_FILES['attachment']['name']; // get the name of the file 
	$size	 = $_FILES['attachment']['size']; // get size of the file for size validation 
	$type	 = $_FILES['attachment']['type']; // get type of the file 
	$error	 = $_FILES['attachment']['error']; // get the error (if any) 



      	$fullFileLocation = "uploads/".$name;
		$success = move_uploaded_file($tmp_name, $fullFileLocation);
		
		// 	print_r($body);


	//validate form field for attaching the file 
	if($error > 0) 
	{ 
		die('Upload error or No files uploaded'); 
	} 
	
	
		// starting of headers
	$headers = 'From: '.$from_email.' <'.$from_email.'>';
	
// boundary 
    	$semi_rand = md5(time()); 
    	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
    	 
    	// headers for attachment 
    	$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
		
      $attachment = chunk_split(base64_encode(file_get_contents($fullFileLocation)));
	
		// multipart boundary 
    	$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
	
             $message .= "--{$mime_boundary}\n";
             
             $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$name\"\n" . 
    		"Content-Disposition: attachment;\n" . " filename=\"$name\"\n" . 
    		"Content-Transfer-Encoding: base64\n\n" . $attachment . "\n\n";
    		$message .= "--{$mime_boundary}--\n";

			if(mail($recipient_email, $subject, $message, $headers))
		{
			 
			//unset file
			if (file_exists($fullFileLocation))
			{
				//unset file
				unset($fullFileLocation);
			}
		
			echo "fail";
			exit(); 
		}
} 



?>

<form enctype="multipart/form-data" method="POST" action="#"> 
	<label>Your Name <input type="text" name="sender_name" /> </label> 
	<label>Your Email <input type="email" name="sender_email" /> </label> 
	<label>Subject <input type="text" name="subject" /> </label> 
	<label>Message <textarea name="message"></textarea> </label> 
	<label>Attachment <input type="file" name="attachment" /></label> 
	<label><input type="submit" name="submit" value="Submit" /></label> 
</form> 
