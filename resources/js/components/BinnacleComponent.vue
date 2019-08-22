<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
<!--       <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
      </template> -->
      <v-card>
        <v-card-title>
          <span class="headline">Bitacora</span>
        </v-card-title>
        <v-card-text>
            <v-data-table
                :headers="headers"
                :items="binnacles"
                class="elevation-1"
                hide-actions
            >
                <template v-slot:items="props">
                  <td>
                  <v-checkbox
                    v-model="props.selected"
                    primary
                    hide-details
                  ></v-checkbox>
                  </td>
                  <td class="text-xs-right">{{ props.item.id }}</td>
                  <td class="text-xs-right">{{ props.item.created_at }}</td>
                  <td class="text-xs-right">{{ props.item.new_state }}</td>
                </template>
            </v-data-table>
     
        </v-card-text>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn dark color="main_green" text @click="dialog = false">Cerrar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props: {
        declaration: Object
    },

    data: () => ({
      dialog: true,
      binnacles:[],
    }),
    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        var app = this;
        axios.get('/api/binnacles?declaration_id=' + app.declaration.id)
            .then(function (resp) {    
                app.binnacles = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });
      },
    }
  }  
</script>