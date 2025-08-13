<?php

use AndreInocenti\SocialMediaUrlValidator\Enums\PlatformsCategoriesEnum;
use AndreInocenti\SocialMediaUrlValidator\Platforms\FacebookValidator;

dataset('many-facebook-urls', [
        ["https://www.facebook.com/Rapadura-Tech-2292492210775710/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Renova-M%C3%ADdia-101416801556176/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Rádio-Visão-FM-879-464423113943744/", PlatformsCategoriesEnum::PROFILE],
        ["https://pt-br.facebook.com/groups/153046561966979/", PlatformsCategoriesEnum::PROFILE],
        ["https://mobile.facebook.com/people/Gilmar-Marques/100009367677509", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Review-de-Produtos-2209792269098964/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Revista-do-Correio-428890500534152/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Radio-Caldas-Fm-104244826393441/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/R%C3%A1dio-Comunit%C3%A1ria-Cinc%C3%A3o-FM-464159240346580/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Rádio-A-Voz-do-Sertão332866466783356/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/profile.php", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Rádio-serra-verde-fm-1049-103574791586651/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Rádio-senador-FM-109085770570422/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/people/JM-Santa-Cruz/100015103087038/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Radio-Rio-Espera-FM-987-709498765870098/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Radio-HB-FM-1049-135009464010205?_rdc=1&_rdr", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/people/Pop-Brito/100010377968387/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Radio-Juazeiro-AM-1190-Khz-239549639455945/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Paula-Freitas-FM-344904045595234/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Lara-Fm-393253520749446/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/pages/Radio-Lunardelli-FM/11442855010880", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Rádio-Oasis-FM-877-426445087445859/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/R%C3%A1dio-Mais-Digital-322238374482581", PlatformsCategoriesEnum::PROFILE],
        ["https://m.facebook.com/pages/O-Guia-Financeiro/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Para%C3%ADba-Atual-239180756689626/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Para%C3%ADba-Feminina-1102995589911144/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Pier-Magazine-595118540900238/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Piraju%C3%AD-Radio-Clube-518163874913604/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Tribuna10-102146874772886/?_rdc=1&_rdr", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/InvestNordeste/about/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Portal-das-Manas-116414553525328/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/R%C3%A1dio-Princesa-FM-1035-104998581219484/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/gaming/pkamikat", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/A-Gazeta-do-Acre-208579685881525/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/ABAAS-2449568795264701", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Adamantina-Net-690947984682278", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/ANDAnews/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Atalaia-FM-1049-321450894714312/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/belezinhacomvc-1504942329727056/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Cassilandia-Urgente-2042059232747218/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Almir-macedo-blog-113186617044796/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-Futebol-Cultura-e-Geografia-1522229501229741/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-T%C3%A2nia-M%C3%BCller-1727534527496965/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-das-Locadoras-de-Ve%C3%ADculos-289534768390092/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-do-Fredson-170130229730634/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-Henrique-Barbosa-112302063592706/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/BLOG-POR-SIMAS-195977007169609/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/R%C3%A1dio-Cidade-Bela-FM-415311565214258/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Brasil-Soberano-e-Livre-164872757030205/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Quadro-Feminino", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-Camocim-Imparcial-603555149658685", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Cariri-Ativo-112153933875410/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/R%C3%A1dio-Cidade-Fm-931-390073081789694/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Piraju%C3%AD-Radio-Clube-518163874913604/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/R%C3%A1dio-Clube-750-AM-117620645014196/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/login/conexaoboasnoticias", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Converg%C3%AAncia-Digital-112284628857729/", PlatformsCategoriesEnum::PROFILE],
        ["https://pt-br.facebook.com/correio24horas%2F", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Corumb%C3%A1-Pires-Do-Rio-734098520070490/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Cosmetics-Toiletries-Brasil-380514552316210/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Cozinha-da-Jan-112207870535655/", PlatformsCategoriesEnum::PROFILE],
        ["https://pt-br.facebook.com/Df-Manchetes-162738151012876/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Jornal-Di%C3%A1rio-de-Cuiab%C3%A1-580779489064442/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Difundir-182759678419629/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Esperan%C3%A7a-FM-231600826920012", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/FOLHA-DE-PONTE-NOVA-199872646740004/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Fast-Company-Brasil-102161058375474", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Info-Investimento-188482012670080", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/pages/Ingles-no-Supermercado/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Folhasanjoense-2063834583852565/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Gazeta-Minas-884417981623652", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Jornal-do-Golfe-Brasil-235118343201440/", PlatformsCategoriesEnum::PROFILE],
        ["https://m.facebook.com/pg/Jornalfogocruzado/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Mundodasmarcas-467041903352382/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/napautaonline/about/?ref=page_internal", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/NewsCuiaba-172009749533058/?_rdc=1&_rdr", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/R%C3%A1dio-Canoa-Grande-FM-907-309386819494298?_rdc=1&_rdr", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Reino-Kawaii-105209198542040/?_rdc=1&_rdr", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/R%C3%A1dio-Menina-FM-434350903361005", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/MidiaFestcom-534565576687035/", PlatformsCategoriesEnum::PROFILE],
        ["https://m.facebook.com/pages/category/Organization/Mundo-Positivo-270615286364815/?locale2=pt_BR", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Minas1-118482035162309/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/pages/Moda-e-Imagem/365613966786175", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/tudozikcom-690252844338570", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Piaui24hs-355162251265816/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Nota-Alta-ESPM-308219805931205/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/aprendendosobreprodutinhos/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Paulo-Roberto-da-Radio-146259889201086/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/R%C3%A1dio-Rep%C3%BAblica-1380-Khz-Morro-Agudo-100824490065898/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Radio-Arco-Iris-1660166144097703", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Jornal-Metropolitano-Rio-256217641738558/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Tudo-Dos-Famosos-101728215019657", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/selecoes/instagram", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/portalnacional/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Revista-EXCLUSIVA-113696675398498/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Clube-Cidade-FM-1065-331078396983453/", PlatformsCategoriesEnum::PROFILE],
        ["https://web.facebook.com/Mercado-Lance-103347361619080/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Funda%C3%A7%C3%A3o-Ecoamaz%C3%B4nia-1166332020139207/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Luiza-Carvalho-Cardoso-1985062648206772/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/pages/Jornal%20Monitor%20Mercantil/362368017692194/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/NewVoice-101179635175629", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Tuim-Blog-Nota-e-Anota-123397729060385", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/O-Jornal-da-Regi%C3%A3o-416481705109309", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Procel-Info-189940331030640", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/RADIO-inova%C3%A7ao-FM-2020756491532659", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Revolti-Play-100308601695075", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/S%C3%A3o-Paulo-Na-Web-232806284153128", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/portalnacional/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/pages/Sistema%20Ocepar/107602682658357/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/terraviva_tvv-109419477126835/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Valor-PRO-103220501226811", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/A-voz-dos-munic%C3%ADpios-787286114984921", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/ABEG%C3%81S-148612331924025/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Acesse-Not%C3%ADcias-611468469015513/?fref=ts", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/AgroMogiana-1649371848661720/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/889643667801967", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-Caruaru-em-Pauta-342184219889589", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Blog-do-Z%C3%A9-Carlos-Borges-271930693697025", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Carlos-Lima-Jornal-Online-396186957136964/?ref=page_internal", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/PortalDestakNews/about/?ref=page_internal", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Dia-da-Not%C3%ADcia-104210671260020", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Em-Campos-do-Jord%C3%A3o-158573430879441", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Magno-Martins-Engenharia-326399670722112/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/M%C3%A1quinas-Equipamentos-102643904740769/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Minas1-118482035162309/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Maranh%C3%A3o-MA-2415515931856519/?eid=ARD4e81kEH_FKybdUu5TzigX3M-zAjYMalw37KkvXeRnNhHpsPW_RdmhQf-K00MCXz_MY_svyaVDpjiG", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Sert%C3%A3o-Central-365459527401778", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/307932635974424", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Surubim-Not%C3%ADcias-534659486669306", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/TAVI-Latam-802855023441952/?modal=admin_todo_tour", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/TeclandoWebcombr-505678006254118/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Tribo-Gamer-292478180794143", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Tudo-OK-Not%C3%ADcias-249945488760480/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Tv-Vertentes-1575936005826217/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/PB-24-horas-Para%C3%ADba-112303307137610/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/ASAS-Assessment-of-SpondyloArthritis-international-Society-104590927632503/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Cidad%C3%A3o-Votorantinense-SA-109870008047964", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/pages/Correio-do-Interior/273582366438235", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Jornal-de-Bairro-em-Bairro-443103309099191/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Jornal-Folha-de-Votorantim-385615991959202/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/NewVoice-101179635175629", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Converg%C3%AAncia-Digital-112284628857729/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Ademi-Rio-180189805418768/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/AMZ-Noticias-168490407148188", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/blogdehollywoodoficial/about/?ref=page_internal", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/BLOG-De-Jamildo-744590685678022", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Camapu%C3%A3-News-511582495618072/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/PIB-Presen%C3%A7a-Internacional-do-Brasil-179165825456479", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Pinzon.noticias/about/?ref=page_internal", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Pol%C3%ADtica-Paraibana-106723214701508/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/groups/ouvintesdauspfm", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/Rapid-TV-News-188875487818380/", PlatformsCategoriesEnum::PROFILE],
        ["https://www.facebook.com/pages/category/App-Page/4gnewspt/posts/", PlatformsCategoriesEnum::PROFILE],
    ]
);

describe('Facebook', function () {
    //
    // matches()
    //

    it('matches diverse facebook URLs', function () {
        $v = new FacebookValidator;

        // Profile / Page
        expect($v->matches('https://facebook.com/profile.php?id=1234'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/profile.php?id=1234&ref=bookmarks'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/profile.php?id=1234/'))->toBeTrue();

        expect($v->matches('https://facebook.com/Page.Name'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/PageName/'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/PageName?utm_source=x'))->toBeTrue();

        expect($v->matches('https://web.facebook.com/pagename'))->toBeTrue();
        expect($v->matches('https://pt-br.facebook.com/pagename/'))->toBeTrue();


        // Posts (numérico e pfbid)
        expect($v->matches('https://facebook.com/PageName/posts/5678'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/PageName/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/PageName/posts/987654321/?ref=share'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/100044573043313/posts/1202953741200383/'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/491794399620983/posts/1121416323325451'))->toBeTrue();

        // Story / Permalink
        expect($v->matches('https://facebook.com/story.php?story_fbid=555666777&id=123'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr#/'))->toBeTrue();

        // Group post
        expect($v->matches('https://www.facebook.com/groups/123456789012345/posts/987654321098765'))->toBeTrue();

        // Vídeo
        expect($v->matches('https://www.facebook.com/PageName/videos/1234567890123456/'))->toBeTrue();
        expect($v->matches('https://m.facebook.com/video.php?v=9876543210'))->toBeTrue();
        expect($v->matches('https://www.facebook.com/watch/?v=123456789012345'))->toBeTrue(); // Facebook Watch
        expect($v->matches('https://fb.watch/abcDEF123/'))->toBeTrue();

        // Reels (trataremos como vídeo nos categories)
        expect($v->matches('https://www.facebook.com/reel/1234567890123456/'))->toBeTrue();

        // Negativos
        expect($v->matches('https://linkedin.com'))->toBeFalse();
        expect($v->matches('https://www.facebook.com/PageName/about'))->toBeTrue();   // é do domínio, mas não é post/profile/video
    });

    //
    // detectUrlCategory()
    //

    it('detects facebook categories correctly (basic)', function () {
        $v = new FacebookValidator;
        expect($v->detectUrlCategory('https://facebook.com/profile.php?id=1234'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        expect($v->detectUrlCategory('https://facebook.com/PageName'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        expect($v->detectUrlCategory('https://facebook.com/PageName/posts/5678'))->toBe(PlatformsCategoriesEnum::POST->value);
        expect($v->detectUrlCategory('https://facebook.com/PageName/about'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        expect($v->detectUrlCategory('https://web.facebook.com/pagename'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        expect($v->detectUrlCategory('https://pt-br.facebook.com/pagename/'))->toBe(PlatformsCategoriesEnum::PROFILE->value);
    });

    it('detects POST in many shapes', function () {
        $v = new FacebookValidator;

        $posts = [
            'https://m.facebook.com/ExamplePage/posts/987654321',
            'https://facebook.com/story.php?story_fbid=555666777&id=123',
            'https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr',
            'https://www.facebook.com/100044573043313/posts/1202953741200383/',
            'https://www.facebook.com/491794399620983/posts/1121416323325451',
            'https://www.facebook.com/REVISTABOOKINGR/posts/pfbid0AzwwUU8puAowPPuwxg6RqSbj44kFTT3STZsFwJof6DbBbRis79s6kxes13J5HYnWl',
            // grupos
            'https://www.facebook.com/groups/123456789012345/posts/987654321098765',
            // pfbid com query e fragment
            'https://www.facebook.com/livealok/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl?rdid=EDuUBbnFKGvqROQx#',
        ];

        foreach ($posts as $url) {
            expect($v->detectUrlCategory($url))->toBe(PlatformsCategoriesEnum::POST->value);
        }
    });

    it('detects VIDEO variants (videos/, video.php, fb.watch, watch/?v=…, reel)', function () {
        $v = new FacebookValidator;

        $videos = [
            'https://www.facebook.com/PageName/videos/1234567890123456/',
            'https://m.facebook.com/video.php?v=9876543210',
            'https://fb.watch/abcDEF123',
            'https://www.facebook.com/watch/?v=123456789012345', // Facebook Watch
            'https://www.facebook.com/reel/1234567890123456/',   // considerar como VIDEO
        ];

        foreach ($videos as $url) {
            expect($v->detectUrlCategory($url))->toBe(PlatformsCategoriesEnum::VIDEO->value);
        }
    });

    it('detects PROFILE variants (vanity, profile.php, subdomain, query/trailing slash)', function () {
        $v = new FacebookValidator;

        $profiles = [
            'https://facebook.com/profile.php?id=1234',
            'https://www.facebook.com/profile.php?id=1234&ref=bookmarks',
            'https://m.facebook.com/profile.php?id=1234/',
            'https://facebook.com/Page.Name',
            'https://www.facebook.com/PageName/',
            'https://m.facebook.com/PageName?utm_source=x',
        ];

        foreach ($profiles as $url) {
            expect($v->detectUrlCategory($url))->toBe(PlatformsCategoriesEnum::PROFILE->value);
        }
    });

    it('many facebook tests at once (expanded)', function () {
        $url = [
            ['https://www.facebook.com/Example.Page',  PlatformsCategoriesEnum::PROFILE],
            ['https://facebook.com/profile.php?id=123456789', PlatformsCategoriesEnum::PROFILE],
            ['https://m.facebook.com/ExamplePage/posts/987654321', PlatformsCategoriesEnum::POST],
            ['https://facebook.com/story.php?story_fbid=555666777&id=123', PlatformsCategoriesEnum::POST],
            ['https://fb.watch/abcDEF123', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/story.php?story_fbid=1057786096151501&id=100057603602454&_rdr', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/100044573043313/posts/1202953741200383/', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/livealok/posts/pfbid02hZiXMYmzApzCTyPtPdFJcjNoLctb4UjjQ4ZWNRmC1jyWBwpGdAEmnpRQYWZgtftrl?rdid=EDuUBbnFKGvqROQx#', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/491794399620983/posts/1121416323325451', PlatformsCategoriesEnum::POST],
            ['https://www.facebook.com/REVISTABOOKINGR/posts/pfbid0AzwwUU8puAowPPuwxg6RqSbj44kFTT3STZsFwJof6DbBbRis79s6kxes13J5HYnWl', PlatformsCategoriesEnum::POST],
            // extras
            ['https://www.facebook.com/PageName/videos/1234567890123456/', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/watch/?v=123456789012345', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/reel/1234567890123456/', PlatformsCategoriesEnum::VIDEO],
            ['https://www.facebook.com/groups/123456789012345/posts/987654321098765', PlatformsCategoriesEnum::POST],
        ];

        $v = new FacebookValidator;
        foreach ($url as $u) {
            expect($v->matches($u[0]))->toBeTrue();
            expect($v->detectUrlCategory($u[0]))->toBe($u[1]->value);
        }
    });

    it('matches facebook URLs', function ($url, $cat) {
        $v = new FacebookValidator;
        expect($v->matches($url))->toBeTrue();
        expect($v->detectUrlCategory($url))->toBe($cat->value);
    })->with('many-facebook-urls');
});
