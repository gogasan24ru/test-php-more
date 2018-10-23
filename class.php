<?php
class PathBuilder
{
	//https://secure.php.net/manual/ru/function.levenshtein.php#113702
	function utf8_to_extended_ascii($str, &$map)
	{
		$matches = array();
		if (!preg_match_all('/[\xC0-\xF7][\x80-\xBF]+/', $str, $matches))
		        return $str; // plain ascii string
    		foreach ($matches[0] as $mbc)
        		if (!isset($map[$mbc]))
           			$map[$mbc] = chr(128 + count($map));
	    	return strtr($str, $map);
	}
	function levenshtein_utf8($s1, $s2)
	{
		$charMap = array();
		$s1 = $this->utf8_to_extended_ascii($s1, $charMap);
		$s2 = $this->utf8_to_extended_ascii($s2, $charMap);
		return levenshtein($s1, $s2);
	}


        var $library;
        function path($from,$to,$ret=Array(),$counter=0){
		$counter++;
		if($counter>100){$ret[]="EXITING"; print_r($ret); return $ret;}
		//$ret=$path;
		//if (count($ret)==0)
	        if(end($ret)!=$from)$ret[]=$from;
		$ways=$this->findWays($from);
		//print_r($ways);
		//print_r($ret);
		if(in_array($to,$ways))
		{
		        $ret[]=$to;
                        return $ret;
		}
		//if(count($ways)==1)
		//{
		//	print_r($ways);
		//	print_r($ret);
		//	return Array("No way found");
		//}
		foreach ($ways as $way)
		{
			if(!in_array($way,$ret))
			{
				$ret=$this->path($way,$to,$ret,$counter);
				if(end($ret)==$to)return $ret;
			}
		}
		return $ret;
	}
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

	function findWays($source)
	{
		$ret=Array();
		foreach ($this->library as $word)
		{
			if($this->levenshtein_utf8($word,$source)==1)
				$ret[]=$word;
		}
		return $ret;
	}

}

?>
