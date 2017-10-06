<?php die() ; ?>

Server Variables
    SERVER_SOFTWARE = Apache
    DOCUMENT_ROOT = /opt/bitnami/apps/wordpress/htdocs
    LSWCP_TAG_PREFIX = 704

LSCache Plugin Options
    version = 1.2.1
    enabled = 1
    radio_select = 1
    purge_upgrade = 1
    cache_priv = 1
    cache_commenter = 1
    cache_rest = 1
    cache_page_login = 1
    timed_urls = 
    timed_urls_time = 
    cache_favicon = 1
    cache_resources = 1
    mobileview_enabled = 
    mobileview_rules = 
    login_cookie = 
    check_advancedcache = 1
    debug = 0
    admin_ips = 127.0.0.1
    debug_level = 
    log_file_size = 30
    heartbeat = 1
    debug_cookie = 
    collaps_qs = 
    log_filters = 
    log_ignore_filters = gettext
gettext_with_context
get_the_terms
get_term
    log_ignore_part_filters = i18n
locale
settings
option
    test_ips = 
    public_ttl = 604800
    private_ttl = 1800
    front_page_ttl = 604800
    feed_ttl = 0
    403_ttl = 3600
    404_ttl = 3600
    500_ttl = 3600
    purge_by_post = A.F.H.M.PGS.PGSRP.PT.T
    excludes_uri = 
    excludes_cat = 
    excludes_tag = 
    nocache_cookies = 
    nocache_useragents = 
    crawler_include_posts = 1
    crawler_include_pages = 1
    crawler_include_cats = 1
    crawler_include_tags = 1
    crawler_excludes_cpt = 
    crawler_order_links = date_desc
    crawler_usleep = 500
    crawler_run_duration = 400
    crawler_run_interval = 600
    crawler_crawl_interval = 302400
    crawler_threads = 3
    crawler_load_limit = 1
    crawler_domain_ip = 
    crawler_custom_sitemap = 
    crawler_cron_active = 
    esi_enabled = 
    esi_cached_admbar = 1
    esi_cached_commform = 1

Wordpress Specific Extras
    wordpress version = 4.8.1
    locale = mk_MK
    active theme = Virtue
    active plugins = Array
(
    [0] => cloudflare-flexible-ssl/plugin.php
    [1] => accelerated-mobile-pages/accelerated-moblie-pages.php
    [2] => akismet/akismet.php
    [3] => all-in-one-wp-migration/all-in-one-wp-migration.php
    [4] => amp-woocommerce/amp-woocommerce.php
    [5] => amp/amp.php
    [6] => black-studio-tinymce-widget/black-studio-tinymce-widget.php
    [7] => browser-caching-with-htaccess/caching.php
    [8] => facebook-for-woocommerce/facebook-for-woocommerce.php
    [9] => fb-instant-articles/facebook-instant-articles.php
    [10] => fb-messenger-live-chat/fb-messenger-live-chat.php
    [11] => fb-reviews-widget/fbrev.php
    [12] => google-analytics-for-wordpress/googleanalytics.php
    [13] => icegram-rainmaker/icegram-rainmaker.php
    [14] => icegram/icegram.php
    [15] => kadence-importer/kadence-importer.php
    [16] => loco-translate/loco.php
    [17] => ninja-forms/ninja-forms.php
    [18] => phppoet-checkout-fields/phppoet-checkout-fields.php
    [19] => pixelyoursite/facebook-pixel-master.php
    [20] => sassy-social-share/sassy-social-share.php
    [21] => simple-tags/simple-tags.php
    [22] => siteorigin-panels/siteorigin-panels.php
    [23] => ssl-insecure-content-fixer/ssl-insecure-content-fixer.php
    [24] => sumome/sumome.php
    [25] => versionpress/versionpress.php
    [26] => virtue-toolkit/virtue_toolkit.php
    [27] => woo-checkout-field-editor-pro/checkout-form-designer.php
    [28] => woo-related-products-refresh-on-reload/woo-related-products.php
    [29] => woocommerce-direct-checkout/wc-direct-checkout.php
    [30] => woocommerce/woocommerce.php
    [32] => woosidebars/woosidebars.php
    [33] => wordpress-seo/wp-seo.php
    [34] => wp-mail-smtp/wp_mail_smtp.php
    [35] => wp-smushit/wp-smush.php
    [36] => zotabox/zotabox.php
)


/opt/bitnami/apps/wordpress/htdocs/.htaccess contents:
# BEGIN LSCACHE
## LITESPEED WP CACHE PLUGIN - Do not edit the contents of this block! ##
<IfModule LiteSpeed>
RewriteEngine on
CacheLookup on
RewriteRule .* - [E=Cache-Control:no-autoflush]

### marker CACHE RESOURCE start ###
RewriteRule wp-content/.*/[^/]*(responsive|css|js|dynamic|loader|fonts)\.php - [E=cache-control:max-age=3600]
### marker CACHE RESOURCE end ###

### marker FAVICON start ###
RewriteRule favicon\.ico$ - [E=cache-control:max-age=86400]
### marker FAVICON end ###

</IfModule>
## LITESPEED WP CACHE PLUGIN - Do not edit the contents of this block! ##
# END LSCACHE
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>

# END WordPress


