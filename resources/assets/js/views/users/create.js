/**
* Class CreateUserView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.CreateUserView = Backbone.View.extend({

        el: '#user-create',
        template: _.template( ($('#add-user-tpl').html() || '') ),
        events: {
            'submit #form-user': 'onStore',
            'submit #form-item-roles': 'onStoreRol'
        },

        /**
        * Constructor Method
        */
        initialize : function() {
            // Attributes
            this.$wraperForm = this.$('#render-form-user');

            // Events
            this.listenTo( this.model, 'change', this.render );
            this.listenTo( this.model, 'sync', this.responseServer );
            this.listenTo( this.model, 'request', this.loadSpinner );
        },

        /**
        * Reference to views
        */
        referenceViews: function () {
            // Rol list
            this.rolesListView = new app.RolesListView( {
                collection: this.rolList,
                parameters: {
                    edit: true,
                    wrapper: this.$('#wrapper-roles'),
                    dataFilter: {
                        'user': this.model.get('id')
                    }
               }
            });
        },
        /**
        * Event Create User
        */
        onStore: function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                var data = window.Misc.formToJson( e.target );
                this.model.save( data, {patch: true, silent: true} );
            }
        },
        /**
        * Event add item rol
        */
        onStoreRol: function (e) {
            if (!e.isDefaultPrevented()) {
                e.preventDefault();

                // Prepare global data
                var data = window.Misc.formToJson( e.target );
                this.rolList.trigger( 'store', data );
            }
        },
        /*
        * Render View Element
        */
        render: function() {

            var attributes = this.model.toJSON();
            this.$wraperForm.html( this.template(attributes) );
            this.$password = this.$('#password');
            this.$password_confirmation = this.$('#password_confirmation');

            if( this.model.id != undefined ) {
                this.rolList = new app.RolList();
                this.referenceViews();
            }
            this.ready();
        },

        /**
        * Fires libraries js
        */
        ready: function () {
            // to fire plugins
            if( typeof window.initComponent.initValidator == 'function' )
                window.initComponent.initValidator();

            if( typeof window.initComponent.initToUpper == 'function' )
                window.initComponent.initToUpper();

            if( typeof window.initComponent.initSpinner == 'function' )
                window.initComponent.initSpinner();

            if( typeof window.initComponent.initSelect2 == 'function' )
                window.initComponent.initSelect2();
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function (model, xhr, opts) {
            window.Misc.setSpinner( this.el );
        },

        /**
        * Response of the server
        */
        responseServer: function ( model, resp, opts ) {
            window.Misc.removeSpinner( this.el );

            if(!_.isUndefined(resp.success)) {
                // response success or error
                var text = resp.success ? '' : resp.errors;
                if( _.isObject( resp.errors ) ) {
                    text = window.Misc.parseErrors(resp.errors);
                }

                if( !resp.success ) {
                    alertify.error(text);
                    return;
                }
                this.$password.val('');
                this.$password_confirmation.val('');

                Backbone.history.navigate(Route.route('usuarios.edit', { usuarios: resp.id}), { trigger:true });
            }
        }
    });
})(jQuery, this, this.document);
