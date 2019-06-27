<template>


	 <v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500">
      <template v-slot:activator="{ on }">

        <v-btn v-on="on" flat color="red lighten-2">
            Subir Archivo
        </v-btn>
        <!-- <v-btn color="primary" dark v-on="on">Upload</v-btn> -->
      </template>
      <v-card>
        <v-card-text>

			<v-flex xs12 class="text-xs-center text-sm-center text-md-center text-lg-center">
				<img :src="imageUrl" height="150" v-if="imageUrl"/>
				<v-text-field label="Select File" @click='pickFile' v-model='imageName' prepend-icon='attach_file'></v-text-field>
				<input
					type="file"
					style="display: none"
					ref="image"
					accept="image/*"
					@change="onFilePicked"
				>
			</v-flex>
			
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" flat @click="dialog = false">Guardar</v-btn>
          <v-btn color="green darken-1" flat @click="dialog = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>


</template>  





<script>
  export default {
    data: () => ({
        dialog: false,
    }),
}
</script>