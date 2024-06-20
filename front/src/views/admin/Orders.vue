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
  >
    
  <template v-slot:top>
      <v-toolbar
        flat
        :color="'rgb(232, 252, 255)'"
      >
        <v-toolbar-title>Orders</v-toolbar-title>
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
              <span class="text-h5">Answer order</span>
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
                          User
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
                          Consumable
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="12"
                    >
                        <p class="text-body-1">
                         {{ editedItem.consumable }}
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
                          Quantity
                        </p>
                    </v-col>
                   </v-row>
                   <v-row>
                    <v-col
                    cols="12"
                    sm="12"
                    >
                        <p class="text-body-1">
                         {{ editedItem.quantity }}
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
  
  </script>
  <script>
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          title: 'Fullname',
          align: 'start',
          sortable: false,
          key: 'fullname',
        },
        { title: 'Equipment', key: 'consumable' },
        { title: 'Quantity', key: 'quantity', },
        { title: 'Actions', key: 'actions', sortable: false ,align: 'center'},
        { title:  'Progress', key:'progress',align: 'center'},
        
       
      ],
      requests: [],
      editedIndex:-1,
      editedItem: {
       fullname:'',
       department:'',
       consumable:'',
       quantity:'',
       progress:'',
       
      },
      
    }),



    watch: {
      dialog (val) {
        val || this.close()
      },
      
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
        this.requests = [
          {
           fullname:'Fedi ben salah',
           department:'technology and information',
           consumable:'souris dell',
           quantity:'1',
           progress:'w',
           description:'Our team found out that the auth api is not working properly and its effecting our progress.'
          },
          {
           fullname:'Ali maaloul',
           department:'technology and information',
           consumable:'clavier',
           quantity:'2',
           progress:'R',
           description:'Our team found out that the auth api is not working properly and its effecting our progress.'
          },
          
        ]
      },

      editItem (item) {
        this.editedIndex = this.requests.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },


      close () {
        this.dialog = false
      },

     

      accept () {
        this.editedItem.progress = 'A'
          Object.assign(this.requests[this.editedIndex], this.editedItem)
        this.close()
      },
      refuse () {
        this.editedItem.progress = 'R'
          Object.assign(this.requests[this.editedIndex], this.editedItem)
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
  