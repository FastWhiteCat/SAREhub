require([
    'jquery',
    'Fwc_SAREhub/js/data-provider',
    'domReady!'
], function ($, dataProvider) {
    configData = dataProvider.getSareAjaxData();
    (function (p) {
        for (var key in p) {
            window['sareX_params'][key] = p[key];
        }
        if(configData.webPush.enabled
            && configData.webPush.type === 'http'){
            window['sareX_params'].webPush.mode = configData.webPush.httpMode
        }
        var s = document.createElement('script');
        s.src = '//x.sare25.com/libs/sarex4.min.js';
        s.async = true;
        var t = document.getElementsByTagName('script')[0];
        t.parentNode.insertBefore(s, t);
    })({
            domain: configData.webPush.domain,
            webPush: {}
    });
});
