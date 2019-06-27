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