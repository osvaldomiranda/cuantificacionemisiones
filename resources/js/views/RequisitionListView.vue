<template>
  <v-data-table
    v-model="selected"
    :headers="headers"
    :items="requisitions"
    item-key="name"
    select-all
    class="elevation-1"
  >
    <template v-slot:items="props">
      <td>
        <v-checkbox
          v-model="props.selected"
          primary
          hide-details
        ></v-checkbox>
      </td>
      <td>{{ props.item.retc_id }}</td>
      <td>{{ JSON.parse(props.item.data)["empresa"]["rut"] }} - {{JSON.parse(props.item.data)["empresa"]["digito"]}}</td>
      <td>{{ JSON.parse(props.item.data)["empresa"]["razon"] }} </td>
      <td>{{ JSON.parse(props.item.data)["establecimiento"]["nombre"] }} </td>
      <td>{{ props.item.state }}</td>
      <td>
      <td class="justify-center layout px-0"> 
            <v-btn small v-if="props.item.state=='PENDIENTE'" @click="approve_requisition(props.item)" color="success">Aprobar</v-btn>
      </td> 
      <td class="justify-center layout px-0"> 
            <v-btn small  v-if="props.item.state=='PENDIENTE'"  @click="refuse(props.item)" color="success">Rechazar</v-btn>
      </td> 
    </template>
  </v-data-table>
</template>


<script>
  import { mapState } from 'vuex';
  export default {
    data () {
      return {
        selected: [],
        requis:"hola",
        headers: [
            { text: 'Solicitud', value: 'retc_id' },
            { text: 'Rut', value: 'state' },
            { text: 'Empresa', value: 'state' },
            { text: 'Establecimiento', value: 'state' },
            { text: 'Estado', value: 'state' }        
        ],
        requisitions: [
        ]
      }
    },
    created () {
        this.initialize();
    },
    methods: {
        initialize () {  
            var app = this;
            axios.get('/api/requisitions')
                .then(function (resp) {
                    app.requisitions = resp.data

                  //  alert(JSON.stringify(resp.data));
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Requisition Could not load data :" + resp);
                });
        },
        approve_requisition(item){
            var app = this;
            axios.post('/api/requisition/approve', item)
                .then(function (resp) { 
                    app.initialize(); 
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error approve_requisition :" + resp);
                });
        },

        refuse(item){
            var app = this;
            axios.post('/api/requisition/reject', item)
                .then(function (resp) { 
                    app.initialize(); 
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Error reject_requisition :" + resp);
                });

        } 
    }        
  }
</script>