
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form">
    <h1><b style="color: yellow">SIA UI</b> PLN</h1>
    <div class="tab-content">
        <h1>Request for Reset Password</h1>

        <?php
            $form = ActiveForm::begin([
                'id' => 'resetPassword-form',
                'options' => ['class' => 'form-horizontal'],
            ])

        ?>
            <div class = "field-wrap">
                <?php echo $form->field($model, 'first_email')->textInput(['type' => 'email', 'required autocomplete' => 'off']); ?>
            </div>

            <p class="forgot"><?php echo Html::a('Login?',Yii::$app->urlManager->createAbsoluteUrl(['site/login']));?></p>

            <?php echo Html::submitButton('Send', ['class' => 'button button-block']) ?>

        <?php ActiveForm::end() ?>

        </form>


    </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="<?php echo \Yii::$app->homeUrl;?>js/login.js"></script>

</body>
</html>
