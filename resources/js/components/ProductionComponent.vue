<template>
    <v-layout row>
      <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition">
          <v-card color="#EEEEEE">
            <v-toolbar dark color="ds_138">
                <v-btn icon dark @click="dialog = false">
                  <v-icon>close</v-icon>
                </v-btn>
                <v-toolbar-title>Producción y Consumo materias primas</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                  <v-btn flat class='white--text' @click="save_all">Guardar</v-btn>
                </v-toolbar-items>
            </v-toolbar>
        <br>
        <v-container>
          
        
        <v-card class="px-5">
          <br>
          <v-layout>
                    <span  class="title">Producción mensual</span>
                </v-layout>

                <v-layout>
                    <v-flex  xs12 sm6 md3 class="pr-1">
                        <v-text-field v-model="product"  label="Producto Final"></v-text-field>
                    </v-flex>
                    <v-flex  xs12 sm6 md3 class="px-1">
                        <v-text-field  v-model="unity" readonly='true' label="Unidad"></v-text-field>
                    </v-flex>
                </v-layout>  

                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_ene" label="Enero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_feb" label="Febrero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_mar" label="Marzo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_abr" label="Abril"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_may" label="Mayo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_jun" label="Junio"></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="prod_jul" label="Julio"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="prod_ago" label="Agosto"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="prod_sep" label="Septiembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_oct" label="Octubre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_nov" label="Noviembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_dic" label="Diciembre"></v-text-field>
                    </v-flex>
                </v-layout> 
             
        </v-card>
        <br>

        <v-card class="px-5">
          <br>
          <v-layout>
                    <span  class="title">Consumo materias primas mensual</span>
                </v-layout>

                <v-layout>
                    <v-flex  xs12 sm6 md3 class="pr-1">
                        <v-text-field v-model="raw_material"  label="Materia Prima"></v-text-field>
                    </v-flex>
                    <v-flex  xs12 sm6 md3 class="px-1">
                        <v-text-field  v-model="unity_mp" readonly='true' label="Unidad"></v-text-field>
                    </v-flex>
                </v-layout>  

                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_ene" label="Enero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_feb" label="Febrero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_mar" label="Marzo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_abr" label="Abril"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_may" label="Mayo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_jun" label="Junio"></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="mp_jul" label="Julio"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="mp_ago" label="Agosto"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="mp_sep" label="Septiembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_oct" label="Octubre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_nov" label="Noviembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_dic" label="Diciembre"></v-text-field>
                    </v-flex>
                </v-layout> 
             
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
      declaration: Object
    },
    data () {
      return {

        dialog: true,

        raw_material: '',
        product: '',

        menu1: false,
        menu2: false,
        menu3: false,
        menu4: false,
       
    headers:[ 
            { text: 'Fecha Inicio', value: 'date_from' },
            { text: 'Fecha Fin', value: 'date_to' },
            { text: 'Nro.Dias', value: 'count' },
            ],

        prod_ene: 0,
        prod_feb: 0,
        prod_mar: 0,
        prod_abr: 0,
        prod_may: 0,
        prod_jun: 0,
        prod_jul: 0,
        prod_ago: 0,
        prod_sep: 0,
        prod_oct: 0,
        prod_nov: 0,
        prod_dic: 0,

        mp_ene: 0,
        mp_feb: 0,
        mp_mar: 0,
        mp_abr: 0,
        mp_may: 0,
        mp_jun: 0,
        mp_jul: 0,
        mp_ago: 0,
        mp_sep: 0,
        mp_oct: 0,
        mp_nov: 0,
        mp_dic: 0,
      }
    },



    created () {
      this.initialize()
    },

    methods: {

        initialize () {
          var app = this;

            // axios.get('/api/consumption/bysource?source_id=' + app.source.id + '&declaration_id=' + app.declaration.id)
            //     .then(function (resp) { 
            //       app.prod_ene = resp.data.jan;
            //       app.prod_feb = resp.data.feb;
            //       app.prod_mar = resp.data.mar;
            //       app.prod_abr = resp.data.apr;
            //       app.prod_may = resp.data.may;
            //       app.prod_jun = resp.data.jun;
            //       app.prod_jul = resp.data.jul;
            //       app.prod_ago = resp.data.aug;
            //       app.prod_sep = resp.data.sep;
            //       app.prod_oct = resp.data.oct;
            //       app.prod_nov = resp.data.nov;
            //       app.prod_dic = resp.data.dic;

            //       app.mp_ene = resp.data.mp_jan;
            //       app.mp_feb = resp.data.mp_feb;
            //       app.mp_mar = resp.data.mp_mar;
            //       app.mp_abr = resp.data.mp_apr;
            //       app.mp_may = resp.data.mp_may;
            //       app.mp_jun = resp.data.mp_jun;
            //       app.mp_jul = resp.data.mp_jul;
            //       app.mp_ago = resp.data.mp_aug;
            //       app.mp_sep = resp.data.mp_sep;
            //       app.mp_oct = resp.data.mp_oct;
            //       app.mp_nov = resp.data.mp_nov;
            //       app.mp_dic = resp.data.mp_dic;

            //     })
            //     .catch(function (resp) {
            //         console.log(resp);
            //         alert("Error sources/refresh :" + resp);
            //     });

        },

      save_all (){

        this.dialog = false;
        var app = this;

        var consumos = {
                'declaration_id': this.declaration.id,
                'product_id': this.source.product_id,
                'product': this.source.product,
                'unity': this.source.unity,
                'raw_material_id': this.source.raw_material_id,
                'raw_material': this.source.raw_material,
                'rm_unity': this.source.rm_unity,
                'jan':  this.prod_ene,
                'feb':  this.prod_feb,
                'mar':  this.prod_mar,
                'apr':  this.prod_abr,
                'may':  this.prod_may,
                'jun':  this.prod_jun,
                'jul':  this.prod_jul,
                'aug':  this.prod_ago,
                'sep':  this.prod_sep,
                'oct':  this.prod_oct,
                'nov':  this.prod_nov,
                'dic':  this.fprod_dic,
                'mp_jan':  this.mp_ene,
                'mp_feb':  this.mp_feb,
                'mp_mar':  this.mp_mar,
                'mp_apr':  this.mp_abr,
                'mp_may':  this.mp_may,
                'mp_jun':  this.mp_jun,
                'mp_jul':  this.mp_jul,
                'mp_aug':  this.mp_ago,
                'mp_sep':  this.mp_sep,
                'mp_oct':  this.mp_oct,
                'mp_nov':  this.mp_nov,
                'mp_dic':  this.mp_dic,
        };

        axios.post('/api/consumption/save', consumos)
        .then(response => {
          
        }).catch(error => {
          alert("ERROR save consumos " + error)
          console.log(error);
        });

      }

    }
  }
</script>