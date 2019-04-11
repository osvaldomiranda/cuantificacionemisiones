<style>
.v-dialog{
  overflow: visible;
}
</style>

<template>
  <div v-if="showModal">
  <v-layout row justify-center>
       <v-dialog v-model="showModal" max-width="1000px">
        <v-card>
          <v-card-title>
            <span class="headline">Registro Consumo y Producción</span>
            </br>
            <p>Tipo Fuente: {{editedItem.source_type_name}}--</p>
            <p>CCF8: {{editedItem.ccf8}}</p>
          </v-card-title>


          <v-card-text>

            <v-btn v-if=" editedItem.raw_material!='' " color="blue darken-1" flat @click="abatimiento">Abatimientos</v-btn>
            <v-container grid-list-md>
              <v-layout wrap>
                <v-flex xs12 sm6 md3>
                  <v-text-field readonly='true' v-model="editedItem.primary_fuel_name" label="Combustible"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md3>
                  <v-text-field v-model="editedItem.fuel_consume" label="Consumo Combustible"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md3>
                  <v-text-field readonly='true' v-model="editedItem.nominal_consume_unity" label="Unidad"></v-text-field>
                </v-flex>


                <v-flex v-if=" editedItem.raw_material!='' "  xs12 sm6 md3>
                  <v-text-field v-if=" editedItem.raw_material!='' " readonly='true' v-model="editedItem.raw_material" label="Materias Primas"></v-text-field>
                </v-flex>
                <v-flex v-if=" editedItem.raw_material!='' "  xs12 sm6 md3>
                  <v-text-field v-if=" editedItem.raw_material!='' "  v-model="editedItem.raw_material_consume" label="Consumo Materias Primas"></v-text-field>
                </v-flex>
                <v-flex v-if=" editedItem.raw_material!='' "  xs12 sm6 md3>
                  <v-text-field v-if=" editedItem.raw_material!='' "  readonly='true' v-model="editedItem.raw_material_unit" label="Unidad"></v-text-field>
                </v-flex>


                <v-flex v-if=" editedItem.product!='' "  xs12 sm6 md3>
                  <v-text-field v-if=" editedItem.product!='' "  readonly='true' v-model="editedItem.product" label="Producto"></v-text-field>
                </v-flex>
                <v-flex v-if=" editedItem.product!='' "  xs12 sm6 md3>
                  <v-text-field  v-if=" editedItem.product!='' "  v-model="editedItem.production" label="Produción"></v-text-field>
                </v-flex>
                <v-flex v-if=" editedItem.product!='' "  xs12 sm6 md3>
                  <v-text-field v-if=" editedItem.product!='' "   readonly='true' v-model="editedItem.pruduction_unit" label="Unidad"></v-text-field>
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

  </v-layout>

  </div>
</template>
<script>
  export default {
    data: () => ({
        showModal: false,
       
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
            source_type_name: 'Convertidor Teniente',
            source_id:0,
            name: '',
            kva: 0,
            register_number: 0,
            model: '',
            brand: '',
            serial_number: 0,
            internal_number: 0,
            nominal_consume: 0,
            nominal_consume_unity: 'Lt',
            first_statement_date: new Date().toISOString().substr(0, 10),
            incription_date: new Date().toISOString().substr(0, 10),
            manufacturing_year: 2019,
            installation_year: 2019,
            source_type_id: 0,
            primary_fuel_id: 0,
            primary_fuel_name: 'Petroleo 2',
            establishment_id: 0,
            state:'ACTIVO',
            ccf8:'34656677',
            fuel_consume:0,
            raw_material:'Concentrado de Cobre',
            raw_material_consume: 0,
            raw_material_unit: 'T',
            product:'Anodo de Cobre',
            production:0,
            pruduction_unit: 'T',
            origin_data:'',
            state: 'PENDIENTE'
        },
        defaultItem: {
            source_type_name: 'Convertidor Teniente',
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


          close () {
            this.showModal = false
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

        showSpecific(value,config){
            this.showModal = true
          
        },

    }
  }
</script>
