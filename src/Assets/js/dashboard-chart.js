/*
|--------------------------------------------------------------------------
| Charts
|--------------------------------------------------------------------------
*/

$(function(){

    var _chartDataConfig = {
        labels: _chartData._labels,
        datasets: [
            {
                label: "Visits",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: _chartData._visits
            }
        ]
    }

    var ctx = $("#dashboardChart").get(0).getContext("2d");
    var myNewChart = new Chart(ctx).Line(_chartDataConfig, options);

});
