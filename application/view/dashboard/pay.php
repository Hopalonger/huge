<div class="container">
    <h1>Reload Your Account</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<?php $potentalvalue = 0; $counter = 0; foreach ($this->users as $user){ $counter++; $potentalvalue = (int)$user->pay + $potentalvalue;} $j = $counter; ?>
        <h3>Balance: $ <?= UserModel::getBalance(Session::get('user_id')); ?></h3>
		<h3>Number of Jobs Todo: <?php echo $j; ?></h3>
		<h3>Number of Jobs Done: <?php echo $this->totaljobs; ?></h3>
		<h3>Potental Value In Jobs: $<?php echo $potentalvalue; ?></h3>
        <h3> You Are checking out with a value of $<?php echo $this->value; ?>
		<?php $pay = (int)$this->value * 100; ?>
		<form action="<?php echo Config::get('URL'); ?>/dashboard/payment" method="POST">
		<input type='hidden' id='pay' name='pay' value='<?php echo $pay; ?>'>
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_TYooMQauvdEDq54NiTphI7jx"
    data-amount="<?php echo $pay; ?>"
    data-name="Make That"
    data-description="Reload Your Account With $<?php echo $this->value; ?>"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true">
  </script>
</form>

    </div>
	</div>
