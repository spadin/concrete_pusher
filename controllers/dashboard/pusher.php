<?php defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('pusher_configuration','pusher');

class DashboardPusherController extends Controller { 
  
  public function view() {
    
  }
  
  public function on_before_render() {
    $config = PusherConfiguration::get();
    $this->set('config', $config);
  }
  
  public function update() {
    $flash = Loader::helper('flash_data','flash_data');
    
    $updated = PusherConfiguration::updateByValues(array(
      'appId'     => $_POST['appId'],
      'appKey'    => $_POST['appKey'],
      'secretKey' => $_POST['secretKey']
    ));
    
    if($updated) {
      $flash->notice("Successfully updated configuration.");
    }
    else {
      $flash->error("Couldn't save configuration to the database.");
    }
    $this->redirect('/dashboard/pusher');
  }
}
?>