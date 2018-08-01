/**
* Class MainBillsView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainBillsView = Backbone.View.extend({

        el: '#bills-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$billsSearchTable = this.$('#bills-search-table');
            this.$billsSearchTable.DataTable({
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('facturas.index') ),
                    data: function( data ) {
                        data.datatables = true;
                    }
                },
                columns: [
                    { data: 'factura_numero', name: 'factura_numero' },
                    { data: 'factura_prefijo', name: 'factura_prefijo'},
                    { data: 'maquina_serie', name: 'factura_maquina'}, /* Posivlemente un buscador provisonal 'name'*/
                    { data: 'factura_fecha_emision', name: 'factura_fecha_emision'},
                    { data: 'factura_total', name: 'factura_total' }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('facturas.show', {facturas: full.id }) )  +'">' + data + '</a>';
                        }
                    }
                ]
			});
        }
    });

})(jQuery, this, this.document);
