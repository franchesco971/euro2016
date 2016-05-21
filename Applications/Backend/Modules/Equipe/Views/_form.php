
<form action="" method="post">
    <p>
        <?php if (isset($erreurs) && in_array(\Library\Entities\Equipe::LIBELLE_INVALIDE, $erreurs)) echo 'Le libelle est invalide.<br />'; ?>
        <label>Libelle</label>
        <input type="text" name="libelle" value="<?php if (isset($equipe)) echo $equipe['libelle']; ?>" /><br />
        <label>Flag</label>
        <input type="text" name="flag" value="<?php if (isset($equipe)) echo $equipe['flag']; ?>" /><br />
<?php
    if(isset($equipe) && !empty($equipe['idEquipe']))
    {
?>
        <input type="hidden" name="id" value="<?php echo $equipe['idEquipe']; ?>" />
        <input type="submit" value="Modifier" name="modifier" />
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
