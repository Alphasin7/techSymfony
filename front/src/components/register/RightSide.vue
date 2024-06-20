<template>
   
  <div class="flex-auto w-[60%] flex flex-col justify-center items-center border-y-2 border-r-2 border-slate-300 rounded-r-lg " >
      <div class=" text-[#004aad] text-[36px] font-extrabold pb-10 ">Create Account</div>
      <div class=" w-[45%] pb-5">
      </div>
    <!--<input class=" bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-[#004aad]" id="inline-full-name" type="text" value="" label="nom" aria-label="nom">
  </div>
  <div class=" w-[45%] pb-5">
    <input class=" bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-[#004aad]" id="inline-full-name" type="text" value="email">
  </div>
  <div class="md:w-[45%] pb-5">
    <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-[#004aad]" id="inline-password" type="password" placeholder="******************">
  </div>


  <div class="text-xl font-bold pb-5">
      Forget your Password?
  </div>
-->
<v-form @submit.prevent="submit" style="width: 600px;" class="mx-auto mt-5 pt-2">
<v-container >
  <v-row>
    <v-col
      cols="12"
      sm="6"
    >
    <v-text-field
        variant="outlined"
        v-model="firstname.value.value"
        label="First name"
        prepend-inner-icon="mdi mdi-account"
        :error-messages="firstname.errorMessage.value"
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
        label="birth date"
        v-model="birthdate.value.value"
        :error-messages="birthdate.errorMessage.value"
        type="date"
      ></v-text-field>
    </v-col>
   
    <v-col
      cols="12"
      sm="6"
    >
    <v-text-field
        variant="outlined"
        label="Adresse"
        v-model="address.value.value"
        prepend-inner-icon="mdi mdi-map-marker"
        :error-messages="address.errorMessage.value"
      ></v-text-field>
    </v-col>
    <v-col
      cols="12"
      sm="6"
    >
    <v-select
        variant="outlined"
        label="Role"
        :items="['admin','user']"
        v-model="role.value.value"
        :error-messages="role.errorMessage.value"
        >
    </v-select>
    </v-col>
   
   


    <v-col
      cols="12"
      sm="6"
    >
    <v-text-field
        variant="outlined"
        label="Password"
        type="password"
        v-model="password.value.value"
        prepend-inner-icon="mdi mdi-lock"
        :error-messages="password.errorMessage.value"
      ></v-text-field>
    </v-col>
 
    
  </v-row>
  <div>
      <button class="shadow bg-[#004aad] hover:bg-[#005fad] focus:shadow-outline focus:outline-none text-white font-bold py-2 px-10 rounded-3xl " style="margin-left: 170px;margin-top: 10px;" type="submit" >
      Sign Up
    </button>
  </div>
  </v-container>
  </v-form>
  
  </div>
</template>

<script setup>
import NavBar from "@/components/employe/NavBar.vue";
import SideBare from "@/components/employe/SideBare.vue";
import { ref } from 'vue'
import { useField, useForm } from 'vee-validate'
import axios from "axios";

const { handleSubmit, handleReset } = useForm({
validationSchema: {
  firstname (value) {
    if (value?.length >= 2) return true

    return 'First name needs to be at least 2 characters.'
  },
  lastname (value) {
    if (value?.length >= 2) return true

    return 'Last name needs to be at least 2 characters.'
  },
  address (value) {
    if (value?.length >= 2) return true

return 'Adress is a required..'
    },
    email (value) {
      if (/^[a-z.-]+@[a-z.-]+\.[a-z]+$/i.test(value)) return true

      return 'Must be a valid e-mail.'
    },
    birthdate (value) {
      if (value?.length >= 0) return true

      return 'birth date is a required.'
    },
    password (value) {
    if (value?.length >= 5) return true

    return 'Password must contain at least one lowercase,uppercase letter,digit (number).'
  },
  role (value) {
    if (value) return true

    return 'role an item.'
  },

},
})
const firstname = useField('firstname');
const lastname = useField('lastname');
const email = useField('email');
const address = useField('address');
const birthdate = useField('birthdate');
const password = useField('password');
const role = useField('role');




const submit = handleSubmit(async (values) =>  {
  console.log(values)
  try{const response = await axios.post('http://localhost:8000/user/new', values)
            if(response.data.status!==null){
             alert("You registered successfully")
            console.log(response.data)
           }else{
            alert("There is an error, try again.")
           }
           console.log('User addedsuccessfully:', response);
          }catch(error){
            alert("There is an error, try again.")
            console.error('Error adding user:', error);
          // Handle error, show error message, etc.
          }

})



</script>
<script>



export default {


components: {
  SideBare,
  NavBar,

},
};
</script>