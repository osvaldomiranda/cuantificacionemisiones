<template>
    <v-layout row>
        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card color="#EEEEEE">
                <v-toolbar dark color="ds_138">
                    <v-btn icon dark @click="dialog = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Registrar consumos y niveles de actividad</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn flat class="white--text"  @click="save_all">Guardar</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <br>
                <v-container>

        <div>


<!--           <v-card color="main_green" class="redondeado">
            <v-layout justify-center class="pa-2 ma-2">
              <v-flex xs4>
                <v-layout align-start justify-center column fill-height class="py-2">
                  <h3 style="color: #fff">Listado de Fuentes a declarar</h3>
                </v-layout>
              </v-flex>
              <v-flex sm3>
                <v-layout align-start justify-center column>
                  <v-flex>
                    <h5 style="color: #fff" class="listado_text">Usuario</h5>
                  </v-flex>
                  <v-flex>
                    <h4 style="color: #fff" class="listado_text">Nombre Apellido</h4>
                  </v-flex>
                </v-layout>
              </v-flex>
              <v-flex sm3>
                <v-layout align-start justify-center column>
                  <v-flex>
                    <h5 style="color: #fff" class="listado_text">Establecimiento</h5>
                    {{ $store.getters.user['name'] }} 
                  </v-flex>
                  <v-flex>
                    <h4 style="color: #fff" class="listado_text">Nombre Establecimiento</h4>
                    {{ $store.getters.establishment['name'] }}
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
          </v-card>  -->



            <v-layout row>
                <v-flex xs1>

                    <v-btn @click= "sourceRefresh" >Actualizar Fuentes</v-btn>

                </v-flex>
            </v-layout>    
 


    <v-toolbar v-if="general.length > 0" color="main_green" dark>
      <v-toolbar-title >Fuentes de uso general</v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="general"
      class="elevation-1"
      v-if="general.length > 0" 
    >
      <template v-slot:items="props">
        <td class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td class="text-xs-right">{{ props.item.register_number }}</td>
        <td class="text-xs-right">{{ props.item.brand }}</td>
        <td class="text-xs-right">{{ props.item.internal_number }}</td>
        <td class="text-xs-right">{{ props.item.origin_data }}</td>
        <td class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td class="text-xs-right">{{ props.item.process }}</td>
        <td class="justify-center layout px-0">
            <v-btn  v-if="props.item.state=='ACTIVO'" small @click="consumptionClick(props.item)" color="ds_138" dark>Registrar Consumo</v-btn>
 
             <v-btn  v-if="props.item.state!='ACTIVO'" small @click="consumptionClick(props.item)" color="main_green" dark>Ver Registro</v-btn>
        </td>   

      </template>
    </v-data-table>

    <v-layout row>
        <v-flex xs1>
            <p></p>
        </v-flex>
    </v-layout> 


    <v-toolbar v-if="energy.length > 0" color="main_green" dark>
        <v-toolbar-title>Fuentes Generación de Energía y Vapor</v-toolbar-title>
        <v-spacer></v-spacer> 
        <discharge key="ENERGY" title='Ir a Diagrama de Descarga'></discharge>
<!--         <v-spacer></v-spacer> 
        <v-btn color="secondary_green" @click='toProduction' >Registrar Prodiucción</v-btn> -->
    </v-toolbar>


    <v-data-table
      :headers="headers"
      :items="energy"
      class="elevation-1"
      v-if="energy.length > 0"
    >
      <template v-slot:items="props">
        <td class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td class="text-xs-right">{{ props.item.register_number }}</td>
        <td class="text-xs-right">{{ props.item.brand }}</td>
        <td class="text-xs-right">{{ props.item.internal_number }}</td>
        <td class="text-xs-right">{{ props.item.serial_number }}</td>
        <td class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td class="text-xs-right">{{ props.item.process }}</td>

        <td> 
            <v-btn  v-if="props.item.state=='ACTIVO'" small @click="consumptionClick(props.item)" color="ds_138" dark>Registrar Consumo</v-btn>
 
             <v-btn  v-if="props.item.state!='ACTIVO'" small @click="consumptionClick(props.item)" color="main_green" dark>Ver Registro</v-btn>
        </td>   
      </template>
    </v-data-table>


    <v-layout row>
        <v-flex xs1>
            <p></p>
        </v-flex>
    </v-layout> 

    
      
    
    <v-toolbar v-if="transformMp.length > 0"  color="main_green" dark>
        <v-toolbar-title>Procesos con Transformación de Materia Prima</v-toolbar-title>
    </v-toolbar>

    <v-toolbar v-if="transformMp.length > 0"  color="secondary_green" dark>
        <v-toolbar-title>{{this.process.name}}</v-toolbar-title>
        <v-spacer></v-spacer> 
        <discharge :key= "this.process.name" title='Ir a Diagrama de Descarga'></discharge>
        <v-spacer></v-spacer>
        <v-btn @click='toProduction' color="secondary_green">Registrar Produción</v-btn>
    </v-toolbar>


    <v-data-table
      :headers="headers"
      :items="transformMp"
      class="elevation-1"
      v-if="transformMp.length > 0" 
    >
        <template v-slot:items="props">
        <td class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td class="text-xs-right">{{ props.item.register_number }}</td>
        <td class="text-xs-right">{{ props.item.brand }}</td>
        <td class="text-xs-right">{{ props.item.internal_number }}</td>
        <td class="text-xs-right">{{ props.item.serial_number }}</td>
        <td class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td class="text-xs-right">{{ props.item.process }}</td>

        <td v-if='props.item.ccf8'> 
            <v-btn  v-if="props.item.state=='ACTIVO'" small @click="consumptionClick(props.item)" color="ds_138" dark>Registrar Consumo</v-btn>
 
             <v-btn  v-if="props.item.state!='ACTIVO'" small @click="consumptionClick(props.item)" color="main_green" dark>Ver Registro</v-btn>
        </td>  
        </template>
    </v-data-table>


    <v-layout row>
        <v-flex xs1>
            <p></p>
        </v-flex>
    </v-layout> 

    <v-toolbar v-if="pda.length > 0" color="main_green" dark>
      <v-toolbar-title>Fuentes Plan de Descontaminación</v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="pda"
      class="elevation-1"
      v-if="pda.length > 0"
    >
      <template v-slot:items="props">
        <td class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td class="text-xs-right">{{ props.item.register_number }}</td>
        <td class="text-xs-right">{{ props.item.brand }}</td>
        <td class="text-xs-right">{{ props.item.internal_number }}</td>
        <td class="text-xs-right">{{ props.item.serial_number }}</td>
        <td class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td class="text-xs-right">{{ props.item.process }}</td>

        <td v-if='props.item.ccf8'> 
            <v-btn  v-if="props.item.state=='ACTIVO'" small @click="consumptionClick(props.item)" color="ds_138" dark>Registrar Consumo</v-btn>
 
             <v-btn  v-if="props.item.state!='ACTIVO'" small @click="consumptionClick(props.item)" color="main_green" dark>Ver Registro</v-btn>
        </td>     
      </template>
    </v-data-table>


  
    <v-btn @click="toFactors" color="main_green" dark round>
      Siguiente
      <v-icon right>arrow_forward</v-icon>
    </v-btn>
  
    

    <div ref="container">
    </div>    

  </div>

            </v-container>  
            </v-card>
        </v-dialog>
    </v-layout>

</template>

<script>

  import { mapState } from 'vuex';  
  import Vue from 'vue';  
  import ConsumptionComponent  from './../components/ConsumptionComponent';
  import FactorsComponent  from './../components/FactorsComponent';
  import ProductionComponent  from './../components/ProductionComponent';
  import { EventBus } from './../eventbus.js';

  export default {
    props: {
        declaration: Object
    },
    data: () => ({
        dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves','Viernes', 'Sabado', 'Domingo'],
        headers: [

            { text: 'Tipo de Fuente', value: 'source_type_name' },            
            { text: 'Nº registro', value: 'register_number' },
            { text: 'Marca', value: 'brand' },
            { text: 'Nº Interno', value: 'internal_number' },
            { text: 'Origen del Dato', value: 'origin_data' },
            { text: 'CCF8', value: 'ccf8' },

        ],
        dialog: true,
        energy:[],
        general:[],
        pda:[],
        process:'',
        transformMp:[],
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
        editedItem: {
            source_id:0,
            name: '',
            kva: 0,
            register_number: 0,
            model: '',
            brand: '',
            serial_number: 0,
            internal_number: 0,
            nominal_consume: 0,
            nominal_consume_unity: '',
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 0,
            primary_fuel_id: 0,
            primary_fuel_name: '',
            establishment_id: 0,
            state:'ACTIVO',
            ccf8:'',
            fuel_consume:0,
            raw_material_consume: 0,
            aw_material_unit: '',
            production:0,
            pruduction_unit: '',
            origin_data:'',
            horahasta:'23:59',
            horadesde:'00:00',
        },
        defaultItem: {
            source_id:0,
            name: '',
            kva: 0,
            register_number: 0,
            model: 0,
            brand: '',
            serial_number: 0,
            internal_number: 0,
            nominal_consume: 0,
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 0,
            primary_fuel_id: 0,
            primary_fuel_name: '',
            establishment_id: 0,
            state:'ACTIVO',
            ccf8:'',
            fuel_consume:0,
            raw_material_consume: 0,
            aw_material_unit: '',
            production:0,
            pruduction_unit: '',
            origin_data:''
        }
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      }
    },

    created () {
        var app = this;
        this.initialize();

        EventBus.$on('clickedChild', function(){    
            app.initialize();
        });
    },

    methods: {
        initialize () {

            var app = this;
            axios.get('/api/sources/byprocess?process=ENERGY')
                .then(function (resp) {    
                    app.energy = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });   
            axios.get('/api/sources/byprocess?process=GENERAL_USE')
                .then(function (resp) {   
                    app.general = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });  
            axios.get('/api/sources/byprocess?process=PDA')
                .then(function (resp) {  
                    // alert(JSON.stringify(resp.data));  
                    app.pda = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

            axios.get('/api/sources/byprocess?process=OTHERS')
                .then(function (resp) { 
                    app.transformMp = resp.data; 
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

            axios.get('/api/sources/process')
                .then(function (resp) { 
                    app.process = resp.data;
                    alert(JSON.stringify(resp.data));
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

        },

        editItem (item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem (item) {
            const index = this.desserts.indexOf(item)
            confirm('Are you sure you want to delete this item?') && this.desserts.splice(index, 1)
        },

        abatimiento(){
            this.dialog2 = true
        },

        cerrar_abatimiento(){
            this.dialog2 = false
        },

        close () {
            this.dialog = false
            setTimeout(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
            }, 300)
        },

        save () {
            if (this.editedIndex > -1) {
              Object.assign(this.desserts[this.editedIndex], this.editedItem)
            } else {
              this.desserts.push(this.editedItem)
            }
            this.close()
        },

        sourceRefresh (){
            axios.get('/api/sources/refresh')
                .then(function (resp) {    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });
            
            axios.get('/api/diagram/refresh')
                .then(function (resp) {    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });
        },
        consumptionClick (a){
            var ComponentReserv = Vue.extend(ConsumptionComponent)
            var instance = new ComponentReserv({store: this.$store, propsData: {
            source: a,
             
          }});
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        },
        toFactors (a){
            this.dialog = false;
            var Graphics = Vue.extend(FactorsComponent)
            var instance = new Graphics({store: this.$store, propsData: {
            declaration: this.declaration,
             
          }});
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        },
        toProduction (){
            this.dialog = false;
            var Graphics = Vue.extend(ProductionComponent)
            var instance = new Graphics({store: this.$store, propsData: {
            declaration: this.declaration, process: this.process.name
          }});
            instance.$mount();
            this.$refs.container.appendChild(instance.$el);
        },
    }
}
</script>
