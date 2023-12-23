<?php

use Marifhasan\Helpers\Helpers;

if (!function_exists('to_qty')) {

	/**
	 * Convert number to words
	 *
	 * @param string $amount
	 * @return string
	 */
	function to_qty($amount)
	{
		return Helpers::toQuantity($amount);
	}
}

if (!function_exists('to_amount')) {

	/**
	 * Convert number to words
	 *
	 * @param string $amount
	 * @return string
	 */
	function to_amount($amount)
	{
		return Helpers::toAmount($amount);
	}
}

if (!function_exists('to_ordinal')) {

	/**
	 * Convert number to words
	 *
	 * @param string $amount
	 * @return string
	 */
	function to_ordinal($amount)
	{
		return Helpers::toOrdinal($amount);
	}
}

if (!function_exists('to_number')) {

	/**
	 * Convert number to words
	 *
	 * @param string $amount
	 * @return string
	 */
	function to_number($amount)
	{
		return Helpers::toNumber($amount);
	}
}

if (!function_exists('to_closing')) {

	/**
	 * Convert number to words
	 *
	 * @param string $amount
	 * @return string
	 */
	function to_closing($amount)
	{
		return Helpers::toClosing($amount);
	}
}

if (!function_exists('to_words')) {

	/**
	 * Convert number to words
	 *
	 * @param string $amount
	 * @return string
	 */
	function to_words($amount, $currency = null)
	{
		return Helpers::toWords($amount, $currency);
	}
}
