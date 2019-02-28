<div class="container">
    <h1>All Jobs</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
		<?php $potentalvalue = 0; $counter = 0; foreach ($this->users as $user){ $counter++; $potentalvalue = (int)$user->pay + $potentalvalue;} $j = $counter; ?>
        <h3>Balance: $ <?= UserModel::getBalance(Session::get('user_id')); ?> | Number of Jobs Todo: <?php echo $j; ?> | Number of Jobs Done: <?php echo $this->totaljobs; ?> | Potental Value In Jobs: $<?php echo $potentalvalue; ?></h3>
		</h3>
		<h3></h3>
		<h3></h3>
        <p>
		
			All Jobs. 
			
			
        </p>
    </div>
	</div>
	<style>
	#box {
			  max-width: 960px;
			  max-length: 1080px;
			  border: 1px solid #ccc;
			  padding: 20px;
			  margin: 30px 0 30px 0;
			  float:left; display:inline; width: 96%;
		}
		
	#stuff {
		background-color: #f2f2f2;
	}
	</style>	
				<div  id="box" >
				<h1> Availble Jobs: </h1>
				<?php foreach ($this->users as $user){?>
                <div id='box'>
                    
					<h2>Job: <?= $user->job_id ?> Pay:  <?= $user->pay; ?>Materials: <td><?= $user->material; ?></td></h2>
					<h3> <?php $print = "3dprints"; if($user->$print == 1 ){echo" Requires 3d printing";}?><?php if($user->weld == 1 ){echo"Requires Welding";}  ?><?php if($user->solder == 1 ){echo"Requires Soldering";} ?><?php if($user->cnc == 1 ){echo"Requires CNC-ing";}  ?>
					<a href="SomePlaceforflieswith.com"> Files </a>
					<td><?= $user->files; ?></td>
                    <p><?= $user->Description; ?><p>
                                              
                        
						
						
						
					<a href="SomePlaceToLearnMore"> Learn More</a>
				</div>
       <?php } ?>
</div>


