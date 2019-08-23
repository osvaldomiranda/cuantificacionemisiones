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


        <v-flex xs12> 

            
            <v-card  color="main_green" style="border-radius:0px;">
                <v-card-title class="mx-2 white--text" style="padding: 10px;">
                    <h5 style="font: #FFF">DECLARACIONES DEL ESTABLECIMIENTO</h5>
                </v-card-title>
            </v-card>

            <v-data-table
              :headers="headers"
              :items="declarations"
              class="elevation-1"
              hide-actions
            >
              <template v-slot:items="props">

                <td class="text-xs-right">{{ props.item.period }}</td>
                <td class="text-xs-right">{{ props.item.type }}</td>
                <td class="text-xs-right">{{ props.item.created_at }}</td>
                <td class="text-xs-right">{{ props.item.state }}</td>
                <td class="justify-center layout px-0">
   

                    <v-btn flat @click='toDeclaration(props.item)' small color="side_bar_gray">
                        Editar
                        <v-icon color="side_bar_gray" right dark>edit</v-icon>
                    </v-btn>
                      
                </td>   

              </template>
            </v-data-table>

            <v-layout>
                <v-flex xs4>
                    <v-btn @click='new138' round color="main_green" class="white--text px-4">Nueva Declaración D.S 138</v-btn>
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
<!--         <v-flex xs4 class="px-1"> 
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
              <v-flex xs6 tag="h4" >{{ JSON.stringify(this.$store.getters.token) }}</v-flex>
                  <v-flex xs6 tag="h4" >Usuario: {{ $store.getters.user['name'] }}</v-flex>
                  <v-flex xs6 tag="h4" >Establecimiento: {{ $store.getters.establishment['name'] }}</v-flex>
                </v-layout>
                
              </v-container>
            </v-card>     
        </v-flex> -->

    <div ref="container">
    </div>   
    </v-layout>    

</template>

<script>
  import Vue from 'vue'; 
  import SourceList  from './../views/SourceListView';
  export default {
    data: () => ({
        dialog: false,
        dialog2: false,
        headers: [

            { text: 'Periodo declaración', value: 'reporting_period' }, 
            { text: 'Tipo', value: 'type' },            
            { text: 'Fecha Declaración', value: 'report_date' },
            { text: 'Estado', value: 'state' },
        ],
      declarations: [],
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

        var app = this;

        axios.get('/api/declarations?establishment_id=1')
            .then(function (resp) {    
                app.declarations = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });


      },
      new138(){
        var app = this;

        axios.post('/api/declaration/new?establishment_id=1&type=DS138')
            .then(function (resp) {    
                app.declaration = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });

        axios.get('/api/declarations?establishment_id=1')
            .then(function (resp) {    
                app.declarations = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });

      },
      toDeclaration (a){
            var Graphics = Vue.extend(SourceList)
            var instance = new Graphics({store: this.$store, propsData: {
            declaration: a,
          }});
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        },
    }
  }
</script>