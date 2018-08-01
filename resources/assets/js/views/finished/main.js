/**
* Class MainFinishedView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainFinishedView = Backbone.View.extend({

        el: '#finished-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$finishedSearchTable = this.$('#finished-search-table');
            this.$finishedSearchTable.DataTable({
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: window.Misc.urlFull( Route.route('finalizados.index') ),
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'maquina_serie', name: 'finalizado_maquina'},
                    { data: 'finalizado_casilla', name: 'finalizado_casilla'},
                    { data: 'finalizado_finicio', name: 'finalizado_finicio'},
                    { data: 'finalizado_ffinal', name: 'finalizado_ffinal' }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('finalizados.show', {finalizados: full.id }) )  +'">' + data + '</a>';
                        }
                    }
                ]
			});
        }
    });

})(jQuery, this, this.document);
