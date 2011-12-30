<?php
defined('C5_EXECUTE') or die("Access Denied.");

$ih      = Loader::helper('concrete/interface');
$cap     = Loader::helper('concrete/dashboard');
$valt    = Loader::helper('validation/token');
$form    = Loader::helper('form');
$flash = Loader::helper('flash_data','flash_data');

?>
<? if($n = $flash->notice()): ?>
  <div class='message success'><?= $n; ?></div>
<? elseif($e = $flash->error()): ?>
  <div class='message error'><?= $e; ?></div>
<? endif ?>
<h1>
  <span><?= t('Pusher Configuration') ?></span>
</h1>
<div class="ccm-dashboard-inner">
  <form action="<?= $form->action('/dashboard/pusher','update'); ?>" method="post" accept-charset="utf-8" id="update_pusher">
    <fieldset>
      <label for="appId">App ID</label>
      <input type="text" name="appId" value="<?= $config->getAppId(); ?>" class="text" id="appId">
      
      <label for="appKey">App Key</label>
      <input type="text" name="appKey" value="<?= $config->getAppKey(); ?>" class="text" id="appKey">
      
      <label for="secretKey">Secret Key</label>
      <input type="text" name="secretKey" value="<?= $config->getSecretKey(); ?>" class="text" id="secretKey">
    </fieldset>
    <p><input type="submit" value="Save &rarr;"></p>
  </form>
</div>
<style type="text/css" media="screen">
  label {
    display: block;
    margin-top: 10px;
  }
  input.text {
    font-size: 14px;
    width: 300px;
  }
</style>