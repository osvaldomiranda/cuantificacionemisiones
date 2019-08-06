<template>
  <div>

        <v-card>
      <v-container
        id="grid"
        fluid
        grid-list-sm
        tag="section"
      >
        <v-layout row wrap>
          <v-flex xs6 tag="h4" >Usuario: {{ $store.getters.user['name'] }}</v-flex>
          <v-flex xs6 tag="h4" >Establecimiento: {{ $store.getters.establishment['name'] }}</v-flex>

        </v-layout>
        
      </v-container>
        </v-card>


      <!-- <v-dialog v-model="dialog" max-width="1200px"> -->

  

    <v-toolbar flat>
      <v-toolbar-title>Fuentes de uso general</v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.register_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.brand }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.internal_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.origin_data }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="justify-center layout px-0">

            <readingsnew></readingsnew>

        </td>   

      </template>
    </v-data-table>


    <v-toolbar flat>
        <v-toolbar-title>Fuentes Generación de Energía y Vapor</v-toolbar-title>
        <v-spacer></v-spacer> 
        
        <discharge></discharge>
        
    </v-toolbar>




    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.register_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.brand }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.internal_number }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.origin_data }}</td>
        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="text-xs-right">{{ props.item.ccf8 }}</td>

        <td v-if="props.item.source_type_name != 'Convertidor Teniente'" class="justify-center layout px-0">
            <readingsnew></readingsnew>
 
        </td>   
      </template>
    </v-data-table>


    <v-toolbar flat>
        <v-toolbar-title>Procesos con Transformación de Materia Prima</v-toolbar-title>
    </v-toolbar>
    <v-toolbar flat color="white">
        <v-toolbar-title>Producción de Celulosa</v-toolbar-title>

            
        <v-spacer></v-spacer> 
            <discharge></discharge>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
    >
      <template v-slot:items="props">
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.source_type_name }}</td>
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.register_number }}</td>
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.brand }}</td>
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.internal_number }}</td>
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.origin_data }}</td>
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="text-xs-right">{{ props.item.ccf8 }}</td>
        <td v-if="props.item.source_type_name == 'Convertidor Teniente'" class="justify-center layout px-0">
           <readingsnew></readingsnew>

        </td>   
      </template>
    </v-data-table>


    <v-toolbar flat>
      <v-toolbar-title>Fuentes Plan de Descontaminación</v-toolbar-title>
    </v-toolbar>
    <v-data-table
      :headers="headers"
      :items="desserts"
      class="elevation-1"
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
           <readingsnew></readingsnew>

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
        dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves','Viernes', 'Sabado', 'Domingo'],
        headers: [

            { text: 'Tipo de Fuente', value: 'source_type_name' },            
            { text: 'Nº registro', value: 'register_number' },
            { text: 'Marca', value: 'brand' },
            { text: 'Nº Interno', value: 'internal_number' },
            { text: 'Origen del Dato', value: 'origin_data' },
            { text: 'CCF8', value: 'ccf8' },

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
        this.desserts = [
            {
            source_id:345,
            name: 'Equipo 1',
            source_type_name: 'Grupo Electrógeno',
            kva: 1,
            register_number: 65465,
            model: 'Prueba',
            brand: 'Prueba',
            serial_number: 19384759,
            internal_number: 1,
            nominal_consume: 1,
            nominal_consume_unity: 'Lt',
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 1,
            primary_fuel_id: 1,
            primary_fuel_name: 'Bencina',
            establishment_id: 1,
            state:'PENDIENTE',
            ccf8:'34878670',
            fuel_consume:0,
            raw_material:'',
            raw_material_consume: 0,
            raw_material_unit: '',
            product:'',
            production:0 ,
            pruduction_unit: '',
            origin_data: ''

            },
            {
            source_id:345,
            name: 'Equipo 1',
            source_type_name: 'Grupo Electrógeno',
            kva: 1,
            register_number: 65465,
            model: 'Prueba',
            brand: 'Prueba',
            serial_number: 19384759,
            internal_number: 1,
            nominal_consume: 1,
            nominal_consume_unity: 'Lt',
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 1,
            primary_fuel_id: 1,
            primary_fuel_name: 'Bencina',
            establishment_id: 1,
            state:'PENDIENTE',
            ccf8:'34878670',
            fuel_consume:0,
            raw_material: '',
            raw_material_consume: 0 ,
            raw_material_unit: 'T',
            product:'',
            production:0,
            pruduction_unit: 'T',
            origin_data:''
            },
            {
            source_id:345,
            name: 'Equipo 1',
            source_type_name: 'Convertidor Teniente',
            kva: 1,
            register_number: 65465,
            model: 'Prueba',
            brand: 'Prueba',
            serial_number: 19384759,
            internal_number: 1,
            nominal_consume: 1,
            nominal_consume_unity: 'Lt',
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 1,
            primary_fuel_id: 1,
            primary_fuel_name: 'Petroleo 2',
            establishment_id: 1,
            state:'PENDIENTE',
            ccf8:'34878670',
            fuel_consume:5000,
            raw_material:'Concentrado Cobre',
            raw_material_consume:4345 ,
            raw_material_unit: 'T',
            product: 'Catodo de Cobre',
            production:23,
            pruduction_unit: 'T',
            origin_data:'SICTER'

            },
            {
            source_id:345,
            name: 'Equipo 1',
            source_type_name: 'Grupo Electrógeno',
            kva: 1,
            register_number: 65465,
            model: 'Prueba',
            brand: 'Prueba',
            serial_number: 19384759,
            internal_number: 1,
            nominal_consume: 1,
            nominal_consume_unity: 'Lt',
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 1,
            primary_fuel_id: 1,
            primary_fuel_name: 'Bencina',
            establishment_id: 1,
            state:'ACTIVO',
            ccf8:'34878670',
            fuel_consume:5000,
            raw_material:'',
            raw_material_consume:4345 ,
            aw_material_unit: 'T',
            product:'',
            production:23,
            pruduction_unit: 'T',
            origin_data:'DS13'
            },
        ]
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
      }
    }
  }
</script>
