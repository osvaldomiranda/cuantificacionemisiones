<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="800px">
<!--       <template v-slot:activator="{ on }">
        <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
      </template> -->


        <v-card class="px-5">
          <br>
          <v-layout>
                    <span class="title">Comentarios</span>
                </v-layout>
                  <v-layout>
                    <v-flex xs8 class="px-1">
                         <v-text-field  v-model="comment" label="Observación"></v-text-field> 
  
                    </v-flex>
 
                    <v-flex xs4>
                      <v-btn @click="createComment" class="ma-2" tile outline color="main_green">Ingresar Observación</v-btn> 
                    </v-flex>
                  </v-layout> 
                <br>
                <v-layout>
                  <v-flex xs12>
                  <v-data-table dense 
                    :headers="headers" 
                    :items="comments" 
                    item-key="name" 
                    class="elevation-1"
                  > 
                  <template v-slot:items="props">
                                <tr @click="showAlert(props.item)">
                                    <td class="text-xs-left">{{ props.item.comment }}</td>                
                                    <td class="text-xs-left">{{ props.item.created_at }}</td>
                                    <td class="text-xs-left">{{ props.item.state }}</td>
                                    <td class="text-xs-left"></td>
                                </tr>
                            </template>
                  </v-data-table>
                  </v-flex>
                </v-layout>
                <br>  
  
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
        comments:[],
        comment:'',
        headers:[ 
            { text: 'Comentario', value: '' },
            { text: 'Fecha', value: '' },
            { text: 'Estado', value: '' },
            ],
    }),
    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        var app = this;
        axios.get('/api/comments?declaration_id=' + app.declaration.id)
            .then(function (resp) {    
                app.comments = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });
      },

      createComment (){
        //alert("CREATE");
        var app = this;
        axios.post('/api/comment/create?declaration_id=' + app.declaration.id+'&comment='+app.comment)
            .then(function (resp) {    
                app.comments = resp.data;
            })
            .catch(function (resp) {
                console.log(resp);
                alert("Error sources/refresh :" + resp);
            });
      }
    }
  }  
</script>