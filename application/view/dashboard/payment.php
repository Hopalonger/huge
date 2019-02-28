<div class="container">
    <h1>Reload Your Account</h1>
    <div class="box">
		<?php \Stripe\Stripe::setApiKey("sk_test_4eC39HqLyjWDarjtT1zdp7dc");
		$token = $this->token; 
		$charge = \Stripe\Charge::create([
    'amount' => $this->value,
    'currency' => 'usd',
    'description' => 'Make That Account Reload',
    'source' => $token,
	]);
	UserModel::addAccountValue($this->value);
	$message = "Your Charge has been Completed. Your Account Will Have $100 added to it quickly.";
?>
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<?php $potentalvalue = 0; $counter = 0; foreach ($this->users as $user){ $counter++; $potentalvalue = (int)$user->pay + $potentalvalue;} $j = $counter; ?>
        <h3>Balance: $ <?= UserModel::getBalance(Session::get('user_id')); ?></h3>
		<h3>Number of Jobs Todo: <?php echo $j; ?></h3>
		<h3>Number of Jobs Done: <?php echo $this->totaljobs; ?></h3>
		<h3>Potental Value In Jobs: $<?php echo $potentalvalue; ?></h3>
        <h2> <?php echo $message; ?> </h2>

    </div>
	</div>
