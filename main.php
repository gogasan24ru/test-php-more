<?php
require_once "class.php";
mb_internal_encoding("UTF-8");

function renderPath($p)
{
	$line="";
	foreach ($p as $i)
	{
		$line.=$i.'=>';
	}
	echo trim($line,"=>")."\n";
}

//renderPath(Array("AAAA","BBBB"));

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
				if(strlen($from)!=8)
					throw new Exception("argument from: invalid lenght");
			$to=$argv[array_search("--path", $argv)+2];
				if(strlen($to)!=8)
                                        throw new Exception("argument to: invalid lenght");
			echo "Arguments: from: $from, to: $to\n";
			if(in_array("--ways", $argv))
			{//display ways and exit
				print_r($pb->findWays($from));
				exit(0);
			}
			$path=$pb->path($from,$to);
			renderPath($path);
			//print_r($pb->findWays($from));
		}
		catch(Exception $e)
		{throw $e;}
	}
}


?>
