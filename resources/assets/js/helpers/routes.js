(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["POST"],"uri":"auth\/login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/logout","name":"auth.logout","action":"App\Http\Controllers\Auth\AuthController@getLogout"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/integrate","name":"auth.integrate","action":"App\Http\Controllers\Auth\AuthController@integrate"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"dashboard","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"usuarios","name":"usuarios.index","action":"App\Http\Controllers\Admin\UserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"usuarios\/create","name":"usuarios.create","action":"App\Http\Controllers\Admin\UserController@create"},{"host":null,"methods":["POST"],"uri":"usuarios","name":"usuarios.store","action":"App\Http\Controllers\Admin\UserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"usuarios\/{usuarios}","name":"usuarios.show","action":"App\Http\Controllers\Admin\UserController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"usuarios\/{usuarios}\/edit","name":"usuarios.edit","action":"App\Http\Controllers\Admin\UserController@edit"},{"host":null,"methods":["PUT"],"uri":"usuarios\/{usuarios}","name":"usuarios.update","action":"App\Http\Controllers\Admin\UserController@update"},{"host":null,"methods":["PATCH"],"uri":"usuarios\/{usuarios}","name":null,"action":"App\Http\Controllers\Admin\UserController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"maquinas","name":"maquinas.index","action":"App\Http\Controllers\Admin\MaquinaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"maquinas\/create","name":"maquinas.create","action":"App\Http\Controllers\Admin\MaquinaController@create"},{"host":null,"methods":["POST"],"uri":"maquinas","name":"maquinas.store","action":"App\Http\Controllers\Admin\MaquinaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"maquinas\/{maquinas}","name":"maquinas.show","action":"App\Http\Controllers\Admin\MaquinaController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"maquinas\/{maquinas}\/edit","name":"maquinas.edit","action":"App\Http\Controllers\Admin\MaquinaController@edit"},{"host":null,"methods":["PUT"],"uri":"maquinas\/{maquinas}","name":"maquinas.update","action":"App\Http\Controllers\Admin\MaquinaController@update"},{"host":null,"methods":["PATCH"],"uri":"maquinas\/{maquinas}","name":null,"action":"App\Http\Controllers\Admin\MaquinaController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"bitacoras","name":"bitacoras.index","action":"App\Http\Controllers\Admin\BitacoraController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"bitacoras\/create","name":"bitacoras.create","action":"App\Http\Controllers\Admin\BitacoraController@create"},{"host":null,"methods":["POST"],"uri":"bitacoras","name":"bitacoras.store","action":"App\Http\Controllers\Admin\BitacoraController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"bitacoras\/{bitacoras}","name":"bitacoras.show","action":"App\Http\Controllers\Admin\BitacoraController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"bitacoras\/{bitacoras}\/edit","name":"bitacoras.edit","action":"App\Http\Controllers\Admin\BitacoraController@edit"},{"host":null,"methods":["PUT"],"uri":"bitacoras\/{bitacoras}","name":"bitacoras.update","action":"App\Http\Controllers\Admin\BitacoraController@update"},{"host":null,"methods":["PATCH"],"uri":"bitacoras\/{bitacoras}","name":null,"action":"App\Http\Controllers\Admin\BitacoraController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"facturas","name":"facturas.index","action":"App\Http\Controllers\Admin\FacturaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"facturas\/create","name":"facturas.create","action":"App\Http\Controllers\Admin\FacturaController@create"},{"host":null,"methods":["POST"],"uri":"facturas","name":"facturas.store","action":"App\Http\Controllers\Admin\FacturaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"facturas\/{facturas}","name":"facturas.show","action":"App\Http\Controllers\Admin\FacturaController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"facturas\/{facturas}\/edit","name":"facturas.edit","action":"App\Http\Controllers\Admin\FacturaController@edit"},{"host":null,"methods":["PUT"],"uri":"facturas\/{facturas}","name":"facturas.update","action":"App\Http\Controllers\Admin\FacturaController@update"},{"host":null,"methods":["PATCH"],"uri":"facturas\/{facturas}","name":null,"action":"App\Http\Controllers\Admin\FacturaController@update"}],
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
            // Route.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // Route.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // Route.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // Route.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // Route.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // Route.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
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
        window.Route = laroute;
    }

}).call(this);

