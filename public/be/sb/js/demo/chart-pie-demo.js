// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Room
var roomSourcesId = document.getElementById("roomSources");
var roomSources = new Chart(roomSourcesId, {
  type: 'doughnut',
  data: {
    labels: ["Cost", "Amount", "Discount", "Tax", "Total"],
    datasets: [{
      data: roomSourcesData,
      backgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBackgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

// Restaurant
var restaurantSourcesId = document.getElementById("restaurantSources");
var restaurantSources = new Chart(restaurantSourcesId, {
  type: 'doughnut',
  data: {
    labels: ["Cost", "Amount", "Discount", "Tax", "Total"],
    datasets: [{
      data: restaurantSourcesData,
      backgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBackgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

// product
var productSourcesId = document.getElementById("productSources");
var productSources = new Chart(productSourcesId, {
  type: 'doughnut',
  data: {
    labels: ["Cost", "Amount", "Discount", "Tax", "Total"],
    datasets: [{
      data: productSourcesData,
      backgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBackgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

// service
var serviceSourcesId = document.getElementById("serviceSources");
var serviceSources = new Chart(serviceSourcesId, {
  type: 'doughnut',
  data: {
    labels: ["Cost", "Amount", "Discount", "Tax", "Total"],
    datasets: [{
      data: serviceSourcesData,
      backgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBackgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});

// facility
var facilitySourcesId = document.getElementById("facilitySources");
var facilitySources = new Chart(facilitySourcesId, {
  type: 'doughnut',
  data: {
    labels: ["Cost", "Amount", "Discount", "Tax", "Total"],
    datasets: [{
      data: facilitySourcesData,
      backgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBackgroundColor: ['#d9534f', '#f0ad4e', '#0275d8', '#5bc0de', '#5cb85c'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
