<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" width="1200px">
      <template v-slot:activator="{ on }">
        <v-btn color="success" dark v-on="on">Siguiente</v-btn>
      </template>
    <v-card
        class="text-xs-center"
        max-width="1200"
    >

        <v-card-text>
            <v-container
            id="grid"
            fluid
            grid-list-sm
            tag="section"
            >
                <v-layout row wrap>

                <v-flex xs3 text-xs-center>
                    <p>CO2</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                <v-flex xs3 text-xs-center>
                    <p>MP10</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                <v-flex xs3 text-xs-center>
                    <p>SO2</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                </v-layout>        
                <v-layout row wrap>
                <v-flex xs3 text-xs-center>
                    <p>CO</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                <v-flex xs3 text-xs-center>
                     <p>MP2.3</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                <v-flex xs3 text-xs-center>
                     <p>NOx</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>
                </v-layout>        
        
            </v-container>    

        </v-card-text>
        <v-divider></v-divider>

        <v-card-actions class="justify-center">
          <v-btn block flat>Cancelar</v-btn>
          <v-btn block flat>Enviar a la Autoridad</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
   
  import VueApexCharts from 'vue-apexcharts'

  export default {
    components: {
      apexcharts: VueApexCharts,
    },

    data: () => ({
        dialog: false,

       series: [{
          name: 'CO2',
          data: [404, 505, 507, 560, 610]
        }],
        chartOptions: {
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '20%'
            },
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
          },

          xaxis: {
            categories: ['2015', '2016', '2017', '2018', '2019'],
          },
          yaxis: {
            title: {
              text: 'T'
            }
          },
          fill: {
            opacity: 1

          },
          tooltip: {
            y: {
              formatter: function (val) {
                return "T : " + val 
              }
            }
          }
        }
    })
  }
</script>