<?php

class AccessLog extends Eloquent {

	protected $table = 'accessLogs';
	
	protected $guarded = array();

	public static $rules = array();
}