<?php
namespace Utility\Payment\Modules;

use Utility\Payment\Transaction;

use Utility\Payment\Order;
use Utility\Payment\External;

class Alertpay implements IPaymentModule {
	const SANDBOX_URL = 'https://sandbox.Payza.com/sandbox/payprocess.aspx';
	const SANDBOX_IPN = 'https://sandbox.Payza.com/sandbox/IPN2.ashx';
	
	protected $ipn;
	protected $account;
	protected $p;
	
	function __construct($ipn,$account){
		$this->ipn = $ipn;
		$this->account = $account;
		
		$this->p = new External\Paypal();
		
		if($this->sandbox)
			$this->p->url = self::SANDBOX_URL;
		
		$this->p->add_field ( 'ap_merchant', $this->account );
		$this->p->add_field ( 'ap_returnurl', $this->ipn . '?action=success' );
		$this->p->add_field ( 'ap_cancelurl', $this->ipn . '?action=cancel' );
		$this->p->add_field ( 'notify_url', $this->ipn . '?action=ipn' );
	}
	private $sandbox;
	function sandboxed($is){
		$this->sandbox = $is;
		if($is)
			$this->p->paypal_url = self::SANDBOX_URL;
	}
	function bill($order){
		if(!is_object($order))
			$order = new Order($order);
		
		if($order->name)
			$this->p->add_field ( 'ap_itemname', $order->name );
		
		$this->p->add_field ( 'ap_amount', $order->ammount );
		
		if($order->item)
			$this->p->add_field ('ap_itemcode', $order->item );
		
		$this->p->submit ();
	}
	function subscribe($ammount){
		
	}
	function ipn(){
		if ($this->p->validate_ipn () && $this->p->ipn_data['payment_status'] == 'Completed') {
			$transaction = new Transaction();
			$transaction->id = $p->ipn_data['txn_id'];
			
			$transaction->gross = $p->ipn_data ['mc_gross'];
			$transaction->fee = $p->ipn_data['mc_fee'];
			
			$order = new Order($transaction->gross - $transaction->fee);
			$order->name = $p->ipn_data['item_name'];
			$order->item = $p->ipn_data['item_number'];
			
			$transaction->order = $order;
			
			return $transaction;
		}
	}
}