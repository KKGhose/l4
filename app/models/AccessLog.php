<?php

class AccessLog extends Eloquent {

	protected $table = 'accessLogs';
	
	protected $guarded = array();

	public static $rules = array();


	public function save_log(AccessLog $log,  $action = '')
	{
		$var = get_browser(null); 

		$log->page_url = 'L4->'.$action;
		$log->ip = $_SERVER['REMOTE_ADDR'];
		$log->host = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
		$log->user_agent = 'Browser: '.$var->parent.', OS: '.$var->platform;
		$log->save();

		return;
	}
}