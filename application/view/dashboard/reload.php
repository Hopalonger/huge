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
        <h3>Reload Your Account Click The Add Buttons and See Your Total Value. To Restart <a href="<?php echo Config::get('URL'); ?>/dashboard/reload">Click here.</a> </h3>

<p id="value"> Current Reload Value $0</p>
<button id="1">Add $1</button>
<button id="5">Add $5</button>
<button id="10">Add $10</button>
<button id="15">Add $15</button>
<button id="20">Add $20</button>
<button id="clear">Clear</button>
<br>
<br>
<form action="<?php echo Config::get('URL'); ?>dashboard/pay" method='post'>
<input type='hidden' id='pay' name='pay' value='0'>
<h1>
<input type= 'submit' id="clear" value='Checkout'>
</h1>
</form>
		<script>
		var x = 0;
		document.getElementById("1").addEventListener("click", Add1);
		document.getElementById("5").addEventListener("click", Add5);
		document.getElementById("10").addEventListener("click", Add10);
		document.getElementById("15").addEventListener("click", Add15);
		document.getElementById("20").addEventListener("click", Add20);
		document.getElementById("clear").addEventListener("click", clear);
				function get(p1){
			
			return x * 100; 
		}
		function clear(p1){
			document.getElementById('value').innerHTML = "Current Reload Value $0";
			document.getElementById('pay').value = "0";
			x = 0;
		}
		function Add1(p1) {
		var ptag = document.getElementById('value')
		x = 1 + x;
		document.getElementById('pay').value = x;
		ptag.innerHTML = 'Current Reload Value $' + x;
		return  x ;  // The function returns the product of p1 and p2
		}
				function Add5(p1) {
		var ptag = document.getElementById('value')
		x = 5 + x;
		document.getElementById('pay').value = x;
		ptag.innerHTML = 'Current Reload Value $' + x;
		return  x ;  // The function returns the product of p1 and p2
		}
				function Add10(p1) {
		var ptag = document.getElementById('value')
		x = 10 + x;
		document.getElementById('pay').value = x;
		ptag.innerHTML = 'Current Reload Value $' + x;
		return  x ;  // The function returns the product of p1 and p2
		}
				function Add15(p1) {
		var ptag = document.getElementById('value')
		x = 15 + x;
		document.getElementById('pay').value = x;
		ptag.innerHTML = 'Current Reload Value $' + x;
		return  x ;  // The function returns the product of p1 and p2
		}
				function Add20(p1) {
		var ptag = document.getElementById('value')
		x = 20 + x;
		document.getElementById('pay').value = x;
		ptag.innerHTML = 'Current Reload Value $' + x;
		return  x ;  // The function returns the product of p1 and p2
		}
		</script>
    </div>
	</div>
