/**
 * weeblrAMP - Accelerated Mobile Pages for Wordpress
 *
 * @author       weeblrPress
 * @copyright    (c) WeeblrPress - Weeblr,llc - 2017
 * @package      weeblrAMP - Community edition
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version      1.4.0.580
 * @date         2017-07-31
 */

/*! Copyright Weeblr llc 2017 - Licence: http://www.gnu.org/copyleft/gpl.html GNU/GPL */

;
(function (_app, window, document, $) {
    "use strict;"

    function removeMsg(elementId) {
        var $msgContainer = $('#' + elementId);
        var $parent = $($msgContainer.parent());
        $msgContainer.slideUp(200, function () {
            $msgContainer.remove();
            // if container is empty, hide it entirely
            var remaining = $parent.children().length;
            if (!remaining) {
                $parent.parent().hide();
            }
        });
    }

    function showError($element) {
        $element.removeClass('wbl-spin').text('Error').addClass('wb-clr-alert');
    }

    function storeAck($element) {
        var uid = $element.data('element-id');
        var token = $element.data('token');
        var data = {
            "uid": uid
        };
        data[token] = 1;
        var request = $.post("index.php?option=com_ajax&plugin=shlib&method=removeMsg&format=json", data)
            .done(function (data, textStatus, jqXHR) {
                try {
                    if ('object' != typeof data) {
                        data = JSON.parse(data);
                    }
                    if ('object' == typeof data) {
                        if (data.success) {
                            removeMsg(uid);
                        }
                        else {
                            console.log('ShLib: Ajax error: ' + data.message);
                            showError($element);
                        }
                    }
                    else {
                        console.log('wbLib: ajax error: no object in return');
                    }
                } catch (e) {
                    console.log('wbLib: ajax error decoding request response: ' + e.message);
                    console.debug(data);
                    console.debug(e);
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log('wbLib: ajax error: ' + textStatus);
                console.debug(errorThrown);
                showError($element);
            });
    }

    function toggleBody(event, ui) {
        var $that = $(this);
        var id = $that.attr('id');
        var $body = $('#wbl-msg-body-' + id);
        if ($body.is(':visible') == false) {
            $body.addClass('wbl-body-visible');
            $body.slideDown(300);
        }
        else {
            $body.slideUp(300);
            $body.removeClass('wbl-body-visible');
        }

    }

    function acknowledge(event, ui) {
        var $that = $(this);
        $that.html("x").addClass('wbl-spin');
        storeAck($that);
        return false;
    }

    function refreshActions() {
        $('.wbl-msg-button-close').click(acknowledge);
        $('.wbl-container-msg-one-toggle').click(toggleBody);
    }

    function onReady() {
        try {
            refreshActions();
        }
        catch (e) {
            console.log('Error setting up message center: ' + e.message);
        }
    }

    $(document).ready(onReady);

    // interface
    _app.wblib = _app.wblib || {};
    _app.wblib.msgCenter = {
        refreshActions: function () {
            refreshActions();
        }
    }
    return _app;
})
(window.weeblrApp = window.weeblrApp || {}, window, document, jQuery);
