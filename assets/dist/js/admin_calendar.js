let currentYear = new Date().getFullYear();

document.addEventListener("DOMContentLoaded", function () {
  updateCalendar(currentYear);
  loadAnalyticsData(currentYear, new Date().getMonth() + 1);
});

function updateCalendar(year) {
  const yearDisplay = document.getElementById("year-display");
  const monthsContainer = document.getElementById("months-container");

  yearDisplay.textContent = year;

  monthsContainer.innerHTML = "";

  const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  monthNames.forEach((monthName, index) => {
    const monthButton = document.createElement("button");
    monthButton.classList.add("month");
    monthButton.textContent = monthName;
    monthButton.dataset.month = index + 1; 
    monthButton.dataset.year = year;

    monthButton.addEventListener("click", () => loadAnalyticsData(year, index + 1));

    monthsContainer.appendChild(monthButton);
  });
}

function changeYear(direction) {
  currentYear += direction;
  updateCalendar(currentYear);
}

function loadAnalyticsData(year, month) {
  updateChartData(year, month);
}

function updateChartData(year, month) {
  $.ajax({
    url: 'adminDashboard.php',
    type: 'POST',
    data: { year: year, month: month },
    dataType: 'json',
    success: function (response) {
      const weeklyData = response.weeklyData || []; 
      const speciesChartData = response.speciesChartData || {};

      if (!Array.isArray(weeklyData)) {
        console.error("Expected weeklyData to be an array:", weeklyData);
        return;
      }

      lineChart.data.datasets[0].data = weeklyData;

      lineChart.data.datasets = lineChart.data.datasets.slice(0, 1);

      let colorIndex = 0;
      Object.keys(speciesChartData).forEach(species_name => {
        // Ensure speciesChartData[species_name] is an array
        if (Array.isArray(speciesChartData[species_name])) {
          lineChart.data.datasets.push({
            label: species_name,
            backgroundColor: colors[colorIndex % colors.length],
            borderColor: colors[colorIndex % colors.length],
            data: speciesChartData[species_name],
            fill: false
          });
          colorIndex++;
        } else {
          console.warn(`Expected speciesChartData[${species_name}] to be an array:`, speciesChartData[species_name]);
        }
      });

      lineChart.update();
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", error);
      console.error("Response:", xhr.responseText);
    }
  });
}

var colors = ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)'];

$(document).ready(function() {
  var lineChartCanvas = $('#lineChart').get(0).getContext('2d');

  var lineChartData = {
    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
    datasets: [
      {
        label: 'Total Catch',
        backgroundColor: 'rgb(40,167,69)',
        borderColor: 'rgb(40,167,69)',
        data: loadAnalyticsData,
        fill: false
      }
    ]
  };

  window.lineChart = new Chart(lineChartCanvas, {
    type: 'line',
    data: lineChartData,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: { display: false }
        },
        y: {
          grid: { display: false }
        }
      }
    }
  });

  loadAnalyticsData(currentYear, new Date().getMonth() + 1);
});
