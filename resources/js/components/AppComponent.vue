<template>
  <v-app id="inspire">

    <v-navigation-drawer
      :clipped="$vuetify.breakpoint.lgAndUp"
      v-model="drawer"
      fixed
      app
      class="side_bar_gray"
    >
      <v-list class="white--text"  dense>
        <template v-for="item in items">
          <v-layout
            v-if="item.heading"
            :key="item.heading"
            :to="item.link"
            row
            align-center
          >
            <v-flex xs4>
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-flex>

          </v-layout>
          <v-list-group
            v-else-if="item.children"
            v-model="item.model"
            :key="item.text"
          >
            <v-list-tile slot="activator" active-class="secondary_green--text">
              <v-list-tile-content>
                <v-list-tile-title>
                  {{ item.text }}
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
            <v-list-tile
              v-for="(child, i) in item.children"

              :key="i"
              @click=""
            >
            </v-list-tile>
          </v-list-group>
          <v-list-tile  active-class="secondary_green--text" :to="item.link" v-else :key="item.text" @click="">

            <v-list-tile-content>
              <v-list-tile-title>
                {{ item.text }}
              </v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-divider color="white"></v-divider>
        </template>
      </v-list>
    </v-navigation-drawer>



    <v-toolbar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      color="main_green"
      app
      fixed
      class="pl-0"
      style="padding-left: 0px"
    >
      <v-btn
        color="#6BEC87"
        dark
        depressed
        style="position:relative; height: 100%"
        @click.stop="drawer = !drawer"
      >
        <v-icon large>menu</v-icon>
      </v-btn>
      <v-toolbar-title class="ml-0 pl-3 white--text">
        <span class="hidden-md-and-down">Cuantificación de Emisiones</span>
        </v-toolbar-title>        
        <v-spacer></v-spacer>
      </v-toolbar-title>

        <!-- <p>Empresa: {{$store.getters.company.name}}</p> -->
        

      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon color="white">notifications</v-icon>
      </v-btn>
    </v-toolbar>

    <v-content>
      <v-container fluid>
        <!-- COntenido -->
        <div class="container">
          <router-view></router-view>
        </div>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  import Vue from 'vue'; 
  import router  from './../routes';
  export default {
    data: () => ({
      dialog: false,
      drawer: null,
      step:"",
      establishment: null,
      naturalStates:[],
      items: [
        { icon: 'contacts', text: 'Bienvenida', link: '/welcome' },
        { icon: 'wrap_text', text: 'Declaraciones', link: '/send_list'}, 
        { icon: 'wrap_text', text: 'Administrar Declaraciones', link: '/send_admin'}, 
        { icon: 'wrap_text', text: 'Administrar Solicitudes', link: '/requisition_list'},     
        { icon: 'wrap_text', text: 'Preguntas Frecuentes', link: '/'},
        { icon: 'wrap_text', text: 'Tutoriales', link: '/'},
      ]
    }),
    created () {
      this.sourceRefresh();


    },
    methods: {



        // async initialize() { 
        //   var app = this 
        //   await axios.get('/api/set_user')
        //   .then(async function (resp) {
        //     alert(JSON.stringify(resp.data));
        //     alert(JSON.stringify(resp.data[0]['user']))
        //     // app.$store.commit('changeUser',resp.data[0]['user']);
        //     // app.$store.commit('changeEstablishment',resp.data[0]['establishment']);        
           
        //   })
        //   .catch(function (resp) {
        //       console.log(resp);
        //       alert("Could not load data :" + resp);
        //   });



        // },

        sourceRefresh (){
            axios.get('/api/sources/refresh')
                .then(function (resp) {
                   alert("Fuentes Actualizadas")    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });
            
            axios.get('/api/diagram/refresh')
                .then(function (resp) {    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error sources/refresh :" + resp);
                });
        },

    }
}
</script>