<div class="container">
    <h1>Private Data</h1>

    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>This info is a bit more personal</h3>

        <div>
            This controller/action/view shows a list of all users more personal information.
        </div>
        <div>
		
            <table class="overview-table">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Address line 1 </td>
                    <td>address line2</td>
                    <td>state</td>
                    <td>city</td>
                    <td>zipcode</td>
                    <td>full name</td>
                    <td>stripeid</td>
                    <td>balance</td>
					<td>total pay</td>
					<td>total jobs</td>
					<td># of 3d prints</td>
					<td># of welds</td>
					<td># of CNC</td>
					<td># of solder</td>
					<td>Phone</td>
                </tr>
                </thead>
				<?php foreach ($this->users as $user){?>
                <?php $print = "3dprints";?>
                    <tr class="active">
                        <td><?= $user->user_id; ?></td>
                        <td><?= $user->address1; ?></td>
                        <td><?= $user->address2; ?></td>
                        <td><?= $user->state; ?></td>
                        <td><?= $user->city; ?></td>
                        <td><?= $user->zipcode; ?></td>
						<td><?= $user->fullname; ?></td>
						<td><?= $user->stripeid; ?></td>
						<td><?= $user->balance; ?></td>
						<td><?= $user->totalpay; ?></td>
						<td><?= $user->totaljobs; ?></td>
						
						<?php echo $print; ?>
						<td><?= $user->$print; ?></td>
						<td><?= $user->weld; ?></td>
						<td><?= $user->cnc; ?></td>
						<td><?= $user->solder; ?></td>
						<td><?= $user->phone; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
