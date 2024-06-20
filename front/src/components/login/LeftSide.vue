
<template>
    <div class="flex-auto w-[60%] flex flex-col justify-center items-center border-y-2 border-l-2 border-slate-300 rounded-l-lg " >
        <div class=" text-[#004aad] text-[36px] font-extrabold pb-10 ">Sign in</div>
        <div class=" w-[45%] pb-5">
      <input v-model="email" class=" bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-[#004aad]" id="inline-full-name" type="text" value="username">
    </div>
    <div class="md:w-[45%] pb-5">
      <input v-model="password" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-[#004aad]" id="inline-password" type="password" placeholder="******************">
    </div>
    <div class="text-xl font-bold pb-5">
        Forget your Password?
    </div>
    <div>
        <button @click="sendData" class="shadow bg-[#004aad] hover:bg-[#005fad] focus:shadow-outline focus:outline-none text-white font-bold py-2 px-10 rounded-3xl" type="button">
        Sign In
      </button>
    </div>
    </div>
</template>


<script setup>
  import axios from 'axios';
  import { jwtDecode } from 'jwt-decode';
  </script>
  <script>
  export default {
    data() {
      return {
        email: '',
        password: ''
      };
    },
   methods: {
      async sendData() {
        try{
    const response = await axios.post('http://localhost:8000/api/login_check',{email:this.email,password:this.password})
       if(response){
       // localStorage.setItem('refresh','true');
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('data',  JSON.stringify(response.data.data));
        const decodedToken = jwtDecode(response.data.token);
        const roles = decodedToken.roles
        /*if(roles[0]==='user' || roles[0]==='ROLE_USER'){
          this.$router.push('/home')
          localStorage.setItem('to','/home')
        }else{
          this.$router.push('/dashboard')
          localStorage.setItem('to','/dashboard')

        }*/
        window.location.reload()
       }
        }catch(error) {
        console.error('Error fetching data:', error);
      }
  },
    }
  }
  </script>