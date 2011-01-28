<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Payment extends Controller_Template {

	public $template = "yourtemplate";

	public function action_index(){
		$amount = 99;
		$desc = "Product description here.";
		
		$paypal = new Paypal;

		$paypal->item_name($desc)
			->amount($amount)
			->notify_url("http://domain.com/payment/notify")
			->return_url("http://domain.com/payment/thankyou") //your thank you page, where paypal will be redirected after the transaction
			->cancel_return("http://domain.com/payment/cancel")
			->custom("custom info")
			->process_single();
	}
	
	public function action_notify(){
			$this->auto_render = FALSE;
			$paypal = new Paypal;
			$process = $paypal->notify();

			if ($process){ // if the payment is successfully implemented
				
				//interpret $_POST variables coming from Paypal here. 

			}
	}
	
}
?> 