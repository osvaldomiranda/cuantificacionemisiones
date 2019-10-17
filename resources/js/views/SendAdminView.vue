<template>
  <div>
    <v-card>
        <!--<v-img :src="require('/Users/Fran/Desktop/cuantificacionemisiones/resources/assets/images/logo138.png')"  
          aspect-ratio="6"
        ></v-img>-->
    </v-card>

        <v-card>
          <v-container
            id="grid"
            fluid
            grid-list-sm
            tag="section"
          >
            <v-layout row wrap>
              <!-- <v-flex xs6 tag="h4" >Usuario: {{ $store.getters.user['name'] }}</v-flex> -->

              <v-flex xs12 sm6 d-flex>
                <v-select
                  :items="items"
                  label="Region"
                ></v-select>
              </v-flex>

            </v-layout>
            
          </v-container>
        </v-card>


    <v-toolbar flat color="main_green">
      <v-toolbar-title class="white--text">Administración de Declaraciones</v-toolbar-title>
    </v-toolbar>

  

    <v-toolbar flat color="white">
        <v-toolbar-title></v-toolbar-title>
            <template>
              <v-row justify="center">
                <v-dialog v-model="dialog3" scrollable max-width="350px">
                  <template v-slot:activator="{ on }">
                    <v-btn color="main_green" dark v-on="on">Cambiar Estado</v-btn>
                  </template>
                  <v-card>
                    <v-card-title>Cambiar Estado</v-card-title>
                    <v-divider></v-divider>
                    <v-card-text style="height: 150px;">
                      <v-radio-group v-model="state" column>
                        <v-radio label="Aceptada" value="ACEPTADA"></v-radio>
                        <v-radio label="Rechazada" value="Rechazada"></v-radio>
                        <v-radio label="Aceptada con Obs." value="Aceptada con Obs."></v-radio>
                      </v-radio-group>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                      <v-btn color="main_green" dark @click="dialog3 = false">Cerrar</v-btn>
                      <v-btn color="main_green" dark @click="changeState">Cambiar Estado</v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-row>
            </template>

    </v-toolbar>



    <v-data-table
      v-model="selected"
      :headers="headers"
      :items="declarations"
      class="elevation-1"
      item-key="declaration.id"
      hide-actions
    >
      <template slot="items" slot-scope="props">
        <td>
        <v-checkbox
          v-model="props.selected"
          primary
          hide-details

        ></v-checkbox>
        </td>
        <td class="text-xs-right">{{ props.item.declaration.id }}</td>
        <td class="text-xs-right">{{ props.item.declaration.period }}</td>
        <td class="text-xs-right">{{ props.item.declaration.type }}</td>
        <td class="text-xs-right">{{ props.item.company.rut }}-{{ props.item.company.digit }}</td>
        <td class="text-xs-right">{{ props.item.establishment.name }}</td>
        <td class="text-xs-right">{{ props.item.commune.name }}</td>
<!--         <td class="text-xs-right">{{ props.item.establishment.region.name }}</td>  -->
        <td class="text-xs-right">{{ props.item.declaration.created_at}}</td>
        <td class="text-xs-right">{{ props.item.declaration.state }}</td>
        <td class="justify-center layout px-0"> 
            <v-btn small @click="toBinnacle(props.item.declaration)" dark color="main_green">Bitacora</v-btn>
        </td>   
        
        <td class="text-xs-right">{{ props.item.source_count }}</td>

        <td class="justify-center layout px-0">
            <v-btn small @click="toComment(props.item.declaration)" dark color="main_green">Observaciones</v-btn>
        </td>   

      </template>
    </v-data-table>


  </div>




</template>

<script>
  import Vue from 'vue';  
  import BinnacleComponent  from './../components/BinnacleComponent';
  import CommentComponent  from './../components/CommentComponent';

  export default {
    data: () => ({
        dialog: false,
        dialog2: false,
        dialog3: false,
        state:'ACEPTADA',
        selected:[],
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
            { text: ' ', value: 'type' }, 
            { text: 'Nro.', value: 'type' }, 
            { text: 'Periodo', value: 'date' },            
            { text: 'Tipo', value: 'region' },
            { text: 'Rut', value: 'commune' },
            { text: 'Establecimiento', value: 'stablishment' },
            { text: 'Comuna', value: 'rut' },
            { text: 'Región', value: 'rut' },
            { text: 'Fecha', value: 'rut' },
            { text: 'Estado', value: 'status' },
        ],
        desserts: [],
        declarations:[],

    }),

    computed: {

    },


    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        var app = this;
        axios.get('/api/declarationswith?establishment_id='+app.$store.getters.establishment.id)
            .then(function (resp) {    
                app.declarations = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });
      },
      toBinnacle (a){
            this.dialog = false;
            var Graphics = Vue.extend(BinnacleComponent)
            var instance = new Graphics({store: this.$store, propsData: {
            declaration: a,
             
          }});
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        },
      toComment (a){
            this.dialog = false;
            var Graphics = Vue.extend(CommentComponent)
            var instance = new Graphics({store: this.$store, propsData: {
            declaration: a,
             
          }});
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        },
        changeState (){
            var app = this;
            axios.post('/api/declarations/change?establishment_id='+app.$store.getters.establishment.id+'&state='+this.state+'&declarations='+JSON.stringify(this.selected))
                .then(function (resp) {    
                    app.declarations = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

        }
    }
  }
</script>