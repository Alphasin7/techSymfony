<template>
    <Line
      id="my-chart-id"
      :options="chartOptions"
      :data="chartData"
      
    />
  </template>
  
  <script>
  import { Line } from 'vue-chartjs'
  import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale,PointElement } from 'chart.js'
  
  ChartJS.register( CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend)
  
  export default {
    name: 'LineChart',
    components: { Line },
    data() {
      return {
        chartData: {
          labels: [ 'January', 'February', 'March','April','May','June','July','August','September','October','November','December' ],
          datasets: [ { 
            data: [40,20,12,30,15,36,3,22,14,10,38,12],
            label: 'monthly order',
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Couleur de fond du graphique
            borderColor: 'rgba(75, 192, 192, 1)',
            color:'rgba(75, 192, 192, 1)',
            borderWidth: 1

         } ]
        },
        chartOptions: {
          responsive: true
        }
      }
    }
  }
  </script>