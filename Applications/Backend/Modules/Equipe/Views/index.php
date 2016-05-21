<div class="col-md-12">
    <div>
        <div><a href="equipe/create">Créer une equipe</a></div>
        <div>
        <?php 
            foreach ($listeEquipes as $equipe) {
        ?>
            <p><div class="flag flag-<?php echo $equipe['flag']; ?>"></div><?php echo $equipe['libelle'];?> <a href="equipe/update/<?php echo $equipe['idEquipe']; ?>">update</a></p> 
        <?php }
        ?>
        </div>
    </div>
</div>