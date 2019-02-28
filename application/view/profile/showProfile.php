<div class="container">
    <h1><?= $this->user->user_name; ?>'s Profile</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3> All About <?= $this->user->user_name; ?></h3>
        <div>This controller/action/view shows all public information about a certain user.</div>

        <?php if ($this->user) { ?>
            <div>
                <table class="overview-table">
                    <thead>
                    <tr>
                        
                        <td>Avatar</td>
                        <td>Username</td>
                        <td>User's email</td>
                        <td>Activated ?</td>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="<?= ($this->user->user_active == 0 ? 'inactive' : 'active'); ?>">
                            
                            <td class="avatar">
                                <?php if (isset($this->user->user_avatar_link)) { ?>
                                    <img src="<?= $this->user->user_avatar_link; ?>" />
                                <?php } ?>
                            </td>
                            <td><?= $this->user->user_name; ?></td>
                            <td><?= $this->user->user_email; ?></td>
                            <td><?= ($this->user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php } ?>
		<style>
		#box {
			background-color: #d4d7db;
			
		}
		</style>
			<h1> Reviews: </h1>
			<?php foreach ($this->reviews as $user){?>
			<div id='box'>
			<center>
			<h3><?= $user->title; ?></h3>
			<h4> | Rating: <?= $user->stars; ?>/5  |  Manufacturing Process: <?= $user->process; ?>  |  Timeliness: <?= $user->timely; ?>/10  | Overall Quality: <?= $user->quality; ?>/10 |  Communication: <?= $user->communication; ?>/10  |<h4>
			<p> <br> </p>
			<p> <?= $user->body; ?></p>
			<br>
			</center>
			</div>
			<br>
			<?php } ?>
    </div>
</div>
