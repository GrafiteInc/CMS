/*
|--------------------------------------------------------------------------
| Charts
|--------------------------------------------------------------------------
*/

$(function () {

    var _chartDataConfig = {
        type: 'line',
        data: {
            labels: _chartData._labels,
            datasets: [{
                label: "Visits",
                backgroundColor: [
                    "#36A2EB"
                ],
                hoverBackgroundColor: [
                    "#36A2EB"
                ],
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: _chartData._visits
            }]
        }
    }

    var ctx = $("#dashboardChart").get(0).getContext("2d");
    window.dashboard = new Chart(ctx, _chartDataConfig);

});
