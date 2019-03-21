<?php
namespace Org\Weixinpay;
class  SDKRuntimeException extends Exception {

	public function errorMessage()

	{

		return $this->getMessage();

	}



}
?>