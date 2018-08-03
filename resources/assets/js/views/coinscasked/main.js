/**
* Class MainCoinsCasketView
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.MainCoinsCasketView = Backbone.View.extend({

        el: '#coinscasket-main',

        /**
        * Constructor Method
        */
        initialize : function() {
            this.$coinsCaskedSearchTable = this.$('#coinscasket-search-table');
            this.$coinsCaskedSearchTable.DataTable({
                processing: true,
                serverSide: true,
                language: window.Misc.dataTableES(),
                ajax: window.Misc.urlFull( Route.route('monedascofres.index') ),
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'maquina_serie', name: 'coin_maquina'},
                    { data: 'coin_canal', name: 'coin_canal'},
                    { data: 'coin_denominacion', name: 'coin_denominacion'},
                    { data: 'coin_cofre', name: 'coin_cofre' }
                ]
			});
        }
    });

})(jQuery, this, this.document);
