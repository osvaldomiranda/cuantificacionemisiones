<template>
  <v-layout row>
    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
<!--       <template v-slot:activator="{ on }">
        <v-btn round color="main_green" class="white--text"  v-on="on">Registrar Covs</v-btn>
      </template> -->
      <v-card>
        <v-toolbar dark color="covs">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Registrar Compuestos Organicos Volatiles</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click="dialog = false">Enviar a la autoridad</v-btn>
          </v-toolbar-items>
        </v-toolbar>
 
    <v-container>
      
        
    <v-card>
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


                  <v-layout row justify-center>
                    <v-dialog v-model="dialogOpAct" max-width="600px">
                      <template v-slot:activator="{ on }">
                        <v-btn color="covs" dark v-on="on">Cargar detalle Operación</v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="headline">Información Operación Actual</span>
                        </v-card-title>
                        <v-card-text>

                          <v-container grid-list-md>
                            <v-form ref="form_operation_type"  lazy-validation>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>

                                  <v-text-field v-model='register_id' :rules = "generalRule" label="Nro. Registro" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='operation_type' :rules = "generalRule" label="Tipo Operación"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                  <v-text-field  v-model='control_system' :rules = "generalRule" label="Sistema de Control"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='description' :rules = "generalRule" label="Descripción"></v-text-field>
                                </v-flex>

                        <v-flex sm8 md8 class="text-xs-center text-sm-center text-md-center text-lg-center">

                            <v-text-field label="Adjuntar Archivo PDF" @click='pickOpFile' v-model='imageOpName' prepend-icon='attach_file'></v-text-field>
                            <input
                                type="file"
                                :rules = "generalRule"
                                style="display: none"
                                ref="imageOp"
                                accept=".pdf"
                                @change="onOpFilePicked"
                            >

                        </v-flex>

                            </v-layout>
                          </v-form>
                          </v-container>
                        </v-card-text>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" flat @click="dialogOpAct = false">Cancelar</v-btn>
                          <v-btn color="blue darken-1" flat @click="opSave">Subir</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-layout>


              </v-card-title>
              <v-data-table
                :headers="headers"
                :items="currentops"
                :search="search"
                v-model="selected"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
              >

                <template v-slot:items="props">
                  <tr @click="showAlert(props.item)">
                  <td class="text-xs-left">{{ props.item.register_id }}</td>
                  <td class="text-xs-left">{{ props.item.operation_type }}</td>
                  <td class="text-xs-left">{{ props.item.control_system }}</td>
                  <td class="text-xs-left">{{ props.item.created_at }}</td>
                  <td class="text-xs-left">
                       <v-btn small @click="downloadFile(props.item)"> {{ props.item.file }} </v-btn>
                  </td>  

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
    </v-card>   
    <br>


    <v-card>

        <v-layout align-center row>
            <v-flex xs1>
            </v-flex>
  
        <v-flex xs10 style="overflow: auto">

            <v-card>
              <v-card-title>
                 <span class="headline">Estimación de Emisiones de COV'S</span>
                 <v-spacer></v-spacer>
             

                  <v-layout row justify-center>
                    <v-dialog v-model="dialogEstim" max-width="600px">
                      <template v-slot:activator="{ on }">
                        <v-btn color="covs" dark v-on="on">Cargar Estimación</v-btn>
                      </template>
                      <v-card>
                        <v-card-title>
                          <span class="headline">Estimación Emisiones de COVS</span>
                        </v-card-title>
                        <v-card-text>
                          <v-container grid-list-md>
                            <v-form ref="form_estimation"  lazy-validation>
                            <v-layout wrap>
                                <v-flex xs12 sm6 md4>

                                  <v-text-field v-model='source' :rules = "generalRule"  label="Fuente" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='discharge_type' :rules = "generalRule"  label="Tipo Descarga"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='measuring_method' :rules = "generalRule"  label="Método de Medición"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='factor' :rules = "generalRule"  label="Valor del Factor"></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='unity' :rules = "generalRule"  label="Unidad de Medida"></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md4>
                                  <v-text-field v-model='factor_origin' :rules = "generalRule"  label="Origen del Factor"></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md4>
                                  <v-text-field  v-model='estimated_emission' :rules = "generalRule"  label="Emisión Estimada"></v-text-field>
                                </v-flex>

                           <v-flex sm8 md8 class="text-xs-center text-sm-center text-md-center text-lg-center">

                            <v-text-field label="Adjuntar Archivo PDF" @click='pickEmFile' v-model='imageEmName' prepend-icon='attach_file'></v-text-field>
                            <input
                                type="file"
                                style="display: none"
                                ref="imageEm"
                                accept=".pdf"
                                :rules = "generalRule" 
                                @change="onEmFilePicked"
                            >

                        </v-flex>

                            </v-layout>
                          </v-form>
                          </v-container>
                        </v-card-text>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue darken-1" flat @click="dialogEstim = false">Cancelar</v-btn>
                          <v-btn color="blue darken-1" flat @click="emSave">Subir</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-layout>



              </v-card-title>
              <v-data-table
                :headers="headers_emisiones"
                :items="estimations"
                :search="search"
                v-model="selected"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
              >

                <template v-slot:items="props">
                  <tr @click="showAlert(props.item)">
                  <td class="text-xs-left">{{ props.item.source }}</td>
                  <td class="text-xs-left">{{ props.item.discharge_type }}</td>
                  <td class="text-xs-left">{{ props.item.measuring_method }}</td>

                  <td class="text-xs-left">{{ props.item.factor }}</td>
                  <td class="text-xs-left">{{ props.item.unity }}</td>  
                  <td class="text-xs-left">{{ props.item.factor_origin }}</td>
                  <td class="text-xs-left">{{ props.item.estimated_emission }}</td>  
                  <td class="text-xs-left">
                    <v-btn small @click="downloadFile(props.item)"> {{ props.item.file }} </v-btn>
                  </td>  


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

    </v-card>    
    <br>

    <v-card>
        <v-layout align-center row>
            <v-flex xs1>
            </v-flex>
  
        <v-flex xs10 style="overflow: auto">

            <v-card>
              <v-card-title>
                 <span class="headline">Mediciones</span>
                 <v-spacer></v-spacer>
                 
                 <v-btn dark color="covs" @click="newReading" >Ingresar Medicion</v-btn>




              </v-card-title>
              <v-data-table
                :headers="headers_mediciones"
                :items="readings"
                :search="search"
                v-model="selected"
                :rows-per-page-items="rowsPerPageItems"
                :pagination.sync="pagination"
              >
                <template v-slot:items="props">
                  <tr @click="showAlert(props.item)">
                  <td class="text-xs-left">{{ props.item.correlative }}</td>
                  <td class="text-xs-left">{{ props.item.method }}</td>
                  <td class="text-xs-left">{{ props.item.pollutant }}</td>
                  <td class="text-xs-left">{{ props.item.date_reading }}</td>
                  <td class="text-xs-left">
                     <v-btn small @click="downloadFile(props.item)"> {{ props.item.file }} </v-btn>
                  </td>  


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
    </v-card>    
    </v-container>>    
    

      </v-card>
    </v-dialog>
    <div ref="container">
    </div>  
  </v-layout>
</template>


<script>
  import Vue from 'vue';  
  import CovsReadings  from './../components/CovsReadings';
  import { EventBus } from './../eventbus.js';
  export default {
    props: {
        declaration: Object,
    },
    data () {
      return {

        generalRule: [v => !!v || 'Campo requerido'],
        numberRule: [v => !!v || 'Campo requerido', v => v && /^[0-9]+$/.test(v) || 'Debe ser valor numérico',],

        dialog: true,
        dialogOpAct: false,
        dialogEstim: false,


        currentops    : [],
        register_id   : '',
        operation_type: '',
        control_system: '',
        description   : '',
        
        imageOpName : '',
        imageOpFile : '',
        imageOpUrl  : '',

        imageEmName : '',
        imageEmFile : '',
        imageEmUrl  : '',
        
        headers: [
          { text: 'Nro.Registro', value: '' },
          { text: 'Tipo Operacion', value: '' },
          { text: 'Sistema Control', value: '' },
          { text: 'Fecha', value: '' },
          { text: 'Archivo', value: '' },
        ],

        estimations: [],
        source            : '',
        discharge_type    : '', 
        measuring_method  : '', 
        factor            : '', 
        factor_origin     : '',
        unity             : '', 
        estimated_emission: '', 

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

        readings: [],

        headers_mediciones: [
          { text: 'Nro Correlativo', value: '' },
          { text: 'Metodo', value: '' },
          { text: 'Contaminante', value: '' },
          { text: 'Fecha', value: '' },
          { text: 'Archivo', value: '' },  
        ],

      }
    },

    created () {
        this.initialize();

        EventBus.$on('saveCovsReading', function(){    
            app.initialize();
        });
    },
    methods: {
      initialize () {
        var app = this;
        
        axios.get('/api/currentops?declaration_id=' + app.declaration.id)
            .then(function (resp) {  
                  
                app.currentops = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });

        axios.get('/api/estimations?declaration_id=' + app.declaration.id)
            .then(function (resp) {    
                app.estimations = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });

        axios.get('/api/reading/bydeclaration?declaration_id=' + app.declaration.id)
            .then(function (resp) {   
                app.readings = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });

      },

      opSave (){
            var app = this;
            if (this.$refs.form_operation_type.validate()){
                var op = {
                    'declaration_id': this.declaration.id,
                    'register_id'   : this.register_id,
                    'operation_type': this.operation_type,
                    'control_system': this.control_system,
                    'description'   : this.description,
                }
      
                let formData = new FormData();
                formData.append('data',  JSON.stringify(op));
                formData.append('file', this.imageOpFile);
                axios.post('/api/currentops/save',formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (resp) {
                    app.initialize();

                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error source_types :" + resp);
                });

                this.dialogOpAct = false;           
            }        

      },

      downloadFile(a){
        axios({
          url: '/api/currentop/download?filename=' + a.file ,
          method: 'GET',
          responseType: 'blob', // important
        }).then((response) => {
           const url = window.URL.createObjectURL(new Blob([response.data]));
           const link = document.createElement('a');
           link.href = url;
           link.setAttribute('download', 'file.pdf'); //or any other extension
           document.body.appendChild(link);
           link.click();
        });



      },

      emSave(){
            var app = this;
            if (this.$refs.form_estimation.validate()){
                var emit = {
                    'declaration_id'    : this.declaration.id,
                    'source'            : this.source,
                    'discharge_type'    : this.discharge_type,
                    'measuring_method'  : this.measuring_method,
                    'unity'             : this.unity,
                    'factor'            : this.factor,
                    'factor_origin'     : this.factor_origin,
                    'estimated_emission': this.estimated_emission,
                }
      
                let formData = new FormData();
                formData.append('data',  JSON.stringify(emit));
                formData.append('file', this.imageEmFile);
                axios.post('/api/estimation/save',formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (resp) {
                    app.initialize();
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error source_types :" + resp);
                });

                this.dialogEstim = false;           
            }     

      },

      pickOpFile () {
            this.$refs.imageOp.click()
        },
        
      onOpFilePicked (e) {
            const files = e.target.files
            if(files[0] !== undefined) {
                this.imageOpName = files[0].name
                if(this.imageOpName.lastIndexOf('.') <= 0) {
                    return
                }
                const fr = new FileReader ()
                fr.readAsDataURL(files[0])
                fr.addEventListener('load', () => {
                    this.imageOpUrl = fr.result
                    this.imageOpFile = files[0] // this is an image file that can be sent to server...
                })
            } else {
                this.imageOpName = ''
                this.imageOpFile = ''
                this.imageOpUrl = ''
            }
        },

      pickEmFile () {
            this.$refs.imageEm.click ()
        },
        
      onEmFilePicked (e){ 
            const files = e.target.files
            if(files[0] !== undefined) {
                this.imageEmName = files[0].name
                if(this.imageEmName.lastIndexOf('.') <= 0) {
                    return
                }
                const fr = new FileReader ()
                fr.readAsDataURL(files[0])
                fr.addEventListener('load', () => {
                    this.imageEmUrl = fr.result
                    this.imageEmFile = files[0] // this is an image file that can be sent to server...
                })
            } else {
                this.imageEmName = ''
                this.imageEmFile = ''
                this.imageEmUrl = ''
            }
        },

      newReading(){
            var ComponentReserv = Vue.extend(CovsReadings)
            var instance = new ComponentReserv({store: this.$store, propsData: { declaration: this.declaration}
            });
            instance.$mount();
            this.$refs.container.replaceChild(instance.$el);
      }, 


    }



  }
</script>