<?php

namespace PW\LouvreBundle\Services;


class PWCheckoutValidation
{

	public function checkout($token, $email, $amount)
	{
		$error = false;

		try {
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
				));

			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $amount,
				'currency' => 'eur'
				));
		}catch (\Stripe\Error\Card $e) {
			$error = true;
		} catch (\Stripe\Error\RateLimit $e) {
			$error = true;
		} catch (\Stripe\Error\InvalidRequest $e) {
			$error = true;
		} catch (\Stripe\Error\Authentication $e) {
			$error = true;
		} catch (\Stripe\Error\ApiConnection $e) {
			$error = true;
		} catch (\Stripe\Error\Base $e) {
			$error = true;
		} catch (Exception $e) {
			$error = true;
		}
		if($error){
			return false;
		}
		else{
			return true;
		}
	}
}
