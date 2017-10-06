/**
 * weeblrAMP - Accelerated Mobile Pages for Wordpress
 *
 * @author       weeblrPress
 * @copyright    (c) WeeblrPress - Weeblr,llc - 2017
 * @package      weeblrAMP - Community edition
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version      1.4.0.580
 *
 * 2017-07-31
 */

/*! Copyright Weeblr llc @_YEAR_@ - Licence: http://www.gnu.org/copyleft/gpl.html GNU/GPL */

;
(function (_app, window, document, $) {
    "use strict;"

    var $spinners = {};

    function start(elementId, options) {
        try {
            var fullElementId = '#' + (elementId || 'wbl-spinner');
            if ($spinners[fullElementId] && $spinners[fullElementId]['count'] > 0) {
                // already a spinner running on this element
                // increase counter
                $spinners[fullElementId]['count'] += 1;
                // but don't create a new spinner
            }
            else if ($spinners[fullElementId] && $spinners[fullElementId]['count'] <= 0) {
                // re-launch a spinner
                $spinners[fullElementId]['element'].fadeIn();
            }
            else {
                //
                var $spinner = $(fullElementId);
                if ($spinner.length) {
                    $spinner.addClass('wbl-spinner-css');
                    if (options && options['class']) {
                        $spinner.addClass(options['class']);
                    }
                    $spinners[fullElementId] = {'element': $spinner, 'count': 1};

                    // launch a new spinner
                    $spinners[fullElementId]['element'].fadeIn();
                }
                else {
                    console.log('wblib: requested to start a spinner for ' + fullElementId + ' but element not found');
                }
            }

        } catch (e) {
            console.log('wblib: error starting svg spinner: ' + e.message);
        }
    }

    function stop(elementId, force) {
        try {
            var fullElementId = '#' + (elementId || 'wbl-spinner');
            // does this spinner exist?
            if (!$spinners[fullElementId]) {
                return;
            }
            if (force) {
                $spinners[fullElementId]['count'] = 0;
            }
            else {
                $spinners[fullElementId]['count'] -= 1;
            }

            // stop spinner is nobody uses it any longer
            if ($spinners[fullElementId] && $spinners[fullElementId]['count'] <= 0) {
                $spinners[fullElementId]['count'] = 0;
                $spinners[fullElementId]['element'].hide();
            }

        } catch (e) {
            console.log('wbLib: error stopping svg spinner: ' + e.message);
        }
    }

    // interface
    _app.spinner = _app.spinner || {};
    _app.spinner.start = start;
    _app.spinner.stop = stop;

    return _app;
})
(window.wblib = window.wblib || {}, window, document, jQuery);

