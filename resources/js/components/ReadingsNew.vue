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




        <v-card>
          <v-container
            id="grid"
            fluid
            grid-list-sm
            tag="section"
          >
            <v-layout row wrap>
              <v-flex xs6 tag="h5" >Fuente Medida: Convertidor Teniente NI000003</v-flex>
              <v-flex xs6 tag="h5" >Chimenea: Chimenea CH000001</v-flex>
              <v-flex xs6 tag="h5" >Abatimiento: Scrubber</v-flex>

            </v-layout>
            


            <v-layout row wrap>
                <v-flex xs12 sm6 md4>
                  <v-text-field label="Correlativo Medición">COV</v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field label="Metodo de Medición"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field label="Laboratorio"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-text-field label="Fecha Medición"></v-text-field>
                </v-flex>
                <v-flex xs12 sm6 md4>
                  <v-btn small color="success">Agregar Corrida</v-btn>
                </v-flex>
            </v-layout>    
            <v-layout row wrap>
           <div id="splash"
            style="position:relative;top:0px;left:0px;width:100%;height:100%;background:white;z-index:1;">
            <center id="splash" style="padding-top:1px;">
              <img src="../../../resources/assets/images/Medicion.png">
            </center>
          </div>

            </v-layout>  

        <v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">

          <img :src="imageUrl" height="60" v-if="imageUrl"/>
          <v-text-field label="Select File" @click=''  prepend-icon='attach_file'></v-text-field>
          <input
            type="file"
            style="display: none"
            ref="image"
            accept="image/*"
            
          >
        </v-flex>

          </v-container>
        </v-card>


<!-- ../../../resources/assets/images/ -->

      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        notifications: false,
        sound: true,
        widgets: false
      }
    }
  }
</script>