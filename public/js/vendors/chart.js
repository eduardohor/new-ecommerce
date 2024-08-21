const theme = {
    primary: "var(--fc-primary)",
    secondary: "var(--fc-secondary)",
    success: "var(--fc-success)",
    info: "var(--fc-info)",
    warning: "var(--fc-warning)",
    danger: "var(--fc-danger)",
    dark: "var(--fc-dark)",
    light: "var(--fc-light)",
    white: "var(--fc-white)",
    gray100: "var(--fc-gray-100)",
    gray200: "var(--fc-gray-200)",
    gray300: "var(--fc-gray-300)",
    gray400: "var(--fc-gray-400)",
    gray500: "var(--fc-gray-500)",
    gray600: "var(--fc-gray-600)",
    gray700: "var(--fc-gray-700)",
    gray800: "var(--fc-gray-800)",
    gray900: "var(--fc-gray-900)",
    black: "var(--fc-black)",
    transparent: "transparent",
};
window.theme = theme;

$(document).ready(function () {
    if ($("#revenueChart").length) {
        var revenueArray = Object.values(window.revenues || {}).map(Number);
        var options = {
            series: [
                {
                    name: "Renda Total",
                    data: revenueArray,
                },
            ],
            labels: [
                "Jan",
                "Fev",
                "Mar",
                "Abr",
                "Mai",
                "Jun",
                "Jul",
                "Ago",
                "Set",
                "Out",
                "Nov",
                "Dez",
            ],
            chart: { height: 350, type: "area", toolbar: { show: 1 } },
            dataLabels: { enabled: false },
            markers: { size: 5, hover: { size: 6, sizeOffset: 3 } },
            colors: ["#0aad0a"],
            stroke: { curve: "smooth", width: 2 },
            grid: { borderColor: window.theme.gray300 },
            xaxis: {
                labels: {
                    show: true,
                    align: "right",
                    style: {
                        fontSize: "12px",
                        fontWeight: 400,
                        colors: [window.theme.gray600],
                        fontFamily: '"Inter", "sans-serif"',
                    },
                },
                axisBorder: { show: true, color: window.theme.gray300 },
                axisTicks: { show: true, color: window.theme.gray300 },
            },
            legend: {
                position: "top",
                fontWeight: 600,
                color: window.theme.gray600,
                markers: { width: 8, height: 8 },
                labels: {
                    colors: window.theme.gray600,
                    useSeriesColors: false,
                },
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return "R$" + value;
                    },
                    show: true,
                    style: {
                        fontSize: "12px",
                        fontWeight: 400,
                        colors: window.theme.gray600,
                        fontFamily: '"Inter", "sans-serif"',
                    },
                },
            },
        };

        var revenueChart = new ApexCharts($("#revenueChart")[0], options);
        revenueChart.render();
        window.revenueChart = revenueChart;
    }

    if ($("#totalSale").length) {
        var orderQuantities = window.orderQuantities;

        var series = [];
        var labels = [];

        var categories = [
            'Pedidos Pendentes',
            'Pedidos Processando',
            'Pedidos Completos',
            'Pedidos Cancelados'
        ];

        categories.forEach(function(category, index) {
            if (orderQuantities.hasOwnProperty(category)) {
                series.push(orderQuantities[category]);
                labels.push(category);
            }
        });

        var options = {
            series: series,
            labels: labels,
            colors: ["#ffc107", "#016bf8", "#0aad0a", "#db3030"],
            chart: {
                type: "donut",
                height: 280
            },
            legend: { show: false },
            dataLabels: { enabled: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: "85%",
                        background: "transparent",
                        labels: {
                            show: true,
                            name: {
                                show: true,
                                fontSize: "22px",
                                fontFamily: '"Inter", "sans-serif"',
                                fontWeight: 600,
                                colors: [window.theme.gray600],
                                offsetY: -10,
                                formatter: function (value) {
                                    return value;
                                },
                            },
                            value: {
                                show: true,
                                fontSize: "24px",
                                fontFamily: '"Inter", "sans-serif"',
                                fontWeight: 800,
                                colors: window.theme.gray800,
                                offsetY: 8,
                                formatter: function (value) {
                                    return value;
                                },
                            },
                            total: {
                                show: true,
                                label: "Pedido Totais",
                                fontSize: "16px",
                                fontFamily: '"Inter", "sans-serif"',
                                fontWeight: 400,
                                colors: window.theme.gray400,
                                formatter: function (value) {
                                    return value.globals.seriesTotals.reduce(
                                        (total, num) => total + num,
                                        0
                                    );
                                },
                            },
                        },
                    },
                },
            },
            stroke: { width: 0 },
            responsive: [
                {
                    breakpoint: 1400,
                    options: {
                        chart: {
                            type: "donut",
                            width: 290,
                            height: 330,
                        },
                    },
                },
            ],
        };

        var totalSaleChart = new ApexCharts($("#totalSale")[0], options);
        totalSaleChart.render();
        window.totalSaleChart = totalSaleChart;

    }
});
