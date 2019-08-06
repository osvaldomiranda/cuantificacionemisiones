<template>
  <v-layout row>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn round color="main_green" class="white--text"  v-on="on">Registrar Covs</v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="success">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Registrar Compuestos Organicos Volatiles</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click="dialog = false">Save</v-btn>
          </v-toolbar-items>
        </v-toolbar>
 

     <v-container fluid>

        <v-layout align-center row>
            <v-flex xs1>
            </v-flex>
  
        <v-flex xs10 style="overflow: auto">

            <v-card>
              <v-card-title>
                 <span class="headline">Información de Operación Actual</span>
                 <v-spacer></v-spacer>
                 <v-btn>Bajar Plantilla</v-btn>
                 <v-spacer></v-spacer>
                 <covopactual></covopactual>
              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="covs"
                :search="search"
                v-model="selected"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
              >
                <template v-slot:items="props">
                  <tr @click="showAlert(props.item)">
                  <td class="text-xs-left">{{ props.item.nro_registro }}</td>
                  <td class="text-xs-left">{{ props.item.tipo_operacion }}</td>
                  <td class="text-xs-left">{{ props.item.sistema_control }}</td>
                  <td class="text-xs-left">{{ props.item.fecha }}</td>
                  <td class="text-xs-left">{{ props.item.archivo }}</td>  

                </tr>
                </template>
                <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                  Your search for "{{ search }}" found no results.
                </v-alert>
              </v-data-table>
            </v-card> 
            <v-flex xs1>
            </v-flex>
        </v-flex>
                
        </v-layout>
        <div ref="container">

        </div>
    </v-container>    



 <v-container fluid>

        <v-layout align-center row>
            <v-flex xs1>
            </v-flex>
  
        <v-flex xs10 style="overflow: auto">

            <v-card>
              <v-card-title>
                 <span class="headline">Estimación de Emisiones de COV'S</span>
                 <v-spacer></v-spacer>
                 <covsestimaciones></covsestimaciones>
              </v-card-title>
              <v-data-table
                :headers="headers_emisiones"
                :items="covs_emisiones"
                :search="search"
                v-model="selected"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
              >
                <template v-slot:items="props">
                  <tr @click="showAlert(props.item)">
                  <td class="text-xs-left">{{ props.item.fuente }}</td>
                  <td class="text-xs-left">{{ props.item.tipo_descarga }}</td>
                  <td class="text-xs-left">{{ props.item.metodo_medicion }}</td>
                  <td class="text-xs-left">{{ props.item.valor_factor }}</td>
                  <td class="text-xs-left">{{ props.item.unidad_medida }}</td>  
                  <td class="text-xs-left">{{ props.item.origen_factor }}</td>
                  <td class="text-xs-left">{{ props.item.emision_estimada }}</td>  
                  <td class="text-xs-left">{{ props.item.archivo }}</td>  


                </tr>
                </template>
                <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                  Your search for "{{ search }}" found no results.
                </v-alert>
              </v-data-table>
            </v-card> 
            <v-flex xs1>
            </v-flex>
        </v-flex>
                
        </v-layout>
        <div ref="container">

        </div>
    </v-container>    


 <v-container fluid>

        <v-layout align-center row>
            <v-flex xs1>
            </v-flex>
  
        <v-flex xs10 style="overflow: auto">

            <v-card>
              <v-card-title>
                 <span class="headline">Mediciones</span>
                 <v-spacer></v-spacer>
                 <readingsnew></readingsnew>
              </v-card-title>
              <v-data-table
                :headers="headers_mediciones"
                :items="covs_mediciones"
                :search="search"
                v-model="selected"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
              >
                <template v-slot:items="props">
                  <tr @click="showAlert(props.item)">
                  <td class="text-xs-left">{{ props.item.nro_correlativo }}</td>
                  <td class="text-xs-left">{{ props.item.nro_registro }}</td>
                  <td class="text-xs-left">{{ props.item.contaminante }}</td>
                  <td class="text-xs-left">{{ props.item.tipo_descarga }}</td>
                  <td class="text-xs-left">{{ props.item.archivo }}</td>  


                </tr>
                </template>
                <v-alert v-slot:no-results :value="true" color="error" icon="warning">
                  Your search for "{{ search }}" found no results.
                </v-alert>
              </v-data-table>
            </v-card> 
            <v-flex xs1>
            </v-flex>
        </v-flex>
                
        </v-layout>
        <div ref="container">

        </div>
    </v-container>    


      </v-card>
    </v-dialog>
  </v-layout>
</template>


<script>
  export default {
    data () {
      return {
        dialog: false,
        covs: [
        {   nro_registro: 'OTO000534-1',
            tipo_operacion: 'Impresiòn',
            sistema_control: 'Some',
            fecha: '01/01/2019',
            archivo: '9879384.pdf',
        }
        ],

        headers: [
          { text: 'Nro.Registro', value: '' },
          { text: 'Tipo Operacion', value: '' },
          { text: 'Sistema Control', value: '' },
          { text: 'Fecha', value: '' },
          { text: 'Archivo', value: '' },
        ],

        covs_emisiones: [
        {   fuente: 'Estanque',
            tipo_descarga: 'Fugitivas',
            metodo_medicion: 'Modelo TANKS',
            valor_factor: '1.2',
            unidad_medida: 'Kg/L',
            origen_factor: 'Tanks 4.09 D',
            emision_estimada: '31',
            archivo: '9879384.pdf',
        }
        ],

        headers_emisiones: [
          { text: 'Fuente', value: '' },
          { text: 'Tipo Descarga', value: '' },
          { text: 'Metodo Medición', value: '' },
          { text: 'Valor Factor', value: '' },
          { text: 'Unidad Medida', value: '' },
          { text: 'Origen Factor', value: '' },
          { text: 'Emisión Estimada', value: '' },
          { text: 'Archivo', value: '' },  
        ],

        covs_mediciones: [
        {   nro_correlativo: '123',
            nro_registro: 'IN000135',
            contaminante: 'COV',
            tipo_descarga: 'Chimenea',
            archivo: '9879384.pdf',
        }
        ],

        headers_mediciones: [
          { text: 'Nro Correlativo', value: '' },
          { text: 'Nro Registro Fuente', value: '' },
          { text: 'Contaminante', value: '' },
          { text: 'Tipo Descarga', value: '' },
          { text: 'Archivo', value: '' },  
        ],

      }
    }
  }
</script>