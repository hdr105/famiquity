<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$config['base_url'] = 'http://famiquity.blogbaaz.com/';
//$config['base_url'] = 'http://' . $_SERVER['HTTP_HOST'] . "/famiquity.blogbaaz.com/";
//$config['base_url'] = 'http://localhost/famiquity/';
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';

if ($_SERVER['HTTP_HOST'] == 'localhost') {
	$config['base_url'] =	$protocol.$_SERVER['HTTP_HOST'].'/famiquity/';
}else{
	$config['base_url'] =	 $protocol.$_SERVER['HTTP_HOST'].'/';
}
$config['index_page'] = '';
$config['uri_protocol']	= 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'Pixel_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 4;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = '';
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 600;
$config['sess_regenerate_destroy'] = FALSE;

$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= TRUE;

$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;

$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'humanity_token';
$config['csrf_cookie_name'] = 'humanity_cookie';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = FALSE;
$config['csrf_exclude_uris'] = array();
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
$config['notification_sender_address'] = 'haadi.javaid@gmail.com';
$config['notification_sender'] = 'Famiquity';