<?php
	/*
	 * BOT CHANNEL
	 * @author Babar
	 */
	 error_reporting(0);
	$con = mysql_connect("localhost","root","coppermine");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db("mindsharedb", $con);
	  
	$options["AF"] = "Afghanistan";  
	$options["AX"] = "Aland Islands";  
	$options["AL"] = "Albania";  
	$options["DZ"] = "Algeria";  
	$options["AS"] = "American Samoa";  
	$options["AD"] = "Andorra";  
	$options["AO"] = "Angola";
	$options["AI"] = "Anguilla";
	$options["AQ"] = "Antarctica";
	$options["AG"] = "Antigua and Barbuda";
	$options["AR"] = "Argentina";
	$options["AU"] = "Australia";
	$options["AT"] = "Austria";
	$options["AZ"] = "Azerbaijan";
	$options["BS"] = "Bahamas";
	$options["BH"] = "Bahrain";
	$options["BD"] = "Bangladesh";
	$options["BB"] = "Barbados";
	$options["BY"] = "Belarus";
	$options["BE"] = "Belgium";
	$options["BZ"] = "Belize";
	$options["BJ"] = "Benin";
	$options["BM"] = "Bermuda";
	$options["BT"] = "Bhutan";
	$options["BO"] = "Bolivia";
	$options["BA"] = "Bosnia and Herzegovina";
	$options["BW"] = "Botswana";
	$options["BV"] = "Bouvet Island";
	$options["BR"] = "Brazil";
	$options["IO"] = "British Indian Ocean Territory";
	$options["BN"] = "Brunei Darussalam";
	$options["BG"] = "Bulgaria";
	$options["BF"] = "Burkina Faso";
	$options["BI"] = "Burundi";
	$options["KH"] = "Cambodia";
	$options["CM"] = "Cameroon";
	$options["CA"] = "Canada";
	$options["CV"] = "Cape Verde";
	$options["KY"] = "Cayman Islands";
	$options["CF"] = "Central African Republic";
	$options["TD"] = "Chad";
	$options["CL"] = "Chile";
	$options["CN"] = "China";
	$options["CX"] = "Christmas Island";
	$options["CC"] = "Cocos (Keeling) Islands";
	$options["CO"] = "Colombia";
	$options["KM"] = "Comoros";
	$options["CG"] = "Congo";
	$options["CD"] = "Congo, the Democratic Republic of the";
	$options["CK"] = "Cook Islands";
	$options["CR"] = "Costa Rica";
	$options["CI"] = "C�te D'Ivoire";
	$options["HR"] = "Croatia";
	$options["CU"] = "Cuba";
	$options["CY"] = "Cyprus";
	$options["CZ"] = "Czech Republic";
	$options["DK"] = "Denmark";
	$options["DJ"] = "Djibouti";
	$options["DM"] = "Dominica";
	$options["DO"] = "Dominican Republic";
	$options["EC"] = "Ecuador";
	$options["EG"] = "Egypt";
	$options["SV"] = "El Salvador";
	$options["GQ"] = "Equatorial Guinea";
	$options["ER"] = "Eritrea";
	$options["EE"] = "Estonia";
	$options["ET"] = "Ethiopia";
	$options["FK"] = "Falkland Islands (Malvinas)";
	$options["FO"] = "Faroe Islands";
	$options["FJ"] = "Fiji";
	$options["FI"] = "Finland";
	$options["FR"] = "France";
	$options["GF"] = "French Guiana";
	$options["PF"] = "French Polynesia";
	$options["TF"] = "French Southern Territories";
	$options["GA"] = "Gabon";
	$options["GM"] = "Gambia";
	$options["GE"] = "Georgia";
	$options["DE"] = "Germany";
	$options["GH"] = "Ghana";
	$options["GI"] = "Gibraltar";
	$options["GR"] = "Greece";
	$options["GL"] = "Greenland";
	$options["GD"] = "Grenada";
	$options["GP"] = "Guadeloupe";
	$options["GU"] = "Guam";
	$options["GT"] = "Guatemala";
	$options["GG"] = "Guernsey";
	$options["GN"] = "Guinea";
	$options["GW"] = "Guinea-Bissau";
	$options["GY"] = "Guyana";
	$options["HT"] = "Haiti";
	$options["HM"] = "Heard Island and Mcdonald Islands";
	$options["VA"] = "Holy See (Vatican City State)";
	$options["HN"] = "Honduras";
	$options["HK"] = "Hong Kong";
	$options["HU"] = "Hungary";
	$options["IS"] = "Iceland";
	$options["IN"] = "India";
	$options["ID"] = "Indonesia";
	$options["IR"] = "Iran, Islamic Republic of";
	$options["IQ"] = "Iraq";
	$options["IE"] = "Ireland";
	$options["IM"] = "Isle of Man";
	$options["IL"] = "Israel";
	$options["IT"] = "Italy";
	$options["JM"] = "Jamaica";
	$options["JP"] = "Japan";
	$options["JE"] = "Jersey";
	$options["JO"] = "Jordan";
	$options["KZ"] = "Kazakhstan";
	$options["KE"] = "KENYA";
	$options["KI"] = "Kiribati";
	$options["KP"] = "Korea, Democratic People's Republic of";
	$options["KR"] = "Korea, Republic of";
	$options["KW"] = "Kuwait";
	$options["KG"] = "Kyrgyzstan";
	$options["LA"] = "Lao People's Democratic Republic";
	$options["LV"] = "Latvia";
	$options["LB"] = "Lebanon";
	$options["LS"] = "Lesotho";
	$options["LR"] = "Liberia";
	$options["LY"] = "Libyan Arab Jamahiriya";
	$options["LI"] = "Liechtenstein";
	$options["LT"] = "Lithuania";
	$options["LU"] = "Luxembourg";
	$options["MO"] = "Macao";
	$options["MK"] = "Macedonia, the Former Yugoslav Republic of";
	$options["MG"] = "Madagascar";
	$options["MW"] = "Malawi";
	$options["MY"] = "Malaysia";
	$options["MV"] = "Maldives";
	$options["ML"] = "Mali";
	$options["MT"] = "Malta";
	$options["MH"] = "Marshall Islands";
	$options["MQ"] = "Martinique";
	$options["MR"] = "Mauritania";
	$options["MU"] = "Mauritius";
	$options["YT"] = "Mayotte";
	$options["MX"] = "Mexico";
	$options["FM"] = "Micronesia, Federated States of";
	$options["MD"] = "Moldova, Republic of";
	$options["MC"] = "Monaco";
	$options["MN"] = "Mongolia";
	$options["ME"] = "Montenegro";
	$options["MS"] = "Montserrat";
	$options["MA"] = "Morocco";
	$options["MZ"] = "Mozambique";
	$options["MM"] = "Myanmar";
	$options["NA"] = "Namibia";
	$options["NR"] = "Nauru";
	$options["NP"] = "Nepal";
	$options["NL"] = "Netherlands";
	$options["AN"] = "Netherlands Antilles";
	$options["NC"] = "New Caledonia";
	$options["NZ"] = "New Zealand";
	$options["NI"] = "Nicaragua";
	$options["NE"] = "Niger";
	$options["NG"] = "Nigeria";
	$options["NU"] = "Niue";
	$options["NF"] = "Norfolk Island";
	$options["MP"] = "Northern Mariana Islands";
	$options["NO"] = "Norway";
	$options["OM"] = "Oman";
	$options["PK"] = "Pakistan";
	$options["PW"] = "Palau";
	$options["PS"] = "Palestinian Territory, Occupied";
	$options["PA"] = "Panama";
	$options["PG"] = "Papua New Guinea";
	$options["PY"] = "Paraguay";
	$options["PE"] = "Peru";
	$options["PH"] = "Philippines";
	$options["PN"] = "Pitcairn";
	$options["PL"] = "Poland";
	$options["PT"] = "Portugal";
	$options["PR"] = "Puerto Rico";
	$options["QA"] = "Qatar";
	$options["RE"] = "Reunion";
	$options["RO"] = "Romania";
	$options["RU"] = "Russian Federation";
	$options["RW"] = "Rwanda";
	$options["SH"] = "Saint Helena";
	$options["KN"] = "Saint Kitts and Nevis";
	$options["LC"] = "Saint Lucia";
	$options["PM"] = "Saint Pierre and Miquelon";
	$options["VC"] = "Saint Vincent and the Grenadines";
	$options["WS"] = "Samoa";
	$options["SM"] = "San Marino";
	$options["ST"] = "Sao Tome and Principe";
	$options["SA"] = "Saudi Arabia";
	$options["SN"] = "Senegal";
	$options["RS"] = "Serbia";
	$options["SC"] = "Seychelles";
	$options["SL"] = "Sierra Leone";
	$options["SG"] = "Singapore";
	$options["SK"] = "Slovakia";
	$options["SI"] = "Slovenia";
	$options["SB"] = "Solomon Islands";
	$options["SO"] = "Somalia";
	$options["ZA"] = "South Africa";
	$options["GS"] = "South Georgia and the South Sandwich Islands";
	$options["ES"] = "Spain";
	$options["LK"] = "Sri Lanka";
	$options["SD"] = "Sudan";
	$options["SR"] = "Suriname ";
	$options["SJ"] = "Svalbard and Jan Mayen";
	$options["SZ"] = "Swaziland";
	$options["SE"] = "Sweden";
	$options["CH"] = "Switzerland ";
	$options["SY"] = "Syrian Arab Republic";
	$options["TW"] = "Taiwan";
	$options["TJ"] = "Tajikistan";
	$options["TZ"] = "Tanzania, United Republic of";
	$options["TH"] = "Thailand";
	$options["TL"] = "Timor-Leste";
	$options["TG"] = "Togo";
	$options["TK"] = "Tokelau";
	$options["TO"] = "Tonga";
	$options["TT"] = "Trinidad and Tobago";
	$options["TN"] = "Tunisia";
	$options["TR"] = "Turkey";
	$options["TM"] = "Turkmenistan";
	$options["TC"] = "Turks and Caicos Islands";
	$options["TV"] = "Tuvalu";
	$options["UG"] = "Uganda";
	$options["UA"] = "Ukraine";
	$options["AE"] = "United Arab Emirates";
	$options["GB"] = "United Kingdom";
	$options["US"] = "United States";
	$options["UM"] = "United States Minor Outlying Islands";
	$options["UY"] = "Uruguay";
	$options["UZ"] = "Uzbekistan";
	$options["VU"] = "Vanuatu";
	$options["VA"] = "Vatican City State";
	$options["VE"] = "Venezuela";
	$options["VN"] = "Vietnam";
	$options["VG"] = "Virgin Islands, British";
	$options["VI"] = "Virgin Islands, U.S.";
	$options["WF"] = "Wallis and Futuna";
	$options["EH"] = "Western Sahara";
	$options["YE"] = "Yemen";
	$options["CD"] = "Zaire";
	$options["ZM"] = "Zambia";
	$options["ZW"] = "Zimbabwe";
	// 10 country
	$data =" select region,sum(views)as total_views from video_raw group by region order by total_views desc limit 10;
			";
	$qData = mysql_query($data);
	

	$i = 0;
	// channel_country_views
	// 1RC50zu8dG9Ttk3l16jViw
	// channel_id             | country        | views 
	if($qData)
	{
		$truncate ="TRUNCATE TABLE channel_country_views";
		mysql_query($truncate);
		while($row = mysql_fetch_object($qData)){
			// echo $row->region;
			$country = $options[$row->region];
			$sql ="
			INSERT IGNORE INTO channel_country_views (channel_id,country,views,region_id) VALUES ('1RC50zu8dG9Ttk3l16jViw','{$country}',{$row->total_views},'{$row->region}')
			";
			echo $sql.'
			';
			$result = mysql_query($sql);
			if($result) echo "Success INSERT data";
			echo "
			";
		}
	}
	
	mysql_close($con);
?>