<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
Loader::model('single_page');

class PusherPackage extends Package {
  
  protected $pkgHandle = 'pusher';
  protected $appVersionRequired = '5.4.2.2';
  protected $pkgVersion = '0.9';

  public function getPackageDescription() {
    return t("Allows global Pusher configuration.");
  }

  public function getPackageName() {
    return t("Pusher");
  }
     
  public function install() {
    $pkg = parent::install();
    
    SinglePage::add('pusher', $pkg);
    PageTheme::add('pusher', $pkg);

    // Add dashboard page
    $dvc = SinglePage::add('dashboard/pusher', $pkg);
		$dvc->update(
		  array(
        'cName'         => t('Pusher'), 
        'cDescription'  => t('Configure Pusher settings.')
      )
    );
  }   
}

?>