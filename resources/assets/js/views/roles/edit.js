/**
* Class EditRolView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.EditRolView = Backbone.View.extend({

        el: '#rol-create',
        template: _.template( ($('#add-rol-tpl').html() || '') ),
        events: {
            'submit #form-roles': 'onStore',
            'click .btn-set-permission': 'changePermissions'
        },
        parameters: {
        },

        /**
        * Constructor Method
        */
        initialize : function(opts) {
            // Initialize
            if( opts !== undefined && _.isObject(opts.parameters) )
                this.parameters = $.extend({}, this.parameters, opts.parameters);

            // Events
            this.listenTo( this.model, 'change', this.render );
            this.listenTo( this.model, 'sync', this.responseServer );
            this.listenTo( this.model, 'request', this.loadSpinner );
        },

        /*
        * Render View Element
        */
        render: function() {
            var attributes = this.model.toJSON();
                attributes.edit = true;
            this.$el.html( this.template(attributes) );

            this.spinner = this.$('#spinner-main');

            this.referencesView();

        },

        /**
        * Reference view checks
        */
        referencesView: function(){
            this.collection = new app.PermisosRolList();
            this.stufView = new app.PermisosRolListView({
                el: '#permissions-browser',
                collection: this.collection,
                parameters: {
                    permissions: this.model.get('permissions'),
                    dataFilter: {
                        'role_id': this.model.get('id'),
                        'nivel1': 0,
                        'nivel2': 0
                    }
                }
            });
        },

        /**
        * Event Create Folder
        */
        onStore: function (e) {
            if (!e.isDefaultPrevented()) {

                e.preventDefault();
                var data = window.Misc.formToJson( e.target );
                this.model.save( data, {patch: true, silent: true} );
            }
        },

        changePermissions: function(e) {
            e.preventDefault();
            var resource = $(e.currentTarget).attr("data-resource"),
                model = this.collection.get(resource),
                _this = this;

            if ( this.createPermisoRolView instanceof Backbone.View ){
                this.createPermisoRolView.stopListening();
                this.createPermisoRolView.undelegateEvents();
            }

            this.createPermisoRolView = new app.CreatePermisoRolView({
                model: model,
                collection: _this.collection,
                parameters: {
                    permissions: this.model.get('permissions'),
                    dataFilter: {
                        'role_id': this.model.get('id'),
                        'nivel1': model.get('nivel1'),
                        'nivel2': model.get('nivel2')
                    }
                }
            });
            this.createPermisoRolView.render();
        },

        /**
        * Load spinner on the request
        */
        loadSpinner: function (model, xhr, opts) {
            window.Misc.setSpinner( this.spinner );
        },

        /**
        * response of the server
        */
        responseServer: function ( model, resp, opts ) {
            window.Misc.removeSpinner( this.spinner );

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

                // Redirect to edit rol
                window.Misc.redirect( window.Misc.urlFull( Route.route('roles.edit', { roles: resp.id}) ) );
            }
        }
    });

})(jQuery, this, this.document);
