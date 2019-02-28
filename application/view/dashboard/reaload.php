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
        <p>Reload Your Account</p>
			
		
    </div>
	</div>
