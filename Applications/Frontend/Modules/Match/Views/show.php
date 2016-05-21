<b style="color:#F00;">
<?php 	if($user->hasFlash())
		{
			echo $user->getFlash();	
		}
?>
</b>
<div id="commentaires">
    Match <?php echo $match['id'] ?> le <?php echo $match::date_new('d/m/Y',$match->dateMatch()) ?> 
    <span class="txtrouge"><?php echo $match['equipe1']['libelle']; ?> - <?php echo $match['equipe2']['libelle']; ?></span><br/>
    <br/>
    <h2>Commentaire</h2>
    <form action="" method="post">
        <!--<label>Commentaire :</label><input type="text" name="contenu" />
        <input type="submit" name="add" value="Valider"/>
        <input type="hidden" name="page" value="commentaire"/>
        <input type="hidden" name="idMatch" value="<?php echo $match->id() ?>"/>-->
        <?php echo $form; ?>
        <input type="hidden" name="idParieur" value="<?php echo $_SESSION['user']->id() ?>"/>
        <input type="submit" value="Commenter"/>
    </form>
</div>
<br/>
<?php
    foreach ($ListeCommentaires as $commentaire)
    {
?>
    <p>
        <?php echo $commentaire['Parieur']['pseudo'] ?> &agrave; comment&eacute; le  
        <a href="match-<?php echo $commentaire['idMatch']; ?>.html"> match<?php echo $commentaire['idMatch']; ?></a> 
        <?php echo $commentaire::date_new('d/m/Y \&\a\g\r\a\v\e\; H:i:s',$commentaire['dateCommentaire'])?>:<br/>
        <?php echo $commentaire['contenu']; ?>
    </p>
<?php
	}
?>