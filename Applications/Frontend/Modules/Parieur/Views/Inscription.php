<h2>Inscription</h2>
<b style="color:#F00;">
<?php 	if($user->hasFlash())
		{
			echo $user->getFlash();	
		}
?>
</b>
<form action="" method="post">
    <p>
        <?php echo $form; ?>
        
        <input type="submit" value="Inscription" />
    </p>
</form>