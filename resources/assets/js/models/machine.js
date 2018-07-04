/**
* Class MachineModel extend of Backbone Model
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function (window, document, undefined) {

    app.MachineModel = Backbone.Model.extend({

        urlRoot: function () {
            return window.Misc.urlFull( Route.route('maquinas.index') );
        },
        idAttribute: 'id',
        defaults: {
            'maquina_serie': '',
            'maquina_ubicacion': '',
            'maquina_casillas': 0,
            'maquina_contacto': '',
            'maquina_telefono': '',
            'maquina_direccion': '',
            'maquina_email': '',
            'maquina_documentos': '',
            'maquina_servidor': '',
            'maquina_usuario': '',
            'maquina_contraseña': '',
            'maquina_directorio': '',
            'maquina_ultima': ''
        }
    });

})(this, this.document);
