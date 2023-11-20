<?php

$kategoriler = array("Macera","Dram","Komedi","Korku") ;


$filmler = array(
    "1" => array(
        "film1_baslik" => "Paper Lives",
        "film1_aciklama" => "Kağıt toplayarak geçinen ve sağlığı giderek kötüleşen Mehmet terk edilmiş bir çocuk bulur. Birden hayatına giren küçük Ali, onu kendi çocukluğuyla yüzleştirecektir. (18 yaş ve üzeri için uygundur)",
        "film1_resim" => "1.jpeg",
        "film1_yorumSayisi" => "0",
        "film1_begeniSayisi" => "106",
        "film1_vizyon" => "evet"
    ) ,

    "2" => array(
        "film2_baslik" => "Walking Dead",
        "film2_aciklama" => "Zombi kıyametinin ardından hayatta kalanlar, birlikte verdikleri ölüm kalım mücadelesinde insanlığa karşı duydukları umuda tutunur.",
        "film2_resim" => "2.jpeg",
        "film2_yorumSayisi" => "236",
        "film2_begeniSayisi" => "1032",
        "film2_vizyon" => "hayir"
    ),

) ;

$filmler["1"]["film1_aciklama"] = ucfirst(strtolower($filmler["1"]["film1_aciklama"])) ;
$filmler["1"]["film1_aciklama"] = ucfirst(strtolower($filmler["1"]["film1_aciklama"])) ;

$filmler["2"]["film2_aciklama"] = ucfirst(strtolower($filmler["2"]["film2_aciklama"])) ;
$filmler["2"]["film2_aciklama"] = ucfirst(strtolower($filmler["2"]["film2_aciklama"])) ;

$filmler["1"]["film1_aciklama"] = substr($filmler["1"]["film1_aciklama"],0,200)."...";
$filmler["2"]["film2_aciklama"] = substr($filmler["2"]["film2_aciklama"],0,200)."...";

$filmler["1"]["film1_url"]=str_replace(" ","-",$filmler["1"]["film1_baslik"]) ;
$filmler["2"]["film2_url"]=str_replace(" ","-",$filmler["2"]["film2_baslik"]) ;

const baslik = "Populer Filmler" ;



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Blog App</title>
</head>
<body>

    <div class="container my-5">

        <div class="row">

            <div class="col-3">
                <ul class="list-group">
                    <li class="list-group-item"><?php echo $kategoriler[0] ?></li>
                    <li class="list-group-item"><?php echo $kategoriler[1] ?></li>
                    <li class="list-group-item"><?php echo $kategoriler[2] ?></li>
                    <li class="list-group-item"><?php echo $kategoriler[3] ?></li>
                </ul>

            </div>
            <div class="col-9">
                <h1 class="mb-4"><?php echo baslik ?></h1>
                <div class="card mb-3">
                    <div class="row">
                         <div class="col-3">
                            <?php echo "<img class=\"img-fluid\" src=\"img/{$filmler["1"]["film1_resim"]}\">" ?>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                                <h5 class="card-title"><?php echo "<a href=\"{$filmler["1"]["film1_url"]}\">{$filmler["1"]["film1_baslik"]}</a>"?></h5>
                                <p class="card-text">
                                    <?php echo $filmler["1"]["film1_aciklama"] ?>
                                </p>
                                <div>
                                    <span class="badge bg-primary"><?php echo $filmler["1"]["film1_yorumSayisi"] ?> yorum</span>
                                    <span class="badge bg-primary"><?php echo $filmler["1"]["film1_begeniSayisi"] ?> begeni</span>
                                    <span class="badge bg-warning">vizyonda: <?php echo $filmler["1"]["film1_vizyon"] ?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="row">
                         <div class="col-3">
                            <?php echo "<img class=\"img-fluid\" src=\"img/{$filmler["2"]["film2_resim"]}\">" ?>
                    </div>
                    <div class="col-9">
                        <div class="card-body">
                                <h5 class="card-title"><?php echo "<a href=\"{$filmler["2"]["film2_url"]}\">{$filmler["1"]["film1_baslik"]}</a>"?></h5>
                                <p class="card-text">
                                    <?php echo $filmler["2"]["film2_aciklama"] ?>
                                </p>
                                <div>
                                    <span class="badge bg-primary"><?php echo $filmler["2"]["film2_yorumSayisi"] ?> yorum</span>
                                    <span class="badge bg-primary"><?php echo $filmler["2"]["film2_begeniSayisi"] ?> begeni</span>
                                    <span class="badge bg-warning">vizyonda: <?php echo $filmler["2"]["film2_vizyon"] ?> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>


    </div>


</body>
</html>