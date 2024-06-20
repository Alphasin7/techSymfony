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
                Equipments
            </div>
        </v-col>
        <v-col>
           
                <NavBar />
          
           
        </v-col>
    </v-row>

   </v-container>



  <v-container>
    <v-row align="center" justify="center">
    <v-col cols="auto" v-for="(variant, i) in list" :key="i"   sm="4" md="1" lg="3">
      <v-card class="mx-auto" max-width="190">
        <v-card-item>
          <div>
            <v-img :src="variant.img" class="mr-4 mt-5 mb-2"></v-img>
            <div class="text-h6">{{ variant.text }}</div>
          </div>
        </v-card-item>

        <v-card-actions class="text-center">
          <router-link :to="variant.link" class="mx-auto" target="_blank">
            <v-btn
              class="text-none text-subtitle-1 mx-auto"
              color="#0082E0"
              size="large"
              variant="flat"
              rounded="lg"
              width="150px"
              density="compact"
            >
              Afficher
            </v-btn>
          </router-link>
        </v-card-actions>
      </v-card>
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
  data() {
    return {
      list: [
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
        { text: "Cartouche Canon 511 (Co)", img: "/eq1.png", link: "/consumables" },
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
