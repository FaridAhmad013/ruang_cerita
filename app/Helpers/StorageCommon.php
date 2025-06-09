<?php
namespace App\Helpers;

class StorageCommon {

    private $service, $error, $res, $type;
    public $home_path;

    function __construct($type = 'filerun')
    {
        $this->service = null;
        $this->type = $type;
        if($type == 'filerun'){
            $this->home_path = '/ROOT/HOME/';
        }
    }
    
    public function init_service(){
        if($this->type == 'filerun'){
            $this->service = new FileRun([
                'url' => 'https://storage.srv.co.id/',
                'client_id' => '5b36e28db0ad8724d874b4a81232832b',
                'client_secret' => 'cjODBKnafBiXYXt25ee2ERE2yS0CUjiVxlaqf5gC',
                'username' => 'superuser',
                'password' => 'rahasia',
                'scope' => ['profile', 'list', 'upload', 'download', 'weblink', 'delete', 'share', 'admin', 'modify', 'metadata']
            ]);
            
            $this->service->connect();
        }
    }

    public function getError(){
        return $this->error;
    }

    public function getRes(){
        return $this->res;
    }
   
    public function user_info(){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->getUserInfo();
        if ($rs) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }
    
    public function avatar(){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->getAvatar();
        if ($rs) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function create_folder($folder){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }

        $rs = $this->service->createFolder(['path' => $this->home_path, 'name' => $folder]);
        if ($rs && $rs['success']) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function list_folder(){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }

        $rs = $this->service->getFolderList(['path' => $this->home_path, 'details' => ['uuid']]);
        if ($rs && $rs['success']) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function upload_file($path, $file){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->uploadFile(['path' => $this->home_path.$path ], $file);
        if ($rs && $rs['success']) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function download($param){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->downloadFile($param);
        if ($rs) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function download_thumbnail($param){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->downloadThumbnail($param);
        if ($rs) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function delete_folder($path){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->delete(['path' => $this->home_path.$path]);
        if ($rs && $rs['success']) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }

    public function delete_file($path, $file){
        $this->init_service();
        $this->error = null;
        $this->res = null;
        if($this->service == null){
            $this->error = "Service Null";
            return false;
        }
        
        $rs = $this->service->delete(['path' => $this->home_path.$path.''.($path ? "/".$file: $file)]);
        if ($rs && $rs['success']) {
            $this->res = $rs;
            return true;
        } else {
            $this->error = $this->service->getError();
            return false;
        }
    }
}