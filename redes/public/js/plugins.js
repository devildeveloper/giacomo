// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function noop() {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Controles QD

$(document).ready(initControls);

function initControls()
{
    $('.block .btn_toggle').click(togglePanel);
}

function togglePanel()
{
    if($(this).find('span').hasClass('icon-chevron-up'))
    {
        $(this).parent().parent().parent().find('.block-content').slideUp('fast');
        $(this).find('span').attr('class', 'icon-chevron-down');
    }else{
        $(this).parent().parent().parent().find('.block-content').slideDown('fast');
        $(this).find('span').attr('class', 'icon-chevron-up');
    }
}



// Place any jQuery/helper plugins in here.
