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
        templateCharts: _.template( ($('#charts-dashboard-tpl').html() || '') ),
        events: {
            'change .change-view-for-machine' : 'changeViewMachine'
        },
        /**
        * Constructor Method
        */
        initialize : function() {
            this.$('#body-charts').html(this.templateCharts);
            var machineVal = this.$('#dashboard_machine_filter').val();
            this.referenceCharts(machineVal);
        },
        /**
        * Change filter machine 
        */
        changeViewMachine: function(e){
            this.initialize();
        },
        /**
        * Reference view charts
        */
        referenceCharts : function(machineVal){

            var _this = this;

            // Ajax charts
            $.ajax({
                url: window.Misc.urlFull( Route.route('dashboard.charts') ),
                type: 'GET',
                data: {machine: machineVal},
            })
            .done(function(resp) {
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
                    _this.chart_rotacion_dia(resp.object.chart_rotacion_dia);
                    _this.chart_rotacion_smeses(resp.object.chart_rotacion_smeses);
                    _this.chart_ventas_smeses(resp.object.chart_ventas_smeses);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alertify.error(thrownError);
            })
        },

        /**
        * Render view Chart rotacion X dia
        */
        chart_rotacion_dia : function(config){
            var ctx     = this.$('#chart_rotacion_dia');
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
                    responsive: true,
                    legend: { display: false },
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
        * Render view Chart rotacion ultimos seis meses
        */
        chart_rotacion_smeses : function(config){
            var ctx     = this.$('#chart_rotacion_smeses');
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
                    responsive: true,
                    legend: { display: false },
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
        * Render view Chart ventas ultimos seis meses
        */
        chart_ventas_smeses : function(config){
            var ctx     = this.$('#chart_ventas');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: config.labels,
                    datasets: [{
                        label: 'Subtotal',
                        data: config.data.subtotal,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Iva',
                        data: config.data.iva,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Comisiones',
                        data: config.data.comisiones,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex].label + ': '+ window.Misc.currency(tooltipItem.yLabel)
                            }
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                callback: function(label, index, labels) {
                                    return window.Misc.currency(label);
                                }
                            }
                        }]
                    }
                }
            });
        },
    });
})(jQuery, this, this.document);
