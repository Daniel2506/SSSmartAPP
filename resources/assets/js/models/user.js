/**
* Class UserModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.UserModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('usuarios.index') );
        },
        idAttribute: 'id',
        defaults: {
            'user_name': '',
            'user_lastname': '',
            'user_address': '',
            'user_email': '',
            'user_telephone': '',
            'username': '',
            'password': ''
        }
    });

})(this, this.document);
