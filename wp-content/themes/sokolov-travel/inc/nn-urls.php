<?php
add_action('wp_head', function () {
    $noindex_urls = [
        '/tovary-dlya-doma-iz-kitaya/',
        '/novosti/',
        '/kak-organizovat-parallelnyj-import/',
        '/kitajskie-postavshhiki-v-rossiyu/',
        '/import-promyshlennogo-oborudovaniya-iz-kitaya/',
        '/zakupka-majning-oborudovaniya-v-kitae/',
        '/oborudovanie-dlya-obsluzhivaniya-kitajskih-avtomobilej/',
        '/zakupka-stroitelnyh-materialov-v-kitae/',
        '/kargo-iz-kitaya-v-moskvu/',
        '/pomoshhnik-v-kitae-po-poisku-tovara/',
        '/kargo-dostavka-iz-kitaya-v-rossiyu/',
        '/mototehnika-iz-kitaya-czeny-i-postavki/',
        '/vykup-tovarov-iz-kitaya-v-rossiyu/',
        '/rost-interesa-k-frezernym-stankam-s-chpu/',
        '/stanki-chpu-iz-kitaya-stoit-li-rassmotret/',
        '/pomoshh-v-poiske-tovarov-i-proizvoditelej-v-kitae/',
        '/kupit-majner-v-kitae-kak-sdelat-eto-pravilno/',
        '/dostavka-iz-kitaya-v-moskvu-kargo-legko-i-udobno/',
        '/tokarnye-chpu-iz-kitaya-novoe-slovo-v-obrabotke-metallov/',
        '/dostavim-tovar-iz-kitaya-pod-klyuch-za-12-dnej/',
        '/kak-kupit-stanok-iz-kitaya-i-ostatsya-dovolnym-vyborom/',
        '/dostavka-promyshlennogo-oborudovaniya-iz-kitaya-vozmozhnosti-i-klyuchevye-aspekty/',
        '/stanki-iz-kitaya-dlya-proizvodstva-vozmozhnosti-preimushhestva-i-osobennosti/',
        '/stoimost-dostavki-kargo-iz-kitaya-podrobnyj-analiz-i-prakticheskie-sovety/',
        '/kargo-iz-kitaya-v-rossiyu-czeny-osobennosti-i-vazhnye-aspekty/',
        '/moped-v-korobke-iz-kitaya-dostupnost-vygoda-i-osobennosti-dostavki/',
        '/majnery-iz-kitaya-kak-vybrat-i-na-chto-obrashhat-vnimanie/',
        '/stanki-iz-kitaya-dlya-malogo-biznesa-vozmozhnosti-preimushhestva-i-osobennosti-vybora/',
        '/kargo-kitaj-rossiya-kak-obespechit-nadyozhnuyu-i-effektivnuyu-dostavku-tovarov/',
        '/kargo-dostavka-iz-kitaya-v-rossiyu-put-ot-fabriki-do-vashego-sklada/',
        '/parallelnyj-import-motocziklov-iz-kitaya-novye-gorizonty-dlya-motolyubitelej-i-biznesa/',
        '/stanki-s-chpu-iz-kitaya-preodolenie-stereotipov-i-zavoevanie-mirovogo-rynka/',
        '/mopedy-iz-kitaya-s-dostavkoj-v-rossiyu-dostupnost-vygoda-i-osobennosti-zakaza/',
    ];

    $current_url = strtok($_SERVER['REQUEST_URI'], '?'); // убираем query параметры

    if (in_array(rtrim($current_url, '/') . '/', $noindex_urls)) {
        echo '<meta name="robots" content="noindex, nofollow">' . "\n";
    }
});
