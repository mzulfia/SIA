
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form">
    <h1><b style="color: yellow">SIA UI</b> PLN</h1>
    <ul class="tab-group">
      <li class="tab active"><a href="#signup">Sign Up</a></li>
      <li class="tab"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">
      <div id="signup">
        <h1>Sign Up for Free</h1>

        <?php
            $form = ActiveForm::begin([
                'id' => 'signup-form',
                'options' => ['class' => 'form-horizontal'],
            ])

        ?>
            <div class = "field-wrap">
                <?php echo $form->field($model_2, 'full_name')->textInput(['required autocomplete' => 'off']); ?>
            </div>

            <div class = "field-wrap">
                <?php echo $form->field($model_2, 'first_email')->textInput(['type' => 'email', 'required autocomplete' => 'off']); ?>
            </div>

            <div class = "field-wrap">
                <?php echo $form->field($model_2, 'password')->textInput(['type' => 'password', 'required autocomplete' => 'off']); ?>
            </div>

            <p class="forgot"><?php echo Html::a('Forgot Password?',Yii::$app->urlManager->createAbsoluteUrl(['site/reqresetpassword']));?></p>

            <?php echo Html::submitButton('Get Started', ['class' => 'button button-block']) ?>

        <?php ActiveForm::end() ?>

        </form>

      </div>

      <div id="login">

        <h1>Welcome Back!</h1>
        <?php
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal'],
            ])
        ?>
            <div class = "field-wrap">
                <?php echo $form->field($model_1, 'username')->textInput(['type' => 'email', 'required autocomplete' => 'off']); ?>

            </div>
            <div class = "field-wrap">
                <?php echo $form->field($model_1, 'password')->textInput(['type' => 'password', 'required autocomplete' => 'off']); ?>
            </div>

            <p class="forgot"><?php echo Html::a('Forgot Password?',Yii::$app->urlManager->createAbsoluteUrl(['site/reqresetpassword']));?></p>

            <?= Html::submitButton('Login', ['class' => 'button button-block']) ?>
        <?php ActiveForm::end() ?>
      </div>

      </div>

    </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="<?php echo \Yii::$app->homeUrl;?>js/login.js"></script>

</body>
</html>
