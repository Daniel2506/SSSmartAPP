/**
* Class AppRouter  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.AppRouter = new( Backbone.Router.extend({
        routes : {
            //Login
            'login(/)': 'getLogin',

            /*
            |-----------------------
            | Administracion
            |-----------------------
            */

            // Users
            'usuarios(/)': 'getUsersMain',
            'usuarios/create(/)': 'getUserCreate',
            'usuarios/:usuarios/edit(/)': 'getUserEdit',

            // Machines
            'maquinas(/)': 'getMachinesMain',
            'maquinas/create(/)': 'getMachineCreate',
            'maquinas/:maquinas/edit(/)': 'getMachineEdit',

            // Bills
            'facturas(/)': 'getBillsMain',

            // Binnacles
            'bitacoras(/)': 'getBinnaclesMain',
        },

        /**
        * Parse queryString to object
        */
        parseQueryString : function(queryString) {
            var params = {};
            if(queryString) {
                _.each(
                    _.map(decodeURI(queryString).split(/&/g),function(el,i){
                        var aux = el.split('='), o = {};
                        if(aux.length >= 1){
                            var val = undefined;
                            if(aux.length == 2)
                                val = aux[1];
                            o[aux[0]] = val;
                        }
                        return o;
                    }),
                    function(o){
                        _.extend(params,o);
                    }
                );
            }
            return params;
        },

        /**
        * Constructor Method
        */
        initialize : function ( opts ){
            // Initialize resources
      	},

        /**
        * Start Backbone history
        */
        start: function () {
            var config = { pushState: true };

            if( document.domain.search(/(104.236.57.82|localhost)/gi) != '-1' ) {
                config.root = '/SSSmart/public/';
            }

            Backbone.history.start( config );
        },

        /**
        * show view in Login Event
        */
        getLogin: function () {

            if ( this.loginView instanceof Backbone.View ){
                this.loginView.stopListening();
                this.loginView.undelegateEvents();
            }

            this.loginView = new app.UserLoginView( );
        },

        getUsersMain: function () {

            if ( this.mainUsersView instanceof Backbone.View ){
                this.mainUsersView.stopListening();
                this.mainUsersView.undelegateEvents();
            }

            this.mainUsersView = new app.MainUsersView( );
        },

        getUserCreate: function () {
            this.userModel = new app.UserModel();

            if ( this.createUserView instanceof Backbone.View ){
                this.createUserView.stopListening();
                this.createUserView.undelegateEvents();
            }

            this.createUserView = new app.CreateUserView({ model: this.userModel });
            this.createUserView.render();
        },

        getUserEdit: function (user) {
            this.userModel = new app.UserModel();
            this.userModel.set({'id': user}, {'silent':true});

            if ( this.createUserView instanceof Backbone.View ){
                this.createUserView.stopListening();
                this.createUserView.undelegateEvents();
            }

            this.createUserView = new app.CreateUserView({ model: this.userModel });
            this.userModel.fetch();
        },

        getMachinesMain: function(){
            if ( this.mainMachinesView instanceof Backbone.View ){
                this.mainMachinesView.stopListening();
                this.mainMachinesView.undelegateEvents();
            }

            this.mainMachinesView = new app.MainMachinesView( );
        },

        getMachineCreate: function () {
            this.machineModel = new app.MachineModel();

            if ( this.createMachineView instanceof Backbone.View ){
                this.createMachineView.stopListening();
                this.createMachineView.undelegateEvents();
            }

            this.createMachineView = new app.CreateMachineView({ model: this.machineModel });
            this.createMachineView.render();
        },

        getMachineEdit: function (machine) {
            this.machineModel = new app.MachineModel();
            this.machineModel.set({'id': machine}, {'silent':true});

            if ( this.createMachineView instanceof Backbone.View ){
                this.createMachineView.stopListening();
                this.createMachineView.undelegateEvents();
            }

            this.createMachineView = new app.CreateMachineView({ model: this.machineModel });
            this.machineModel.fetch();
        },

        getBillsMain: function(){
            if ( this.mainBillsView instanceof Backbone.View ){
                this.mainBillsView.stopListening();
                this.mainBillsView.undelegateEvents();
            }

            this.mainBillsView = new app.MainBillsView( );
        },

        getBinnaclesMain: function(){
            if ( this.mainBinnaclesView instanceof Backbone.View ){
                this.mainBinnaclesView.stopListening();
                this.mainBinnaclesView.undelegateEvents();
            }

            this.mainBinnaclesView = new app.MainBinnaclesView( );
        }

    }));
})(jQuery, this, this.document);
