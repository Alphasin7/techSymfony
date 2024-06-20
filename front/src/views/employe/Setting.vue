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
                 style="background-color: #EAEEED;
                 width: 190px;height: 35px;font-size:25px;text-align: center;
                 border-radius: 10px;
                 font-weight: bold;">
                  Setting
              </div>
          </v-col>
          <v-col>
             
                  <NavBar />
            
             
          </v-col>
      </v-row>
  
     </v-container>
  
  
  

  
      </v-main>
          
        </v-app>
  </template>
  
  <script setup>
  import NavBar from "@/components/employe/NavBar.vue";
  import SideBare from "@/components/employe/SideBare.vue";
  
  </script>
  <script>
  
  
  
  export default {
   
   
    components: {
      SideBare,
      NavBar,
  
    },
  };
  </script>
  <style scoped></style>
  