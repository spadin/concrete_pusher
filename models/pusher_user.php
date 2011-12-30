<?php

defined('C5_EXECUTE') or die("Access Denied.");

class PusherUser extends Object {	
    
  var $user_id,
      $user_info;
  
  function PusherUser() {
    $u = new User(); 
    $this->user_id = $u->getUserId();
    
    $ui = UserInfo::getByID($this->user_id);
    $this->user_info = array(
      'name'       => $ui->getUsername(),
      'pictureUrl' => $this->get_picture_url()
    );
  }
  function getUserInfo() {
    return $this->user_info;
  }
  function getUserID() {
    return $this->user_id;
  }
  function toArray() {
    return array(
      'user_id'   => $this->user_id,
      'user_info' => $this->user_info
    );
  }
  public function get_picture_url($size='35') {
    $ui = UserInfo::getByID($this->user_id);
    $ih = Loader::helper('image'); 
    $av = Loader::helper('concrete/avatar'); 

    $avatarImgPath = $av->getImagePath( $ui, false );
    $mw = $size;
    $mh = $size;

    if( substr($avatarImgPath,0,strlen(DIR_REL))==DIR_REL ) $avatarImgPath=substr($avatarImgPath,strlen(DIR_REL));

    $thumb = $ih->getThumbnail( DIR_BASE.$avatarImgPath, $mw, $mh); 

    if($thumb->src) {
      $path = $thumb->src;  }
    else { 
      $path = $avatarImgPath; 
    }
    if($path == "") return "http://robohash.org/default.png?size=35x35&bgset=1";//"/themes/default/images/icon/avatar.png";

    return $path;
  }
}