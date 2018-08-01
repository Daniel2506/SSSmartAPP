/**
* Class MainCoinsView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainCoinsView = Backbone.View.extend({

        el: '#coins-main',

        /**
        * Constructor Method
        */
        initialize : function() {

            this.$coinsSearchTable = this.$('#coins-search-table');
            this.$coinsSearchTable.DataTable({
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: window.Misc.urlFull( Route.route('monedas.index') ),
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'maquina_serie', name: 'moneda_maquina'},
                    { data: 'moneda_canal', name: 'moneda_canal'},
                    { data: 'moneda_denominacion', name: 'moneda_denominacion'},
                    { data: 'moneda_hopper', name: 'moneda_hopper' }
                ]
			});
        }
    });

})(jQuery, this, this.document);
