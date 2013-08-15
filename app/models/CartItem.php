<?php

class CartItem extends Eloquent {

	protected $table = 'cartItems';
	
	protected $guarded = array();

	public static $rules = array();

}