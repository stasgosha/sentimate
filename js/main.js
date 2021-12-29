$(function () {


    console.log(document.domain.toLowerCase());
    if (document.domain.toLowerCase().indexOf("sentimate.com") != -1){
        ///live
        var url = 'https://pro.sentimate.com/product-analysis/search?';
        var tenant='revuze';
        var token_issuer='https://auth.sentimate.com/';
        var domain='auth.sentimate.com';
        var clientID='HKFVDCp1lL0Xk4F72quWxMlhAyX67OrO';
        var audience='https://revuze.us.auth0.com/api/v2/';
    }else{
        ///staging
        var url = 'https://pro-staging.sentimate.com/product-analysis/search?';
        var tenant='revuze-staging';
        var token_issuer='https://auth-staging.sentimate.com/';
        var domain='auth-staging.sentimate.com';
        var clientID='85IVkPcs9dUoPCt1SvTA7oZqByEZkXu8';
        var audience='https://revuze-staging.us.auth0.com/api/v2/';
    }
    var starturl=url;




    var utm_source = getQueryParam('utm_source');
    var utm_medium = getQueryParam('utm_medium');
    var utm_campaign = getQueryParam('utm_campaign');
    var utm_term = getQueryParam('utm_term');
    var utm_content = getQueryParam('utm_content');
    var hubspotutk = getQueryParam('hubspotutk');
    var industry = getQueryParam('industry');
    var category = getQueryParam('category');
    var q = getQueryParam('q');
    var permalink = getQueryParam('permalink');
    var compBcat = getQueryParam('compBcat');
    var compBuuid = getQueryParam('compBuuid');


    var input = getQueryParam('input');
    if(utm_source){
        createCookie('utm_source',utm_source,3);

    }
    if(utm_medium){
        createCookie('utm_medium',utm_medium,3);
    }
    if(utm_campaign){
        createCookie('utm_campaign',utm_campaign,3);
    }
    if(utm_term){
        createCookie('utm_term',utm_term,3);
    }
    if(utm_content){
        createCookie('utm_content',utm_content,3);
    }
    if(hubspotutk){
        createCookie('hubspotutk',hubspotutk,3);
    }
    if(hubspotutk){
        createCookie('hubspotutk',hubspotutk,3);
    }
    if(category){
        createCookie('category',category,3);
    }
    if(industry){
        createCookie('industry',industry,3);
    }
    if(permalink){
        createCookie('permalink',permalink,3);
    }
    if(compBcat){
        createCookie('compBcat',compBcat,3);
    }
    if(compBuuid){
        createCookie('compBuuid',compBuuid,3);
    }
    if(q){
        createCookie('q',q,3);
    }

    if(input || input==0 ){
        createCookie('input',input,3);
    }




    var utm={};
    if(readCookie('utm_source')){
        utm['utm_source']=readCookie('utm_source');
    }
    if(readCookie('utm_medium')){
        utm['utm_medium']=readCookie('utm_medium');
    }
    if(readCookie('utm_campaign')){
        utm['utm_campaign']=readCookie('utm_campaign');
    }
    if(readCookie('utm_term')){
        utm['utm_term']=readCookie('utm_term');
    }
    if(readCookie('utm_content')){
        utm['utm_content']=readCookie('utm_content');
    }


    var params='';
    for (const [key, value] of Object.entries(utm)) {
        if(params){
            params=params+'&'+key+'='+value;
        }else{
            params='?'+key+'='+value;
        }

    }
    //url = url + params;


    var industry = getQueryParam('industry');
    var category = getQueryParam('category');
    var compBcat = getQueryParam('compBcat');
    var compBuuid = getQueryParam('compBuuid');
    var permalink = getQueryParam('permalink');
    var q = getQueryParam('q');





    function createCookie(name, value, days) {
        var expires;

        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        } else {
            expires = "";
        }
        document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = encodeURIComponent(name) + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ')
                c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0)
                return decodeURIComponent(c.substring(nameEQ.length, c.length));
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name, "", -1);
    }


    const togglePasswordLogin = document.querySelector(".togglePassword_login")
    togglePasswordLogin.addEventListener("click", function (e) {
        const input = document.getElementById("password_login");
        const type =
            input.getAttribute("type") === "password"
                ? "text"
                : "password";
        input.setAttribute("type", type);
        this.classList.toggle("eye-icon--show");
    });

    const togglePasswordSignin = document.querySelector(".togglePassword_signin")
    togglePasswordSignin.addEventListener("click", function (e) {
        const input = document.getElementById("signin_password");
        const type =
            input.getAttribute("type") === "password"
                ? "text"
                : "password";
        input.setAttribute("type", type);
        this.classList.toggle("eye-icon--show");
    });

    const togglePasswordSigninConfirm = document.querySelector(".togglePassword_signin_confirm")
    togglePasswordSigninConfirm.addEventListener("click", function (e) {
        const input = document.getElementById("password-confirmation");
        const type =
            input.getAttribute("type") === "password"
                ? "text"
                : "password";
        input.setAttribute("type", type);
        this.classList.toggle("eye-icon--show");
    });

   function api(autologinparams=0,link=0,params=0) {

       var redirectUrl='';

        if(uuid !== "" && !params ){

            var redirectUrl = '/product-analysis/'+uuid;
            if(link){
                redirectUrl=redirectUrl+link;
            }
            if($('.product-name').length){
                redirectUrl=redirectUrl+'?q='+$('.product-name').text();
            }
        }else {

            if(params){
                redirectUrl=redirectUrl+link;
            }else {
                if ($('#searchinput').val()) {
                    var redirectUrl = '/product-analysis/search-results?q=' + $('#searchinput').val();
                } else {
                    if (readCookie('permalink')) {
                        var redirectUrl = readCookie('permalink');
                    } else {
                        var redirectUrl = '/category-analysis/top-ranking-products';
                    }
                }
            }

        }
        var gets={};
        if(industry){
            gets['industry']=readCookie('industry');
        }
        if(category){
            gets['category']=readCookie('category');
        }
        if(compBcat){
            gets['compBcat']=readCookie('compBcat');
        }
        if(compBuuid){
            gets['compBuuid']=readCookie('compBuuid');
        }
        if(permalink){
            gets['permalink']=readCookie('permalink');
        }
        if(q){
            gets['q']=readCookie('q');
        }
        var params='';
        for (const [key, value] of Object.entries(gets)) {
            if(key!='permalink'){
                if(params){
                    params=params+'&'+key+'='+value;
                }else{
                    params='?'+key+'='+value;
                }
            }
        }


        redirectUrl = redirectUrl + params;

        var encode = encodeURIComponent(redirectUrl);
        var redirectQuery = `${!params ? '' : ''}redirect=${encode}`;
        // if(params ){
        urlnew= url +redirectQuery;
        // }

        ///////////////////////////////////

        var params = {
            overrides: {
                __tenant: tenant,
                __token_issuer: token_issuer
            },
            domain: domain,
            clientID: clientID,
            audience: audience,
            redirectUri: "",
            responseType: "code",
            scope: 'openid profile email',
            skipRedirectCallback: true,
            responseMode: 'web_message',
            prompt: 'none'
        };


        if(starturl==urlnew){
            urllogin = urlnew+'login=true';
        }else{
            urllogin = urlnew+'&login=true';
        }

        console.log('||||||||||');
        console.log(urlnew);
        console.log('||||||||||');
        console.log(urllogin);
        console.log('||||||||||');
        console.log(redirectUrl);


        const webAuthCallback = customWebAuth(window.location.origin);
        const webAuth = customWebAuth(urlnew);
        const webAuthLogin = customWebAuth(urllogin);

        // console.log('///////////////');
        // console.log(webAuth);
        function customWebAuth(redirectUri) {
            var params = {
                overrides: {
                    __tenant: tenant,
                    __token_issuer: token_issuer
                },
                domain: domain,
                clientID: clientID,
                audience: audience,
                redirectUri: "",
                responseType: "code",
                scope: 'openid profile email',
            };
            params.redirectUri = redirectUri;
            return new auth0.WebAuth(params);
        }

        webAuthCallback.parseHash({ nonce: '1234' }, function (err, authResult) {

            if (err || !authResult) {
                return console.log(err);
            }

            webAuthCallback.client.userInfo(authResult.accessToken, function (err, user) {
                // create form to HS here:
                //
                // user.email
                // user.family_name
                // user.given_name
                // user.sub


                webAuth.authorize({
                    connection: 'google-oauth2',
                }, function (err, res) {
                    if (err) displayError(err, 'error-message-signin');
                    if (res) console.log(res);
                });
            });
        });


        const DEFAULT_THEME = 'light';
        let activeTheme = DEFAULT_THEME;
        initTheme();
        initKeyboardShortcuts();



        var databaseConnection = 'Username-Password-Authentication';

        function initKeyboardShortcuts() {
            document.addEventListener("keydown", function (e) {
                if (e.shiftKey && e.key === "X") {
                    switchTheme(activeTheme === 'light' ? 'dark' : 'light');
                }
            });
        }

        function initTheme() {
            activeTheme = localStorage.getItem('activeTheme');
            if (activeTheme) {
                switchTheme(activeTheme);
            } else {
                switchTheme(DEFAULT_THEME);
            }
        }

        function switchTheme(className) {
            let htmlElement = document.querySelector('html');
            if (htmlElement) {
                document.querySelector('html').className = "";
                document.querySelector('html').classList.add(className);
            }
            activeTheme = className;
            localStorage.setItem('activeTheme', className);
        }

        function resetPassword(e) {

            var username = document.getElementById('email').value;

            webAuth.changePassword({
                connection: databaseConnection,
                email: username
            }, function (err, resp) {
                if (err) {
                    displayError(err, 'error-message-login');
                } else {
                    displayError(resp, 'error-message-login');
                }
            });
        }

        function login(e) {
            e.preventDefault();
            var button = this;
            var username = document.getElementById('email').value;
            var password = document.getElementById('password_login').value;
            redirectLogin(username, password);

        }

        var user = {};

        if(readCookie('userdata') && $('body').hasClass('page-template-singup')) {
            $('body').css('opacity','0.5');
            autologin();

        }

        $('[data-modal]').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'signup-popup',
            });
            if($(this).data('modal')=='#popUp' ){
                if(readCookie('userdata')) {
                    autologinparams = 1;
                }else{
                    autologinparams = 0;
                }
                if($(this).attr('data-link')){
                    var link=$(this).attr('data-link');
                }else{
                    var link='';
                }
                if($(this).hasClass('slick-arrow')){
                    params=1;
                }else{
                    params=0;
                }
                api(autologinparams,link,params);
            }else{
                hideModal('.modal');

                if ($(this).data('modal-tab') != undefined) {
                    goToTab($(this).data('modal-tab'));
                }
                showModal( $(this).data('modal') );
            }
        });


       $('#search').submit(function(e){
           e.preventDefault();
           window.dataLayer = window.dataLayer || [];
           window.dataLayer.push({
               'event': 'signup-popup',
           });
           // hideModal('.modal');
           // showModal( '#popUp' );

           if( readCookie('userdata')){
               autologinparams=1;
               api(autologinparams);
               return;
           }else{
               hideModal('.modal');
               showModal( '#popUp' );
           }
           api();

       })

       if(autologinparams){
           autologin();
       }
        function autologin(){
            var actual = JSON.parse(atob(readCookie('userdata')));
            console.log(webAuthLogin);
            webAuthLogin.login({
                realm: databaseConnection,
                username: actual.email,
                password: actual.pass,
            }, function (err) {
                if (err){

                }
            });
        }

        function loginWithGoogle() {

            webAuthCallback.parseHash({nonce: '1234'}, function (err, authResult) {
                // debugger
                if (err || !authResult) {
                    return console.log(err);
                }

                webAuthCallback.client.userInfo(authResult.accessToken, function (err, user) {
                    // create form to HS here:
                    //
                    // user.email
                    // user.family_name
                    // user.given_name
                    // user.sub

                    webAuth.authorize({
                        connection: 'google-oauth2',
                    }, function (err, res) {
                        if (err) displayError(err, 'error-message-signin');
                        if (res) console.log(res);
                    });
                });
            });
        }

        function signup() {
            var button = this;
            var email = document.getElementById('signin_email').value;
            var password = document.getElementById('signin_password').value;
            var confirm = document.getElementById('password-confirmation').value;

            if (password !== confirm) {
                displayError(`Password don't match`, 'error-message-signin');
                return;
            }


            button.disabled = true;
            // webAuth.redirect.signupAndLogin({
            webAuth.signup ({
                connection: databaseConnection,
                email: email,
                password: password,
            }, function (err, res) {
                if (err) {
                    displayError(err, 'error-message-signin');
                    button.disabled = false;
                } else if (res && res.Id && res.email) {
                    createHsForm(res.Id, res.email);
                    var user={"email": email, "pass": password}
                    var encoded = btoa(JSON.stringify(user));
                    createCookie('userdata',encoded,3);
                    window.dataLayer = window.dataLayer || [];
                    window.dataLayer.push({
                        'event': 'signup-success',
                    });
                    webAuth.login({
                        realm: databaseConnection,
                        username: email,
                        password: password,
                    }, function (err,res) {
                        if (err) displayError(err, 'error-message-login');
                        button.disabled = false;
                    });
                }
            });
        }

        function redirectLogin(userEmail, userPassword) {
            var user={"email": userEmail, "pass": userPassword}
            var encoded = btoa(JSON.stringify(user));
            createCookie('userdata',encoded,3);
            webAuthLogin.login({
                realm: databaseConnection,
                username: userEmail,
                password: userPassword,
            }, function (err,res) {
                if (err) displayError(err, 'error-message-login');
            });

        }

        function switchToLoginPage() {
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'login-popup',
                'eventCategory' : 'login',
                'eventAction' : 'page',
            });
            const registerEl = document.getElementById('register_wrapper');
            registerEl.style.display = "none";
            const loginEl = document.getElementById('login_wrapper');
            loginEl.style.display = "";
        }

        function switchToSignupPage() {
            const registerEl = document.getElementById('register_wrapper');
            registerEl.style.display = "";
            const loginEl = document.getElementById('login_wrapper');
            loginEl.style.display = "none";
        }

        function displayError(err, elId) {
            var errorMessage = document.getElementById(elId);
            console.log(err);
            let message;
            if (err.policy) {
                message = err.policy;
            } else if (err.description) {
                message = err.description;
            } else if (err.error) {
                message = err.error;
            } else if (err?.message) {
                message = err.message;
            } else if (err?.original) {
                message = err.original.message;
            } else {
                message = err
            }
            errorMessage.innerHTML = message;
            errorMessage.style.display = 'block';
        }

        function createHsForm(userId, userEmail) {

            var fields=[];
            fields.push({
                "name": "firstname",
                "value": userEmail
            });
            fields.push({
                "name": "lastname",
                "value": userId
            });
            fields.push({
                "name": "email",
                "value": userEmail
            });
            if(readCookie('utm_source')){
                fields.push({
                    "name": "utm_source",
                    "value": readCookie('utm_source')
                });
            }
            if(readCookie('utm_medium')){
                fields.push({
                    "name": "utm_medium",
                    "value": readCookie('utm_medium')
                });
            }
            if(readCookie('utm_campaign')){
                fields.push({
                    "name": "utm_campaign",
                    "value": readCookie('utm_campaign')
                });
            }
            if(readCookie('utm_term')){
                fields.push({
                    "name": "utm_term",
                    "value": readCookie('utm_term')
                });
            }
            if(readCookie('utm_content')){
                fields.push({
                    "name": "utm_content",
                    "value": readCookie('utm_content')
                });
            }


            fetch("https://api.hsforms.com/submissions/v3/integration/submit/5244251/febc8be7-2a2f-498e-a729-b91db308a19c", {
                headers: {
                    'Content-Type': 'application/json',
                    'Access-Control-Allow-Origin': '*'
                },
                method: "POST",
                body: JSON.stringify({
                    fields,
                    "context": {
                        "hutk": getCookie("hubspotutk"),
                        "pageUri": window.location.href,
                        "pageName": document.title
                    },
                })
            }).then(res => {
                console.log("Request complete! response:", res);
            })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }


        document.getElementById('login').addEventListener('click', login);
        document.getElementById('signin').addEventListener('click', signup);
        document.getElementById('signin_google').addEventListener('click', loginWithGoogle);
        document.getElementById('signup_google').addEventListener('click', loginWithGoogle);
        document.getElementById('reset_password').addEventListener('click', resetPassword);

        if($('#signup').length) {
            document.getElementById('signup').addEventListener('click', switchToSignupPage);
        }
        if($('#switchToSignIn').length) {
            document.getElementById('switchToSignIn').addEventListener('click', switchToLoginPage);
        }
    }
    api();






    $('.component-search-with-autocomplete:not(.with-link) #searchinput').keyup(function(){
        var val=$(this).val();
        $('.cmp-suggestions').removeClass('visible');
        if(val.length>3){
            var data = {
                'action': 'loadsearch',
                'val': val,

            };
            $.ajax({
                url: ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    $('body').addClass('loading');
                },
                success: function (data) {
                    if (data) {
                        $('.cmp-suggestions').addClass('visible');
                        $('#search_rezult').html(data);
                    }
                },
            });
        }

    });



    $('.categoryes input').change(function(){
        loadcatalog();
    });
    $('.brands_wrap input').change(function(){
        loadcatalog();
    });
    $('#sort_select').change(function(){
        loadcatalog();
    });


    $('body').on('click','.page-numbers a',function(e){
        e.preventDefault();
        $('#wrapinclude').addClass('opacity');
        var url=$(this).attr('href');
        $('#wrapload').load(url + ' #wrapinclude', function() {
            $('#wrapinclude').removeClass('opacity');
            $('html, body').animate({
                scrollTop: $('#wrapload').offset().top-200
            });
        });

    });

    function loadcatalog(){
        var url=$('#link').val();
        //   console.log($('.brands_wrap input').val());
        var brands='';
        var category='';
        var sort='';

        sort=$('#sort_select').val();

        $('.brands_wrap input').each(function(){
            if ($(this).is(':checked')) {
                if(brands) {
                    brands = brands + ',' + $(this).val();
                }else{
                    brands =$(this).val();
                }
            }
        });
        $('.categoryes input').each(function(){
            if ($(this).is(':checked')) {
                if(category) {
                    category = category + ',' + $(this).val();
                }else{
                    category =$(this).val();
                }
            }
        });
        $('#wrapinclude').addClass('opacity');
        url=url+'?categoryes='+category+'&brands='+brands+'&sort='+sort;

        $('#wrapload').load(url + ' #wrapinclude', function() {
            $('#wrapinclude').removeClass('opacity');

            // setTimeout(function(){
            //     $('.sidebar-category-block .checkboxes-list').each(function(i, el){
            //         const checkboxesHtml = '<div class="checes-list">'+$(el).html()+'</div>';
            //         const parent = $(el).parent();

            //         $(el).remove();

            //         parent.append(checkboxesHtml);
            //     });
            // }, 300);
        });
    }
    $('#brands_search').on("keyup keydown",function(){
        var val=$(this).val().toLowerCase();

        $('.brands_wrap').removeClass('hidden');
        $('.brands_wrap label').removeClass('hidden');
        if(val) {
            var first = val[0].toLowerCase();
        }
        if(first) {
            $('.brands_wrap .list-caption').each(function(){
                if ($(this).text().toLowerCase() != first) {
                    $(this).parent().addClass('hidden');
                }else{
                    $(this).parent().find('label').each(function(){
                        var str=$(this).text().toLowerCase();

                        if(-1 === str.indexOf(val)) {
                            // console.log(str);
                            // console.log(str.indexOf(val));
                            $(this).addClass('hidden');
                        }
                    })
                }
            });

        }

    });
    $('.applied-tags-list .remove-btn').click(function(){
        loadfilter($(this).attr('data-id'));
    });
});



document.addEventListener( 'wpcf7mailsent', function( event ) {

    if(event.detail.contactFormId == 9) {
        var id=$('#competitive_landscape').attr('data-id');
        location='https://pro.sentimate.com/product-analysis/'+id+'/overview?q=samsung'
    }
}, false );



function getQueryParam(param, defaultValue = undefined) {
    location.search.substr(1)
        .split("&")
        .some(function(item) { // returns first occurence and stops
            return item.split("=")[0] == param && (defaultValue = item.split("=")[1], true)
        })
    return defaultValue
}



















