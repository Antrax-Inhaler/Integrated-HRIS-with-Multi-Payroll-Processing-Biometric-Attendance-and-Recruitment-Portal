const chartData = {
    labels: ["Male", "Female", "Young", "Old"],
    data: [30, 17, 10, 45],
  };
  
  const myChart = document.querySelector(".my-chart");
  const ul = document.querySelector(".programming-stats .details ul");
  
  new Chart(myChart, {
    type: "doughnut",
    data: {
      labels: chartData.labels,
      datasets: [
        {
          label: "  Total population ",
          data: chartData.data,
        },
      ],
    },
    options: {
      borderWidth: 5,
      borderRadius: 2,
      hoverBorderWidth: 0,
      plugins: {
        legend: {
          display: false,
        },
      },
    },
  });
  
  const populateUl = () => {
    chartData.labels.forEach((l, i) => {
      let li = document.createElement("li");
      li.innerHTML = `${l}: <span class='percentage'>${chartData.data[i]}%</span>`;
      ul.appendChild(li);
    });
  };
  
  populateUl();
  
  // Define data for the bar chart
const barChartData = {
    labels: ["Male", "Female", "Young", "Old"],
    datasets: [
      {
        label: "Population",
        backgroundColor: ["rgba(255, 99, 132, 0.5)", "rgba(54, 162, 235, 0.5)", "rgba(255, 206, 86, 0.5)", "rgba(75, 192, 192, 0.5)"],
        borderColor: ["#fff", "#fff", "#fff", "#fff"],
        borderWidth: 3,
        data: [30, 17, 10, 45],
      },
    ],
  };
  
  // Find the canvas element for the bar chart
  const barChartCanvas = document.querySelector(".bar-chart");
  
  // Create the bar chart
  new Chart(barChartCanvas, {
    type: "bar",
    data: barChartData,
    options: {
      plugins: {
        legend: {
          display: false,
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 10,
          },
        },
      },
    },
  });
  