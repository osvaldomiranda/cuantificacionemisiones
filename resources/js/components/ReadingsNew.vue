<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn  small color="red" dark v-on="on">Registrar Mediciones</v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="primary">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Registro de mediciones</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click="dialog = false">Guardar</v-btn>
          </v-toolbar-items>
        </v-toolbar>

        <v-container>
            <v-card class="px-5">
                <br>
                <v-layout>
                    <v-flex  xs12 sm6 md3 class="pr-1">
                        <v-text-field v-model="this.source.source_type_name"  readonly='true' label="Fuente"></v-text-field>
                    </v-flex>
                    <v-flex  xs12 sm6 md3 class="px-1">
                        <v-text-field  v-model="this.source.internal_number" readonly='true' label="Nro.Interno"></v-text-field>
                    </v-flex>
                </v-layout>  

                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="correlative" label="Correlativo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="method" label="Metodo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-select
                            :items="labs"
                            v-model="lab"
                            label="Laboratorio"
                        ></v-select> 
                    </v-flex>
                    <v-flex xs3 class="px-1">
                                              
                            <v-col cols="12" lg="6">
                                <v-menu
                                  v-model="menu"
                                  :close-on-content-click="false"
                                  transition="scale-transition"
                                  offset-y
                                  full-width
                                  max-width="290px"
                                  min-width="290px"
                                >
                                  <template v-slot:activator="{ on }">
                                    <v-text-field
                                      v-model="date_reading"
                                      label="Fecha de Medición
                                      "
                                      persistent-hint
                                      prepend-icon="event"
                                      readonly
                                      v-on="on"
                                    ></v-text-field>
                                  </template>
                                  <v-date-picker v-model="date_reading" no-title @input="menu = false"></v-date-picker>
                                </v-menu>
                            </v-col>


                       
                    </v-flex>
                    <v-flex xs2 class="px-2">

                        <v-file-input show-size label="File input"></v-file-input>
                        <!-- <img :src="imageUrl" height="150" v-if="imageUrl"/> -->
<!--                         <v-text-field label="Seleccionar Archivo" @click='pickFile' v-model='file' prepend-icon='attach_file'></v-text-field>
                        <input
                            type="file"
                            style="display: none"
                            ref="image"
                            accept=".pdf"
                            @change="onFilePicked"
                        > -->
                    </v-flex>
                </v-layout>
            </v-card>
            <br>
            <v-card class="px-5">
                <br>
                    <v-layout>
                        <span class="title">Corridas</span>
                    </v-layout>

                    <v-layout>
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="duration"  readonly='true' label="Duración"></v-text-field>
                        </v-flex>
                        <v-flex xs3 class="px-2">
                            <v-text-field v-model="measured_concentration" label="Concentración Medida"></v-text-field>
                        </v-flex>
                        <v-flex xs3 class="px-2">
                            <v-text-field v-model="corrected_concentration" label="Concentración corregida"></v-text-field>
                        </v-flex>                        
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="corrected_flow" label="Caudal Corregido"></v-text-field>
                        </v-flex> 

                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="emission" label="Emisión"></v-text-field>
                        </v-flex>
                    </v-layout> 
                    <v-layout> 
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="excess_air" label="Exceso de Aire"></v-text-field>
                        </v-flex>
                        <v-flex xs3 class="px-2">
                            <v-text-field v-model="combustion_efficiency" label="Eficiencia Combustión"></v-text-field>
                        </v-flex>  
                        <v-flex xs3 class="px-2">
                            <v-text-field v-model="temperature" label="Temperatura"></v-text-field>
                        </v-flex>                        
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="speed" label="Velocidad m/s"></v-text-field>
                        </v-flex> 
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="isocinetic" label="Isocinetismo"></v-text-field>
                        </v-flex>
 
                    </v-layout>    
                    <v-layout> 

                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="o2" label="O2"></v-text-field>
                        </v-flex>
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="co2" label="CO2"></v-text-field>
                        </v-flex>
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="co" label="CO"></v-text-field>
                        </v-flex>                        
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="co_ppm" label="CP (ppm)"></v-text-field>
                        </v-flex> 
                        <v-flex xs4 class="px-2">
                            <v-btn @click="saveItem" class="ma-2" tile outline color="main_green">Ingresar Corrida</v-btn> 
                        </v-flex>
                    </v-layout> 
                    <br>
                    <v-layout>
                        <v-flex xs12>
                                <v-data-table dense 
                                    :headers="headers" 
                                    :items="paralizations" 
                                    item-key="name" 
                                    class="elevation-1"
                                >   
                                <template v-slot:items="props">
                                    <tr @click="showAlert(props.item)">
                                        <td class="text-xs-left">{{ props.item.date_from }}</td>
                                        <td class="text-xs-left">{{ props.item.date_to }}</td>
                                        <td class="text-xs-left"></td>
                                    </tr>
                                </template>
                                </v-data-table>
                        </v-flex>
                    </v-layout>
                    <br>    
                </v-card>
        </v-container>
            </v-card>



    </v-dialog>
  </v-layout>
</template>

<script>
  import {EventBus}  from './../eventbus.js';
  export default {
    props: {
        source: Object
    },

    data () {
      return {
        dialog: true,
        menu: false,
        file:'',
        labs:['Laboratorio 1','Laboratorio 2','Laboratorio 3','Laboratorio 4','Laboratorio 5'],
        headers:[ 
            { text: 'Concentración Medida', value: '' },
            { text: 'Concentración Corregida', value: '' },
            { text: 'Emisión', value: '' },
            { text: 'Exceso de Aire ', value: '' },
            { text: 'Temperatura', value: '' },
            { text: 'Velocidad', value: '' },
            { text: 'O2', value: '' },
            { text: 'CO2', value: '' },
            { text: 'CO', value: '' },
            { text: 'CO(ppm)', value: '' },
            { text: 'Isocinetismo', value: '' },
            { text: 'Eficiencia Combustión', value: '' },
            ],
      }
    }
  }
</script>