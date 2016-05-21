
<form action="" method="post">
    <p>
        <?php if (isset($match['erreurs']) && in_array(\Library\Entities\Match::DATE_INVALIDE, $match['erreurs'])) echo 'Date vide.<br />'; ?>
        <?php if (isset($match['erreurs']) && in_array(\Library\Entities\Match::EQUIPE_IDENTIQUE, $match['erreurs'])) echo 'Equipe identique.<br />'; ?>
        <label>Libelle</label>
        <select name='idEquipe1'>
            <?php foreach ($equipes as $equipe) { ?>
            <option value="<?php echo $equipe['idEquipe']; ?>" <?php echo $match['idEquipe1']==$equipe['idEquipe']?'selected':''; ?> ><?php echo $equipe['libelle']; ?></option>
            <?php } ?>
        </select><br />
        <label>Score 1</label>
        <input type="text" name="score1" value="<?php if (isset($match)) echo $match['score1']; ?>" /><br />
        <select name='idEquipe2'>
            <?php foreach ($equipes as $equipe) { ?>
            <option value="<?php echo $equipe['idEquipe']; ?>" <?php echo $match['idEquipe2']==$equipe['idEquipe']?'selected':''; ?> ><?php echo $equipe['libelle']; ?></option>
            <?php } ?>
        </select><br />
        <label>Score 2</label>
        <input type="text" name="score2" value="<?php if (isset($match)) echo $match['score2']; ?>" /><br />
        <input type="text" name="dateMatch" id="datepicker" value="<?php if ($match['dateMatch']) echo date('m/d/Y',$match['dateMatch']); ?>" />
<?php
    if(isset($match) && !empty($match['idMatch']))
    {
?>
        <input type="hidden" name="id" value="<?php echo $match['idMatch']; ?>" />
        <input type="submit" value="Modifier" name="Modifier" />
        <input type="submit" value="Valider" name="Valider" />
<?php
    }
    else
    {
?>
        <input type="submit" value="Ajouter" />
<?php
    }
?>
    </p>
</form>
