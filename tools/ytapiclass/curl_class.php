<?php
class curl_class {

function get($url){
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_TIMEOUT,15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
	//curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY); 
	
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec ($ch);
	$info = curl_getinfo($ch);
	curl_close ($ch);
	print_r($info);
	return $response;
}

function copySecureFile($FromLocation,$ToLocation,$VerifyPeer=false,$VerifyHost=true)
	{
		// Initialize CURL with providing full https URL of the file location
		$Channel = curl_init($FromLocation);
 
		// Open file handle at the location you want to copy the file: destination path at local drive
		$File = fopen ($ToLocation, "w");
 
		// Set CURL options
		curl_setopt($Channel, CURLOPT_FILE, $File);
 
		// We are not sending any headers
		curl_setopt($Channel, CURLOPT_HEADER, 0);
 
		// Disable PEER SSL Verification: If you are not running with SSL or if you don't have valid SSL
		curl_setopt($Channel, CURLOPT_SSL_VERIFYPEER, $VerifyPeer);
 
		// Disable HOST (the site you are sending request to) SSL Verification,
		// if Host can have certificate which is nvalid / expired / not signed by authorized CA.
		curl_setopt($Channel, CURLOPT_SSL_VERIFYHOST, $VerifyHost);
 
		// Execute CURL command
		curl_exec($Channel);
 
		// Close the CURL channel
		curl_close($Channel);
 
		// Close file handle
		fclose($File);
 
		// return true if file download is successfull
		return file_exists($ToLocation);
	}
}