<b style="color:#F00;">
<?php 	if($user->hasFlash())
		{
			echo $user->getFlash();	
		}
?>
</b>
<p id="intro">
	Et voil&agrave;, l'Euro 2016 commence enfin, et ils ne seront pas les seuls &agrave; jouer.<br/>
    Alors &agrave; vos claviers ,et pariez sur tous les matches &agrave; venir.<br/>
    Bonne chance &agrave; tous et &agrave; toutes.
    <span class="txtrouge">Les développeurs je vous avertis direct n'essayez de cracker le site et de manière général considérez que le site date de 2012</span>
</p>
<?php
	if(!$user->isAuthenticated())
	{
		include('../Applications/Frontend/Modules/Connexion/Views/index.php'); ?>
        
        <div id="inscriptionlien" class="floatright"><a href="inscription.html">Inscription</a></div>
		<?php
	}
?> 

<div style="color:red" ><!--<br/>
<p>les gagnants d'hier sont sdevys,aurel,patrice et law</p>
<p>patrice et aurel renverse le classement</p>
<p>*version 2.2 : classement par service</p>
<p>SUITE A UNE DEMANDE IL Y AURA 2 NOUVEAUX INSCRITS MAIS EVIDEMMENT ILS COMMENCERONT A ZERO</p>
<p>patrice et aurel vous commencez &agrave; tous nous &eacute;nerver. rayana-ines,predator et guillaume ont &eacute;galement eu 6 points hier</p>
<p>l'ech&eacute;ance de paiement est arriv&eacute;</p>
<p>A partir de maintenant un bon pari vaut <u>6 points</u></p>-->
</div>

<h2>R&Eacute;SULTATS</h2>
<?php
    foreach ($listeResultats as $match)
    {
?>
	<a href="match-<?php echo $match['idMatch']; ?>.html">
            Match<?php echo $match['idMatch']; ?> <?php echo $match::date_new('d-m-Y',$match['dateMatch']); ?>
        </a> :
        <a href="equipe-<?php echo $match['equipe1']['idEquipe']; ?>.html">
            <div class="flag flag-<?php echo $match['equipe1']['flag']; ?>"></div><?php echo $match['equipe1']['libelle']; ?>
        </a> <?php echo $match['score1']; ?> - <?php echo $match['score2']; ?> 
        <a href="equipe-<?php echo $match['equipe2']['idEquipe']; ?>.html">
            <?php echo $match['equipe2']['libelle']; ?> <div class="flag flag-<?php echo $match['equipe2']['flag']; ?>"></div>
        </a>
<br/>
<?php
	}
?>
<h2>COMS</h2>
<div id="coms">

<?php
    foreach ($listeCommentaires as $Commentaire)
    {
?>
	<p>
		<?php echo $Commentaire['Parieur']['pseudo'];?> &agrave; comment&eacute; le  
		<a href="match-<?php echo $Commentaire['idMatch']; ?>.html"> match<?php echo $Commentaire['idMatch']; ?><!--'.$tab['idEquipe1'].'-'.$tab['idEquipe2'].'--></a>
        <?php echo $Commentaire::date_new('d/m/Y \&\a\g\r\a\v\e\; H:i:s',$Commentaire['dateCommentaire'])?>:<br/>
		<?php echo $Commentaire['contenu']; ?>
  	</p>
<?php
	}
?></div>