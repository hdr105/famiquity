<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BackupController extends CI_Controller  
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('file');
		$this->load->helper('directory');
		$this->load->library('zip');
		
	}

	public function index()
	{
		
		$application = "./application";
		$assets = "./assets";
		$system = "./system";
		$indexfile = "./index.php";
		$htaccessfile = "./.htaccess";
		$dest = './backup/code-backup-on-'. date("Y-m-d-H-i-s");
		$bk_application = $this->folder_backup($application,$dest,"/application");
		if($bk_application)
		{
			$bk_assets = $this->folder_backup($assets,$dest,"/assets");
			if($bk_assets)
			{
				$bk_system = $this->folder_backup($system,$dest,"/system");
			}
			if($bk_system)
			{
				$bk_index = $this->CopyFiles($indexfile,$dest."/index.php");
				if($bk_index)
				{
					$bk_htaccess = $this->CopyFiles($htaccessfile,$dest."/ .htaccess");
					if($bk_htaccess)
					{
						$bk_database = $this->database_backup($dest);
						if($bk_database)
						{
							$this->zip->read_dir($dest);
						}
					}
				}
			}
		}
		
		
		


		delete_files($dest, true);
		rmdir($dest);

		$files = get_filenames('./backup');

		if (count($files) > 14) {

			unlink("./backup/".current($files));
		}

		$zipped = $this->zip->archive('./backup/code-backup-on-'. date("Y-m-d-H-i-s").'.zip'); 
		if($zipped)
		{
			redirect(base_url());
		}
		
		
		
	}

	public function database_backup($dest)
	{

		if(!is_dir($dest."/database"))
		{
			mkdir($dest."/database", 0777, true);
		}

		$this->load->dbutil();

		$prefs = array(     
			'format'      => 'zip',             
			'filename'    => 'db_backup.sql'
		);

		$db_name = 'database-backup-on-'. date("Y-m-d-H-i-s") .'.zip';

		$backuped = write_file($dest.'/database/'.$db_name, $this->dbutil->backup($prefs));
		if($backuped)
		{
			return true;
		}
		else
		{
			return false;
		} 



	}


	function folder_backup($source,$dest,$folder,$app =true)
	{

		if(is_dir($source))
		{
			if(!is_dir($dest))
			{
				mkdir($dest, 0777, true);
			}

			if(!is_dir($dest.$folder) && $app == true)
			{
				mkdir($dest.$folder, 0777, true);
			}

			$dir_items = array_diff(scandir($source), array('..', '.'));

			if(count($dir_items) > 0)
			{
				foreach($dir_items as $v)
				{

					if ($app == true) {
						
						$this->folder_backup(rtrim(rtrim($source, '/'), '\\').DIRECTORY_SEPARATOR.$v, rtrim(rtrim($dest.$folder, '/'), '\\').DIRECTORY_SEPARATOR.$v,false);
					}else{

						$this->folder_backup(rtrim(rtrim($source, '/'), '\\').DIRECTORY_SEPARATOR.$v, rtrim(rtrim($dest."/", '/'), '\\').DIRECTORY_SEPARATOR.$v,false);
					}


				}
				return true;
				
			}


		}
		elseif(is_file($source))
		{
			copy($source, $dest);
		}
	}


	public function CopyFiles($source, $dest)
	{
		if(is_file($source))
		{
			copy($source, $dest);
			return true;
		}
	}



}