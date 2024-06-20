<template>
    <Bar
      id="my-chart-id"
      :options="chartOptions"
      :data="chartData"
    />
  </template>
  
  <script>
  import { Bar } from 'vue-chartjs'
  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
  
  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)
  
  export default {
    name: 'BarChart',
    components: { Bar },
    data() {
      return {
        chartData: {
          labels: [ 'January', 'February', 'March','April','May','June','July','August','September','October','November','December' ],
          datasets: [ { 
            data: [40,20,12,30,15,36,3,22,14,10,38,12],
            label: 'monthly order',
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
         } ]
        },
        chartOptions: {
          responsive: true
        }
      }
    }
  }
  </script>