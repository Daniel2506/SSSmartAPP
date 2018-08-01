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

            // Dashboard
            '(/)': 'getDashboard',

            // Roles
            'roles(/)': 'getRolesMain',
            'roles/create(/)': 'getRolesCreate',
            'roles/:rol/edit(/)': 'getRolesEdit',

            // Users
            'usuarios(/)': 'getUsersMain',
            'usuarios/create(/)': 'getUserCreate',
            'usuarios/:ususarios(/)': 'getUserShow',
            'usuarios/:usuarios/edit(/)': 'getUserEdit',

            // Machines
            'maquinas(/)': 'getMachinesMain',
            'maquinas/create(/)': 'getMachineCreate',
            'maquinas/:maquinas/edit(/)': 'getMachineEdit',

            // Bills
            'facturas(/)': 'getBillsMain',

            // Binnacles
            'bitacoras(/)': 'getBinnaclesMain',

            // Coins
            'monedas(/)': 'getCoinsMain',

            // Finalizados
            'finalizados(/)': 'getFinishedMain',
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
            this.componentGlobalView = new app.ComponentGlobalView();
            this.componentReportView = new app.ComponentReportView();
      	},

        /**
        * Start Backbone history
        */
        start: function () {
            var config = { pushState: true };

            if( document.domain.search(/(104.236.57.82|localhost)/gi) != '-1' ) {
                config.root = '/SSSmartAPP/public/';
            }

            Backbone.history.start( config );
        },

        /**
        * show view in Dashboard Event
        */
        getDashboard: function () {

            if ( this.dashboardView instanceof Backbone.View ){
                this.dashboardView.stopListening();
                this.dashboardView.undelegateEvents();
            }

            this.dashboardView = new app.DashboardView( );
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
        /**
        * show view main roles
        */
        getRolesMain: function () {

            if ( this.mainRolesView instanceof Backbone.View ){
                this.mainRolesView.stopListening();
                this.mainRolesView.undelegateEvents();
            }

            this.mainRolesView = new app.MainRolesView( );
        },

        /**
        * show view create roles
        */
        getRolesCreate: function () {
            this.rolModel = new app.RolModel();

            if ( this.createRolView instanceof Backbone.View ){
                this.createRolView.stopListening();
                this.createRolView.undelegateEvents();
            }

            this.createRolView = new app.CreateRolView({ model: this.rolModel });
            this.createRolView.render();
        },

        /**
        * show view edit roles
        */
        getRolesEdit: function (rol) {
            this.rolModel = new app.RolModel();
            this.rolModel.set({'id': rol}, {silent: true});

            if ( this.editRolView instanceof Backbone.View ){
                this.editRolView.stopListening();
                this.editRolView.undelegateEvents();
            }

            if ( this.createRolView instanceof Backbone.View ){
                this.createRolView.stopListening();
                this.createRolView.undelegateEvents();
            }

            this.editRolView = new app.EditRolView({ model: this.rolModel });
            this.rolModel.fetch();
        },
        /**
        * show view main users
        */
        getUsersMain: function () {

            if ( this.mainUsersView instanceof Backbone.View ){
                this.mainUsersView.stopListening();
                this.mainUsersView.undelegateEvents();
            }

            this.mainUsersView = new app.MainUsersView( );
        },
        /**
        * show view create users
        */
        getUserCreate: function () {
            this.userModel = new app.UserModel();

            if ( this.createUserView instanceof Backbone.View ){
                this.createUserView.stopListening();
                this.createUserView.undelegateEvents();
            }

            this.createUserView = new app.CreateUserView({ model: this.userModel });
            this.createUserView.render();
        },
        /**
        * show view show user
        */
        getUserShow: function (user) {
            this.userModel = new app.UserModel();
            this.userModel.set({'id': user}, {'silent':true});

            if ( this.showUserView instanceof Backbone.View ){
                this.showUserView.stopListening();
                this.showUserView.undelegateEvents();
            }

            this.showUserView = new app.ShowUserView({ model: this.userModel });
        },
        /**
        * show view edit users
        */
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
        /**
        * show view main machine
        */
        getMachinesMain: function(){
            if ( this.mainMachinesView instanceof Backbone.View ){
                this.mainMachinesView.stopListening();
                this.mainMachinesView.undelegateEvents();
            }

            this.mainMachinesView = new app.MainMachinesView( );
        },
        /**
        * show view create machine
        */
        getMachineCreate: function () {
            this.machineModel = new app.MachineModel();

            if ( this.createMachineView instanceof Backbone.View ){
                this.createMachineView.stopListening();
                this.createMachineView.undelegateEvents();
            }

            this.createMachineView = new app.CreateMachineView({ model: this.machineModel });
            this.createMachineView.render();
        },
        /**
        * show view edit machine
        */
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
        /**
        * show view main bills
        */
        getBillsMain: function(){
            if ( this.mainBillsView instanceof Backbone.View ){
                this.mainBillsView.stopListening();
                this.mainBillsView.undelegateEvents();
            }

            this.mainBillsView = new app.MainBillsView( );
        },
        /**
        * show view binnacles
        */
        getBinnaclesMain: function(){
            if ( this.mainBinnaclesView instanceof Backbone.View ){
                this.mainBinnaclesView.stopListening();
                this.mainBinnaclesView.undelegateEvents();
            }

            this.mainBinnaclesView = new app.MainBinnaclesView( );
        },
        /**
        * show view coins
        */
        getCoinsMain: function(){
            if ( this.mainCoinsView instanceof Backbone.View ){
                this.mainCoinsView.stopListening();
                this.mainCoinsView.undelegateEvents();
            }

            this.mainCoinsView = new app.MainCoinsView( );
        },
        /**
        * show view finished
        */
        getFinishedMain: function(){
            if ( this.mainFinishedView instanceof Backbone.View ){
                this.mainFinishedView.stopListening();
                this.mainFinishedView.undelegateEvents();
            }

            this.mainFinishedView = new app.MainFinishedView( );
        }

    }));
})(jQuery, this, this.document);
