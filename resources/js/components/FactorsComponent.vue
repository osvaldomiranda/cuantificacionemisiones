<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
<!--       <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
      </template> -->
      <v-card class="px-4">
        <v-toolbar dark color="main_green">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Calculo factores de emisión</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <!-- <v-btn dark color="main_green" text @click="dialog = false">Guardar</v-btn> -->
          </v-toolbar-items>
        </v-toolbar>


        <v-container>

        <v-layout>

            <template>
              <v-carousel
                  cycle
                  height="400"
                  hide-delimiters='false'
                  show-arrows-on-hover
              >
                <v-carousel-item
                  v-for="(slide, i) in slides"
                  :key="i"
                >
                  <v-sheet
                    :color="colors[i]"
                    height="100%"
                  >
                    <v-row
                      class="fill-height"
                      align="center"
                      justify="center"
                    >
                      <div>
                          <v-layout row>
                            <v-flex xs2>
                            </v-flex>
                            <v-flex xs5 class="px-2">
                                <p>CO2</p>
                                <apexcharts palette="palette7" width="400"  type="bar" :options="chartOptions" :series="series"></apexcharts>
                            </v-flex>

                            <v-flex xs5 class="px-2">
                                <p>CH4</p>
                                <apexcharts width="400" heigth="500" type="bar" :options="chartOptions" :series="series"></apexcharts>
                            </v-flex>
                        </v-layout>    
                      </div>
                    </v-row>
                  </v-sheet>
                </v-carousel-item>
              </v-carousel>
            </template>

          
        </v-layout>

        <br>
        <br>
        <v-layout row>
            <v-flex xs12 class="px-4">
                <span class="headline">Detalle de Emisiones</span>
            </v-flex>

            <v-flex xs12>
                <v-toolbar flat>
                    <v-toolbar-title>Fuentes de uso general</v-toolbar-title>
                </v-toolbar>
            </v-flex>    
                <v-flex xs12>
                    <v-data-table
                      :headers="headers"
                      :items="general"
                      class="elevation-1"
                      hide-actions
                    >
                        <template v-slot:items="props">
                            <td class="text-xs-left">{{ props.item.source_type_name }}</td>
                            <td class="text-xs-left">{{ props.item.consumption }} {{ props.item.unity.split('/',2)[0] }}</td>
                            <td class="text-xs-left">{{ props.item.CO2 }}</td>
                            <td class="text-xs-left">{{ props.item.CO }}</td>
                            <td class="text-xs-left">{{ props.item.ME }}</td>
                            <td class="text-xs-left">{{ props.item.NOX }}</td>
                            <td class="text-xs-left">{{ props.item.NO }}</td> 
                            <td class="text-xs-left">{{ props.item.PM }}</td> 
                            <td class="text-xs-left">{{ props.item.PM10 }}</td>
                            <td class="text-xs-left">{{ props.item.PM25 }}</td>
                            <td class="text-xs-left">{{ props.item.SOX }}</td>

                        </template>
                    </v-data-table>
                </v-flex>     
            </v-layout>

            <br>
            <v-layout row>
                <v-flex xs12>
                    <v-toolbar flat>
                        <v-toolbar-title>Producción de Energía y Vapor</v-toolbar-title>
                    </v-toolbar>
                </v-flex>    
                <v-flex xs12>
                    <v-data-table
                      :headers="headers"
                      :items="energy"
                      class="elevation-1"
                      hide-actions
                    >
                        <template v-slot:items="props">
                            <td class="text-xs-left">{{ props.item.source_type_name }}</td>
                            <td class="text-xs-left">{{ props.item.consumption }} {{ props.item.unity.split('/',2)[0] }}</td>
                            <td class="text-xs-left">{{ props.item.CO2 }}</td>
                            <td class="text-xs-left">{{ props.item.CO }}</td>
                            <td class="text-xs-left">{{ props.item.ME }}</td>
                            <td class="text-xs-left">{{ props.item.NOX }}</td>
                            <td class="text-xs-left">{{ props.item.NO }}</td> 
                            <td class="text-xs-left">{{ props.item.PM }}</td> 
                            <td class="text-xs-left">{{ props.item.PM10 }}</td>
                            <td class="text-xs-left">{{ props.item.PM25 }}</td>
                            <td class="text-xs-left">{{ props.item.SOX }}</td>

                        </template>
                    </v-data-table>
                </v-flex>     
            </v-layout>


            <br>
            <v-layout row>
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
                            <td class="text-xs-left">{{ props.item.source_type_name }}</td>
                            <td class="text-xs-left">{{ props.item.consumption }} {{ props.item.unity.split('/',2)[0] }}</td>
                            <td class="text-xs-left">{{ props.item.CO2 }}</td>
                            <td class="text-xs-left">{{ props.item.CO }}</td>
                            <td class="text-xs-left">{{ props.item.ME }}</td>
                            <td class="text-xs-left">{{ props.item.NOX }}</td>
                            <td class="text-xs-left">{{ props.item.NO }}</td> 
                            <td class="text-xs-left">{{ props.item.PM }}</td> 
                            <td class="text-xs-left">{{ props.item.PM10 }}</td>
                            <td class="text-xs-left">{{ props.item.PM25 }}</td>
                            <td class="text-xs-left">{{ props.item.SOX }}</td>
                        </template>
                    </v-data-table>

                 </v-layout>

            </v-container>    

        </v-card-text>

        <v-btn @click="dialog = false" color="warning">
            <span>Cancelar</span>
        </v-btn>

        <v-btn @click="changeState" dark color="main_green">
            <span>Enviar a la Autoridad</span>
        </v-btn>
    
        </v-container>  

      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
 import VueApexCharts from 'vue-apexcharts'
  export default {
    components: {
      apexcharts: VueApexCharts,
    },
    props: {
        declaration: Object
    },

    data () {
      return {

        colors: [
          'seconday_gray',
          'seconday_gray',
          'seconday_gray',
        ],
        slides: [
          'First',
          'Second',
          'Third',
        ],

        dialog: true,
        energy:[],
        geneal:[],
        pda:[],

        headers: [
            { text: 'Tipo de Fuente', value: 'source_type_name' },            
            { text: 'Consumo', value: 'consume' },
            { text: 'CO2', value: 'co2' },
            { text: 'CO', value: 'ch4' },
            { text: 'Methane', value: 'n2o' },
            { text: 'NOX', value: 'mp10' },
            { text: 'NO', value: 'mp25' },
            { text: 'MP', value: 'mp25' },
            { text: 'MP10', value: 'mp25' },
            { text: 'MP2.5', value: 'so2' },
            { text: 'SOX', value: 'nox' },
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


      }
    },

    created () {
      this.initialize()
    },

    methods: {
        initialize () {
            var app = this;

            axios.get('/api/factors/byprocess?process=ENERGY&declaration='+app.declaration.id+'&establishment_id=1')
                .then(function (resp) {    
                    app.energy = resp.data;

                   // alert(JSON.stringify(resp.data));
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

            axios.get('/api/factors/byprocess?process=GENERAL_USE&declaration='+app.declaration.id+'&establishment_id=1')
                .then(function (resp) {   
                    app.general = resp.data;
                    // alert(JSON.stringify(resp.data));
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

            axios.get('/api/factors/byprocess?process=PDA&declaration='+app.declaration.id+'&establishment_id=1')
                .then(function (resp) {    
                    app.pda = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

        },

        changeState(){
            var app = this;
            axios.post('/api/declaration/change?declaration_id='+app.declaration.id+'&new_state=ENVIADA')
                .then(function (resp) {    
                    app.pda = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });
            app.dialog = false;    
        }
    }

  }
</script>