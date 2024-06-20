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
                  Consumables
              </div>
          </v-col>
          <v-col>
             
                  <NavBar />
            
             
          </v-col>
      </v-row>
  
     </v-container>
  
  
  
    <v-container>
     


  <v-sheet  class="mx-auto" :height="200" :width="400">
    <div class="d-flex  mx-auto">
  <v-img src="/eq1.png" class="mt-5" width="170" height="150" ></v-img>
<div class="  mx-auto mt-5" >
      <v-btn class="text-none text-subtitle-1 mx-auto  ml-7"
              color="#0082E0"
              size="large"
              variant="flat"
              rounded="lg"
              width="150px"
              density="compact">
        equipment
      </v-btn>

    <v-card-text style="font-weight: bold;">
      Cartouche Canon 511 (Co)
    </v-card-text>
</div>
</div>

</v-sheet>

  </v-container>
  <v-container>
    <v-sheet
    class="mx-auto"
    style=" background-color: transparent !important;"
    elevation=""
    max-width="800"
  >
    <v-slide-group
      v-model="model"
      class="pa-4"
      
      show-arrows
    >
      <v-slide-group-item
        v-for="n in 15"
        :key="n"
        v-slot="{ isSelected, toggle, selectedClass }"
      >
        <v-card
          color="#FFFFFF"
          :class="['ma-4', selectedClass]"
          height="220"
          width="190"
          @click="toggle"
        >
        <div class=" align-center " style="text-align: center;">
          <v-img src="/co2.png" class="mt-5 ml-5" width="150" height="100" ></v-img>
          <v-card-text>Cable Alimentation</v-card-text>
          <v-btn density="compact" color="#0082E0"  size="large" icon="mdi mdi-plus"></v-btn>
        </div>
          
        </v-card>
      </v-slide-group-item>
    </v-slide-group>
  </v-sheet>
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
    data() {
      return {
        list: [
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
          { text: "Cartouche Canon 511 (Co)", img: "eq1.png", link: "/consumables" },
        ],
      };
    },
   
    components: {
      SideBare,
      NavBar,
  
    },
  };
  </script>
  <style scoped></style>
  