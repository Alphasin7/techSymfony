<template>
  <v-app
        :style="{  background: '#F5F5F5' }"
      >
        <SideBare/>
        <v-main>
    <v-container class="px-1 mt-n2" >
      <v-row>
        <v-col >
            <div 
            style="background-color: #FFFFFF;
               width: 190px;height: 35px;font-size:25px;text-align: center;
               border-radius: 10px;
               font-weight: bold;" class="ml-4">
                Profil
            </div>
        </v-col>
        <v-col>
           
                <NavBar />
          
           
        </v-col>
    </v-row>

   </v-container>

   <v-sheet  class="mx-auto " :height="400" :width="600" 
    style="border-radius: 20px;box-shadow: 1px 1px 2px 2px #b6b4b4;">  

<v-form @submit.prevent="submit" style="width: 600px;" class="mx-auto mt-6">
  <v-container >
    <v-row>
      <v-col
        cols="12"
        sm="6"
      >
      <v-text-field
          variant="outlined"
          v-model="name.value.value"
          label="First name"
          prepend-inner-icon="mdi mdi-account"
          :error-messages="name.errorMessage.value"
        ></v-text-field>
      </v-col>

      <v-col
        cols="12"
        sm="6"
      >
      <v-text-field
          variant="outlined"
          label="Last name"
          prepend-inner-icon="mdi mdi-account"
          v-model="lastname.value.value"
          :error-messages="lastname.errorMessage.value"
        ></v-text-field>
      </v-col>
      <v-col
        cols="12"
        sm="6"
      >
      <v-text-field
          variant="outlined"
          label="Email"
          prepend-inner-icon="mdi mdi-email"
          v-model="email.value.value"
          :error-messages="email.errorMessage.value"
        ></v-text-field>
      </v-col>
      <v-col
        cols="12"
        sm="6"
      >
      <v-text-field
          variant="outlined"
          label="address"
          prepend-inner-icon="mdi mdi-map-marker"
          v-model="address.value.value"
          :error-messages="address.errorMessage.value"
        ></v-text-field>
      </v-col>
      <!--<v-col
        cols="12"
        sm="6"
      >
      <v-select
          variant="outlined"
          label="Roles"
          :items="['user', 'admin']"
          v-model="role.value.value"
          :error-messages="role.errorMessage.value"
          >
      </v-select> 
     
      </v-col>-->

      <v-col
        cols="12"
        sm="6"
      >
      <v-text-field
          variant="outlined"
          type="password"
          label="password"
          prepend-inner-icon="mdi mdi-lock"
          v-model="pwd.value.value"
          :error-messages="pwd.errorMessage.value"
        ></v-text-field>
      </v-col>
     
      

      <v-col
        cols="12"
        sm="12"
      >
      
      </v-col>
   
      <v-btn
            class="text-none text-subtitle-1 mx-auto"
            color="#0082E0"
            size="large"
            variant="flat"
            rounded="lg"
            width="150px"
            density="compact"
            type="submit"
          >
            Update
          </v-btn>
          <v-btn @click="handleReset"
            class="text-none text-subtitle-1 mx-auto"
            color="#0082E0"
            size="large"
            variant="flat"
            rounded="lg"
            width="150px"
            density="compact"
            
          >
            Cancel
          </v-btn>
    </v-row>
    </v-container>
    </v-form>
    </v-sheet>




    </v-main>
        
      </v-app>
</template>

<script setup>
import NavBar from "@/components/employe/NavBar.vue";
import SideBare from "@/components/employe/SideBare.vue";
import { ref } from 'vue'
import { useField, useForm } from 'vee-validate'
import axios from "axios";

const { handleSubmit, handleReset } = useForm({
  validationSchema: {
    name (value) {
      if (value?.length >= 2) return true

      return 'First name needs to be at least 2 characters.'
    },
    lastname (value) {
      if (value?.length >= 2) return true

      return 'Last name needs to be at least 2 characters.'
    },
    address (value) {
      if (value?.length >= 2) return true

      return 'First name needs to be at least 2 characters.'
    },
      email (value) {
        if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true

        return 'Must be a valid e-mail.'
      },
   /* role (value) {
      if (value) return true

      return 'select an item.'
    },*/
    pwd (value){
      if (value?.length >= 8) return true
      return 'Password needs to be at least 8 characters.'
    }
    
  },
})
const name = useField('name');
const lastname = useField('lastname');
const address = useField('address');
const email = useField('email');
//const role = useField('role');
const pwd = useField('pwd')

const dataRaw = localStorage.getItem('data');
  const  data = JSON.parse(dataRaw);
 
  name.value.value=data.name
  lastname.value.value=data.lastname
  address.value.value=data.address
  email.value.value=data.email
  const id = data.id


const submit = handleSubmit(async values => {
  localStorage.setItem('data',JSON.stringify({...data,...values}));
  try{const response = await axios.post(`http://localhost:8000/user/${id}/edit`, {...data,...values})
            if(!response.data.error){
            console.log('user updated',response.data)
           }
           
          }catch(error){
            console.error('Error updating user:', error);
          // Handle error, show error message, etc.
          }
})

</script>
<script>



export default {
  data() {
      return {
        email: '',
        password: ''
      };
    },
 created(){
 
 },
  components: {
    SideBare,
    NavBar,

  },
};
</script>
<style scoped></style>
