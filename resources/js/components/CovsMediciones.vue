<template>
  <v-layout row justify-center>
    <v-dialog v-model="dialog" max-width="600px">
      <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Cargar Medición</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Medición de Emisiones</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              	<v-flex xs12 sm6 md4>
                	<v-text-field label="Nro. Correlativo" required></v-text-field>
              	</v-flex>
              	<v-flex xs12 sm6 md4>
                	<v-text-field label="Nro. Registro de Fuente"></v-text-field>
              	</v-flex>
              	<v-flex xs12 sm6 md4>
                	<v-text-field label="Contaminante">COV</v-text-field>
              	</v-flex>
              	<v-flex xs12 sm6 md4>
                	<v-text-field label="Tipo de Descarga"></v-text-field>
              	</v-flex>



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

            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false">Cancelar</v-btn>
          <v-btn color="blue darken-1" flat @click="dialog = false">Subir</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
  export default {
    data: () => ({
      dialog: false
    })
  }
</script>