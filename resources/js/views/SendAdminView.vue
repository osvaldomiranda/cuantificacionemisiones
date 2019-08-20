<template>
  <div>
    <v-card>
        
<!--         <v-img :src="require('/Users/osvaldo/cuantificacion_emisiones/resources/assets/images/logo138.png')"  
          aspect-ratio="6"
        ></v-img> -->
    </v-card>

        <v-card>
          <v-container
            id="grid"
            fluid
            grid-list-sm
            tag="section"
          >
            <v-layout row wrap>
              <v-flex xs6 tag="h4" >Usuario: {{ $store.getters.user['name'] }}</v-flex>

              <v-flex xs12 sm6 d-flex>
                <v-select
                  :items="items"
                  label="Region"
                ></v-select>
              </v-flex>

            </v-layout>
            
          </v-container>
        </v-card>


    <v-toolbar flat color="success">
      <v-toolbar-title class="white--text">Administración de Declaraciones</v-toolbar-title>
    </v-toolbar>


    <v-toolbar flat color="white">
        <v-toolbar-title></v-toolbar-title>


            <router-link to="/">
                <v-btn small color="success">
                  <span>Cambiar estado</span>
                </v-btn>
            </router-link>
    </v-toolbar>


    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
      hide-actions
    >
      <template v-slot:items="props">
        <td>
        <v-checkbox
          v-model="props.selected"
          primary
          hide-details
        ></v-checkbox>
        </td>
        <td class="text-xs-right">{{ props.item.type }}</td>
        <td class="text-xs-right">{{ props.item.date }}</td>
        <td class="text-xs-right">{{ props.item.region }}</td>
        <td class="text-xs-right">{{ props.item.commune }}</td>
        <td class="text-xs-right">{{ props.item.register_id }}</td>
        <td class="text-xs-right">{{ props.item.establishment }}</td>
        <td class="text-xs-right">{{ props.item.rut }}</td>
        <td class="text-xs-right">{{ props.item.status }}</td>

        <td class="justify-center layout px-0"> 
            <v-btn small @click="" color="success">Bitacora</v-btn>
        </td>   
        
        <td class="text-xs-right">{{ props.item.source_count }}</td>

        <td class="justify-center layout px-0">
            <v-btn  small @click="" color="success">PDF</v-btn>  

            <v-btn small @click="" color="success">Analizar</v-btn>
                  
            <v-btn small @click="" color="success">Observaciones</v-btn>
        </td>   

      </template>
    </v-data-table>


  </div>




</template>

<script>
  export default {
    data: () => ({
        dialog: false,
        dialog2: false,
        region:'Todas',
        items: ['Todas',
        'I de Tarapacá (Capital: Iquique)',
        'II de Antofagasta (Capital: Antofagasta)',
        'III de Atacama (Capital: Copiapó)',
        'IV de Coquimbo (Capital: Coquimbo)',
        'V de Valparaíso (Capital: Valparaíso)',
        'VI del Libertador General Bernardo O’Higgins (Capital: Rancagua)',
        'VII del Maule (Capital: Talca)',
        'VIII de Concepción (Capital: Concepción)',
        'IX de la Araucanía (Capital: Temuco)',
        'X de Los Lagos (Capital: Puerto Montt)',
        'XI de Aysén del General Carlos Ibañez del Campo (Capital: Coyhiaique)',
        'XII de Magallanes y de la Antártica Chilena (Capital: Punta Arenas)',
        'Metropolitana de Santiago (Capital:)',
        'XIV de Los Ríos (Capital: Valdivia)',
        'XV de Arica y Parinacota (Capital: Arica)',
        'XVI del Ñuble (Capital: Chillán)',
        ],
        headers: [

            { text: 'Tipo', value: 'type' }, 
            { text: 'Fecha', value: 'date' },            
            { text: 'Región', value: 'region' },
            { text: 'Comuna', value: 'commune' },
            { text: 'Nro.Registro', value: 'register_id' },
            { text: 'Establecimiento', value: 'stablishment' },
            { text: 'Rut', value: 'rut' },
            { text: 'Estado', value: 'status' },
            { text: 'Bitacora', value: 'binnacle' },
            { text: 'Fuentes', value: 'source_count' },
            { text: 'Acciones', value: '' },
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
                type: 'D.S 138',
                date: '01/01/2017',
                region: 'Región Metropolitana de Santiago',
                commune: 'Quilicura',
                register_id: 'EIND017412-2(5466569)',
                establishment: 'SENSU CHILE S.A.',
                rut: '96439654-9',
                status: 'En Desarrollo',
                source_count: 2
            },
            {
                type: 'D.S 138',
                date: '01/01/2018',
                region: 'Región Metropolitana de Santiago',
                commune: 'Quilicura',
                register_id: 'EIND017412-2(5466569)',
                establishment: 'SENSU CHILE S.A.',
                rut: '96439654-9',
                status: 'Enviada',
                source_count: 12
            },
            {
                type: 'D.S 138',
                date: '01/01/2019',
                region: 'Región Metropolitana de Santiago',
                commune: 'Quilicura',
                register_id: 'EIND017412-2(5466569)',
                establishment: 'SENSU CHILE S.A.',
                rut: '96439654-9',
                status: 'Rechada',
                source_count: 5
            },
        ]
      },
    }
  }
</script>