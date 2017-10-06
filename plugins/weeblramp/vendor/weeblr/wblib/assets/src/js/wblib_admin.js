/**
 * @ant_title_ant@
 *
 * @author      @ant_author_ant@
 * @copyright   @ant_copyright_ant@
 * @package     @ant_package_ant@
 * @license     @ant_license_ant@
 * @version     @ant_version_ant@
 * @date        @ant_current_date_ant@
 */

/*! Copyright WeeblrPress - Weeblr,llc @_YEAR_@ - Licence: http://www.gnu.org/copyleft/gpl.html GNU/GPL */

;
(function (_app, window, document, $) {
    "use strict";

    var mediaInputClass = '.js-wbamp-media-manager-field';
    var mediaTriggerClass = '.js-wbamp-media-manager-button';
    var colorPickerClass = '.js-wblib-color-picker';
    var clearTransientsClass = '.js-wbamp-clear-transients-button';
    var flushRewriteRulesClass = '.js-wbamp-flush-rewrite-rules-button';

    var hideableSettings = [];
    var $upgradeTab = null;

    /**
     * Implementation
     */

    /**
     * Output to console, with a global on/off switch
     * @param text
     */
    function log(text) {
        _debug && console.log(text + ' - ' + Date.now());
    }

    function mediaManagerClickHandler(event) {
        event.preventDefault();
        var image = null;
        var $button = $(this);
        var $inputField = $button.prev(mediaInputClass).first();
        var inputFieldId = $inputField.attr('id');
        var minWidth = $button.data('media-min-width');
        var minHeight = $button.data('media-min-height');

        // if existing instance, open
        if (!wp.media.frames.wblib_media_manager) {
            // no instance, create it
            wp.media.frames.wblib_media_manager = wp.media({
                title: $button.data('media-title'),
                multiple: false,
                library: {
                    type: $button.data('media-type')
                },
                button: {
                    text: $button.data('media-button')
                }
            });

            var handler = function () {
                var selection = wp.media.frames.wblib_media_manager.state().get('selection');

                if (!selection) {
                    return;
                }

                // iterate over selection, though we only allowed one
                selection.each(function (attachment) {
                    var width = attachment.attributes.width;
                    if (minWidth && width < minWidth) {
                        console.log('This image is not wide enough. Minimal width is: ' + minWidth + ' pixels.');
                    }
                    var height = attachment.attributes.height;
                    if (minHeight && height < minHeight) {
                        console.log('This image is not wide enough. Minimal width is: ' + minHeight + ' pixels.');
                    }

                    // update form
                    var url = attachment.attributes.url;
                    $inputField.val(url);
                    $('#' + inputFieldId + '_width').val(width);
                    $('#' + inputFieldId + '_height').val(height);
                    // add thumbnail
                    if ($button.data('media-preview')) {
                        var $thumb = $('<img />')
                            .attr('src', url);
                        var previewId = '#js-' + inputFieldId + '-preview';
                        $(previewId)
                            .empty()
                            .append($thumb);
                    }
                });
            };

            wp.media.frames.wblib_media_manager.on('select', handler);
        }

        wp.media.frames.wblib_media_manager.open();
    }


    function initMediaManager() {
        $(mediaTriggerClass).on('click', mediaManagerClickHandler);
    }

    function initColorPickers() {
        //$(colorPickerClass).wblColorPicker();
        $(colorPickerClass).wpColorPicker();
    }

    function initClearTransients() {
        $(clearTransientsClass).on('click', clearTransientsClickHandler);
    }

    function clearTransientsClickHandler(event) {
        event.preventDefault();
        var $this = $(this);
        var data = {
            action: 'wblib_config_action',
            'config_item': 'clear_transients',
            '_ajax_nonce': _app.ajax_nonces['clear_transients'] || ''
        };
        $('#js-wbamp-clear-transients-msg').hide();
        _app.spinner.start('js-wbamp-clear-transients-spinner', {class: 'wbl-spinner-css-12'});
        $this.prop('disabled', 'disabled');
        $.post(ajaxurl, data)
            .done(function (response) {
                    console.debug(response);
                    // stop spinner
                    _app.spinner.stop('js-wbamp-clear-transients-spinner');
                    // show message
                    if (response.success) {
                        $('#js-wbamp-clear-transients-msg')
                            .removeClass('wbamp-ajax-response-msg-failure')
                            .addClass('wbamp-ajax-response-msg-success')
                            .html(response.data)
                            .fadeIn();
                        setTimeout(function () {
                            $('#js-wbamp-clear-transients-msg').hide()
                        }, 5000);
                    } else {
                        $('#js-wbamp-clear-transients-msg')
                            .removeClass('wbamp-ajax-response-msg-success')
                            .addClass('wbamp-ajax-response-msg-failure')
                            .html(response.data)
                            .fadeIn();
                    }
                    // enable again button
                    $this.prop('disabled', false);
                }
            );
    }

    function initFlushRewriteRules() {
        $(flushRewriteRulesClass).on('click', flushRewriteRulesClickHandler);
    }

    function flushRewriteRulesClickHandler(event) {
        event.preventDefault();
        var $this = $(this);
        var data = {
            action: 'wblib_config_action',
            'config_item': 'flush_rewrite_rules',
            '_ajax_nonce': _app.ajax_nonces['flush_rewrite_rules'] || ''
        };
        $('#js-wbamp-flush-rewrite-rules-msg').hide();
        _app.spinner.start('js-wbamp-flush-rewrite-rules-spinner', {class: 'wbl-spinner-css-12'});
        $this.prop('disabled', 'disabled');
        $.post(ajaxurl, data)
            .done(function (response) {
                    console.debug(response);
                    // stop spinner
                    _app.spinner.stop('js-wbamp-flush-rewrite-rules-spinner');
                    // show message
                    if (response.success) {
                        $('#js-wbamp-flush-rewrite-rules-msg')
                            .removeClass('wbamp-ajax-response-msg-failure')
                            .addClass('wbamp-ajax-response-msg-success')
                            .html(response.data)
                            .fadeIn();
                        setTimeout(function () {
                            $('#js-wbamp-flush-rewrite-rules-msg').hide()
                        }, 5000);
                    } else {
                        $('#js-wbamp-flush-rewrite-rules-msg')
                            .removeClass('wbamp-ajax-response-msg-success')
                            .addClass('wbamp-ajax-response-msg-failure')
                            .html(response.data)
                            .fadeIn();
                    }
                    // enable again button
                    $this.prop('disabled', false);
                }
            );
    }

    function ajaxClickHandler(actionType, $this) {
        var data = {
            action: 'wblib_config_action',
            'config_item': actionType,
            '_ajax_nonce': _app.ajax_nonces[actionType] || ''
        };
        $('#js-wbamp-' + actionType + '-msg').hide();
        _app.spinner.start('js-wbamp-' + actionType + '-spinner', {class: 'wbl-spinner-css-12'});
        $this.prop('disabled', 'disabled');
        $.post(ajaxurl, data)
            .done(function (response) {
                    // stop spinner
                    _app.spinner.stop('js-wbamp-' + actionType + '-spinner');
                    // show message
                    if (response.success) {
                        $('#js-wbamp-' + actionType + '-msg')
                            .removeClass('wbamp-ajax-response-msg-failure')
                            .addClass('wbamp-ajax-response-msg-success')
                            .html(response.data)
                            .fadeIn();
                        setTimeout(function () {
                            $('#js-wbamp-' + actionType + '-msg').hide()
                        }, 5000);
                    } else {
                        $('#js-wbamp-' + actionType + '-msg')
                            .removeClass('wbamp-ajax-response-msg-success')
                            .addClass('wbamp-ajax-response-msg-failure')
                            .html(response.data)
                            .fadeIn();
                    }
                    // enable again button
                    $this.prop('disabled', false);
                }
            );
    }

    /**
     * Search for all hideable elements on the page,
     * in order to hide/show them according to rules
     * set by users
     */
    function initHideableSettings() {
        // collect all rows with the js-wbamp-show-if class
        var $settings = $('.js-wbamp-show-if');

        $settings.each(processHideableSetting);

        // hide settings at first display as well
        updateHideableSettings();
    }

    /**
     * Process a hideable setting element, storing
     * its trigger element, and other infos so that
     * we can hide/show the element later on
     *
     * @param index
     * @param setting
     */
    function processHideableSetting(index, setting) {
        var record = {};
        var $setting = $(setting);
        var settingClasses = $setting.attr('class');
        var splitClasses = settingClasses && settingClasses.split(' ');
        $.each(
            splitClasses,
            function () {
                if ('js-data' == this.substr(0, 7)) {
                    record['hideable_id'] = this;
                    record['$hideable_id'] = $('.' + this);
                    record['data_source'] = this.substr(8);
                }
            }
        );

        // hiding was decided server side
        var alwaysHide = $setting.data('always_hide');
        if (alwaysHide) {
            record['always_hide'] = true;
            hideableSettings.push(record);
            return;
        }

        // if we found where to read the hide/show infos from, do that
        var $dataSource = $('#' + record['data_source']);
        if ($dataSource.length) {
            record['show_if_id'] = $dataSource.data('show_if_id');
            record['show_include'] = $dataSource.data('show_include');
            record['show_include'] = record['show_include'] && record['show_include'].toString().split(' ');
            record['show_exclude'] = $dataSource.data('show_exclude');
            record['show_exclude'] = record['show_exclude'] && record['show_exclude'].toString().split(' ');
        }

        if (record['show_if_id']) {
            record['$show_trigger'] = $('#' + record['show_if_id']);

            if (record['$show_trigger'].length && record['data_source']) {

                // attach on change handler
                record['$show_trigger'].on('change', updateHideableSettings);

                // then store the record
                hideableSettings.push(record);
            }
        }
    }

    /**
     * Go through all hideable settings on the page,
     * check their trigger element and hide/show them
     * accordingly
     */
    function updateHideableSettings() {
        $.each(
            hideableSettings,
            function (index, item) {

                if (item['always_hide']) {
                    item['$hideable_id'].fadeOut();
                    return;
                }
                var currentValue = item['$show_trigger'].val();
                var elementType = item['$show_trigger'].prop('type');

                // special case for checkboxes
                // shown if show_include == 'checked' (or left empty)
                // shown if show_include == 'unchecked'
                if ('checkbox' == elementType) {
                    if ($.inArray('checked', item['show_include']) != -1) {
                        if (item['$show_trigger'].prop('checked')) {
                            item['$hideable_id'].fadeIn();
                        }
                        else {
                            item['$hideable_id'].fadeOut();
                        }
                        return;
                    }

                    if ($.inArray('unchecked', item['show_include']) != -1) {
                        if (item['$show_trigger'].prop('checked')) {
                            item['$hideable_id'].fadeOut();
                        }
                        else {
                            item['$hideable_id'].fadeIn();
                        }
                        return;
                    }
                }

                // if trigger value is on exclude list, hide item
                if (item['show_exclude'] && $.inArray(currentValue, item['show_exclude']) != -1) {
                    item['$hideable_id'].fadeOut();
                    return;
                }
                // if trigger value is on include list, show item
                if (item['show_include']) {
                    if ($.inArray(currentValue, item['show_include']) != -1) {
                        item['$hideable_id'].fadeIn();
                    }
                    else {
                        item['$hideable_id'].fadeOut();
                    }
                }
                else {
                    item['$hideable_id'].fadeIn();
                }

            }
        );
    }

    /**
     * If any "upgrade" link is clicked, show the Upgrade tab
     * @param event
     */
    function upgradeLinksClick(event) {
        event.preventDefault();
        $upgradeTab.click();
        window.location = '#';
    }

    /**
     * Search for all links to upgrade and attach a click
     * handler to show the upgrade tab, if any
     */
    function initUpgradeLinks() {

        $upgradeTab = $('a.js-wblib-tab-upgrade');

        if ($upgradeTab.length) {
            // collect all rows with the "upgrade" tag class
            var $upgradeLinks = $('.js-wblib-upgrade-link');

            $upgradeLinks.on('click', upgradeLinksClick);
        }
    }


    /**
     * Sets a javascript cookie. Scritly no validation,
     * better get your stuff right
     *
     * @param string id
     * @param string value
     * @param int expireDuration
     * @param string path
     * @param bool secure
     */
    function setCookie(id, value, expireDuration, path, secure) {
        // compute expiration
        expireDuration = parseInt(expireDuration) || Infinity;
        var expireString = Infinity === expireDuration ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + expireDuration;

        // register path
        path = path || '/';

        // secure?
        var secureString = secure ? '; secure' : '';

        // set cookie
        var co = encodeURIComponent(id) + "=" + encodeURIComponent(value) + expireString + "; path=" + path + secureString;
        document.cookie = co;
    }

    /**
     * Get a javascript cookie
     *
     * Based on From https://developer.mozilla.org/en-US/docs/Web/API/Document/cookie/Simple_document.cookie_framework
     * Released under the GNU Public License, version 3 or later
     * http://www.gnu.org/licenses/gpl-3.0-standalone.html
     * (c) Mozilla
     *
     * @param id
     */
    function getCookie(id) {
        if (!id) {
            return null;
        }

        return decodeURIComponent(document.cookie.replace(new RegExp("(?:(?:^|.*;)\\s*" + encodeURIComponent(id).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$"), "$1")) || null;
    }

    /**
     * Delete a cookie
     * @param id
     */
    function deleteCookie(id) {
        setCookie(encodeURIComponent(id), '', -1);
    }

    /**
     * Help display management
     */

    var helpInstances = [];
    var helpCache = {};

    function showHelp(event) {
        event && event.preventDefault();

        // store help instance details
        var $element = $(this);
        var instanceId = $element.attr('id');
        if (!helpInstances[instanceId]) {
            helpInstances[instanceId] = {
                'url': $element.attr('href'),
                'id': $element.data('id'),
                'embed_url': $element.data('embed_url'),
                'embed_url_hash': $element.data('embed_url_hash'),
                'button_id': $element.data('button_id'),
                'frame_id': $element.data('frame_id'),
                'frame_container_id': $element.data('frame_container_id'),
                'spinner_id': $element.data('spinner_id'),
                'spinner_container_id': $element.data('spinner_container_id'),
                'hash': $element.data('hash'),
                'state': $element.data('state')
            }
        }

        if ('opened' == helpInstances[instanceId].state) {
            closeHelp(helpInstances[instanceId]);
            return;
        }

        $('#js-wbamp-settings-doc-msg-' + helpInstances[instanceId].hash).empty();

        // have we fetched this help before?
        if (helpCache[helpInstances[instanceId].id]) {
            displayHelp(helpInstances[instanceId], helpCache[helpInstances[instanceId].id]);
        }
        else {
            showSpinner(helpInstances[instanceId])
            jQuery.ajax(
                {
                    "url": helpInstances[instanceId].embed_url,
                    "error": function (jqXHR, textStatus, errorThrown) {
                        hideSpinner(helpInstances[instanceId]);
                        console.error('Error fetching documentation page ' + helpInstances[instanceId].id + ', status: ' + textStatus + ', code: ' + jqXHR.status);
                        $('#js-wbamp-settings-doc-msg-' + helpInstances[instanceId].hash).html('Sorry, could not load help from server. Please try again later.')
                        setTimeout(
                            function () {
                                $('#js-wbamp-settings-doc-msg-' + helpInstances[instanceId].hash).empty();
                            },
                            7000
                        );
                    },
                    "success": function (data, textStatus, jqXHR) {
                        displayHelp(helpInstances[instanceId], data);
                    }
                });

        }
    }

    /**
     * Show a spinner while the remote help content is fetched,
     * along with its parent container
     */
    function showSpinner(instance) {
        $('#' + instance.spinner_container_id).slideDown();
        _app.spinner.start(instance.spinner_id);
    }

    /**
     * Hide a previously displayed spinner, including its container
     */
    function hideSpinner(instance) {
        _app.spinner.stop(instance.spinner_id);
        $('#' + instance.spinner_container_id).hide();
    }

    /**
     * Opens the iframe (rather its container) used to display the help content
     */
    function openHelp(instance) {
        instance.state = 'opened';
        $('#' + instance.button_id).addClass('wblib-visible');
        $('#' + instance.frame_id).fadeIn();
    }

    /**
     * Closes the iframe (rather it's container) used to display the help content
     */
    function closeHelp(instance) {
        instance.state = 'closed';
        $('#' + instance.frame_id).slideUp();
        $('#' + instance.button_id).removeClass('wblib-visible');
        var theFrame = document.getElementById(instance.frame_id);
        if (theFrame) {
            // in case the frame already exists, kill it
            theFrame.parentElement.removeChild(theFrame);
        }
    }

    /**
     * Displays some help content by injecting it into an (existing) iframe
     * and calling another method to show the iframe
     *
     * @param helpId
     * @param helpData
     */
    function displayHelp(instance, helpData) {

        var loaded = false;

        // if not in cache already, cache data
        if (helpData && !helpCache[instance.id]) {
            helpCache[instance.id] = helpData;
        }

        var theFrame = document.getElementById(instance.frame_id);
        if (theFrame) {
            // in case the frame already exists, kill it
            theFrame.parentElement.removeChild(theFrame);
        }

        // create an iframe element
        var $newFrame = $('<iframe id="' + instance.frame_id + '" class="wblib-settings-doc-frame wblib-hide"></iframe>');

        // inject it in the container, right after the spinner container
        $('#' + instance.frame_container_id).append($newFrame);

        theFrame = $newFrame[0];
        var theDoc;
        var theWindow;
        if (theFrame.document) {
            theDoc = theFrame.document;
        }
        else if (theWindow = theFrame.contentWindow) {
            theDoc = theWindow.document;
        }

        $newFrame.on('load', function () {

            hideSpinner(instance);
            openHelp(instance);

            // scroll to anchor, if any
            if (!loaded && instance.embed_url_hash && theDoc) {
                loaded = true;
                var target = theDoc.getElementById(instance.embed_url_hash);
                if (target) {
                    var viewportOffset = target.getBoundingClientRect();
                    theWindow.scrollTo(0, viewportOffset.top);
                }
            }
        });

        // inject in iframe document
        theDoc.open();
        theDoc.writeln(helpData);
        theDoc.close();
    }

    function initEmbedHelp() {
        $('.js-wblib-settings-doc-embed').click(showHelp);
    }

    /**
     * Startup code
     */
    function onReady() {
        try {
            initMediaManager();
            initColorPickers();
            initClearTransients();
            initFlushRewriteRules();
            initHideableSettings();
            initUpgradeLinks();
            initEmbedHelp();
        }
        catch (e) {
            console.log('wbLib: error setting up javascript: ' + e.message);
        }
    }

    $(document).ready(onReady);

    /**
     * Public interface
     */
    _app.setCookie = setCookie;
    _app.getCookie = getCookie;
    _app.deleteCookie = deleteCookie;
    _app.doc_embed = {
        showHelp: showHelp,
        displayHelp: displayHelp
    };
    return _app;

})
(window.wblib = window.wblib || {}, window, document, jQuery);


