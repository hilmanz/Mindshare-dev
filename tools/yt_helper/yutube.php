<?php

error_reporting(E_ALL);
$link = "https://www.youtube.com/insight_proxy_csv?dim=COUNTRY%2CVIEWER_AGE%2CVIEWER_GENDER&met=VIEWER_PROMILLE&ord=VIEWER_PROMILLE&from=18032012&to=16042012&where=UN001&whatType=USER&whatId=1RC50zu8dG9Ttk3l16jViw";
/**
	 * Copy File from HTTPS/SSL location
	 *
	 * @param string $FromLocation
	 * @param string $ToLocation
	 * @return boolean
	 */
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
	/**
	 *	This code don't work
	 *	echo file_get_contents("https://www.verisign.com/hp07/i/vlogo.gif");
	**/
	// Function Usage
	if(copySecureFile($link,"c:/csv_youtube/asd.csv"))
	{
		echo 'File transferred successfully.';
	}
	else
	{
		echo 'File transfer failed.';
	}