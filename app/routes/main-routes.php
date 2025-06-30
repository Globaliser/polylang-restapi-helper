<?php

namespace PolylangRestapiHelper;

/* APIS */

$ata_router->api_version('polylang-restapi-helper/v1');

$ata_router->api_method('POST')->api('/set-post-lang-relation')->call('PolylangRestapiHelperApi::api_set_post_lang_relation');
$ata_router->api_method('POST')->api('/set-category-lang-relation')->call('PolylangRestapiHelperApi::api_set_category_lang_relation');

$ata_router->api_method('GET')->api('/get-post-lang-relations/(?P<id>\d+)')->call('PolylangRestapiHelperApi::api_get_post_lang_relations');
$ata_router->api_method('GET')->api('/get-category-lang-relations/(?P<id>\d+)')->call('PolylangRestapiHelperApi::api_get_category_lang_relations');