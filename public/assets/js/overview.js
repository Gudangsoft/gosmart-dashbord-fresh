(function ($) {
    // "use strict";

    /*--
        Apex Charts
    -----------------------------------*/
    var title_class = document.getElementById('title_class').innerHTML;
    var title_materi = document.getElementById('title_materi').innerHTML;
    var total_class = document.getElementById('total_class_complete').innerHTML;
    var total_materi = document.getElementById('total_materi_complete').innerHTML;

    var options = {
        series: [ {
            name: 'Selesai',
            type: 'line',
            data: [total_class, total_materi,]
        }],
        chart: {
            height: 370,
            type: 'bar',
            stacked: false,
            toolbar: {
                show: false,
            }
        },
        stroke: {
            width: [0],
            curve: 'smooth'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },
        markers: {
            size: 3
        },
        colors: ['#309255'],
        xaxis: {
            categories: [
                [title_class],
                [title_materi],
            ],
            labels: {
                style: {
                    colors: ['#52565b'],
                    fontSize: '14px',
                    fontFamily: 'Gordita',
                    fontWeight: 400,
                }
            }
        },
        yaxis: {
            tickAmount: 7,
            min: 0,
            labels: {
                style: {
                    colors: ['#52565b'],
                    fontSize: '14px',
                    fontFamily: 'Gordita',
                    fontWeight: 400,
                },
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(0) + " ";
                }
                return y;

                }
            }
            }
        };

        var chart = new ApexCharts(document.querySelector("#uniqueReport"), options);
        chart.render();


})(jQuery);
