<?php
namespace Tickets\Service;

use Zend\Validator\File\Extension;

class FileService
{
   
    protected static $path = '/var/www/pmts/public/files/';
    protected $_file = null;

    public function setFile($file)
    {
        if(null === $this->_file){
            $this->_file = $file;
        }
    }
    
    public function getFile($key = 'name')
    {
        if($key == ''){
            return $this->_file['file'];
        }
        return $this->_file['file'][$key];
    }
      
    public function saveFile($mode = 'move')
    {
        //save file in tmp folder
        if($mode == 'tmp'){
            return $this->saveTmpFile();
        }
        
        $tmpFile = self::$path.'tmp/'.$this->getFile('tmp_file');
        $newFile = self::$path.'/'.$this->getFile('fileupload');
        
        $thumbFile = self::$path.'tmp/th_'.$this->getFile('tmp_file');
        $newThumbFile = self::$path.'/th_'.$this->getFile('fileupload');
        
        if(file_exists($tmpFile)){
            
            rename($tmpFile,$newFile);
            
            if(file_exists($thumbFile)){
                 rename($thumbFile,$newThumbFile);
            }
            
            return $this->getFile();
        }
        return false;
        
        
    }
    
    public function removeFile($filename, $mode = 'tmp')
    {
        if($mode == 'tmp'){
            $path = self::$path.'tmp/';
            $thumbPath = self::$path.'tmp/th_';        
        }else{
            $path = self::$path;
            $thumbPath = self::$path.'th_';
        }
        
        if(file_exists($path.$filename)){
            
            unlink($path.$filename);
            
            if(file_exists($thumbPath.$filename)){
                 unlink($thumbPath.$filename);
            }
            
            return true;
        }
    }
    
    public function saveTmpFile()
    {
        $fileTmpName = $this->getFile('tmp_name');
        $filename = $this->getFile('name');
        $newFile = self::$path.$filename;
        
        if(move_uploaded_file($fileTmpName, $newFile)){
            
            if($this->getFileValidator()->isValid($newFile)){
                $extension = pathinfo($newFile, PATHINFO_EXTENSION);
                $tmpName = md5(microtime()).'.'.$extension;
                $tmpFile = self::$path.'tmp/'.$tmpName;
                rename($newFile,$tmpFile);
                   
                    if($extension == 'gif' || $extension == 'jpg' || $extension == 'png'){
                        $tmpFile = $this->createImageThumb($tmpFile, $tmpName);
                    }
                    return $tmpName;
            }
            unlink($newFile);
            return false;
        }
        return false;
    }
       
    
    public function getFileExtension()
    {
        
    }
    
    public function validateFile()
    {
        
    }
    
    public function createImageThumb($image, $tmpName)
    {
        $maxWidth = 280;
        $thumb = new \Imagick($image);
        $imgWidth = $thumb->getImageWidth();
        $thumbFile = self::$path.'th_'.$tmpName;
        
        if($imgWidth > $maxWidth){
            $thumb->scaleImage($maxWidth, 0);
            
            if($thumb->writeimage($thumbFile)){
                $thumb->destroy();
                return $thumbFile;
            }else{
                return false;
            }
        }
        return true;
    }
    
    
    public function getFileValidator()
    {
        $allowedExtension = array(
            'jpg',
            'png',
            'gif',
            'pdf',
            'doc',
            'txt',
        ); 
        
        $validator = new Extension($allowedExtension);
        return $validator;
    }
        
}

