<?php

try {
    $data = shuuka_before_user_page_render();
}catch (Exception $e) {
    echo "The SecreteKey is not Valid ".$e->getMessage();
    wp_die();
}

$regex_https = '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@';
$regex_http = '@(http?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@';

$nickname = preg_replace($regex_https, ' ', $data->nickname);
$nickname = preg_replace($regex_http, ' ', $nickname);
$nickname = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $nickname);

$description = preg_replace($regex_https, ' ', $data->description);
$description = preg_replace($regex_http, ' ', $description);
$description = str_replace( array( '\'', '"', ',' , ';', '<', '>' ), ' ', $description);

?>

<!doctype html>

<html id="shk-page">

<head>
    <meta charset="utf-8">
    <title><?=$nickname?> - Social Links</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="description" content="<?=$description?>">

    <meta property="og:title" content="<?=$nickname?> - Social Links"/>
    <meta property="og:description" content="<?=$description?>"/>
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$shuuka_pluginUrl?>assets/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=$shuuka_pluginUrl?>assets/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$shuuka_pluginUrl?>assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=$shuuka_pluginUrl?>assets/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$shuuka_pluginUrl?>assets/icons/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=$shuuka_pluginUrl?>assets/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <?php if($data->avatar): ?>
        <meta property="og:image" content="<?=$data->avatar;?>" />
    <?php else: ?>
        <meta property="og:image" content="<?=$shuuka_pluginUrl?>assets/icons/shuuka-socialimg-v2.jpg" />
    <?php endif; ?>

    <?php if($data->avatar): ?>
        <meta itemprop="image" content="<?=$data->avatar;?>">
    <?php else: ?>
        <meta itemprop="image" content="<?=$shuuka_pluginUrl?>assets/icons/shuuka-socialimg-v2.jpg">
    <?php endif; ?>
    
    <meta itemprop="description" content="<?=$description?>" >
    <?php wp_head(); ?>
</head>
<body>
<div id="webContainer">
    <div id="main-view" style=" padding-bottom: 54px; ">
        <div id="page" class="container-fluid max-width hide-opacity" style="opacity: 1;padding-top: 20px !important;">
            <div class="section-content">
                <div>

                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="page-content margin-auto box-left-medium" style="margin-bottom:40px">

                                <div id="page-description" class="shuuka-box">
                                    <div class="descriptionView">
                                        <div class="show-info">
                                            <div class="avatar-wrapper">
                                                <div class="round-box">
                                                    <?php if($data->avatar): ?>
                                                        <img class="avatar" src="<?=$data->avatar;?>" alt="Verified user"/>
                                                    <?php else: ?>
                                                        <svg version="1.1" id="avatar-dashboard" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 515 515" style="enable-background:new 0 0 515 515" xml:space="preserve"><style type="text/css">.st0-avatar{fill:#f8fbf8}.st1-avatar{fill:#5acda6}</style><g id="g-avatar"><path class="st0-avatar" d="M180.9,403.8L104,445.7c-4.5,2.5-8.6,5.5-12.3,8.8c44.8,37.8,102.6,60.6,165.8,60.6 c62.7,0,120.2-22.4,164.8-59.7c-4.1-3.5-8.6-6.6-13.5-9.1l-82.3-41.1c-10.6-5.3-17.3-16.2-17.3-28.1v-32.3c2.3-2.6,5-6,7.8-10 c11.2-15.8,19.7-33.3,25.6-51.5c10.6-3.3,18.3-13,18.3-24.6v-34.5c0-7.6-3.4-14.4-8.6-19.1v-49.8c0,0,10.2-77.5-94.7-77.5 s-94.7,77.5-94.7,77.5v49.8c-5.2,4.7-8.6,11.5-8.6,19.1v34.5c0,9.1,4.8,17.1,11.9,21.7c8.6,37.5,31.2,64.5,31.2,64.5v31.5 C197.2,387.7,190.9,398.3,180.9,403.8z"></path><path class="st1-avatar" d="M261.9,0C185.2-1.3,0,0,0,0s1.2,187.7,0,253.1C-0.8,303.5,0,515,0,515h112c3.7-3.3-12.4-66.9-8-69.3l76.8-41.9 c10.1-5.5,16.4-16.1,16.4-27.5v-31.5c0,0-22.6-27-31.2-64.5c-7.1-4.6-11.9-12.6-11.9-21.7v-34.5c0-7.6,3.4-14.4,8.6-19.1v-49.8 c0,0-10.2-77.5,94.7-77.5s94.7,77.5,94.7,77.5V205c5.2,4.7,8.6,11.5,8.6,19.1v34.5c0,11.6-7.8,21.3-18.3,24.6 c-5.9,18.3-14.4,35.7-25.6,51.5c-2.8,4-5.5,7.4-7.8,10V377c0,11.9,6.7,22.8,17.3,28.1l82.3,41.1c4.9,2.5,9.4,5.6,13.5,9.1 c12.3,14.1,8.8,50.5,23.7,59.7h69c0,0-0.9-202.4,0-253.1C516.1,197.4,515,0,515,0H261.9z"></path><path class="st0-avatar" d="M124.3,434.6c0,0-74.9,37.7-95.7,80.4h448.1c-11.7-17.7-22-40.2-54.4-59.7c-30.5-18.4-209-14.6-209-14.6 L124.3,434.6z"></path></g></svg>
                                                    <?php endif;  ?>
                                                    <?php if ($data->verify === 1): ?>
                                                        <span class="verify">
                                                                <img src="<?=$shuuka_pluginUrl.'assets/images/verify-account.png'?>"
                                                                     alt="Verified user"/>
                                                            </span>
                                                    <?php endif ?>
                                                </div>
                                            </div>

                                                <div class="show-info-text">
                                                    <h5 style=" margin-top: 0; ">
                                                        <span style="color:#05d1a3;margin-right:10px;">
                                                            <?= $nickname ?>
                                                        </span> 
                                                        <?php if ($data->categoryName): ?>
                                                            - <?= $data->categoryName ?></span>
                                                        <?php endif; ?>
                                                    </h5>
                                                    <?php if ($data->description): ?>
                                                        <p><?=$data->description ?></p>
                                                    <?php endif; ?>
                                                </div>

                                            <?php if($data->shuks): ?>
                                                <span class="events-group">
                                                    <button class="btn-shuuka btn-round btn-shuk" type="button">
                                                        <span class="count" style="margin-right:2px;"><?=$data->shuks?>1</span>
                                                        <span class="text">shuks</span>
                                                    </button>
                                                </span>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="subView">
                                    <div id="social-icon-list">
                                        <div class="icon-list shuuka-box">

                                            <?php foreach ($data->networks as $key => $value): ?>
                                                <div class="item">
                                                    <div class="li social">

                                                        <div class="social-btn-box">
                                                            <a target="_blank" href="<?= $value->shortUrl ?>"
                                                               class="social-options btn btn-default" type="button">
                                                                <img src="<?=$shuuka_pluginUrl.'assets/images/icon-link.svg'?>" alt="Link">
                                                            </a>
                                                        </div>

                                                        <a target="_blank" href="<?= $value->shortUrl ?>">
                                                            <div class="net-icon net-icon-shuuka-<?= $value->networkName ?>"
                                                                 style="width:49px;height:50px;">
                                                                <img src="<?='https://www.shuuka.com/images/socialicons/shuuka-'.$value->networkName.'.png'?>"
                                                                     alt="SHUUKA"/>
                                                            </div>
                                                            <span class="social-network">
                                                                    <span class="name"><?= $value->networkName ?></span>
                                                                </span>
                                                            <span class="social-name wrap-name-list">
                                                                    <?= $value->networkNickname ?>
                                                                </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="https://www.shuuka.com" target="_blank">
                <img class="brand-logo" src="<?=$shuuka_pluginUrl.'vendor/redux-framework/ReduxCore/templates/panel/assets/logo.png'?>" alt="shuuka logo"/>
            </a>
        </div>
        <div id="footer-wave" style=" position: relative; width: 100%; ">
            <svg style="width: 100%;bottom: -110px !important;margin-top: 0;" class="bottomRightRounded wave-footer" version="1.1"
                 x="0px" y="0px" viewBox="0 0 1679 97">
                <path class="st0" d="M1679.1,32.4C1679.1,32.4,1679.1,32.3,1679.1,32.4l0-3h-3.4v0c-42.5,0.3-84.9,0.7-127.3,1.5
                c-18.6,0.3-37.1,0.8-55.7,1.2c-21.6,0.5-43.1,1.2-64.7,1.9c-11.8,0.3-23.6,0.7-35.5,1.1c-17.6,0.6-35.3,1.3-52.9,1.9
                c-9.2,0.3-18.5,0.7-27.7,1.1c-15.7,0.6-31.5,1.3-47.2,1.9c-8.7,0.4-17.3,0.7-26,1.1c-14,0.6-27.9,1.3-41.9,1.9c-8,0.4-16,0.7-24,1.1
                c-13.2,0.6-26.4,1.3-39.7,1.9c-7.6,0.4-15.1,0.7-22.7,1.1c-12.1,0.6-24.1,1.3-36.2,1.9c-8,0.4-16,0.7-24,1.1
                c-14,0.8-27.9,1.6-41.9,2.4c-11.1,0.6-22.1,1-33.2,1.6c-14.5,0.8-29.1,1.6-43.6,2.4c-14.1,0.7-28.3,1.3-42.4,2.1
                c-16.5,0.9-33.1,1.9-49.6,2.9c-12.8,0.7-25.6,1.3-38.4,2c-18.6,1-37.2,2-55.9,3c-16.2,0.9-32.4,1.7-48.6,2.5
                c-16.1,0.8-32.3,1.7-48.4,2.5c-16.7,0.8-33.4,1.7-50.1,2.5c-17.2,0.8-34.4,1.7-51.6,2.5c-17.7,0.8-35.4,1.7-53.1,2.5
                c-19.1,0.9-38.3,1.7-57.4,2.5c-21,0.9-41.9,1.7-62.9,2.5c-18.3,0.7-36.6,1.4-54.9,2c-19.8,0.7-39.6,1.4-59.4,2
                c-17.7,0.6-35.5,1.1-53.2,1.5c-22.1,0.5-44.1,1.1-66.2,1.5c-25,0.4-50,0.8-75,1C47,92,29.6,92,12.2,92H0v5h4.3
                c278.6,0,557.2,0,835.7,0c278.7,0,557.3,0,836,0.1c2.3,0,3-0.4,3-2.9C1679,64.6,1679,62,1679.1,32.4z"></path>
            </svg>
        </div>
    </div>
    
    <?php //if(isAnalytics($shuuka_gl_analytic)) :?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$shuuka_gl_analytic?>"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?=$shuuka_gl_analytic?>');
        </script>
    <?php //endif; ?>

    
    <?php if(isAnalytics($shuuka_fb_pixel)) :?>
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?=$shuuka_fb_pixel?>');
            fbq('track', 'PageView');
        </script>
        <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?=$shuuka_fb_pixel?>&ev=PageView&noscript=1"/>
        </noscript>
    <?php endif; ?>

</body>
</html>
