<div class="container">
    <h1>All User's</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>View all users</h3>
        <div>
            See All Users and See What tasks they have completed. See Some of the highest rated workers on the site simple as that.
			See what other people are doing and current projects
        </div>
        <div>
            <table class="overview-table">
                <thead>
                <tr>
                    
                    <td>Avatar</td>
                    <td>Username</td>
                    <td>User's email</td>
					<td>Number of Jobs Completed</td>
					<td>Qualifed for Welding</td>
					<td>Qualifed for Soldering</td>
					<td>3D Prining Certifed</td>
					<td>CNC Certifed</td>
                    <td>Activated (yes/no)</td>
                    <td>Link to user's profile</td>
                </tr>
                </thead>
				
                <?php $extension = $this->extension; foreach ($this->users as $user) { ?>
                    <tr class="<?= ($user->user_active == 0 ? 'inactive' : 'active'); ?>">
                        <?php $id = $user->user_id; ?>
                        <td class="avatar">
                            <?php if (isset($user->user_avatar_link)) { ?>
                                <img src="<?= $user->user_avatar_link; ?>" />
                            <?php } ?>
                        </td>
                        <td><?= $user->user_name; ?></td>
                        <td><?= $user->user_email; ?></td>
						<td><?= $extension[$id]->totaljobs; ?></td>
						<td><?php if($extension[$id]->weld == 1){echo "Yes";}else{echo "No";}?></td>
						<td><?php if($extension[$id]->solder == 1){echo "Yes";}else{echo "No";}?></td>
						<td><?php $prints = "3dprints"; if($extension[$id]->$prints == 1){echo "Yes";}else{echo "No";}?></td>
						<td><?php if($extension[$id]->cnc == 1){echo "Yes";}else{echo "No";}?></td>
                        <td><?= ($user->user_active == 0 ? 'No' : 'Yes'); ?></td>
                        <td>
                            <a href="<?= Config::get('URL') . 'profile/showProfile/' . $user->user_id; ?>">Profile</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
