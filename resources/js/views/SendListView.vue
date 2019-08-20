<style type="text/css">
    .fab{
        border-radius: 99px
    }
    .white-box{
        border-radius: 5px
    }
</style>

<template>


    <v-layout>


        <v-flex xs8 class="px-1"> 

            
            <v-card  color="main_green" style="border-radius:0px;">
                <v-card-title class="mx-2 white--text" style="padding: 10px;">
                    <h5 style="font: #FFF">DECLARACIONES DEL ESTABLECIMIENTO</h5>
                </v-card-title>
            </v-card>

            <v-data-table
              :headers="headers"
              :items="desserts"
              class="elevation-1"
              hide-actions
            >
              <template v-slot:items="props">

                <td class="text-xs-right">{{ props.item.reporting_period }}</td>
                <td class="text-xs-right">{{ props.item.type }}</td>
                <td class="text-xs-right">{{ props.item.report_date }}</td>
                <td class="text-xs-right">{{ props.item.user }}</td>
                <td class="text-xs-right">{{ props.item.state }}</td>
                <td class="justify-center layout px-0">
                    <v-btn flat v-if= "props.item.report_date!=''" small @click="" color="side_bar_gray">
                        Revisar
                        <v-icon color="side_bar_gray" right dark>visibility</v-icon>    
                    </v-btn>  

                    <router-link
                        to="/source_list"
                    >
                        <v-btn flat v-if= "props.item.report_date==''" small @click="" color="side_bar_gray">
                            Editar
                            <v-icon color="side_bar_gray" right dark>edit</v-icon>
                        </v-btn>
                    </router-link>       
                </td>   

              </template>
            </v-data-table>

            <v-layout>
                <v-flex xs4 class="px-4">
                    <router-link to="/source_list">
                        <v-btn round color="main_green" class="white--text px-4">Editar declaración D.S 138</v-btn>
                    </router-link>
                </v-flex>
               
                <v-flex xs4 class="px-4">  
                    <router-link  to="/readings">
                        <v-btn round color="main_green" class="white--text px-4">Registrar Mediciones</v-btn>
                    </router-link>    
                </v-flex>
                <v-flex xs4 class="px-4">
                    <covs></covs>      
                </v-flex>

            </v-layout>

        </v-flex>
        <v-flex xs4 class="px-1"> 
            <v-card color="main_green" style="border-radius:0px;">
                <v-card-title class="mx-2 white--text" style="padding: 10px;">
                    <h5 style="font: #FFF">DATOS DEL ESTABLECIMIENTO</h5>
                </v-card-title>
            </v-card>
            <v-card>
              <v-container
                id="grid"
                fluid
                grid-list-sm
                tag="section"
              >
                <v-layout row wrap>
              <!-- <v-flex xs6 tag="h4" >{{ JSON.stringify(this.$store.getters.token) }}</v-flex> -->
                  <v-flex xs6 tag="h4" >Usuario: {{ $store.getters.user['name'] }}</v-flex>
                  <v-flex xs6 tag="h4" >Establecimiento: {{ $store.getters.establishment['name'] }}</v-flex>
                </v-layout>
                
              </v-container>
            </v-card>     
        </v-flex>


    </v-layout>    

</template>

<script>
  export default {
    data: () => ({
        dialog: false,
        dialog2: false,
        headers: [

            { text: 'Periodo declaración', value: 'reporting_period' }, 
            { text: 'Tipo', value: 'type' },            
            { text: 'Fecha Declaración', value: 'report_date' },
            { text: 'Usuario', value: 'user' },
            { text: 'Estado', value: 'state' },
        ],
      desserts: [],
        company:{
            name: 'Empresa Prueba',
            rut: '76200200',
            digit: '3',
            stret: 'Moneda',
            number: '920',
            comune: 'Santiago Centro',
        },
        user:{
            name:'Osvaldo Miranda',
            email: 'omiranda@mma.gob.cl'
        },
    }),

    computed: {
    },


    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.desserts = [
            {
                reporting_period: 2017,
                report_date: '01/01/2016',
                state: 'Aceptada',
                type: 'COVs',
                user: 'Ignacio Saravia',
            },
            {
                reporting_period: 2018,
                report_date: '01/01/2016',
                state: 'Aceptada',
                type: 'Medición',
                user: 'Ignacio Saravia',
            },
            {
                reporting_period: 2019,
                report_date: '',
                state: 'En Proceso',
                type: 'D.S.138',
                user: 'Ignacio Saravia',
            },
        ]
      },
    }
  }
</script>