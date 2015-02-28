angular.module("app").controller("lastestJobHeatmapController", ["$scope", "$http", function (a, b) {
    "use strict";
    a.jobs = [], a.loading = !1, a.date = !1, a.predicate = "time";
    var c = new CalHeatMap;
    c.init({id: "latest-jobs-heatmap", scale: [10, 20, 30, 40], itemName: ["job", "jobs"], range: 6, cellsize: 10, browsing: !0, browsingOptions: {nextLabel: '<i class="icon-chevron-right"></i>', previousLabel: '<i class="icon-chevron-left"></i>'}, data: "api/jobs/stats/{{t:start}}/{{t:end}}", onClick: function (c) {
        a.loading = !0;
        var d = d3.time.format("%H:%M, %A %B %e %Y");
        a.date = d(c), b({method: "GET", url: "api/jobs/" + +c / 1e3 + "/" + (+c / 1e3 + 60)}).success(function (b) {
            a.jobs = [];
            for (var c in b) {
                for (var d in b[c])b[c][d].created = new Date(1e3 * b[c][d].s_time);
                a.jobs = b
            }
            a.loading = !1
        }).error(function () {
            })
    }, onComplete: function () {
        $(".latest-jobs-graph a").tooltip({container: "body"})
    }}), a.clear = function () {
        a.date = !1, a.jobs = []
    }
}]);
