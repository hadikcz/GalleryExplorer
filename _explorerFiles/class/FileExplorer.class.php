<?php
/**
    The MIT License (MIT)

    Copyright (c) 2015 @author Vladimír Novák<hadikcze@gmail.com>

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 **/
class FileExplorer {
    
    /**
     * Root directory for gallery
     * @var string
     */
    private $rootDirectory;
        
    /**
     * Directory for CSS, images in templates
     * @var string
     */
    private $dataDirecotry;
    
    /**
     * List of ignore files for scanner
     * @var array
     */
    private $ignoreList = array('.','..','index.php','help.html', 'index.html', 'album.rss');
    
    function __construct($root, $dataDir) {
        $this->rootDirectory = $root;
        $this->dataDirecotry = $dataDir;
        $this->ignoreList[] = $dataDir;
        
    }
    public function getDirectories(){
        $scan =  $this->getDirectoryScan();
        $scan = $this->removeIgnored($scan);
        $scan = $this->checkForIndexFiles($scan);
        $scan = $this->getInfoData($scan);
        return $scan;
    }
    
    private function getDirectoryScan($path = null){
        if($path != null){
            return scandir(dirname($path));
        }
        return scandir($this->rootDirectory);
    }
    
    private function removeIgnored($scan){
        $result = array();
        foreach($scan as $row){
            if(!in_array($row, $this->ignoreList)){
                $result[] = $row;
            }
        }
        return $result;
    }
    
    private function checkForIndexFiles($scan){
        $result = array();
        foreach($scan as $row){
            if(file_exists($this->rootDirectory . "/" . $row . '/index.html')){
                $result[] = $row;
            }
        }
        return $result;
    }
    
    private function getInfoData($scan){
        $result = array();
        foreach($scan as $row){
            $dir = new stdClass();
            $dir->name = $row;
            $dir->path = $row . '/index.html';
            $result[] = $dir;
        }
        return $result;
    }
}
