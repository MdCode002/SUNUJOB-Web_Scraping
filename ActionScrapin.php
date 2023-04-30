<?php
$annonce = array();

error_reporting(E_ALL & ~E_WARNING);
$catg = $_POST['cate'];

$url = 'https://www.expat-dakar.com/emploi-informatique';
$i = 2;

while (true) {
    $html = file_get_contents($url);


    // Vérifier si la réponse est valide
    if ($html !== false) {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTMLFile($url);
        libxml_clear_errors();

        $main = $dom->getElementsByTagName('a');

        foreach ($main as $a) {
            if (strpos($a->getAttribute('class'), 'listing-card__inner') !== false && $a->getAttribute('data-t-listing_category_slug') === $catg) {
                $link = $a->getAttribute('href');
                $div = $a->getElementsByTagName('div');
                foreach ($div as $cont) {
                    if ($cont->getAttribute('class') === 'listing-card__header__title') {
                        $nom = $cont->nodeValue;
                    }
                    if ($cont->getAttribute('class') === 'listing-card__header__date') {
                        $date = $cont->nodeValue;
                    }
                }
                array_push($annonce, ["e", $nom, $link, $date]);
                // echo $nom . ' : <a target="blank"href="' . $link . '"> ' . $link . '</a> , ' . $date . '<br>';
            }
        }

        $url = 'https://www.expat-dakar.com/m/emploi-informatique?page=' . strval($i);
        $i += 1;
    } else {
        break;
    }
}
$urlj =  "https://deals.jumia.sn/posts/search?attributes%5Bjobs%5D%5Bindustry%5D=1459&attributes%5Bjobs%5D%5Bcontract%5D=&xhr=jdaaf&search-category=1459&search-location=Choisir+une+ville";
$j = 2;
while (true) {
    $htmlj = file_get_contents($urlj);

    // Vérifier si la réponse est valide
    if ($htmlj !== false) {
        $domj = new DOMDocument();
        libxml_use_internal_errors(true);
        $domj->loadHTMLFile($urlj);
        libxml_clear_errors();

        $mainj = $domj->getElementsByTagName('a');
        $vip = 0;
        foreach ($mainj as $a) {
            // var_dump($a);
            if ($a->getAttribute('class') === 'post-link post-vip') {
                $vip++;
                if ($vip > 4) {
                    $linkj = $a->getAttribute('href');
                    $linkj = "https://deals.jumia.sn" . $linkj;
                    $nomj = $a->getAttribute('title');

                    array_push($annonce, ["j", $nomj, $linkj]);
                    // echo $nomj . ' : <a target="blank"href="' . $linkj . '"> ' . $linkj . '</a> <br />';
                }
            }
        }

        $urlj = 'https://deals.jumia.sn/posts/search?attributes%5Bjobs%5D%5Bindustry%5D=1459&attributes%5Bjobs%5D%5Bcontract%5D=&xhr=jdaaf&search-category=1459&search-location=Choisir+une+ville&page=' . strval($j);
        $j += 1;
        libxml_clear_errors();
    } else {
        break;
    }
}
