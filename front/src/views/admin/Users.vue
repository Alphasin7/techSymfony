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
         :items="users"
         height="500"
         :loading="loading"
  >
    <template v-slot:top>
      <v-toolbar
        flat
        :color="'rgb(232, 252, 255)'"
      >
        <v-toolbar-title>users</v-toolbar-title>
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
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.name"
                      label="Name"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.lastname"
                      label="Lastname"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.birthdate"
                      label="Birthdate"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.address"
                      label="Address"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.email"
                      label="email"
                    ></v-text-field>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="6"
                    md="4"
                  >
                    <v-text-field
                      v-model="editedItem.role"
                      label="role"
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
      loading:false,
      dialog: false,
      dialogDelete: false,
      headers: [
        {
          title: 'ID',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Fullname', key: 'fullname' },
        { title: 'Birthdate', key: 'birthdate' },
        { title: 'Address', key: 'address' },
        { title: 'Email', key: 'email' },
        { title: 'Role', key: 'role' },
        { title: 'Actions', key: 'actions', sortable: false },
       
      ],
      users: [],
      editedIndex: -1,
      editedItem: {
            id: 0,
            fullname: "",
            name:"",
            lastname:"",
            birthdate: "",
            address:"",
            email:"",
            role:""
          },
      defaultItem:{
            id: 0,
            fullname: "",
            name:"",
            lastname:"",
            birthdate: "",
            address:"",
            email:"",
            role:""
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
      this.fetchData()
    },

    methods: {
      fetchData() {
        this.loading=true
    axios.get('http://localhost:8000/user',)
      .then(response => {
      console.log(response.data)
        this.users = response.data;
      })
      .catch(error => {
        console.error('Error fetching data:', error);
      }).finally(()=>{
        this.loading=false;
      })
  },
    
      editItem (item) {
        this.editedIndex = this.users.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },

      deleteItem (item) {
        this.editedIndex = this.users.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
      },

     async deleteItemConfirm () {
        try{
           const response = await axios.post(`http://localhost:8000/user/${this.editedItem.id}`)
           if(response.data.info==='D'){
            this.users.splice(this.editedIndex, 1)
           }
           console.log('User deleted successfully:', response);
          }catch(error){
            console.error('Error deleting user:', error);
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
        
        this.editedItem.fullname = this.editedItem.name +' '+this.editedItem.lastname;
        if (this.editedIndex > -1) {
          try{
           const response = await axios.post(`http://localhost:8000/user/${this.editedItem.id}/edit`, this.editedItem)
           if(response.data.message==='S'){
            Object.assign(this.users[this.editedIndex], this.editedItem)
           }
           console.log('User updated successfully:', response);
          }catch(error){
            console.error('Error updating user:', error);
          // Handle error, show error message, etc.
          }
        } else {
          try{
           const response = await axios.post('http://localhost:8000/user/new', this.editedItem)
           if(response.data.id!==null){
            this.editedItem.id=response.data.id
            this.users.push(this.editedItem)
           }
           console.log('User addedsuccessfully:', response);
          }catch(error){
            console.error('Error adding user:', error);
          // Handle error, show error message, etc.
          }
          
        }
        this.close()
      },

    },
  }
</script>
  
  <style scoped></style>
  