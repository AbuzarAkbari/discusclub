function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}

window.fbAsyncInit = function() {
    FB.init({
        appId            : '557243647957650',
        autoLogAppEvents : true,
        xfbml            : true,
        cookie           : true,
        version          : 'v2.10'
    });

    checkLogin()

};

function checkLogin() {
    FB.getLoginStatus(function(response) {
        if(response.status != "connected") {
            return
        }
        var data = new FormData();
        Object.keys(response.authResponse).forEach(function(key) {
            data.append( key, response.authResponse[key] );
        })
        var x = parseURLParams(window.location.href);
        if(x && x.redirect) {
            data.append("redirect", x ? x.redirect[0] : "/")
        }
        fetch("/includes/tools/facebook_login", {
            method: "POST",
            body: data,
            credentials: "same-origin"
        })
            .then(function(res) { return res.json()})
            .then(function(res) {
                window.location = res.redirect
            });
    });
}

function checkLoginState() {
    checkLogin()
}