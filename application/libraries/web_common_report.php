<?php  
	require_once('simple_html_dom.php');



	class Web_common_report
	{

		public $country_list = array (
		  'AF' => 'AFGHANISTAN',
		  'AX' => 'ÅLAND ISLANDS',
		  'AL' => 'ALBANIA',
		  'BLANK' => 'ZANZIBAR',
		  'DZ' => 'ALGERIA (El Djazaïr)',
		  'AS' => 'AMERICAN SAMOA',
		  'AD' => 'ANDORRA',
		  'AO' => 'ANGOLA',
		  'AI' => 'ANGUILLA',
		  'AQ' => 'ANTARCTICA',
		  'AG' => 'ANTIGUA AND BARBUDA',
		  'AR' => 'ARGENTINA',
		  'AM' => 'ARMENIA',
		  'AW' => 'ARUBA',
		  'blank' => 'YUGOSLAVIA (Internet code still used)',
		  'AU' => 'AUSTRALIA',
		  'AT' => 'AUSTRIA',
		  'AZ' => 'AZERBAIJAN',
		  'BS' => 'BAHAMAS',
		  'BH' => 'BAHRAIN',
		  'BD' => 'BANGLADESH',
		  'BB' => 'BARBADOS',
		  'BY' => 'BELARUS',
		  'BE' => 'BELGIUM',
		  'BZ' => 'BELIZE',
		  'BJ' => 'BENIN',
		  'BM' => 'BERMUDA',
		  'BT' => 'BHUTAN',
		  'BO' => 'BOLIVIA',
		  'BQ' => 'BONAIRE, ST. EUSTATIUS, AND SABA',
		  'BA' => 'BOSNIA AND HERZEGOVINA',
		  'BW' => 'BOTSWANA',
		  'BV' => 'BOUVET ISLAND',
		  'BR' => 'BRAZIL',
		  'IO' => 'BRITISH INDIAN OCEAN TERRITORY',
		  'BN' => 'BRUNEI DARUSSALAM',
		  'BG' => 'BULGARIA',
		  'BF' => 'BURKINA FASO',
		  'BI' => 'BURUNDI',
		  'KH' => 'CAMBODIA',
		  'CM' => 'CAMEROON',
		  'CA' => 'CANADA',
		  'CV' => 'CAPE VERDE',
		  'KY' => 'CAYMAN ISLANDS',
		  'CF' => 'CENTRAL AFRICAN REPUBLIC',
		  'CD' => 'CONGO, THE DEMOCRATIC REPUBLIC OF THE (formerly Zaire)',
		  'CL' => 'CHILE',
		  'CN' => 'CHINA',
		  'CX' => 'CHRISTMAS ISLAND',
		  'CC' => 'COCOS (KEELING) ISLANDS',
		  'CO' => 'COLOMBIA',
		  'KM' => 'COMOROS',
		  'CG' => 'CONGO, REPUBLIC OF',
		  'CK' => 'COOK ISLANDS',
		  'CR' => 'COSTA RICA',
		  'CI' => 'CÔTE D\'IVOIRE (Ivory Coast)',
		  'HR' => 'CROATIA (Hrvatska)',
		  'CU' => 'CUBA',
		  'CW' => 'CURAÇAO',
		  'CY' => 'CYPRUS',
		  'CZ' => 'ZECH REPUBLIC',
		  'DK' => 'DENMARK',
		  'DJ' => 'DJIBOUTI',
		  'DM' => 'DOMINICA',
		  'DO'=>'Dominican Republic',
		  'DC' => 'DOMINICAN REPUBLIC',
		  'EC' => 'ECUADOR',
		  'EG' => 'EGYPT',
		  'SV' => 'EL SALVADOR',
		  'GQ' => 'EQUATORIAL GUINEA',
		  'ER' => 'ERITREA',
		  'EE' => 'ESTONIA',
		  'ET' => 'ETHIOPIA',
		  'FO' => 'FAEROE ISLANDS',
		  'FK' => 'FALKLAND ISLANDS (MALVINAS)',
		  'FJ' => 'FIJI',
		  'FI' => 'FINLAND',
		  'FR' => 'FRANCE',
		  'GF' => 'FRENCH GUIANA',
		  'PF' => 'FRENCH POLYNESIA',
		  'TF' => 'FRENCH SOUTHERN TERRITORIES',
		  'GA' => 'GABON',
		  'GM' => 'GAMBIA, THE',
		  'GE' => 'GEORGIA',
		  'DE' => 'GERMANY (Deutschland)',
		  'GH' => 'GHANA',
		  'GI' => 'GIBRALTAR',
		  'GB' => 'UNITED KINGDOM',
		  'GR' => 'GREECE',
		  'GL' => 'GREENLAND',
		  'GD' => 'GRENADA',
		  'GP' => 'GUADELOUPE',
		  'GU' => 'GUAM',
		  'GT' => 'GUATEMALA',
		  'GG' => 'GUERNSEY',
		  'GN' => 'GUINEA',
		  'GW' => 'GUINEA-BISSAU',
		  'GY' => 'GUYANA',
		  'HT' => 'HAITI',
		  'HM' => 'HEARD ISLAND AND MCDONALD ISLANDS',
		  'HN' => 'HONDURAS',
		  'HK' => 'HONG KONG (Special Administrative Region of China)',
		  'HU' => 'HUNGARY',
		  'IS' => 'ICELAND',
		  'IN' => 'INDIA',
		  'ID' => 'INDONESIA',
		  'IR' => 'IRAN (Islamic Republic of Iran)',
		  'IQ' => 'IRAQ',
		  'IE' => 'IRELAND',
		  'IM' => 'ISLE OF MAN',
		  'IL' => 'ISRAEL',
		  'IT' => 'ITALY',
		  'JM' => 'JAMAICA',
		  'JP' => 'JAPAN',
		  'JE' => 'JERSEY',
		  'JO' => 'JORDAN (Hashemite Kingdom of Jordan)',
		  'KZ' => 'KAZAKHSTAN',
		  'KE' => 'KENYA',
		  'KI' => 'KIRIBATI',
		  'KP' => 'KOREA (Democratic Peoples Republic of [North] Korea)',
		  'KR' => 'KOREA (Republic of [South] Korea)',
		  'KW' => 'KUWAIT',
		  'KG' => 'KYRGYZSTAN',
		  'LA' => 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC',
		  'LV' => 'LATVIA',
		  'LB' => 'LEBANON',
		  'LS' => 'LESOTHO',
		  'LR' => 'LIBERIA',
		  'LY' => 'LIBYA (Libyan Arab Jamahirya)',
		  'LI' => 'LIECHTENSTEIN (Fürstentum Liechtenstein)',
		  'LT' => 'LITHUANIA',
		  'LU' => 'LUXEMBOURG',
		  'MO' => 'MACAO (Special Administrative Region of China)',
		  'MK' => 'MACEDONIA (Former Yugoslav Republic of Macedonia)',
		  'MG' => 'MADAGASCAR',
		  'MW' => 'MALAWI',
		  'MY' => 'MALAYSIA',
		  'MV' => 'MALDIVES',
		  'ML' => 'MALI',
		  'MT' => 'MALTA',
		  'MH' => 'MARSHALL ISLANDS',
		  'MQ' => 'MARTINIQUE',
		  'MR' => 'MAURITANIA',
		  'MU' => 'MAURITIUS',
		  'YT' => 'MAYOTTE',
		  'MX' => 'MEXICO',
		  'FM' => 'MICRONESIA (Federated States of Micronesia)',
		  'MD' => 'MOLDOVA',
		  'MC' => 'MONACO',
		  'MN' => 'MONGOLIA',
		  'ME' => 'MONTENEGRO',
		  'MS' => 'MONTSERRAT',
		  'MA' => 'MOROCCO',
		  'MZ' => 'MOZAMBIQUE (Moçambique)',
		  'MM' => 'MYANMAR (formerly Burma)',
		  'NA' => 'NAMIBIA',
		  'NR' => 'NAURU',
		  'NP' => 'NEPAL',
		  'NL' => 'NETHERLANDS',
		  'AN' => 'NETHERLANDS ANTILLES (obsolete)',
		  'NC' => 'NEW CALEDONIA',
		  'NZ' => 'NEW ZEALAND',
		  'NI' => 'NICARAGUA',
		  'NE' => 'NIGER',
		  'NG' => 'NIGERIA',
		  'NU' => 'NIUE',
		  'NF' => 'NORFOLK ISLAND',
		  'MP' => 'NORTHERN MARIANA ISLANDS',
		  'ND' => 'NORWAY',
		  'NO' => 'NORWAY',
		  'OM' => 'OMAN',
		  'PK' => 'PAKISTAN',
		  'PW' => 'PALAU',
		  'PS' => 'PALESTINIAN TERRITORIES',
		  'PA' => 'PANAMA',
		  'PG' => 'PAPUA NEW GUINEA',
		  'PY' => 'PARAGUAY',
		  'PE' => 'PERU',
		  'PH' => 'PHILIPPINES',
		  'PN' => 'PITCAIRN',
		  'PL' => 'POLAND',
		  'PT' => 'PORTUGAL',
		  'PR' => 'PUERTO RICO',
		  'QA' => 'QATAR',
		  'RE' => 'RÉUNION',
		  'RO' => 'ROMANIA',
		  'RU' => 'RUSSIAN FEDERATION',
		  'RW' => 'RWANDA',
		  'BL' => 'SAINT BARTHÉLEMY',
		  'SH' => 'SAINT HELENA',
		  'KN' => 'SAINT KITTS AND NEVIS',
		  'LC' => 'SAINT LUCIA',
		  'MF' => 'SAINT MARTIN (French portion)',
		  'PM' => 'SAINT PIERRE AND MIQUELON',
		  'VC' => 'SAINT VINCENT AND THE GRENADINES',
		  'WS' => 'SAMOA (formerly Western Samoa)',
		  'SM' => 'SAN MARINO (Republic of)',
		  'ST' => 'SAO TOME AND PRINCIPE',
		  'SA' => 'SAUDI ARABIA (Kingdom of Saudi Arabia)',
		  'SN' => 'SENEGAL',
		  'RS' => 'SERBIA (Republic of Serbia)',
		  'SC' => 'SEYCHELLES',
		  'SL' => 'SIERRA LEONE',
		  'SG' => 'SINGAPORE',
		  'SX' => 'SINT MAARTEN',
		  'SK' => 'SLOVAKIA (Slovak Republic)',
		  'SI' => 'SLOVENIA',
		  'SB' => 'SOLOMON ISLANDS',
		  'SO' => 'SOMALIA',
		  'ZA' => 'ZAMBIA (formerly Northern Rhodesia)',
		  'GS' => 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS',
		  'SS' => 'SOUTH SUDAN',
		  'ES' => 'SPAIN (España)',
		  'LK' => 'SRI LANKA (formerly Ceylon)',
		  'SD' => 'SUDAN',
		  'SR' => 'SURINAME',
		  'SJ' => 'SVALBARD AND JAN MAYE',
		  'SZ' => 'SWAZILAND',
		  'SE' => 'SWEDEN',
		  'CH' => 'SWITZERLAND (Confederation of Helvetia)',
		  'SY' => 'SYRIAN ARAB REPUBLIC',
		  'TW' => 'TAIWAN ("Chinese Taipei" for IOC)',
		  'TJ' => 'TAJIKISTAN',
		  'TZ' => 'TANZANIA',
		  'TH' => 'THAILAND',
		  'TL' => 'TIMOR-LESTE (formerly East Timor)',
		  'TG' => 'TOGO',
		  'TK' => 'TOKELAU',
		  'TO' => 'TONGA',
		  'TT' => 'TRINIDAD AND TOBAGO',
		  'TN' => 'TUNISIA',
		  'TR' => 'TURKEY',
		  'TM' => 'TURKMENISTAN',
		  'TC' => 'TURKS AND CAICOS ISLANDS',
		  'TV' => 'TUVALU',
		  'UG' => 'UGANDA',
		  'UA' => 'UKRAINE',
		  'AE' => 'UNITED ARAB EMIRATES',
		  'US' => 'UNITED STATES',
		  'UM' => 'UNITED STATES MINOR OUTLYING ISLANDS',
		  'UY' => 'URUGUAY',
		  'UZ' => 'UZBEKISTAN',
		  'VU' => 'VANUATU',
		  'VA' => 'VATICAN CITY (Holy See)',
		  'VN' => 'VIET NAM',
		  'VG' => 'VIRGIN ISLANDS, BRITISH',
		  'VI' => 'VIRGIN ISLANDS, U.S.',
		  'WF' => 'WALLIS AND FUTUNA',
		  'EH' => 'WESTERN SAHARA (formerly Spanish Sahara)',
		  'YE' => 'YEMEN (Yemen Arab Republic)',
		  'ZW' => 'ZIMBABWE',
		);


	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->helper('my_helper');
		$this->CI->load->library('session');
	}


	function ip_info($ip)
	{
		$url="ipinfo.io/{$ip}/json";
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");  
		curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_TIMEOUT, 20); // times out after 20s
		$st=curl_exec($ch);  
		$result=json_decode($st,TRUE);
		$get_info=curl_getinfo($ch) ;
		$httpcode=$get_info['http_code'];

		$response=array();

		if($httpcode=='200' && isset($result['country'])){
		$response['status']="success";
		
		
		$response['city']= isset($result['city'])?$result['city']:"";
		
		$country_code =isset($result['country'])?strtoupper($result['country']):"";
		if($country_code)
			$response['country']=$this->country_list[$country_code];
		else
			$response['country']="";
		
		$response['postal']=isset($result['postal'])?$result['postal']:"";
		$response['org']=isset($result['org'])?$result['org']:"";
		$response['hostname']=$result['hostname'];
		$response['region']=isset($result['region'])?$result['region']:"";

		$location=isset($result['loc'])?$result['loc']:"";
		$location=explode(",",$location);
		$response['latitude']=isset($location[0]) ? $location[0]:"";
		$response['longitude']=isset($location[1]) ? $location[1]:"";

		}	

		else{
			$response['status']="error";
		} 

		return $response; 
	}

	function free_geo_ip($ip)
	{

		$url="freegeoip.net/json/{$ip}";
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");  
		curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_TIMEOUT, 20); // times out after 20s
		$st=curl_exec($ch);  
		$result=json_decode($st,TRUE);

		$get_info=curl_getinfo($ch) ;
		$httpcode=$get_info['http_code'];

		$response=array();

		if($httpcode=='200' && isset($result['country_code']))
		{
			$response['status']="success";
			$response['city']=$result['city'];
			$county_code = strtoupper($result['country_code']);
			$response['country']=$this->country_list[$county_code];
			$response['postal']=$result['zip_code'];
			$response['latitude']=$result['latitude'];
			$response['longitude']=$result['longitude'];
		}	

		else{
			$response['status']="error";
		} 

		return $response; 

	}



	function ip_information($ip)
	{

		$ip_information=$this->free_geo_ip($ip);

		if($ip_information['status']=='error'){
			$ip_information=$this->ip_info($ip);
		}

		return $ip_information;	
	}

	/** Get Alexa Ranking, Traffic Rank, Reach Rank, Country Rank ****/
	function get_alexa_rank($domain)
	{

		try 
		{
			$doc = new DOMDocument; 
			$url="http://data.alexa.com/data?cli=10&url={$domain}";
			$doc->load($url);
			$thedocument = $doc->documentElement;
			$rankingInfo=$thedocument->getElementsByTagName('SD');

			$country="";
			$country_rank="";

			foreach($rankingInfo as $info){
				/****Get Reach Rank*****/
				$ranks=$info->getElementsByTagName('REACH');

				foreach($ranks as $rank){
					$reach_rank=$rank->getAttribute('RANK');
				}

				/****Get country Rank***/
				$countr_rank_info=$info->getElementsByTagName('COUNTRY');

				foreach($countr_rank_info as $c_info){
					$country=$c_info->getAttribute('NAME');
					$country_rank=$c_info->getAttribute('RANK');
				}

				/***** Get Traffic Rank *****/
				$ranks=$info->getElementsByTagName('POPULARITY');

				foreach($ranks as $rank){
					$traffic_rank=$rank->getAttribute('TEXT');
				}


			}

			$response['reach_rank']=isset($reach_rank)?$reach_rank:"no data";
			$response['country']=isset($country)?$country:"no data";
			$response['country_rank']=isset($country_rank)?$country_rank:"no data";
			$response['traffic_rank']=isset($traffic_rank)?$traffic_rank:"no data";

			return $response;
		} 

		catch (Exception $e) 
		{
			$url="http://getbddoctor.com/secure/alexa/index.php?domain={$domain}";
			$ch = curl_init(); // initialize curl handle
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");
			curl_setopt($ch, CURLOPT_AUTOREFERER, false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
			curl_setopt($ch, CURLOPT_REFERER, 'http://'.$url);
			curl_setopt($ch, CURLOPT_URL, $url); // set url to post to
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
			curl_setopt($ch, CURLOPT_TIMEOUT, 50); // times out after 50s
			curl_setopt($ch, CURLOPT_POST, 0); // set POST method
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_COOKIEJAR, "my_cookies.txt");
			curl_setopt($ch, CURLOPT_COOKIEFILE, "my_cookies.txt");
			$content = curl_exec($ch); // run the whole process
			$curl_info= curl_getinfo($ch);
			curl_close($ch);
			return json_decode($content,true);
		}

		

	}


	function get_ip_country($domain,$proxy='')
	{

		$domain=str_replace("www.","",$domain);
		$domain=str_replace("http://","",$domain);
		$domain=str_replace("https://","",$domain);
		$domain=str_replace("/","",$domain);
		$domain=strtolower($domain);

		$ip_link = "http://www.iplocationfinder.com/{$domain}";
		$ch = curl_init(); // initialize curl handle
		curl_setopt($ch, CURLOPT_URL,$ip_link); // set url to post to
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );

		/**** Using proxy of public and private proxy both ****/
		if($this->proxy_ip!='')
			curl_setopt($ch, CURLOPT_PROXY, $this->proxy_ip);
		
		if($this->proxy_auth_pass!='')	
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $this->proxy_auth_pass);
			
		
		$content = curl_exec($ch); // run the whole process
		curl_close($ch);

		$response=array();		

		preg_match('#<th>ISP:</th><td>(.*?)</td>#', $content, $matches);
		$response['isp']=isset($matches[1])?$matches[1] : '';

		preg_match('#<th>IP:</th><td>(.*?)</td>#', $content, $matches);
		$response['ip']=isset($matches[1])?$matches[1] : '';

		preg_match('#<th>Organization:</th><td>(.*?)</td>#', $content, $matches);
		$response['organization']=isset($matches[1])?$matches[1] : '';		

		preg_match('#<th>City:</th><td>(.*?)</td>#', $content, $matches);
		$response['city']=isset($matches[1])?$matches[1] : '';

		preg_match('#<th>Region:</th><td>(.*?)</td>#', $content, $matches);
		$response['region']=isset($matches[1])?$matches[1] : '';

		preg_match('#<th>Country:</th><td>(.*?)</td>#', $content, $matches);
		$country=isset($matches[1])?$matches[1] : '';
		$response['country'] = preg_replace("#<img.*?>#", "", $country); 

		preg_match('#<th>Timezone:</th><td>(.*?)</td>#', $content, $matches);
		$response['time_zone']=isset($matches[1])?$matches[1] : '';

		preg_match('#<th>Longitude:</th><td>(.*?)</td>#', $content, $matches);
		$response['longitude']=isset($matches[1])?$matches[1] : '';

		preg_match('#<th>Latitude:</th><td>(.*?)</td>#', $content, $matches);
		$response['latitude']=isset($matches[1])?$matches[1] : '';

		return $response;

	}

}


?>