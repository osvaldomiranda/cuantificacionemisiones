<template>
  <v-layout row justify-center>

    <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
      <template v-slot:activator="{ on }">
        <v-btn  small color="red" dark v-on="on">Registrar Mediciones</v-btn>
      </template>
      <v-card>
        <v-toolbar dark color="readings">
          <v-btn icon dark @click="dialog = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title>Registro de mediciones</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn dark flat @click="saveAll">Guardar</v-btn>
          </v-toolbar-items>
        </v-toolbar>


        
        <v-container>
            <v-form ref="form"  lazy-validation>
            <v-card class="px-5">
                <br>
                <v-layout>
                    <v-flex  xs12 sm6 md3 class="pr-1">
                        <v-text-field v-model="this.source.source_type_name"  readonly='true' label="Fuente"></v-text-field>
                    </v-flex>
                    <v-flex  xs12 sm6 md3 class="px-1">
                        <v-text-field  v-model="this.source.internal_number" readonly='true' label="Nro.Interno"></v-text-field>
                    </v-flex>
                    <v-flex xs3 class="px-1">
                        <v-select
                            :items="pollutants"
                            v-model="pollutant"
                            label="Contaminante"
                            :rules = "generalRule"
                        ></v-select> 
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
                            :rules = "generalRule"
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
                    <v-flex xs4 class="px-2">
                        <v-text-field label="Adjuntar Archivo (20MB max)" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
                        <input
                            type="file"
                            style="display: none"
                            ref="image"
                            accept=".pdf"
                            @change="onFilePicked"
                            :rules = "generalRule"
                        >
                    </v-flex>
                </v-layout>
            </v-card>
            </v-form> 
            <br>
            <v-card class="px-5">
                <br>
                    <v-layout>
                        <span class="title">Corridas</span>
                    </v-layout>

                    <v-layout>
                        <v-flex xs2 class="px-2">
                            <v-text-field :rules = "numberRule" v-model="duration"  label="Duración"></v-text-field>
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
                            <v-text-field v-model="excess_air" label="Exceso de Aire %"></v-text-field>
                        </v-flex>
                        <v-flex xs3 class="px-2">
                            <v-text-field v-model="combustion_efficiency" label="Eficiencia Combustión %"></v-text-field>
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
                            <v-text-field v-model="o2" label="O2 %"></v-text-field>
                        </v-flex>
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="co2" label="CO2 %"></v-text-field>
                        </v-flex>
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="co" label="CO %"></v-text-field>
                        </v-flex>                        
                        <v-flex xs2 class="px-2">
                            <v-text-field v-model="co_ppm" label="CP (ppm) %"></v-text-field>
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
                                    :items="runs" 
                                    item-key="name" 
                                    class="elevation-1"
                                >   
                                <template v-slot:items="props">
                                    <tr @click="showAlert(props.item)">
                                        <td class="text-xs-left">{{ props.item.duration }}</td>
                                        <td class="text-xs-left">{{ props.item.measured_concentration }}</td>
                                        <td class="text-xs-left">{{ props.item.corrected_flow }}</td>
                                        <td class="text-xs-left">{{ props.item.emission }}</td>
                                        <td class="text-xs-left">{{ props.item.excess_air }}</td>
                                        <td class="text-xs-left">{{ props.item.combustion_efficiency }}</td>
                                        <td class="text-xs-left">{{ props.item.temperature }}</td>
                                        <td class="text-xs-left">{{ props.item.speed }}</td>
                                        <td class="text-xs-left">{{ props.item.isocinetic }}</td>
                                        <td class="text-xs-left">{{ props.item.o2 }}</td>
                                        <td class="text-xs-left">{{ props.item.co2 }}</td>
                                        <td class="text-xs-left">{{ props.item.co }}</td>
                                        <td class="text-xs-left">{{ props.item.co_ppm }}</td>
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
        source: Object,
        declaration: Object,
    },

    data () {
      return {
        generalRule: [v => !!v || 'Campo requerido'],
        numberRule: [v => !!v || 'Campo requerido', v => v && /^[0-9]+$/.test(v) || 'Debe ser valor numérico',],

        dialog: true,
        menu: false,
        imageName:'',
        imageFile:'',
        
        correlative:'',
        method:'',
        date_reading:'',
        pollutant:'',
        reading_id:'',
    

        runs: [],
        duration:'',
        measured_concentration:'',
        corrected_concentration:'',
        corrected_flow:'',
        emission:'',
        excess_air:'',
        combustion_efficiency:'',
        temperature:'',
        speed:'',
        isocinetic:'', 
        o2:'',
        co2:'',
        co:'',
        co_ppm:'',

        pollutants: [
                'Amoniaco',
                'Arsenico',
                'Azufre Total Reducido (TRS)',
                'Benceno',
                'Comuestos Organicos Volatiles (COV)',
                'Dioxido de Carbono (CO2)',
                'Dioxinas y Furanos',
                'Mercurio',
                'Monoxido de Carbono (CO)',
                'Particulas Totales Suspendidas (PTS)',
                'PM10',
                'PM2.5',
                'Plomo ',
                'Oxidos de Nitrogeno (NOx)',
                'Oxidos de Azufre (SOx)',
                'Tolueno',
                ],
        pollutant:'',
        labs:[  'AIRON INGENIERIA Y CONTROL AMBIENTAL S.A',
                'AEEG EMISSIONS SANTIAGO',
                'MENDEZ ASOCIADOS LIMITADA',
                'JHG - JOSE DOMINGO CAÑAS',
                'CESMEC S.A DIVISIÓN MEDIO AMBIENTE',
                'PROTERM SA',
                'ALGORITMOS - CASA MATRIZ',
                'AXIS TECNOLOGIAS AMBIENTALES LIMITADA',
                'SOCIEDAD COMERCIAL SERCOAMB LIMITADA',
                'ASESORIAS H Y S INGEMA LTDA',
                'AYMA-ANALISIS Y MEDICIONES AMBIENTALES LTDA',
                'SERPRAM S.A.',
                'SERVICIOS MINEROS',
                'SERVICIOS DE INSPECCIÓN AMBIENTAL AIRTESLAB SPA  - AIRTESLAB SPA',
                'ECOINGEN FISZALIZACIÓN AMBIENTA SPA - ECOINGEN CONCEPCIÓN', 
                ],
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
    },    
    created () {
        this.initialize();
    },

    methods: {
        initialize () {
            var app = this;
            axios.get('/api/reading/bysource?source_id=' + app.source.id + '&declaration_id=' + app.declaration.id)
                .then(function (resp) { 
                    app.correlative  = resp.data.correlative;
                    app.method       = resp.data.method;
                    app.lab          = resp.data.lab;
                    app.date_reading = resp.data.date_reading;
                    app.pollutant    = resp.data.pollutant;
                    app.reading_id   = resp.data.id;
                    app.imageName    = resp.data.file;
                    app.runs_reading();
                })
                .catch(function (resp) {
                    console.log(resp);
                //    alert("Error sources/refresh :" + resp);
                });

        },

        runs_reading (){
            var app = this;

            if(app.reading_id) {
                axios.get('api/runs/byreading?reading_id=' + app.reading_id)
                    .then(function (resp) { 
                        app.runs = resp.data; 
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    //    alert("Error sources/refresh :" + resp);
                    });
            }
        },
        saveItem () {
            var item = {
                        'source_id': this.source.id,
                        'duration': this.duration,
                        'measured_concentration': this.measured_concentration,
                        'corrected_concentration': this.corrected_concentration,
                        'corrected_flow': this.corrected_flow,
                        'emission': this.emission,
                        'excess_air': this.excess_air,
                        'combustion_efficiency': this.combustion_efficiency,
                        'temperature': this.temperature,
                        'speed': this.speed,
                        'isocinetic': this.isocinetic,
                        'o2': this.o2,
                        'co2': this.co2,
                        'co': this.co,
                        'co_ppm': this.co_ppm
                    };

            this.runs.push(item);
        },

        saveAll(){

            if (this.$refs.form.validate()){
                var reading = {
                    'declaration_id': this.declaration.id,
                    'source_id': this.source.id,
                    'correlative': this.correlative,
                    'method': this.method,
                    'lab': this.lab,
                    'date_reading': this.date_reading,
                    'pollutant': this.pollutant,
                    'runs': this.runs
                }

                
                let formData = new FormData();
                formData.append('data',  JSON.stringify(reading));
                formData.append('file', this.imageFile);
                axios.post('/api/reading/save',formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function (resp) {
                    EventBus.$emit('saveReading', 'someValue');
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error source_types :" + resp);
                });
                this.dialog = false;           
            }


        },

        pickFile () {
            this.$refs.image.click ()
        },
        
        onFilePicked (e) {
            const files = e.target.files
            if(files[0] !== undefined) {
                this.imageName = files[0].name
                if(this.imageName.lastIndexOf('.') <= 0) {
                    return
                }
                const fr = new FileReader ()
                fr.readAsDataURL(files[0])
                fr.addEventListener('load', () => {
                    this.imageUrl = fr.result
                    this.imageFile = files[0] // this is an image file that can be sent to server...
                })
            } else {
                this.imageName = ''
                this.imageFile = ''
                this.imageUrl = ''
            }
        },

    }
  
      
    
  }
</script>