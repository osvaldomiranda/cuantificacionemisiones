<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn small color="main_green" dark v-on="on">Registrar Consumo</v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="main_green">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Registro Consumo y Producción</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click="dialog = false">Guardar</v-btn>
          </v-toolbar-items>
        </v-toolbar>


        <v-container>
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
                <v-flex xs1 class="px-1">
                    <v-text-field v-model="editedItem.fuel_consume" label="Ene"></v-text-field>
                </v-flex>
                <v-flex xs1 class="px-1">
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
                <v-flex xs1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Jul"></v-text-field>
                </v-flex>
                <v-flex xs1 sm1 md1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Ago"></v-text-field>
                </v-flex>
                <v-flex xs1 sm1 md1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Sep"></v-text-field>
                </v-flex>
                <v-flex xs1 sm1 md1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Oct"></v-text-field>
                </v-flex>
                <v-flex xs1 sm1 md1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Nov"></v-text-field>
                </v-flex>
                <v-flex xs1 sm1 md1>
                    <v-text-field v-model="editedItem.fuel_consume" label="Dic"></v-text-field>
                </v-flex>
            </v-layout>
                
<!--                 <v-layout row>
                  <span v-if=" editedItem.product!='' "  class="title">Consumos Materias Primas</span>
                </v-layout>

                <v-layout wrap row>
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
                </v-layout> -->


            <template>
              <v-card>
                
               
              <span class="title">Periodos de Paralización</span>

              <v-layout wrap row>
                <v-flex xs1>                  
                </v-flex>
                <v-flex xs12 sm6 md2>
                  <v-text-field  v-model="editedItem.desde" label="Desde"></v-text-field>   
                </v-flex>
                <v-flex xs12 sm6 md2>
                  <v-text-field  v-model="editedItem.desde" label="Hasta"></v-text-field>   
                </v-flex>
              </v-layout> 
               </v-card>
              <v-data-table
                :headers="headers"
                :items="desserts"
                :items-per-page="5"
                class="elevation-1"
              ></v-data-table>
            </template>


              
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






      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
  export default {
    data () {
      return {

       headers: [
          {
            text: 'Dessert (100g serving)',
            align: 'left',
            sortable: false,
            value: 'name',
          },
          { text: 'Calories', value: 'calories' },
          { text: 'Fat (g)', value: 'fat' },
          { text: 'Carbs (g)', value: 'carbs' },
          { text: 'Protein (g)', value: 'protein' },
          { text: 'Iron (%)', value: 'iron' },
        ],
        desserts: [
          {
            name: 'Frozen Yogurt',
            calories: 159,
            fat: 6.0,
            carbs: 24,
            protein: 4.0,
            iron: '1%',
          },
          {
            name: 'Ice cream sandwich',
            calories: 237,
            fat: 9.0,
            carbs: 37,
            protein: 4.3,
            iron: '1%',
          },],


        dialog: false,
        notifications: false,
        sound: true,
        widgets: false,
        dias: ['Lunes', 'Martes', 'Miercoles', 'Jueves','Viernes', 'Sabado', 'Domingo'],
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
      }
    }
  }
</script>
