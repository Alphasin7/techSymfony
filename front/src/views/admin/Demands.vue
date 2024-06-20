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
        <v-toolbar-title>Demands</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog
          v-model="dialog"
          max-width="500px"
        >
          
          <v-card>
            <v-card-title>
              <span class="text-h5">Answer reuqest</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                    <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    >
                        <p class="text-h6">
                          user
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="12"
                    >
                        <p class="text-body-1">
                         {{ editedItem.fullname }}
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    >
                        <p class="text-h6">
                          reason
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="12"
                    >
                        <p class="text-body-1">
                         {{ editedItem.reason }}
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    >
                        <p class="text-h6">
                          start date
                        </p>
                    </v-col>
                    <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    >
                        <p class="text-h6">
                          end date
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    >
                    <p class="text-body-1">
                         {{ editedItem.sdate }}
                        </p>
                    </v-col>
                    <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    >
                    <p class="text-body-1">
                         {{ editedItem.fdate }}
                        </p>
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
                color="red"
                variant="text"
                @click="refuse"
              >
                Refuse
              </v-btn>
              <v-btn
                color="green"
                variant="text"
                @click="accept"
              >
                Accept
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
    
      </v-toolbar>
    </template>

    <template v-slot:item.actions="{ item }">
      <v-icon
        size="small"
        class="me-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
    
    </template>
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
  import SideBar from "@/components/admin/SideBar.vue";
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
        { title: 'Actions', key: 'actions', sortable: false ,align: 'center'},
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
    },

    methods: {
      fetchData() {
        this.loading=true
    axios.get('http://localhost:8000/conge',)
      .then(response => {
        this.requests = response.data;
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
          this.editedIndex = -1
        })
      },

     

      async accept () {
        this.editedItem.progress = 'A'
       try{ const response = await axios.post(`http://localhost:8000/conge/${this.editedItem.id}/edit`, this.editedItem)
           if(response.data.message==='S'){
            Object.assign(this.requests[this.editedIndex], this.editedItem)
           }
           console.log('User updated successfully:', response);
          }catch(error){
            console.error('Error updating user:', error);
          }
          
        this.close()
      },
     async  refuse () {
        this.editedItem.progress = 'R'
       try{ const response = await axios.post(`http://localhost:8000/conge/${this.editedItem.id}/edit`, this.editedItem)
           if(response.data.message==='S'){
            Object.assign(this.requests[this.editedIndex], this.editedItem)
           }
           console.log('User updated successfully:', response);
          }catch(error){
            console.error('Error updating user:', error);
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
  