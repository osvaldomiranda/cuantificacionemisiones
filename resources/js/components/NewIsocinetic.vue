<template>
	  <div class="text-xs-center">
    <v-dialog
      v-model="dialog"
      width="800"
    >
      <template v-slot:activator="{ on }">
        <v-btn
          color="red lighten-2"
          dark
          v-on="on"
        >
          Nuevo registro
        </v-btn>
      </template>

      <v-card>
        <v-card-title
        </v-card-title>

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

        </v-card-text>

        <v-divider></v-divider>

      </v-card>
    </v-dialog>
  </div>
</template>