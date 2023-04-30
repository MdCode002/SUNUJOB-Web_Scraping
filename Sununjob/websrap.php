<!DOCTYPE html>
<html lang="en">
<?php require('./ActionScrapin.php') ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUNUJOB</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <img id="logo" src="./img/2023-04-30 (2).png" alt="">
    <div id="cointainAnnonce">
        <?php foreach ($annonce as $annonce) { ?>
            <div class="annonce">
                <?php if ($annonce[0] == "e") { ?>
                    <img src="./img/expat.png" alt="" class="img"><?php }
                                                                if ($annonce[0] == "j") { ?>
                    <img src="./img/jumia-logo.png" alt="" class="img"><?php } ?>
                <h3 class="titre"><?php echo "$annonce[1]" ?></h3>
                <!-- <img src=" ./img/jumia-logo.png" alt=""> -->
                <a href=<?php echo "$annonce[2]" ?> target="_blank" rel="noopener noreferrer">
                    <div class="offre">Voir l'offre</div>
                </a>
            </div><?php } ?>
    </div>
</body>

</html>