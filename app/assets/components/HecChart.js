class HecChart extends HTMLElement {
    constructor() {
        super();
        this.chart = null;
        this.data = JSON.parse(this.getAttribute("data"))
        this.labels = JSON.parse(this.getAttribute("labels"))
        this.label = this.getAttribute("label")
        this.backgroundColor = this.getAttribute("backgroundColor")
        this.borderColor = this.getAttribute("borderColor")
        this.borderWidth = this.getAttribute("borderWidth")
        this.dragData = this.getAttribute("dragData")
        this.name = this.getAttribute("name")
        this.chartData = {
            labels: this.labels,
            datasets: [
                {
                    label: this.label,
                    data: this.data,
                    backgroundColor: this.backgroundColor,
                    borderColor: this.borderColor,
                    borderWidth: this.borderColor,
                    dragData: this.dragData,
                }
            ]
        }
        // {
        //     labels: ["A", "B", "C", "A", "B", "C", "A", "B", "C", "A", "B", "C", "A", "B", "C", "A", "B", "C", "A", "B", "C", "A", "B", "C"],
        //     datasets: [
        //         {
        //             label: "Data",
        //             data: [50, 100, 30, 50, 100, 30, 50, 100, 30, 50, 100, 30, 50, 100, 30, 50, 100, 30, 50, 100, 30, 50, 100, 30],
        //             backgroundColor: [
        //                 "rgba(255, 99, 132, 0.8)",
        //             ],
        //             borderColor: [
        //                 "rgba(255, 99, 132, 1)",
        //             ],
        //             borderWidth: 6,
        //             dragData: true,
        //         },
        //     ],
        // };
    }

    connectedCallback() {
        this.render();
        this.initChart();
        this.updateHiddenInput();
    }

    render() {
        this.innerHTML = `
            <div style="height: 30rem;">
                <canvas id="chartCanvas-${this.id}"></canvas>
            </div>
            <input id="hiddenInputValue${this.id}" name="${this.name}" class="hidden">`;
    }

    initChart() {
        const canvas = this.querySelector(`#chartCanvas-${this.id}`);
        const ctx = canvas.getContext("2d");

        this.chart = new Chart(ctx, {
            type: this.getAttribute("type") || "bar",
            data: this.chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    dragData: {
                        onDragEnd: () => {
                            this.updateHiddenInput();
                        },
                    },
                    title: {
                        display: true,
                        text: this.getAttribute("chart-title") || "Hec chart",
                        font: {
                            size: 18,
                            weight: "bold",
                        },
                    },
                    legend: {
                        display: true,
                        position: "top",
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: 10,
                        max: 110,
                        grace: 0,
                        grid: {
                            color: "rgba(0,0,0,0.1)",
                        },
                    },
                    x: {
                        grid: {
                            color: "rgba(0,0,0,0.1)",
                        },
                    },
                },
                animation: {
                    duration: 800,
                    easing: "easeInOutQuart",
                },
            },
        });
    }

    updateHiddenInput() {
        const input = document.getElementById(`hiddenInputValue${this.id}`);
        const chartData = {
            // labels: this.data.labels,
            values: this.chartData.datasets[0].data,
            // timestamp: new Date().toISOString(),
        };
        input.value = JSON.stringify(chartData);
    }
}
customElements.define("hec-chart", HecChart);
