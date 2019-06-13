<?php
namespace App\Model\Entity;

use Cake\I18n\Time;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use Cake\Utility\Text;


trait FuncoesTrait
{
        
    public function formatNumber($data){
        if (@$data == null) return null;
        return preg_replace('/[^0-9]/', '', (string) $data);
    }

    public function formatAlpha($data){
        if (@$data == null) return null;
        return mb_strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', (string) $data)) ;
    }

    public function getPath($field, $folder){
        return @!is_null($this->_properties[$field]) ?  'http://'.$_SERVER['HTTP_HOST']. DS . $folder.$this->_properties[$field] : null;
    }

    public function formatDateTime($data, $padrao = 'Y-m-d' ){
        if(@!is_null($data)){
            $data = new Time($data);
            return $data->format($padrao);
        } 
        return $data;
    }
}