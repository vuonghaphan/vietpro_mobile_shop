<?php

require_once '../src/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '550596582188041', // Replace {app-id} with your app id
  'app_secret' => 'cafae5ed96dd993f43b3a4729bc254f8',
  'default_graph_version' => 'v5.0'
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://localhost/PHPk178/vietpro_mobile_shop/admin/facebook/fb-callback.php', $permissions);

echo '<a href="'. htmlspecialchars($loginUrl) .'">đăng nhập bằng Facebook</a>';
?>
