<template>
    <v-app
          :style="{  background: '#F5F5F5' }"
        >
          <SideBar/>
          <v-main>
      <v-container class="px-1 mt-n2" >
        <v-row>
          <v-col >
             
          </v-col>
          <v-col>
             
                  <NavBar />
            
             
          </v-col>
      </v-row>
  
     </v-container>

    
      <v-container class="px-6 mt-n2" fluid>
        <v-data-table
         :headers="headers"
         :items="requests"
         height="500"
         :loading="loading"
  >
    
  <template v-slot:top>
      <v-toolbar
        flat
        :color="'rgb(232, 252, 255)'"
      >
        <v-toolbar-title>Days-off</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="700px"
        >
          <template v-slot:activator="{ props }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="props"
            >
              new
            </v-btn>
          </template>
          <v-card>
            <v-card-title>  
              <span class="text-h5">New</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editedItem.fullname"
                      label="Fullname"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editedItem.department"
                      label="department"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                      v-model="editedItem.reason"
                      label="reason"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                     type="date"
                      v-model="editedItem.sdate"
                      label="start date yy-mm-dd"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-text-field
                    type="date"
                      v-model="editedItem.fdate"
                      label="end date yy-mm-dd"
                    ></v-text-field>
                </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="close"
              >
                Cancel
              </v-btn>
              <v-btn
                color="blue-darken-1"
                variant="text"
                @click="save"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        
    
      </v-toolbar>
    </template>

   <!-- <template v-slot:item.actions="{ item }">
      <v-icon
        size="small"
        class="me-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon> 
    
    </template>-->
    <template v-slot:no-data>
      <v-btn
        color="primary"
        @click="initialize"
      >
        Reset
      </v-btn>
    </template>
    <template v-slot:item.progress="{ item }">
        <div class="text-center ">
          <v-chip
            :color="getColor(item.progress)"
            :text="getText(item.progress)"
            class="text-uppercase"
            label
            size="small"
          ></v-chip>
        </div>
      </template>
  </v-data-table>
      </v-container>
   



     </v-main>

          
        </v-app>
  </template>
  
  <script setup>
  import NavBar from "@/components/employe/NavBar.vue";
import SideBar from "@/components/employe/SideBare.vue";
  import axios from 'axios';
  </script>
  <script>
  export default {
    data: () => ({
      loading:false,
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          title: 'Fullname',
          align: 'start',
          sortable: false,
          key: 'fullname',
        },
        { title: 'Department', key: 'department' },
        { title: 'Reason', key: 'reason' },
        { title: 'Start date ', key: 'sdate', },
        { title: 'End date ', key: 'fdate', },
       // { title: 'Actions', key: 'actions', sortable: false ,align: 'center'},
        { title:  'Progress', key:'progress',align: 'center'},
        
       
      ],
      requests: [],
      editedIndex:-1,
      editedItem: {
        id:0,
       fullname:'',
       department:'',
       reason:'',
       sdate:'',
       fdate:'',
       progress:''
      },
      defaultItem: {
        id:0,
       fullname:'',
       department:'',
       reason:'',
       sdate:'',
       fdate:'',
       progress:''
      },
      
    }),



    watch: {
      dialog (val) {
        val || this.close()
      },
      
    },

    created () {
      this.fetchData()
      let dataRaw = localStorage.getItem('data');
        let  data = JSON.parse(dataRaw);
        this.editedItem.fullname=data.fullname
    },

    methods: {
      fetchData() {
        const dataRaw = localStorage.getItem('data');
        const  data = JSON.parse(dataRaw);
        this.loading=true
    axios.get(`http://localhost:8000/conge/only/${data.id}`,)
      .then(response => {
        if(!response.data.error){
          this.requests = response.data;
        }
       console.log(response.data)
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      }).finally(()=>{
        this.loading=false;
      })
  },

      editItem (item) {
        this.editedIndex = this.requests.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },


      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          let dataRaw = localStorage.getItem('data');
        let  data = JSON.parse(dataRaw);
        this.editedItem.fullname=data.fullname
          this.editedIndex = -1
        })
      },

     

      async save () {
        const dataRaw = localStorage.getItem('data');
        const  data = JSON.parse(dataRaw);
        this.editedItem.progress = 'y'
        this.editedItem.id=data.id
        try{
           const response = await axios.post('http://localhost:8000/conge/new', this.editedItem)
           if(response.data.state==='S'){
            this.requests.push(this.editedItem)
           }
           console.log('request success:', response);
          }catch(error){
            console.error('requests fail:', error);
          // Handle error, show error message, etc.
          }
          
        this.close()
      },
     
      getColor(progress){
        switch(progress){
            case 'R': return'red'
            case 'A': return'green'
            default : return 'yellow'
        }
      },
      getText(progress){
        switch(progress){
            case 'R': return'Refused'
            case 'A': return'Accepted'
            default : return 'Waiting'
        }
      }

    },
  }
</script>
  
  <style scoped></style>
  