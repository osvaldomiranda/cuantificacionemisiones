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
                        <v-text-field  v-model="prod_unity"  label="Unidad"></v-text-field>
                    </v-flex>
                </v-layout>  

                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_ene" type="number" label="Enero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_feb" type="number" label="Febrero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_mar" type="number" label="Marzo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_abr" type="number" label="Abril"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_may" type="number" label="Mayo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_jun" type="number" label="Junio"></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="prod_jul" type="number" label="Julio"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="prod_ago" type="number" label="Agosto"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="prod_sep" type="number" label="Septiembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_oct" type="number" label="Octubre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_nov" type="number" label="Noviembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="prod_dic" type="number" label="Diciembre"></v-text-field>
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
                        <v-text-field  v-model="rm_unity"  label="Unidad"></v-text-field>
                    </v-flex>
                </v-layout>  

                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_ene" type="number" label="Enero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_feb" type="number" label="Febrero"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_mar" type="number" label="Marzo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_abr" type="number" label="Abril"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_may" type="number" label="Mayo"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_jun" type="number" label="Junio"></v-text-field>
                    </v-flex>
                </v-layout>
                <v-layout>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="mp_jul" type="number" label="Julio"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="mp_ago" type="number" label="Agosto"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field  v-model="mp_sep" type="number" label="Septiembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_oct" type="number" label="Octubre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_nov" type="number" label="Noviembre"></v-text-field>
                    </v-flex>
                    <v-flex xs2 class="px-1">
                        <v-text-field v-model="mp_dic" type="number" label="Diciembre"></v-text-field>
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
      declaration: Object,
      process: String
    },
    data () {
      return {

        dialog: true,

        raw_material_id: 1,
        raw_material: '',
        rm_unity: 'Lt',

        product_id: 1,
        product: '',
        prod_unity: 'Lt',



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

            axios.get('/api/production/bydeclarationprocess?process=' + app.process + '&declaration_id=' + app.declaration.id)
                .then(function (resp) { 

                  app.raw_material_id = resp.data.raw_material_id;
                  app.raw_material    = resp.data.raw_material;
                  app.rm_unity        = resp.data.rm_unity;

                  app.product_id = resp.data.final_product_id;
                  app.product    = resp.data.final_product;
                  app.prod_unity = resp.data.fp_unity;

                  app.prod_ene = resp.data.fp_jan;
                  app.prod_feb = resp.data.fp_feb;
                  app.prod_mar = resp.data.fp_mar;
                  app.prod_abr = resp.data.fp_apr;
                  app.prod_may = resp.data.fp_may;
                  app.prod_jun = resp.data.fp_jun;
                  app.prod_jul = resp.data.fp_jul;
                  app.prod_ago = resp.data.fp_aug;
                  app.prod_sep = resp.data.fp_sep;
                  app.prod_oct = resp.data.fp_oct;
                  app.prod_nov = resp.data.fp_nov;
                  app.prod_dic = resp.data.fp_dic;

                  app.mp_ene = resp.data.rm_jan;
                  app.mp_feb = resp.data.rm_feb;
                  app.mp_mar = resp.data.rm_mar;
                  app.mp_abr = resp.data.rm_apr;
                  app.mp_may = resp.data.rm_may;
                  app.mp_jun = resp.data.rm_jun;
                  app.mp_jul = resp.data.rm_jul;
                  app.mp_ago = resp.data.rm_aug;
                  app.mp_sep = resp.data.rm_sep;
                  app.mp_oct = resp.data.rm_oct;
                  app.mp_nov = resp.data.rm_nov;
                  app.mp_dic = resp.data.rm_dic;

                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });

        },

      save_all (){

        alert("save All");
        var app = this;

        var production = {

                'declaration_id': this.declaration.id,
                'process': this.process,

                'raw_material_id': this.raw_material_id,
                'raw_material': this.raw_material,
                'rm_unity': this.rm_unity,

                'final_product_id': this.product_id,
                'final_product': this.product,
                'fp_unity': this.prod_unity,

                'fp_jan':  this.prod_ene,
                'fp_feb':  this.prod_feb,
                'fp_mar':  this.prod_mar,
                'fp_apr':  this.prod_abr,
                'fp_may':  this.prod_may,
                'fp_jun':  this.prod_jun,
                'fp_jul':  this.prod_jul,
                'fp_aug':  this.prod_ago,
                'fp_sep':  this.prod_sep,
                'fp_oct':  this.prod_oct,
                'fp_nov':  this.prod_nov,
                'fp_dic':  this.prod_dic,
                'rm_jan':  this.mp_ene,
                'rm_feb':  this.mp_feb,
                'rm_mar':  this.mp_mar,
                'rm_apr':  this.mp_abr,
                'rm_may':  this.mp_may,
                'rm_jun':  this.mp_jun,
                'rm_jul':  this.mp_jul,
                'rm_aug':  this.mp_ago,
                'rm_sep':  this.mp_sep,
                'rm_oct':  this.mp_oct,
                'rm_nov':  this.mp_nov,
                'rm_dic':  this.mp_dic,


        };

        axios.post('/api/production/save', production)
        .then(response => {
          
        }).catch(error => {
          alert("ERROR save productions " + error)
          console.log(error);
        });

        this.dialog = false;
      }

    }
  }
</script>