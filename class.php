<?php
class PathBuilder
{
        var $library;
        function path($from,$to,$ret=Array()){
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
		if(count($ways)==1)return Array();
		foreach ($ways as $way)
		{
			if(!in_array($way,$ret))
			{
				if($way===$to)
				{
				}
				else
				{
					$ret=$this->path($way,$to,$ret);
					if(end($ret)==$to)return $ret;
				}
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
			if(levenshtein($word,$source)==1)
				$ret[]=$word;
		}
		return $ret;
	}

}

?>
