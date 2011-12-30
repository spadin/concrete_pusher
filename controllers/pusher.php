<?php defined('C5_EXECUTE') or die("Access Denied.");

Loader::packageElement('Pusher', 'pusher');
Loader::model('pusher_configuration','pusher');
Loader::model('pusher_user','pusher');

class PusherController extends Controller { 
  var $config;
  
  public function view() {
    $this->set_theme();
    $this->redirect('/');
  }
  public function auth() {
    $this->set_theme();
    
    $user = new PusherUser();
    $user_id = $user->getUserID();
    $user_info = $user->getUserInfo();
    
    $json = $this->pusher->presence_auth($_REQUEST['channel_name'],$_REQUEST['socket_id'], $user_id, $user_info);
    $this->set('json', $json);
  }
  
  public function on_start() {
    $this->config = PusherConfiguration::get();
    $appKey       = $this->config->getAppKey();
    $appId        = $this->config->getAppId();
    $secretKey    = $this->config->getSecretKey();
    $this->pusher = new Pusher($appKey, $secretKey, $appId);
  }
  
  public function set_theme() {
    $pt = PageTheme::getByHandle("pusher");
    $v  = View::getInstance();
    $v->setThemeByPath('/pusher', $pt);
    
    if(isset($_GET['callback']) && $_GET['callback'] <> '') {
      $this->set('callback', $_GET['callback']);
    }
  }
}
?>