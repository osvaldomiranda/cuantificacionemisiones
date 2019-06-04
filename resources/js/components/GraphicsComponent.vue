<template>
  <v-layout row justify-center>
<!--     <v-dialog v-model="dialog" fullscreen scrollable transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn color="success" dark v-on="on">Siguiente</v-btn>
      </template> -->
      <v-card>
<!--         <v-toolbar dark color="success">
            <v-btn icon dark @click="dialog = false">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title>Emisiones de la declaración</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat color="success" @click="dialog = false">Enviar</v-btn>
            </v-toolbar-items>
            </v-toolbar> -->

             <v-container>


                <v-layout row wrap>
                <v-flex xs1>
                  
                </v-flex> 
                <v-flex xs3 text-xs-center>
                    <p>CO2</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                <v-flex xs3 text-xs-center>
                    <p>CH4</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>

                <v-flex xs3 text-xs-center>
                    <p>N2O</p>
                    <apexcharts width="300" type="bar" :options="chartOptions" :series="series"></apexcharts>
                </v-flex>
                <v-flex xs1>  
                </v-flex>

                </v-layout>        
                
                <v-layout row wrap>
                    
                    <v-flex xs3 text-xs-center>
                        <p>MP10</p>
                        <apexcharts width="250" type="bar" :options="chartOptions" :series="series"></apexcharts>
                    </v-flex>

                    <v-flex xs3 text-xs-center>
                        <p>MP2.5</p>
                        <apexcharts width="250" type="bar" :options="chartOptions" :series="series"></apexcharts>
                    </v-flex>

                    <v-flex xs3 text-xs-center>
                        <p>SO2</p>
                        <apexcharts width="250" type="bar" :options="chartOptions" :series="series"></apexcharts>
                    </v-flex>
                    <v-flex xs3 text-xs-center>
                        <p>NOx</p>
                        <apexcharts width="250" type="bar" :options="chartOptions" :series="series"></apexcharts>
                    </v-flex>
                   
                </v-layout>   


                <v-layout row justify-center wrap>
                <span class="headline">Detalle de Emisiones</span>    
                <v-toolbar flat>
                        <v-toolbar-title>Fuentes de uso general</v-toolbar-title>
                    </v-toolbar>

                    <v-data-table
                      :headers="headers"
                      :items="desserts2"
                      class="elevation-1"
                      hide-actions
                    >
                        <template v-slot:items="props">
                            <td class="text-xs-right">{{ props.item.source_type_name }}</td>
                            <td class="text-xs-right">{{ props.item.consume }}</td>
                            <td class="text-xs-right">{{ props.item.co2 }}</td>
                            <td class="text-xs-right">{{ props.item.ch4 }}</td>
                            <td class="text-xs-right">{{ props.item.n2o }}</td>
                            <td class="text-xs-right">{{ props.item.mp10 }}</td>
                            <td class="text-xs-right">{{ props.item.mp25 }}</td> 
                            <td class="text-xs-right">{{ props.item.so2 }}</td> 
                            <td class="text-xs-right">{{ props.item.nox }}</td> 
                        </template>
                    </v-data-table>
                </v-layout>


                <v-layout row justify-center wrap>
                <v-toolbar flat>
                        <v-toolbar-title>Proceso Cementera</v-toolbar-title> 
                        
                    </v-toolbar>

                    <v-data-table
                      :headers="headers"
                      :items="desserts"
                      class="elevation-1"
                      hide-actions
                    >
                        <template v-slot:items="props">
                            <td class="text-xs-right">{{ props.item.source_type_name }}</td>
                            <td class="text-xs-right">{{ props.item.consume }}</td>
                            <td class="text-xs-right">{{ props.item.co2 }}</td>
                            <td class="text-xs-right">{{ props.item.ch4 }}</td>
                            <td class="text-xs-right">{{ props.item.n2o }}</td>
                            <td class="text-xs-right">{{ props.item.mp10 }}</td>
                            <td class="text-xs-right">{{ props.item.mp25 }}</td> 
                            <td class="text-xs-right">{{ props.item.so2 }}</td> 
                            <td class="text-xs-right">{{ props.item.nox }}</td> 
                        </template>
                    </v-data-table>

                 </v-layout>

            </v-container>    

        </v-card-text>

            <v-btn color="warning">
              <span>Cancelar</span>
            </v-btn>

            <v-btn color="success">
              <span>Enviar a la Autoridad</span>
            </v-btn>
      </v-card>
    <!-- </v-dialog> -->
  </v-layout>
</template>

<script>
   
  import VueApexCharts from 'vue-apexcharts'

  export default {
    components: {
      apexcharts: VueApexCharts,
    },

    data: () => ({
        // dialog: false,


        headers: [

            { text: 'Tipo de Fuente', value: 'source_type_name' },            
            { text: 'Consumo', value: 'consume' },
            { text: 'CO2', value: 'co2' },
            { text: 'CH4', value: 'ch4' },
            { text: 'N2O', value: 'n2o' },
            { text: 'MP10', value: 'mp10' },
            { text: 'MP2.5', value: 'mp25' },
            { text: 'SO2', value: 'so2' },
            { text: 'NOX', value: 'nox' },
            ],


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
    }),
    created () {
      this.initialize()
    },


    // Agregar totales
    methods: {
      initialize () {
        this.desserts = [
            {
                source_type_name: 'Proceso Cementera',  
                Combustible: '',          
                consume: '',
                co2: '20.000 K',
                ch4: '24 K',
                n2o: '10 K',
                mp10: '',
                mp25: '', 
                so2: '',
                nox: '',
            },
            {
                source_type_name: 'Horno Rotatorio',  
                Combustible: 'Petroleo 6' ,         
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
            {
                source_type_name: 'Horno Rotatorio',  
                Combustible: 'Petroleo 6',          
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
            {
                source_type_name: 'Horno Rotatorio',  
                Combustible: 'Petroleo 6',          
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
        ],

        this.desserts2 = [
            {
                source_type_name: 'Grupo Electrogeno',  
                Combustible: 'Petroleo 6',          
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
            {
                source_type_name: 'Grupo Electrogeno',  
                Combustible: 'Petroleo 6' ,         
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
            {
                source_type_name: 'Grupo Electrogeno',  
                Combustible: 'Petroleo 6',          
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
            {
                source_type_name: 'Grupo Electrogeno',  
                Combustible: 'Petroleo 6',          
                consume: '30.000 Lt',
                co2: '15.000 K',
                ch4: '30 K',
                n2o: '10 K',
                mp10: '10 K',
                mp25: '1 K', 
                so2: '50 K',
                nox: '10 K',
            },
        ]
      },
    }
  }
</script>