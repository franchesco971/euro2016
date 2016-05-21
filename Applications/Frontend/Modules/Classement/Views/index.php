<style type="text/css">
	table
	{
		border:1px solid #016ba7;
		border-spacing:0;
	}
	.headertr
	{
		background-color:#016ba7;
		border:1px solid #016ba7;
		color:white;
	}
	.headertr th
	{
		border-right:1px solid #dee1e2;
	}
	th
	{
		/*line-height:0px;*/
	}
	tr td
	{
		border:1px solid #dee1e2;
	}
</style>
<div id="classement">
	<div style="float:left">
		<h3>Classement par Joueur</h3>
	<?php
		//echo parieur::classement();
		if($classement)
		{
			?>
            <table >
				<tr class="headertr"><th>Place</th><th>Pseudo</th><th>Points</th><!--<th>Service</th>--></tr>
			<?php
			foreach($classement as $Key =>$parieur)
			{
			?>
            	<tr><td class="txtbleu"><?php echo $Key+1; ?></td><td><?php echo $parieur->pseudo() ?></td>
                <td><?php echo $parieur->points() ?></td><!--<td><?php echo $parieur::service($parieur->id()) ?></td>--></tr>
			<?php
			}
			?>
            </table>
			<?php
		}
	?>
	</div>
	<div style="float:left;padding-left:20px;">
		<h3>Classement par service</h3>
	<?php	
		//echo count($classementService);
		if($classementService)
		{
			?>
            <table >
				<tr class="headertr"><th>Place</th><th>Pseudo</th><th>Points</th><th>Service</th></tr>
			<?php
			foreach($classementService as $Key =>$parieur)
			{
			?>
            	<tr><td class="txtbleu"><?php echo $Key+1; ?></td><td><?php echo $parieur->pseudo() ?></td><td><?php echo $parieur->points() ?></td></tr>
			<?php
			}
			?>
            </table>
			<?php
		}
	?>
		<p>*Hors cedric et "clemence"<br/> ayant commencé après</p>
		<img src="images/logo_euro.jpg" border="0" />
	</div>
</div>