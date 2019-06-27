<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn small color="success" v-on="on">Med.Isocinetica</v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="success">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Registro de Mediciónes Isocineticas</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click="dialog = false">Save</v-btn>
          </v-toolbar-items>
        </v-toolbar>
 



        <v-card-text>
          <v-container grid-list-md>
            <v-layout row wrap>
              <v-flex xs4>
                <v-text-field label="Nro.Correlativo" required></v-text-field>
              </v-flex>
            </v-layout>  
            <v-layout row wrap> 
              <v-flex xs4>
                <v-select
                  :items="['CH015662-4', 'CH015663-4', 'CH015664-4', 'CH015665-4']"
                  label="Nro.Registro del Ducto"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs4>
                <v-select
                  :items="['Amoniaco', 'Arsenico', 'Dioxido de Carbono (CO2)', 'Oxidos de Azufre(SOx)']"
                  label="Contaminante"
                  required
                ></v-select>
              </v-flex>
            </v-layout>
            <v-layout row wrap>  
              <v-flex xs4>
                <v-select
                  :items="['Descarga por Chimenea', 'Emisiones Evaporativas', 'Emisiones Fugitivas']"
                  label="Tipo de Descarga"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs4>
                
                <v-select
                  :items="['CH-5', 'CH-6(EPA-6)', 'Análisis Granulometrico']"
                  label="Metodo de Medición"
                  required
                ></v-select>
              </v-flex>  
            </v-layout> 
            <v-layout row wrap> 
              <v-flex xs2>
                <v-text-field label="Emisión(Kg/hr)" required></v-text-field>
              </v-flex>
              <v-flex xs2>
                <v-text-field label="Caudal(m3N/hr)" required></v-text-field>
              </v-flex>
              <v-flex xs2>
                <v-text-field label="Concentración" required></v-text-field>
              </v-flex>
               <v-flex xs2>
                <v-select
                  :items="['ppm', 'mg/m3N']"
                  label="Unidad de Concentración"
                  required
                ></v-select>
              </v-flex>
            </v-layout> 
            <v-layout row wrap> 
               <v-flex xs4>
                <v-select
                  :items="['Cesmec', 'Airon S.A.','ASITEC','ATIS S.A.']"
                  label="Laboratorio"
                  required
                ></v-select>
              </v-flex>  

              <v-flex xs2>
                <v-text-field label="Fecha" required>28/06/2019</v-text-field>
              </v-flex>
            </v-layout>
            <v-layout row wrap>
              <v-flex xs12>
                <v-text-field label="Observaciones" required></v-text-field>
              </v-flex>

            </v-layout>
            <v-layout row wrap>
              <v-flex xs12>
                <upload></upload>
              </v-flex>

            </v-layout>
          </v-container>
          
        </v-card-text>






      </v-card>
    </v-dialog>
  </v-layout>
</template>


<script>
  export default {
    data () {
      return {
        dialog: false,
      }
    }
  }
</script>