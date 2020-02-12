(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://elementalfusion.online',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/clear","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@clear"},{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/config","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@config"},{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/status","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@status"},{"host":null,"methods":["GET","HEAD"],"uri":"opcache-api\/compile","name":null,"action":"Appstract\Opcache\Http\Controllers\OpcacheController@compile"},{"host":null,"methods":["POST"],"uri":"impersonate-ui","name":"impersonate-ui.take","action":"Hapidjus\ImpersonateUI\Controllers\ImpersonateUiController@take"},{"host":null,"methods":["GET","HEAD"],"uri":"impersonate-ui","name":"impersonate-ui.leave","action":"Hapidjus\ImpersonateUI\Controllers\ImpersonateUiController@leave"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/telescope\/{id}","name":"debugbar.telescope","action":"Barryvdh\Debugbar\Controllers\TelescopeController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"},{"host":null,"methods":["DELETE"],"uri":"_debugbar\/cache\/{key}\/{tags?}","name":"debugbar.cache.delete","action":"Barryvdh\Debugbar\Controllers\CacheController@delete"},{"host":null,"methods":["POST"],"uri":"mailbox\/mailgun\/mime","name":null,"action":"BeyondCode\Mailbox\Http\Controllers\MailgunController"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/documentation","name":"l5-swagger.api","action":"\L5Swagger\Http\Controllers\SwaggerController@api"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE","OPTIONS"],"uri":"docs\/{jsonFile?}","name":"l5-swagger.docs","action":"\L5Swagger\Http\Controllers\SwaggerController@docs"},{"host":null,"methods":["GET","HEAD"],"uri":"docs\/asset\/{asset}","name":"l5-swagger.asset","action":"\L5Swagger\Http\Controllers\SwaggerAssetController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/oauth2-callback","name":"l5-swagger.oauth2_callback","action":"\L5Swagger\Http\Controllers\SwaggerController@oauth2Callback"},{"host":null,"methods":["GET","HEAD"],"uri":"stripe\/payment\/{id}","name":"cashier.payment","action":"Laravel\Cashier\Http\Controllers\PaymentController@show"},{"host":null,"methods":["POST"],"uri":"stripe\/webhook","name":"cashier.webhook","action":"Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/login\/{userId}\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/logout\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"_dusk\/user\/{guard?}","name":null,"action":"Laravel\Dusk\Http\Controllers\UserController@user"},{"host":null,"methods":["GET","HEAD"],"uri":"livewire\/livewire.js","name":null,"action":"Livewire\LivewireJavaScriptAssets@source"},{"host":null,"methods":["GET","HEAD"],"uri":"livewire\/livewire.js.map","name":null,"action":"Livewire\LivewireJavaScriptAssets@maps"},{"host":null,"methods":["POST"],"uri":"livewire\/message\/{name}","name":null,"action":"Livewire\Connection\HttpConnectionHandler"},{"host":null,"methods":["GET","HEAD"],"uri":"pipe-dream","name":null,"action":"\PipeDream\Laravel\Controllers\PipeDreamWebController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"pipe-dream\/test","name":null,"action":"Closure"},{"host":null,"methods":["POST"],"uri":"pipe-dream\/api\/build","name":null,"action":"\PipeDream\Laravel\Controllers\PipeDreamAPIController@build"},{"host":null,"methods":["GET","HEAD"],"uri":"pipe-dream\/api\/scripts","name":null,"action":"\PipeDream\Laravel\Controllers\PipeDreamAPIController@scripts"},{"host":null,"methods":["GET","HEAD"],"uri":"pipe-dream\/api\/templates","name":null,"action":"\PipeDream\Laravel\Controllers\PipeDreamAPIController@templates"},{"host":null,"methods":["GET","HEAD"],"uri":"tinker","name":null,"action":"Spatie\WebTinker\Http\Controllers\WebTinkerController@index"},{"host":null,"methods":["POST"],"uri":"tinker","name":null,"action":"Spatie\WebTinker\Http\Controllers\WebTinkerController@execute"},{"host":null,"methods":["GET","HEAD"],"uri":"api","name":null,"action":"Closure"},{"host":null,"methods":["POST"],"uri":"api\/stripe\/webhook","name":null,"action":"\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user\/invoice\/{invoice}","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/{fallbackPlaceholder}","name":"api.fallback.404","action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/upload","name":"upload.index","action":"App\Http\Controllers\API\V1\UploadController@index"},{"host":null,"methods":["POST"],"uri":"api\/v1\/upload","name":"upload.store","action":"App\Http\Controllers\API\V1\UploadController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/v1\/upload\/{upload}","name":"upload.show","action":"App\Http\Controllers\API\V1\UploadController@show"},{"host":null,"methods":["DELETE"],"uri":"api\/v1\/upload\/{upload}","name":"upload.destroy","action":"App\Http\Controllers\API\V1\UploadController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":null,"action":"\Illuminate\Routing\ViewController"},{"host":null,"methods":["POST"],"uri":"devices","name":null,"action":"williamcruzme\FCM\Http\Controllers\DeviceController@store"},{"host":null,"methods":["DELETE"],"uri":"devices","name":null,"action":"williamcruzme\FCM\Http\Controllers\DeviceController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["POST"],"uri":"login\/attempt","name":"login.attempt","action":"App\Http\Controllers\Auth\LoginController@attempt"},{"host":null,"methods":["GET","HEAD"],"uri":"login\/{token}\/validate","name":"login.token.validate","action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"login\/locked","name":"login.locked","action":"App\Http\Controllers\Auth\LoginController@locked"},{"host":null,"methods":["POST"],"uri":"login\/locked","name":"login.unlock","action":"App\Http\Controllers\Auth\LoginController@unlock"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"Closure"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":"password.update","action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/confirm","name":"password.confirm","action":"App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm"},{"host":null,"methods":["POST"],"uri":"password\/confirm","name":null,"action":"App\Http\Controllers\Auth\ConfirmPasswordController@confirm"},{"host":null,"methods":["GET","HEAD"],"uri":"email\/verify","name":"verification.notice","action":"App\Http\Controllers\Auth\VerificationController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"email\/verify\/{id}\/{hash}","name":"verification.verify","action":"App\Http\Controllers\Auth\VerificationController@verify"},{"host":null,"methods":["POST"],"uri":"email\/resend","name":"verification.resend","action":"App\Http\Controllers\Auth\VerificationController@resend"},{"host":null,"methods":["GET","HEAD"],"uri":"auth0\/callback","name":"auth0-callback","action":"\Auth0\Login\Auth0Controller@callback"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard","name":"home","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dashboard\/logs","name":"logs","action":"App\Http\Controllers\LogController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"partials","name":null,"action":"Closure"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // routes.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // routes.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // routes.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // routes.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // routes.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // routes.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.routes = laroute;
    }

}).call(this);

