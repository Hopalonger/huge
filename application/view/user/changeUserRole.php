<div class="container">
    <h1>Upgrade to Business</h1>

    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>
	<?php $potentalvalue = 0; $counter = 0; foreach ($this->users as $user){ $counter++; $potentalvalue = (int)$user->pay + $potentalvalue;} $j = $counter; ?>
        <h3>Balance: $ <?= UserModel::getBalance(Session::get('user_id')); ?></h3>
		<h3>Number of Jobs Todo: <?php echo $j; ?></h3>
		<h3>Number of Jobs Done: <?php echo $this->totaljobs; ?></h3>
		<h3>Potental Value In Jobs: $<?php echo $potentalvalue; ?></h3>
    <div class="box">
        <h2>Upgrade to Business</h2>
        <p>
			Upgrade to Business . You Get many perks such as an unlimited access to jobs.
			You also get reduced shipping rates for products that you commission. You also
			get a higher Pay Per product. You also will be consulted about new features
			and what people want from the site. The Main Perk of Business is that you get
			notified of all jobs that where no claimed after 48 hours. 
			<br>
			<br>
			<b> Price: $50.00</b>
			(Will be subtracted from user balance)
        </p>
		<script>
		if(document.getElementById('yeet').value > 50){
			var x = 'yeet';
		}else{
			document.getElementById('button').btn.disabled = true;
		}
		</script>
		<input type ="hidden" value="<?= UserModel::getBalance(Session::get('user_id')); ?>" id="yeet">
	    <form action="<?php echo Config::get('URL'); ?>user/changeUserRole_action" method="post">
            <?php if (Session::get('user_account_type') == 1) { ?>
                <input type="submit" name="user_account_upgrade" id = "button" value="Upgrade my account (to Premium User) Will Charge $20 Dollars" />
	        <?php } else if (Session::get('user_account_type') == 2) { ?>
			<h3> You are already A Business User And There is no need to updgrade</h3>
	        <?php } ?>
	    </form>
        <h2>Currently your account type is: <?php echo Session::get('user_account_type'); ?></h2>
        <!-- basic implementation for two account types: type 1 and type 2 -->

    </div>
</div>
