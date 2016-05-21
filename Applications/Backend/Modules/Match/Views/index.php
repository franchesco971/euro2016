<div class="col-md-12">
    <div>
        <div><a href="match/create">Créer une match</a></div>
        <div>
        <?php 
            foreach ($list as $match) {
        ?>
            <p>
                Match <?php echo $match['idMatch']; ?>: 
                <?php echo $match['equipe1']['libelle'].' '.$match['score1'].'-'.$match['score2'].' '.$match['equipe2']['libelle'] ?>  
                <a href="match/update/<?php echo $match['idMatch']; ?>">Update</a>
                <?php echo ($match['dateMatch']>time()?'programmé':'fini'); ?>
                <?php echo !is_null($match['idGagnant'])?' validé':' non validé'; ?>
            </p> 
        <?php }
        ?>
        </div>
    </div>
</div>