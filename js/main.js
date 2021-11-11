$(function () {





    var utm_source = getUrlParameter('utm_source');
    var utm_medium = getUrlParameter('utm_medium');
    var utm_campaign = getUrlParameter('utm_campaign');
    var utm_term = getUrlParameter('utm_term');
    var utm_content = getUrlParameter('utm_content');
    var hubspotutk = getUrlParameter('hubspotutk');
    var input = getUrlParameter('input');
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
    if(input || input==0 ){
        createCookie('input',input,3);
    }

    if(!readCookie('input')) {
        var url = 'https://pro-staging.sentimate.com/category-analysis/search';
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
    if(readCookie('hubspotutk')){
        utm['hubspotutk']=readCookie('hubspotutk');
    }

    var params='';
    for (const [key, value] of Object.entries(utm)) {
        if(params){
            params=params+'&'+key+'='+value;
        }else{
            params='?'+key+'='+value;
        }

    }
    url=url+params;
    console.log(url);
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




    window.addEventListener('load', function () {
        const DEFAULT_THEME = 'light';
        let activeTheme = DEFAULT_THEME;
        initTheme();
        initKeyboardShortcuts();

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

        var config = JSON.parse(
            decodeURIComponent(escape(window.atob('eyJhc3NldHNVcmwiOiIiLCJhdXRoMERvbWFpbiI6InJldnV6ZS1zdGFnaW5nLnVzLmF1dGgwLmNvbSIsImF1dGgwVGVuYW50IjoicmV2dXplLXN0YWdpbmciLCJjbGllbnRDb25maWd1cmF0aW9uQmFzZVVybCI6Imh0dHBzOi8vcmV2dXplLXN0YWdpbmcudXMuYXV0aDAuY29tLyIsImNhbGxiYWNrT25Mb2NhdGlvbkhhc2giOmZhbHNlLCJjYWxsYmFja1VSTCI6Imh0dHBzOi8vcHJvLXN0YWdpbmcuc2VudGltYXRlLmNvbSIsImNkbiI6Imh0dHBzOi8vY2RuLmF1dGgwLmNvbS8iLCJjbGllbnRJRCI6Ijg1SVZrUGNzOWRVb1BDdDFTdlRBN29acUJ5RVprWHU4IiwiZGljdCI6eyJzaWduaW4iOnsidGl0bGUiOiJTZW50aW1hdGUifX0sImV4dHJhUGFyYW1zIjp7InByb3RvY29sIjoib2F1dGgyIiwiYXVkaWVuY2UiOiJodHRwczovL3JldnV6ZS1zdGFnaW5nLnVzLmF1dGgwLmNvbS9hcGkvdjIvIiwic2NvcGUiOiJvcGVuaWQgcHJvZmlsZSBlbWFpbCIsInJlc3BvbnNlX3R5cGUiOiJjb2RlIiwicmVzcG9uc2VfbW9kZSI6InF1ZXJ5Iiwibm9uY2UiOiJRVTVtTUU0MFVqUmFjbmwrZW5OWlMxQjFSblY0VDA5MGVFdGtmbk4wZDFwQk4wTkZRMWhwV1Vsa1RRPT0iLCJjb2RlX2NoYWxsZW5nZSI6Ik1IOTJkemZVYV9IRlZuYTRpLURXVGtteHJGQkR6NnJPV0MwdDlPT0lua0EiLCJjb2RlX2NoYWxsZW5nZV9tZXRob2QiOiJTMjU2IiwiYXV0aDBDbGllbnQiOiJleUp1WVcxbElqb2lRR0YxZEdnd0wyRjFkR2d3TFdGdVozVnNZWElpTENKMlpYSnphVzl1SWpvaU1TNHpMakVpZlE9PSIsIl9jc3JmIjoiQ0ltVndmck0tUVQ2aWFONF81OW14RVlDRjhGX3VkTGF3OU5RIiwiX2ludHN0YXRlIjoiZGVwcmVjYXRlZCIsInN0YXRlIjoiaEtGbzJTQndOelV4UWtkQ1lsTXRlbFkyWjFWTGNWUlFhVUZNWjJ4WU9GWklSMHBrTnFGdXBXeHZaMmx1bzNScFpOa2dYME0xZUhoeFprbGFjRzVrVWtReWVVSlpTSEpFZDNOWkxVOVBjV1ZZVEVlalkybGsyU0E0TlVsV2ExQmpjemxrVlc5UVEzUXhVM1pVUVRkdlduRkNlVVZhYTFoMU9BIn0sImludGVybmFsT3B0aW9ucyI6eyJwcm90b2NvbCI6Im9hdXRoMiIsImF1ZGllbmNlIjoiaHR0cHM6Ly9yZXZ1emUtc3RhZ2luZy51cy5hdXRoMC5jb20vYXBpL3YyLyIsInNjb3BlIjoib3BlbmlkIHByb2ZpbGUgZW1haWwiLCJyZXNwb25zZV90eXBlIjoiY29kZSIsInJlc3BvbnNlX21vZGUiOiJxdWVyeSIsIm5vbmNlIjoiUVU1bU1FNDBValJhY25sK2VuTlpTMUIxUm5WNFQwOTBlRXRrZm5OMGQxcEJOME5GUTFocFdVbGtUUT09IiwiY29kZV9jaGFsbGVuZ2UiOiJNSDkyZHpmVWFfSEZWbmE0aS1EV1RrbXhyRkJEejZyT1dDMHQ5T09JbmtBIiwiY29kZV9jaGFsbGVuZ2VfbWV0aG9kIjoiUzI1NiIsImF1dGgwQ2xpZW50IjoiZXlKdVlXMWxJam9pUUdGMWRHZ3dMMkYxZEdnd0xXRnVaM1ZzWVhJaUxDSjJaWEp6YVc5dUlqb2lNUzR6TGpFaWZRPT0iLCJfY3NyZiI6IkNJbVZ3ZnJNLVFUNmlhTjRfNTlteEVZQ0Y4Rl91ZExhdzlOUSIsIl9pbnRzdGF0ZSI6ImRlcHJlY2F0ZWQiLCJzdGF0ZSI6ImhLRm8yU0J3TnpVeFFrZENZbE10ZWxZMloxVkxjVlJRYVVGTVoyeFlPRlpJUjBwa05xRnVwV3h2WjJsdW8zUnBaTmtnWDBNMWVIaHhaa2xhY0c1a1VrUXllVUpaU0hKRWQzTlpMVTlQY1dWWVRFZWpZMmxrMlNBNE5VbFdhMUJqY3psa1ZXOVFRM1F4VTNaVVFUZHZXbkZDZVVWYWExaDFPQSJ9LCJ3aWRnZXRVcmwiOiJodHRwczovL2Nkbi5hdXRoMC5jb20vdzIvYXV0aDAtd2lkZ2V0LTUuMS5taW4uanMiLCJpc1RoaXJkUGFydHlDbGllbnQiOmZhbHNlLCJhdXRob3JpemF0aW9uU2VydmVyIjp7InVybCI6Imh0dHBzOi8vcmV2dXplLXN0YWdpbmcudXMuYXV0aDAuY29tIiwiaXNzdWVyIjoiaHR0cHM6Ly9yZXZ1emUtc3RhZ2luZy51cy5hdXRoMC5jb20vIn0sImNvbG9ycyI6e319')))
        )

        var leeway = config.internalOptions.leeway;
        if (leeway) {
            var convertedLeeway = parseInt(leeway);

            if (!isNaN(convertedLeeway)) {
                config.internalOptions.leeway = convertedLeeway;
            }
        }

        var webAuth = new auth0.WebAuth(
            {
                overrides: {
                    __tenant: "revuze-staging",
                    __token_issuer: "https://auth-staging.sentimate.com/"
                },
                domain: "auth-staging.sentimate.com",
                clientID: "85IVkPcs9dUoPCt1SvTA7oZqByEZkXu8",
                redirectUri: 'https://pro-staging.sentimate.com?redirect='+url,
                responseType: "code"
            }
        );



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
            button.disabled = true;
            webAuth.login({
                realm: databaseConnection,
                username: username,
                password: password,
            }, function (err) {
                if (err) displayError(err, 'error-message-login');
                button.disabled = false;
            });
        }

        var user = {};




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

        function switchToLoginPage() {
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

        function loginWithGoogle() {
            webAuth.authorize({
                connection: 'google-oauth2',
                user_metadata: {
                    hsForm: {
                        utm_source: readCookie('utm_source'),
                        utm_medium: readCookie('utm_medium'),
                        utm_campaign: readCookie('utm_campaign'),
                        utm_term: readCookie('utm_term'),
                        utm_content: readCookie('utm_content'),
                        hutk: readCookie('hubspotutk'),
                        pageUri: window.location.href,
                        pageName: document.title
                    }
                }
            }, function (err, res) {
                if (err) displayError(err, 'error-message-signin');
                if (res) console.log(res);
            });
        }




        function displayError(err, elId) {
            var errorMessage = document.getElementById(elId);
         //   console.log(err);
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

        document.getElementById('signup').addEventListener('click', switchToSignupPage);
        document.getElementById('switchToSignIn').addEventListener('click', switchToLoginPage);
        document.getElementById('login').addEventListener('click', login);
        document.getElementById('signin').addEventListener('click', signup);
        document.getElementById('signin_google').addEventListener('click', loginWithGoogle);
        document.getElementById('signup_google').addEventListener('click', loginWithGoogle);
        document.getElementById('reset_password').addEventListener('click', resetPassword);
    });























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

    $('.component-search-with-autocomplete.with-link').each(function(i, el){
        const input = $(el).find('#searchinput');
        const link = $(el).find('a.btn');
        const form = $(el).find('form');

        input.keyup(function(e){
            link.attr('href', 'https://pro.sentimate.com/product-analysis/search-results?q=' + encodeURIComponent(input.val()));

            if (e.key == "Enter") {
                window.location.href = 'https://pro.sentimate.com/product-analysis/search-results?q=' + encodeURIComponent(input.val());
            }
        });

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
            //         const checkboxesHtml = '<div class="checkboxes-list">'+$(el).html()+'</div>';
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


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};





































