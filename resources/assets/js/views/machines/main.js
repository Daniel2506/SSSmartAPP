/**
* Class MainMachinesView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainMachinesView = Backbone.View.extend({

        el: '#machines-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$machinesSearchTable = this.$('#machines-search-table');
            this.$machinesSearchTable.DataTable({
				dom: "<'row'<'col-sm-4'B><'col-sm-4 text-center'l><'col-sm-4'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: {
                    url: window.Misc.urlFull( Route.route('maquinas.index') ),
                    data: function( data ) {
                        data.datatables = true;
                    }
                },
                columns: [
                    { data: 'maquina_serie', name: 'maquina_serie' },
                    { data: 'maquina_casillas', name: 'maquina_casillas'},
                    { data: 'maquina_ubicacion', name: 'maquina_ubicacion'},
                    { data: 'maquina_email', name: 'maquina_email'},
                    { data: 'maquina_telefono', name: 'maquina_telefono' }
                ],
                buttons: [
                    {
                        text: '<i class="fa fa-plus"></i> Nueva máquina',
                        className: 'btn-sm',
                        action: function ( e, dt, node, config ) {
                                window.Misc.redirect( window.Misc.urlFull( Route.route('maquinas.create') ) )
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function ( data, type, full, row ) {
                            return '<a href="'+ window.Misc.urlFull( Route.route('maquinas.show', {maquinas: full.id }) )  +'">' + data + '</a>';
                        }
                    }
                ]
			});
        }
    });

})(jQuery, this, this.document);
