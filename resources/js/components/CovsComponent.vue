<template>
  <v-layout row>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn small color="success" v-on="on">Registrar Covs</v-btn>
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
                 <new_iso></new_iso>
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
                 <span class="headline">Estimación de Emisiones a nivel de Fuentes</span>
                 <v-spacer></v-spacer>
                 <new_iso></new_iso>
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
                 <span class="headline">Mediciones</span>
                 <v-spacer></v-spacer>
                 <new_iso></new_iso>
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
      }
    }
  }
</script>