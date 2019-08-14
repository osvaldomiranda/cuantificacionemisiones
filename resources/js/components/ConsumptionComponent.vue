<template>
  	<v-layout row>
    	<v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      		<v-card>
        		<v-toolbar dark color="main_green">
          			<v-btn icon dark @click="dialog = false">
            			<v-icon>close</v-icon>
          			</v-btn>
          			<v-toolbar-title>Registrar consumos y niveles de actividad</v-toolbar-title>
          			<v-spacer></v-spacer>
          			<v-toolbar-items>
            			<v-btn flat color="main_green" @click="dialog = false">Guardar</v-btn>
          			</v-toolbar-items>
        		</v-toolbar>
 				<br>
				<v-container>
				  
				
				<v-card class="px-5">
					<br>
					<v-layout>
		                <span  class="title">Consumo combustible mensual</span>
		            </v-layout>

		            <v-layout>
		                <v-flex  xs12 sm6 md3 class="pr-1">
		                    <v-text-field  readonly='true' label="Combustible"></v-text-field>
		                </v-flex>
		                <v-flex  xs12 sm6 md3 class="px-1">
		                    <v-text-field  readonly='true' label="Unidad"></v-text-field>
		                </v-flex>
		            </v-layout>  

		            <v-layout>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_ene" label="Enero"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_feb" label="Febrero"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_mar" label="Marzo"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_abr" label="Abril"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_may" label="Mayo"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_jun" label="Junio"></v-text-field>
		                </v-flex>
		            </v-layout>
		            <v-layout>
		                <v-flex xs2 class="px-1">
		                    <v-text-field  v-model="fuel_jul" label="Julio"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field  v-model="fuel_ago" label="Agosto"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field  v-model="fuel_sep" label="Septiembre"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_oct" label="Octubre"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_nov" label="Noviembre"></v-text-field>
		                </v-flex>
		                <v-flex xs2 class="px-1">
		                    <v-text-field v-model="fuel_dic" label="Diciembre"></v-text-field>
		                </v-flex>
		            </v-layout>	
		         
				</v-card>

				<br>
				<v-card class="px-5">
					<br>
					<v-layout>
		                <span class="title">Ciclo de Funcionamiento semanal</span>
		            </v-layout>

		            <v-layout>
		                <v-flex xs12 sm6 md2 class="px-1">
		                    <v-select
		                        :items="dias"
		                        v-model="day_from"
		                        label="Día Desde"
		                    ></v-select> 
		                </v-flex>
		                <v-flex xs12 sm6 md2 class="px-1">
		                    <v-select
		                        :items="dias"
		                        v-model="day_to"
		                        label="Día Hasta"
		                    ></v-select>   
		                </v-flex>
		                <v-flex xs12 sm6 md2 class="px-1">
							<v-row>
							    <v-col cols="11" sm="5">
								    <v-menu
								        ref="menu1"
								        v-model="menu1"
								        :close-on-content-click="false"
								        :nudge-right="40"
								        :return-value.sync="time1"
								        transition="scale-transition"
								        offset-y
								        full-width
								        max-width="290px"
								        min-width="290px"
								    >
								        <template v-slot:activator="{ on }">
								          <v-text-field
								            v-model="time1"
								            label="Desde"
								            prepend-icon="access_time"
								            readonly
								            v-on="on"
								          ></v-text-field>
								        </template>
								        <v-time-picker
								          v-if="menu1"
								          v-model="time1"
								          full-width
								          @click:minute="$refs.menu1.save(time1)"
								        ></v-time-picker>
								    </v-menu>
							    </v-col>
							</v-row>
		                </v-flex>
		                <v-flex xs12 sm6 md2 class="px-1">
							<v-row>
							    <v-col cols="11" sm="5">
								    <v-menu
								        ref="menu2"
								        v-model="menu2"
								        :close-on-content-click="false"
								        :nudge-right="40"
								        :return-value.sync="time2"
								        transition="scale-transition"
								        offset-y
								        full-width
								        max-width="290px"
								        min-width="290px"
								    >
								        <template v-slot:activator="{ on }">
								          <v-text-field
								            v-model="time2"
								            label="Hasta"
								            prepend-icon="access_time"
								            readonly
								            v-on="on"
								          ></v-text-field>
								        </template>
								        <v-time-picker
								          v-if="menu2"
								          v-model="time2"
								          full-width
								          @click:minute="$refs.menu2.save(time2)"
								        ></v-time-picker>
								    </v-menu>
							    </v-col>
							</v-row>
		                </v-flex>
		            </v-layout>  
				</v-card>
				<br>
				<v-card class="px-5">
					<br>
					<v-layout>
		                <span class="title">Periodos de paralización</span>
		            </v-layout>
              		<v-layout>
                		<v-flex xs4 class="px-1">
                  			<!-- <v-text-field  v-model="editedItem.desde" label="Desde"></v-text-field> -->
							<v-col cols="12" lg="6">
						        <v-menu
						          v-model="menu3"
						          :close-on-content-click="false"
						          transition="scale-transition"
						          offset-y
						          full-width
						          max-width="290px"
						          min-width="290px"
						        >
						          <template v-slot:activator="{ on }">
						            <v-text-field
						              v-model="paralization_from"
						              label="Desde"
						              persistent-hint
						              prepend-icon="event"
						              readonly
						              v-on="on"
						            ></v-text-field>
						          </template>
						          <v-date-picker v-model="paralization_from" no-title @input="menu3 = false"></v-date-picker>
						        </v-menu>
						    </v-col>


                		</v-flex>
                		<v-flex xs4 class="px-1">
                  			<!-- <v-text-field  v-model="editedItem.desde" label="Hasta"></v-text-field>    -->
							<v-col cols="12" lg="6">
						        <v-menu
						          v-model="menu4"
						          :close-on-content-click="false"
						          transition="scale-transition"
						          offset-y
						          full-width
						          max-width="290px"
						          min-width="290px"
						        >
						          <template v-slot:activator="{ on }">
						            <v-text-field
						              v-model="paralization_to"
						              label="Hasta"
						              persistent-hint
						              prepend-icon="event"
						              readonly
						              v-on="on"
						            ></v-text-field>
						          </template>
						          <v-date-picker v-model="paralization_to" no-title @input="menu4 = false"></v-date-picker>
						        </v-menu>
						    </v-col>
                		</v-flex>
                		<v-flex xs1>
                		</v-flex>
                		<v-flex xs4>
                			<v-btn @click="saveItem" class="ma-2" tile outlined color="main_green">Ingresar Paralización</v-btn>	
                		</v-flex>
                	</v-layout>	
		            <br>
		            <v-layout>
		            	<v-flex xs12>
  								<v-data-table dense 
  									:headers="headers" 
  									:items="paralizations" 
  									item-key="name" 
  									class="elevation-1"
  								>	
  								<template v-slot:items="props">
		                            <tr @click="showAlert(props.item)">
		                                <td class="text-xs-left">{{ props.item.date_from }}</td>
		                                <td class="text-xs-left">{{ props.item.date_to }}</td>
		                                <td class="text-xs-left"></td>
		                            </tr>
		                        </template>
  								</v-data-table>
		            	</v-flex>
		            </v-layout>
		            <br>	
				</v-card>


    			</v-container>  
      		</v-card>
    	</v-dialog>
  	</v-layout>
</template>


<script>
  export default {
    data () {
      return {
        dialog: true,

        time1: null,
        time2: null,

        menu1: false,
        menu2: false,
        menu3: false,
        menu4: false,
       
		headers:[ 
          	{ text: 'Fecha Inicio', value: 'date_from' },
          	{ text: 'Fecha Fin', value: 'date_to' },
          	{ text: 'Nro.Dias', value: 'count' },
          	],

		paralizations:[],
		paralization_to:"",
		paralization_from:"",
		day_from: "",
		day_to: "",
		
        dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves','Viernes', 'Sabado', 'Domingo'],

        fuel_ene: 0,
        fuel_feb: 0,
        fuel_mar: 0,
        fuel_abr: 0,
        fuel_may: 0,
        fuel_jun: 0,
        fuel_jul: 0,
        fuel_ago: 0,
        fuel_sep: 0,
        fuel_oct: 0,
        fuel_nov: 0,
        fuel_dic: 0,
      }
    },

    created () {
      this.initialize()
    },

    methods: {
      	initialize () {
      		var app = this;
            axios.get('/api//consumption/bysource')
                .then(function (resp) { 
                   
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

            axios.get('/api/paralization/bysource')
                .then(function (resp) {    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

            axios.get('api/operatingcicle/bysource')
                .then(function (resp) {    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });
      	},
	    deleteItem (item) {
	        const index = this.paralizations.indexOf(item)
	        confirm('Are you sure you want to delete this item?') && this.paralizations.splice(index, 1)
	    },
	    saveItem () {
	    	var item = {'declaration_id':1  ,'source_id':1, 'date_from':this.paralization_from, 'date_to':this.paralization_to};

	        this.paralizations.push(item);
	    },

    }
  }
</script>