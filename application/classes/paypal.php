<?php defined('SYSPATH') or die('No direct script access.');

class Paypal {

private $_production = "0";
private $_production_url = "https://www.paypal.com/cgi-bin/webscr";
private $_production_main_url = "www.paypal.com";
private $_sandbox_url = "https://sandbox.paypal.com/cgi-bin/webscr";
private $_sandbox_main_url = "sandbox.paypal.com";
private $_cmd = "_xclick";
private $_amount = "";
private $_notify_url = "";
private $_business = "yourpaypal@email.com"; //change this to your sandbox email if not in production
private $_currency_code = "USD";
private $_invoice = "";
private $_item_name = "";
private $_image_url = "";
private $_return_url = "";
private $_cancel_return = "";
private $_first_name = "";
private $_last_name = "";
private $_address1 = "";
private $_address2 = "";
private $_city = "";
private $_state = "";
private $_zip = "";
private $_country = "";
private $_email = "";
private $_no_note = "1";
private $_no_shipping = "1";
private $_custom = "";


/* Settings module */


private function convert_to_url(){
		$url = "cmd=". urlencode($this->_cmd). "&"
				."amount=". urlencode($this->_amount). "&"
				."notify_url=". urlencode($this->_notify_url). "&"
				."business=". urlencode($this->_business). "&"
				."currency_code=". urlencode($this->_currency_code). "&"
				."invoice=". urlencode($this->_invoice). "&"
				."item_name=". urlencode($this->_item_name). "&"
				."image_url=". urlencode($this->_image_url). "&"
				."return=". urlencode($this->_return_url). "&"
				."cancel_return=". urlencode($this->_cancel_return). "&"
				."first_name=". urlencode($this->_first_name). "&"
				."last_name=". urlencode($this->_last_name). "&"
				."address1=". urlencode($this->_address1). "&"
				."address2=". urlencode($this->_address2). "&"
				."city=". urlencode($this->_city). "&"
				."state=". urlencode($this->_state). "&"
				."zip=". urlencode($this->_zip). "&"
				."country=". urlencode($this->_country). "&"
				."email=". urlencode($this->_email). "&"
				."no_note=". urlencode($this->_no_note). "&"
				."custom=". urlencode($this->_custom). "&"
				."no_shipping=". urlencode($this->_no_shipping). "&";
			
		return $url;
					
	}
	
public function process_single(){
		if ($this->_production == "0"){
			$main_url = $this->_sandbox_url;
		}else{
			$main_url = $this->_production_url;
		}
	
		Request::instance()->redirect($main_url. "?". $this->convert_to_url());
		/*
$ch = curl_init($main_url);
		curl_setopt ($ch, CURLOPT_POST, 1);
 		curl_setopt ($ch, CURLOPT_POSTFIELDS, $this->convert_to_url());
 		curl_exec ($ch);
 		curl_close ($ch);
*/
	}
	
public function notify(){
		
		if ($this->_production == "0"){
			$url = $this->_sandbox_main_url;
		}else{
			$url = $this->_production_main_url;
		}
	
	error_reporting(E_ALL ^ E_NOTICE); 
			
			$header = ""; 
			$emailtext = ""; 
			// Read the post from PayPal and add 'cmd' 
			$req = 'cmd=_notify-validate'; 
			if(function_exists('get_magic_quotes_gpc')) 
			{
				$get_magic_quotes_exits = true;
			} 
			
			foreach ($_POST as $key => $value) 
			// Handle escape characters, which depends on setting of magic quotes 
			{
				if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1){ 
					$value = urlencode(stripslashes($value));
				}else{ 
					$value = urlencode($value);
				} 
			$req .= "&$key=$value";
			} 
			// Post back to PayPal to validate 
			$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
			$header .= "Content-Length: " . strlen($req) . "\r\n\r\n"; 
			$fp = fsockopen ('ssl://'. $url, 443, $errno, $errstr, 30);
			
			
			// Process validation from PayPal 
			// TODO: This sample does not test the HTTP response code. All 
			// HTTP response codes must be handles or you should use an HTTP // library, such as cUrl

			if (!$fp) { // HTTP ERROR 
			
			}else{ 
				// NO HTTP ERROR 
				fputs ($fp, $header . $req); 
				
				while (!feof($fp)) {
					$res = fgets ($fp, 1024); 
					if (strcmp ($res, "VERIFIED") == 0) {
						
						// Check if payment has been made already
						// Check 
						// Check 
						// Check 
						// Check 
						// Process payment 
						
						return TRUE;
					} else if (strcmp ($res, "INVALID") == 0) {
						// If 'INVALID', send an email. TODO: Log for manual investigation. 
						
						return FALSE;
					}
				} 
				
				fclose ($fp);
		}
		
	}
	
	/*variables */
	public function production($data){
		$this->_production = $data;
		return $this;
	}
	
	public function production_url($data){
		$this->_production_url = $data;
		return $this;
	}

	
	public function production_main_url($data){
		$this->_production_main_url = $data;
		return $this;
	}

	
	public function sandbox_url($data){
		$this->_sandbox_url = $data;
		return $this;
	}

	
	public function sandbox_main_url($data){
		$this->_sandbox_main_url = $data;
		return $this;
	}

	
	public function cmd($data){
		$this->_cmd = $data;
		return $this;
	}

	
	public function amount($data){
		$this->_amount = $data;
		return $this;
	}

	
	public function notify_url($data){
		$this->_notify_url = $data;
		return $this;
	}

	
	public function business($data){
		$this->_business = $data;
		return $this;
	}

	
	public function currency_code($data){
		$this->_currency_code = $data;
		return $this;
	}

	
	public function invoice($data){
		$this->_invoice = $data;
		return $this;
	}

	
	public function item_name($data){
		$this->_item_name = $data;
		return $this;
	}

	
	public function image_url($data){
		$this->_image_url = $data;
		return $this;
	}

	
	public function return_url($data){
		$this->_return_url = $data;
		return $this;
	}

	
	public function cancel_return($data){
		$this->_cancel_return = $data;
		return $this;
	}

	
	public function first_name($data){
		$this->_first_name = $data;
		return $this;
	}

	
	public function last_name($data){
		$this->_last_name = $data;
		return $this;
	}

	
	public function address1($data){
		$this->_address1 = $data;
		return $this;
	}

	
	public function address2($data){
		$this->_address2 = $data;
		return $this;
	}

	
	public function city($data){
		$this->_city = $data;
		return $this;
	}

	
	public function state($data){
		$this->_state = $data;
		return $this;
	}

	
	public function zip($data){
		$this->_zip = $data;
		return $this;
	}

	
	public function country($data){
		$this->_country = $data;
		return $this;
	}

	
	public function email($data){
		$this->_email = $data;
		return $this;
	}

	
	public function no_note($data){
		$this->_no_note = $data;
		return $this;
	}

	
	public function no_shipping($data){
		$this->_no_shipping = $data;
		return $this;
	}

	
	public function custom($data){
		$this->_custom = $data;
		return $this;
	}
	
} 
?>