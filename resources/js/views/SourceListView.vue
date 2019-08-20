<template>
  <div>


          <v-card color="main_green" class="redondeado">
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
                    <!-- {{ $store.getters.user['name'] }}  -->
                  </v-flex>
                  <v-flex>
                    <h4 style="color: #fff" class="listado_text">Nombre Establecimiento</h4>
                    <!-- {{ $store.getters.establishment['name'] }} -->
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
          </v-card>



            <v-layout row>
                <v-flex xs1>

                    <v-btn @click= "sourceRefresh" >Actualizar Fuentes</v-btn>

                </v-flex>
            </v-layout>    


    <v-dialog v-model="dialog"  hide-overlay transition="dialog-bottom-transition">  

        <v-card>
          <v-card-title>
            <span class="headline">Tipo Fuente: {{editedItem.source_type_name}}</span> 
          </v-card-title>


          <v-card-text>

            <v-btn v-if=" editedItem.raw_material!='' " color="blue darken-1" flat @click="abatimiento">Abatimientos</v-btn>


            <v-container grid-list-md>
            

                <v-layout row>
                    <span class="title">Consumos mensuales</span>
                </v-layout>

                <v-layout row>

                    <v-flex xs12 sm6 md3>
                        <v-text-field readonly='true' v-model="editedItem.primary_fuel_name" label="Combustible"></v-text-field>
                </v-flex>              
                <v-flex xs12 sm6 md3>
                  <v-text-field readonly='true' v-model="editedItem.nominal_consume_unity" label="Unidad"></v-text-field>
                </v-flex>  
              </v-layout>

              <v-layout row>

                
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Ene"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Feb"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Mar"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Abr"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="May"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Jun"></v-text-field>
                  </v-flex>
              </v-layout>
              <v-layout row>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Jul"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Ago"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Sep"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Oct"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Nov"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Dic"></v-text-field>
                  </v-flex>
                </v-layout>
                
                <v-layout row>
                  <span v-if=" editedItem.product!='' "  class="title">Consumos Materias Primas</span>
                </v-layout>

                <v-layout wrap roe>
                  <v-flex v-if=" editedItem.raw_material!='' "  xs12 sm6 md3>
                    <v-text-field v-if=" editedItem.raw_material!='' " readonly='true' v-model="editedItem.raw_material" label="Materias Primas"></v-text-field>
                  </v-flex>
                  <v-flex v-if=" editedItem.raw_material!='' "  xs12 sm6 md3>
                    <v-text-field v-if=" editedItem.raw_material!='' "  readonly='true' v-model="editedItem.raw_material_unit" label="Unidad"></v-text-field>
                  </v-flex>
                </v-layout>  

              <v-layout row>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Ene"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Feb"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Mar"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Abr"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="May"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Jun"></v-text-field>
                  </v-flex>
              </v-layout>
              <v-layout row>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Jul"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Ago"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Sep"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Oct"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Nov"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Dic"></v-text-field>
                  </v-flex>
                </v-layout>


                <v-layout row>
                  <span v-if=" editedItem.product!='' "  class="title">Producción Mensual</span>
                </v-layout>

                <v-layout row>
                  <v-flex v-if=" editedItem.product!='' "  xs12 sm6 md3>
                    <v-text-field v-if=" editedItem.product!='' "  readonly='true' v-model="editedItem.product" label="Producto"></v-text-field>
                  </v-flex>
                  <v-flex v-if=" editedItem.product!='' "  xs12 sm6 md3>
                    <v-text-field v-if=" editedItem.product!='' "   readonly='true' v-model="editedItem.pruduction_unit" label="Unidad"></v-text-field>
                  </v-flex>
                </v-layout>

              <v-layout row>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Ene"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Feb"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Mar"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Abr"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="May"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Jun"></v-text-field>
                  </v-flex>
              </v-layout>
              <v-layout row>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Jul"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Ago"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Sep"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Oct"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Nov"></v-text-field>
                  </v-flex>
                  <v-flex xs1>
                    <v-text-field v-if=" editedItem.product!='' "  v-model="editedItem.fuel_consume" label="Dic"></v-text-field>
                  </v-flex>
                </v-layout>

              <span class="title">Periodos de Paralización</span>
              <v-layout wrap row>
                <v-flex xs12 sm6 md2>
                  <v-text-field  v-model="editedItem.desde" label="Desde"></v-text-field>   
                </v-flex>
                <v-flex xs12 sm6 md2>
                  <v-text-field  v-model="editedItem.desde" label="Hasta"></v-text-field>   
                </v-flex>


                <v-flex xs1>                  
                </v-flex>


              </v-layout> 
              <span class="title">Ciclo de Funcionamiento semanal</span>
              <v-layout wrap row>
                <v-flex xs12 sm6 md2>
                    <v-select
                        :items="dias"
                        label="Día Desde"
                    ></v-select> 
                </v-flex>
                <v-flex xs12 sm6 md2>
                    <v-select
                        :items="dias"
                        label="Día Hasta"
                    ></v-select>   
                </v-flex>
                <v-flex xs12 sm6 md2>
                  <v-text-field  v-model="editedItem.horadesde" label="Hora Desde"></v-text-field>   
                </v-flex>
                <v-flex xs12 sm6 md2>
                  <v-text-field  v-model="editedItem.horahasta" label="Hora Hasta"></v-text-field>   
                </v-flex>
              </v-layout>  

            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="close">Cerrar</v-btn>
            <v-btn v-if=" editedItem.state == 'PENDIENTE' " color="blue darken-1" flat @click="save">Cuardar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>


      <v-dialog v-model="dialog2" max-width="500px">

        <v-card>
          <v-card-title>
            <span class="headline">Abatimientos</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>
              <v-flex xs12 sm6 md4>
                <p>PEL: 98%</p>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <p>FM: 98%</p>
              </v-flex>
              
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="cerrar_abatimiento">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
 


    <v-toolbar v-if="general.length > 0" color="main_green" dark>
      <v-toolbar-title >Fuentes de uso general</v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
      v-if="general.length > 0" 
    >
      <template v-slot:items="props">
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.register_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.brand }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.internal_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.origin_data }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="justify-center layout px-0">
            <register v-if= "props.item.state=='PENDIENTE'"></register>

            <v-btn v-if= "props.item.state=='ACTIVO'" small @click="editItem(props.item)" color="main_green" outline  
            > Registrado
              <v-icon right>check</v-icon>
            </v-btn>
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
        
        <discharge></discharge>
        
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

        <td small @click="editItem(props.item)" color="main_green" dark>Registrar Consumo</v-btn>
 <!--            <v-btn v-if= "props.item.state=='ACTIVO'" small @click="editItem(props.item)" color="main_green" outline  
            > Registrado
              <v-icon right>check</v-icon>
            </v-btn> -->
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
        <v-toolbar-title>Producción de Celulosa</v-toolbar-title>
        <v-spacer></v-spacer>
        <production></production>
    </v-toolbar>


    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
      v-if="transformMp.length > 0" 
    >
        <template v-slot:items="props">
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.source_type_name }}</td>
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.register_number }}</td>
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.brand }}</td>
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.internal_number }}</td>
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.origin_data }}</td>
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.ccf8 }}</td>
            <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="justify-center layout px-0">
                <v-btn v-if= "props.item.state=='PENDIENTE'" small @click="editItem(props.item)" color="main_green" dark>Registrar Consumo</v-btn>
                <v-btn v-if= "props.item.state=='ACTIVO'" small @click="editItem(props.item)" color="main_green" outline  
                > Registrado
                <v-icon right>check</v-icon>
                </v-btn>
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
      :items="desserts"
      class="elevation-1"
      v-if="pda.length > 0"
    >
      <template v-slot:items="props">
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.register_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.brand }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.serial_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.internal_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.origin_data }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="justify-center layout px-0">
            <v-btn v-if= "props.item.state=='PENDIENTE'" small @click="editItem(props.item)" color="main_green" dark>Registrar Consumo</v-btn>
            <v-btn v-if= "props.item.state=='ACTIVO'" small @click="editItem(props.item)" color="main_green" outline  
            > Registrado
              <v-icon right>check</v-icon>
            </v-btn>
        </td>    
      </template>
    </v-data-table>


    <router-link to="/graphics">
        <v-btn color="main_green" dark round>
          Siguiente
          <v-icon right>arrow_forward</v-icon>
        </v-btn>
    </router-link>
    

  </div>
</template>

<script>
  export default {
    data: () => ({
        dialog: false,
        dialog2: false,
        dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves','Viernes', 'Sabado', 'Domingo'],
        headers: [

            { text: 'Tipo de Fuente', value: 'source_type_name' },            
            { text: 'Nº registro', value: 'register_number' },
            { text: 'Marca', value: 'brand' },
            { text: 'Nº Interno', value: 'internal_number' },
            { text: 'Origen del Dato', value: 'origin_data' },
            { text: 'CCF8', value: 'ccf8' },

        ],
        energy:[],
        general:[],
        pda:[],
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
      this.initialize()
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

        axios.get('/api/sources/byprocess?process=GENERAL_PURPOSE')
            .then(function (resp) {    
                app.general = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });

        axios.get('/api/sources/byprocess?process=PDA')
            .then(function (resp) {    
                app.pda = resp.data;
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

        axios.get('/api/diagram/refresh')
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
      }

    }
  }
</script>
