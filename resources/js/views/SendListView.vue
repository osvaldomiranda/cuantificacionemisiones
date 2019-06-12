<template>
  <div>
    <v-card>
        
        <v-img :src="require('/Users/osvaldo/cuantificacion_emisiones/resources/assets/images/logo138.png')"  
          aspect-ratio="6"
        ></v-img>
    </v-card>

		<v-card>
		  <v-container
		    id="grid"
		    fluid
		    grid-list-sm
		    tag="section"
		  >
		    <v-layout row wrap>
          <v-flex xs6 tag="h4" >{{ JSON.stringify(this.$store.getters.token) }}</v-flex>
		      <v-flex xs6 tag="h4" >Usuario: {{user.name}}</v-flex>
		      <v-flex xs6 tag="h4" >Establecimiento: {{company.name}}</v-flex>
		    </v-layout>
		    
		  </v-container>
		</v-card>


    <v-toolbar flat color="success">
      <v-toolbar-title class="white--text">Declaraciones del establecimiento</v-toolbar-title>
    </v-toolbar>
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
        	<v-btn v-if= "props.item.report_date!=''" small @click="" color="success">Ver Detalle</v-btn>  
        	<router-link
        		to="/source_list"
    		>
        		<v-btn v-if= "props.item.report_date==''" small @click="" color="success">Editar declaracion</v-btn>
        	</router-link>       
        </td>	

      </template>
    </v-data-table>

    <router-link
        to="/source_list"
    >
		<v-btn small color="success">Editar declaración D.S 138</v-btn>
	</router-link>
    <router-link
        to="/source_list"
    >
		<v-btn  small color="success">Nueva declaración RES 15027</v-btn>	
	</router-link>
  </div>
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
 				type: 'D.S. 138',
 				user: 'Ignacio Saravia',
        	},
        	{
 				reporting_period: 2018,
 				report_date: '01/01/2016',
 				state: 'Aceptada',
 				type: 'D.S. 138',
 				user: 'Ignacio Saravia',
        	},
        	{
 				reporting_period: 2019,
 				report_date: '',
 				state: 'En Proceso',
 				type: 'D.S. 138',
 				user: 'Ignacio Saravia',
        	},
        ]
      },
    }
  }
</script>