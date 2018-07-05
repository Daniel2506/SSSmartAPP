/**
* Class ShowUserView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.ShowUserView = Backbone.View.extend({

        el: '#user-show',

        /**
        * Constructor Method
        */
        initialize : function() {
            // Model exist
            if( this.model.id != undefined ) {

                this.rolList = new app.RolList();

                // Reference views
                this.referenceViews();
            }
        },

        /**
        * reference to views
        */
        referenceViews: function () {
            // Rol list
            this.rolesListView = new app.RolesListView( {
                collection: this.rolList,
                parameters: {
                    edit: false,
                    wrapper: this.$('#wrapper-roles'),
                    dataFilter: {
                        'user': this.model.get('id')
                    }
               }
            });
        }
    });

})(jQuery, this, this.document);
