<div id="parie">
<?php
	if($listeMatchsParie)
	{
		?> <h2>PARIS EFFECTU&Eacute;S</h2> <?php
		foreach($listeMatchsParie as $match)
		{
			?>
             <div  class="pariform">
                <!--<form method="get">-->
                <form method="post" action="/modifPari/match-<?php echo $match->id() ?>.html">
                    <p>Match <?php echo $match->id() ?> le <?php echo $match::date_new('d/m/Y',$match->dateMatch()) ?></a></p>
                    <p>                                               
                        <span>
                            <div class="flag flag-<?php echo $match['equipe1']['flag']; ?>"></div><?php echo $match->Equipe1()->libelle() ?> - 
                                <?php echo $match->Equipe2()->libelle() ?><div class="flag flag-<?php echo $match['equipe2']['flag']; ?>"></div>
                            <a class="txtrouge" href="match-<?php echo $match->id()?>.html">Commenter</a>
                        </span>
                    </p>
                   
                    <select name="idGagnant" id="idGagnant" <?php if($match->dateMatch()+60*60*18<time()){echo 'disabled="disabled"';} ?>>
                        <option value="0" <?php if($match->idGagnant()==0){echo 'value="0" selected="selected"';}elseif($match->idGagnant()==99){echo 'value="99" selected="selected"';} ?> >match nul</option>
                        <option value="<?php echo $match->idEquipe1() ?>"  <?php if($match->idEquipe1()==$match->idGagnant()){echo 'selected="selected"';} ?>><?php echo $match->equipe1()->libelle() ?></option>
                        <option value="<?php echo $match->idEquipe2() ?>" <?php if($match->idEquipe2()==$match->idGagnant()){echo 'selected="selected"';} ?> ><?php echo $match->equipe2()->libelle() ?></option>
                    </select>
                        <?php if($match->dateMatch()+60*60*18>time()){ ?>
                    <input type="submit" name="update" value="Modifier"/>

                    <input type="hidden" name="idMatch" value="<?php echo $match->id() ?>"/>
                    <input type="hidden" name="idParieur" value="<?php echo $_SESSION['user']->id()?>"/>
                        <?php } ?>
                </form>
            </div>
			<?php
		}
	}
	
	if($listeMatchs)
	{
		?> <h2>PARIS &Agrave; VENIR</h2> <?php
		foreach($listeMatchs as $match)
		{
			
			?>
            <div  class="pariform">
                <!--<form method="get" id="pariform<?php echo $match->id() ?>">-->
                <form method="post" id="pariform<?php echo $match->id() ?>" action="/pari/match-<?php echo $match->id() ?>.html">
                    <p>Match <?php echo $match->id() ?> le <?php echo $match::date_new('d/m/Y',$match->dateMatch()) ?></a></p>
                    <p>                                               
                        <span>
                            <div class="flag flag-<?php echo $match['equipe1']['flag']; ?>"></div><?php echo $match->Equipe1()->libelle() ?> - 
                                <?php echo $match->Equipe2()->libelle() ?><div class="flag flag-<?php echo $match['equipe2']['flag']; ?>"></div>
                            <a class="txtrouge" href="match-<?php echo $match->id()?>.html">Commenter</a>
                        </span>
                    </p>
                    <select name="idGagnant" id="idGagnant">
                    	<?php 
						if($match->dateMatch()+60*60*18<time() && $_SESSION['user']->pseudo()!='admin')
						{	?>
                        	 <option value="99">match nul</option>
                        <?php 
						}
						else
						{
							if($match->id()<29)
							{
						?>
                        <option value="0">match nul</option>
						<?php
							}
						?>
                        <option value="<?php echo $match->idEquipe1() ?>"><?php echo $match->Equipe1()->libelle() ?></option>
                        <option value="<?php echo $match->idEquipe2() ?>"><?php echo $match->Equipe2()->libelle() ?></option>
                        <?php	
						} ?>
                    </select>
					<!--<a id="btn<?php echo $match->id() ?>" class="txtbleu souligner">Valider</a>-->
                    <input type="submit" name="add" value="Valider"/>
					<!--<input type="hidden" name="add" value="Valider"/>-->
                    <input type="hidden" name="idMatch" value="<?php echo $match->id() ?>"/>
                    <input type="hidden" name="idParieur" value="<?php echo $_SESSION['user']->id() ?>"/>
                </form>
            </div>
            <script type="text/javascript">
            $("document").ready(function() {
                $('#btn<?php echo $match->id() ?>').click(function(){
                        $("#pariform<?php echo $match->id() ?>").submit();
                });
                <?php if($match->dateMatch()+60*60*18<time() && $_SESSION['user']->pseudo()!='admin'){    ?>                
                    $("#pariform<?php echo $match->id() ?>").submit();    
                <?php } ?>        
            });
            </script>
<?php
		}
	}

?>
</div>