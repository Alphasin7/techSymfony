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
         :items="equipments"
         height="500"
  >
    <template v-slot:top>
      <v-toolbar
        flat
        :color="'rgb(232, 252, 255)'"
      >
        <v-toolbar-title>Equipments</v-toolbar-title>
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
              <span class="text-h5">{{ formTitle }}</span>
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
                      v-model="editedItem.label"
                      label="Label"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-file-input
                      v-model="editedItem.image"
                      label="Image"
                    ></v-file-input>
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
        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.image="{ item }">
        <v-card class="my-2" elevation="2" rounded>
          <v-img
            :src="`http://localhost:8000/images/${item.image}`"
            height="150"
            cover
          ></v-img>
        </v-card>
      </template>
    <template v-slot:item.actions="{ item }">
      
      <v-icon
        size="small"
        @click="addToCart(item)"
      >
        mdi-cart
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
      dialog: false,
      dialogDelete: false,
      cart:[],
      headers: [
        
        { align: 'start',title: 'Label', key: 'label' },
        { title: 'Image', key: 'image' },
        { title: 'Actions', key: 'actions', sortable: false },
       
      ],
      equipments: [],
      editedIndex: -1,
      editedItem: {
        id: 0,
        label: "",
        image: [""],
      },
      defaultItem: {
        id: 0,
        label: "equipment",
        image: [],
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },

    created () {
      const storedCart = localStorage.getItem('cart');
    this.cart = storedCart ? JSON.parse(storedCart) : [];
      this.fetchData()
    },

    methods: {
      fetchData() {
        this.loading=true
    axios.get('http://localhost:8000/equipement')
      .then(response => {
        this.equipments = response.data;
      })
      .catch(error => {
        equipments = this.defaultItem;
        console.error('Error fetching data:', error);
      }).finally(()=>{
        this.loading=false;
      })
  },

      editItem (item) {
        this.editedIndex = this.equipments.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.equipments.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

     

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      closeDelete () {
        this.dialogDelete = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },
      addToCart(item){
      this.cart.push(item);
      console.log(this.cart)
      localStorage.setItem('cart', JSON.stringify(this.cart));
        
      }
    }
    
  }
</script>
  
  <style scoped></style>
  