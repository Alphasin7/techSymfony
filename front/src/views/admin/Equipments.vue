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
          <template v-slot:activator="{ props }">
            <v-btn
              color="primary"
              dark
              class="mb-2"
              v-bind="props"
            >
              Add equipment
            </v-btn>
          </template>
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
        class="me-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        size="small"
        @click="deleteItem(item)"
      >
        mdi-delete
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
  import SideBar from "@/components/admin/SideBar.vue";
  import axios from 'axios';
  </script>
  <script>
  export default {
    data: () => ({
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          title: 'ID',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Label', key: 'label' },
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
        return this.editedIndex === -1 ? 'New Equipment' : 'Edit Equipment'
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

     async deleteItemConfirm () {
        try{
           const response = await axios.post(`http://localhost:8000/equipement/${this.editedItem.id}`)
           if(response.data.info==='D'){
            this.equipments.splice(this.editedIndex, 1)
           }
           console.log('equip deleted successfully:', response);
          }catch(error){
            console.error('equip deleting user:', error);
          // Handle error, show error message, etc.
          }
        this.closeDelete()
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

      async save () {
        if(typeof this.editedItem.image[0].name !=='undefined' ){
          await this.uploadFile();
          this.editedItem.image[0]=this.editedItem.image[0].name 

        }
        if (this.editedIndex > -1) {
          try{
           const response = await axios.post(`http://localhost:8000/equipement/${this.editedItem.id}/edit`, this.editedItem)
           if(response.data.message==='S'){
            Object.assign(this.equipments[this.editedIndex], this.editedItem)
           }
           console.log('equipment updated successfully:', response);
          }catch(error){
            console.error('Error updating equipment:', error);
          // Handle error, show error message, etc.
          }
        } else {
          try{
           const response = await axios.post('http://localhost:8000/equipement/new', this.editedItem)
           if(response.data.id!==null){
            this.editedItem.id=response.data.id
            this.equipments.push(this.editedItem)
           }
           console.log('equipment added successfully:', response);
          }catch(error){
            console.error('Error adding equipment:', error);
          // Handle error, show error message, etc.
          }
        }
        this.close()
      },
      async uploadFile() {
      const file = this.editedItem.image[0];
    console.log(file);
      const formData = new FormData();
      formData.append('file', file);

      
      try{
        const response = await axios.post('http://localhost:8000/equipement/save', formData);
        if(response.data.results==="F"){
          console.log('success uploading image:', response);
        }
      }catch(error){
        console.error('error uploading image:',error)
      }
       
    }

    },
  }
</script>
  
  <style scoped></style>
  