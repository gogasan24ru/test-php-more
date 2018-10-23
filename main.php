<?php
mb_internal_encoding("UTF-8");
class PathBuilder
{
	var $library;
	function path($from,$to){}
	function PathBuilder($path){
		$library=Array();
			try {
				$libraryContents=trim(file_get_contents($path),PHP_EOL);
				$this->library=explode(PHP_EOL, $libraryContents);
			} catch (Exception $e) {
				throw e;
			}

		if(count($this->library)==0)
		{
			throw new Exception("Library is empty");
		}
	}
	function Count()
	{
		return count($this->library);
	}
}

if(in_array("--library", $argv))
{
	try{
		$filenameIndex=array_search("--library", $argv)+1;
		$filename=$argv[$filenameIndex];
		if(!file_exists($filename))throw  new Exception("Source file doesnt exist");
		$pb = new PathBuilder($filename);
		echo $pb->Count()." words loaded\n";
	}
	catch(Exception $e)
	{throw $e;}
	
	if(in_array("--path", $argv))
	{
		try{
			$from=$argv[array_search("--path", $argv)+1];
			$to=$argv[array_search("--path", $argv)+2];
			echo "Arguments: from: $from, to: $to\n";
			$path=$pb->path($from,$to);
		}
		catch(Exception $e)
		{throw $e;}
	}
}


?>