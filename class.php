<?php
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

?>
