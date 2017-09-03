<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>SIA</title>
    <?php $this->head() ?>

	    <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo \Yii::$app->homeUrl;?>css/login-style.css">
        <link rel="stylesheet" href="<?php echo \Yii::$app->homeUrl;?>css/login-style2.css">

</head>
<?php $this->beginBody() ?>
<body>
  <!-- Top content -->
        <div class="top-content">
        	 <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>SIA UI</strong> PLN </h1>
                            <div class="description">
                            	<p>

                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Sistem Informasi Duty Manager</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <?php foreach (\Yii::$app->session->getAllFlashes() as $message):; ?>
                              <?php
                              echo \kartik\widgets\Growl::widget([
                                  'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
                                  'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Title Not Set!',
                                  'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
                                  'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Message Not Set!',
                                  'showSeparator' => true,
                                  'delay' => 1, //This delay is how long before the message shows
                                  'pluginOptions' => [
                                      'delay' => (!empty($message['duration'])) ? $message['duration'] : 3000, //This delay is how long the message shows for
                                      'placement' => [
                                          'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                                          'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                                      ]
                                  ]
                              ]);
                              ?>
                            <?php endforeach; ?>
                            <div class="form-bottom">
                               <?= $content; ?>

		                      </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="<?php echo \Yii::$app->homeUrl;?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo \Yii::$app->homeUrl;?>js/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo \Yii::$app->homeUrl;?>js/jquery.backstretch.min.js"></script>
        <script src="<?php echo \Yii::$app->homeUrl;?>js/scripts.js"></script>

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
</body>
<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
