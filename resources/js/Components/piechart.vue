<template>
    <div class="w-full lg:w-1/2">
      <canvas ref="chartCanvas"></canvas>
    </div>
  </template>

  <script setup>
  import { ref, onMounted, watch } from 'vue';
  import Chart from 'chart.js/auto';

  const props = defineProps({
    chartData: {
      type: Array,
      required: true,
    },
    chartLabels: {
      type: Array,
      required: true,
    },
    colors: {
      type: Array,
      default: () => ['#FF6384', '#36A2EB', '#FFCE56'], // Default colors
  }});

  // Chart instance reference
  let chartInstance = null;
  const chartCanvas = ref(null);

  // Function to render the pie chart
  function renderChart() {
    // Check if chartData and chartLabels are valid
    if (!props.chartData.length || !props.chartLabels.length) return;

    const ctx = chartCanvas.value.getContext('2d');

    const data = {
      labels: props.chartLabels,
      datasets: [{
        data: props.chartData,
        backgroundColor: props.colors,
        hoverOffset: 4,
      }],
    };

    // Destroy the previous chart before rendering a new one
    if (chartInstance) {
      chartInstance.destroy();
    }

    chartInstance = new Chart(ctx, {
      type: 'pie',
      data,
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom', 
          },
        },
      },
    });
  }

  // Watch for changes in both chartData and chartLabels and re-render the chart
  watch([() => props.chartData, () => props.chartLabels], renderChart, { deep: true });

  // Render the chart on component mount
  onMounted(() => {
    renderChart();
  });
  </script>

  <style scoped>
  /* Add any styles you need for the PieChart component */
  </style>
