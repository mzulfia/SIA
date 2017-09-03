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
      <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <link rel="stylesheet" href="<?php echo \Yii::$app->homeUrl;?>css/site.css">
      <link rel="stylesheet" href="<?php echo \Yii::$app->homeUrl;?>css/login-style.css">
      <link rel="stylesheet" href="<?php echo \Yii::$app->homeUrl;?>css/login-style2.css">

</head>
<body>
    <?= $content; ?>

    <!-- Javascript -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="<?php echo \Yii::$app->homeUrl;?>js/login.js"></script>

    <!--[if lt IE 10]>
        <script src="assets/js/placeholder.js"></script>
    <![endif]-->
</body>
<?php $this->endBody() ?>
</html>
