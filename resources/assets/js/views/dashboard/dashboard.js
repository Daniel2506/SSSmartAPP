/**
* Class DashboardView  of Backbone Router
* @author KOI || @dropecamargo
* @link http://koi-ti.com
*/

//Global App Backbone
app || (app = {});

(function ($, window, document, undefined) {

    app.DashboardView = Backbone.View.extend({

        el: '#dashboard-main',

        /**
        * Constructor Method
        */
        initialize : function() {
            this.referenceCharts();
        },

        /**
        *
        */
        referenceCharts : function(){

            var _this = this;

            // Ajax charts
            $.ajax({
                url: window.Misc.urlFull( Route.route('dashboard.charts') ),
                type: 'GET',
                beforeSend: function() {
                    window.Misc.setSpinner( _this.spinner );
                }
            })
            .done(function(resp) {
                window.Misc.removeSpinner( _this.spinner );
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

                    // Render
                    _this.chart_rotacion_dia(resp.chart_rotacion_dia);
                    _this.chart_rotacion_smeses(resp.chart_rotacion_smeses);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                window.Misc.removeSpinner( _this.spinner );
                alertify.error(thrownError);
            })
        },

        /**
        *
        */
        chart_rotacion_dia : function(config){
            var ctx     = this.$('#chart_rotacion_dia').get(0).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: config.labels,
                    datasets: [{
                        label: '# Rotación',
                        data: config.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        },
        /**
        *
        */
        chart_rotacion_smeses : function(config){
            var ctx     = this.$('#chart_rotacion_smeses').get(0).getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: config.labels,
                    datasets: [{
                        label: '# Rotación',
                        data: config.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        },
    });
})(jQuery, this, this.document);
