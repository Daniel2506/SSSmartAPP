/**
* Class MainBinnaclesView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainBinnaclesView = Backbone.View.extend({

        el: '#binnacles-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$binnaclesSearchTable = this.$('#binnacles-search-table');
            this.$binnaclesSearchTable.DataTable({
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('bitacoras.index') ),
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'bitacora_usuario', name: 'bitacora_usuario'},
                    { data: 'bitacora_accion', name: 'bitacora_accion'},
                    { data: 'bitacora_observaciones', name: 'bitacora_observaciones'},
                    { data: 'bitacora_fh', name: 'bitacora_fh' }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('bitacoras.show', {bitacoras: full.id }) )  +'">' + data + '</a>';
                        }
                    }
                ]
			});
        }
    });

})(jQuery, this, this.document);
