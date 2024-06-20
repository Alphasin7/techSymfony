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
      <v-row class="ml-6 mt-3">
        <v-col cols="12" sm="3">
          <v-card
            class="rounded-xs"
            height="90"
            width="270"
          >
            <div class="d-flex flex-no-wrap ">
              <v-avatar class="ml-5 mt-2" size="70px" color="#ffc7c2">
                  <v-icon icon="mdi mdi-account-multiple" size="x-large" color="#f24822" ></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h5 mt-0">
                  USERS
                </v-card-text>

                <v-card-subtitle> {{this.info.user}} </v-card-subtitle>
              </div>
             <!--<v-img src="av.png" class="mr-4 mt-5" absolute></v-img>--> 
            </div>
          </v-card>
        </v-col>
        <v-col cols="12" sm="3">
          <v-card
          class="rounded-xs"
            height="90"
            width="270"
          >
            <div class="d-flex flex-no-wrap ">
              <v-avatar class="ml-5 mt-2" size="70px" color="#fff1c2">
                  <v-icon icon="mdi mdi-cart" size="x-large" color="#eba611"></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h5 mt-0"> ORDERS </v-card-text>

                <v-card-subtitle>620</v-card-subtitle>
              </div>
             <!--<v-img src="av.png" class="mr-4 mt-5" absolute></v-img>--> 
            </div>
          </v-card>
        </v-col>
        <v-col cols="12" sm="3">
          <v-card
          class="rounded-xs"
            height="90"
            width="270"
          >
            <div class="d-flex flex-no-wrap ">
              <v-avatar class="ml-5 mt-2" size="70px" color="#d9b8ff">
                  <v-icon icon="mdi mdi-laptop" size="x-large" color="#9747ff"></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h5 mt-0">
                  EQUIPMENT
                </v-card-text>

                <v-card-subtitle>{{this.info.equip}}</v-card-subtitle>
              </div>
              <!--<v-img src="map.png" class="mr-4 mt-5" absolute></v-img>-->
            </div>
          </v-card>
        </v-col>
        

        
        <v-col cols="12" sm="8" class="mt-2">
          <v-card class="mx-auto" height="400px">
            <v-card-item >
              <BarChart />
            </v-card-item>
          </v-card>
        </v-col>

        <v-col cols="12" sm="4" class="mt-1">
          <v-card class="mx-auto" height="350px">
            <v-card-item>
      
              <v-col cols="12" sm="3">
          <v-card
          class="rounded-xs"
            height="90"
            width="290"
          >
            <div class="d-flex flex-no-wrap">
              <v-avatar class="ml-5 mt-2" size="65px" color="#FFF799">
                  <v-icon icon="mdi mdi-pause-circle-outline" size="x-large" color="#FFD940"></v-icon>
              </v-avatar>
              <div >
                <v-card-text class="text-h6 mt-0">
                  orders in process
                </v-card-text>

                <v-card-subtitle class="ml-5 ">20</v-card-subtitle>
              </div>
             <!-- <v-img src="map.png" class="mr-4 mt-5" absolute></v-img>-->
            </div>
          </v-card>
        </v-col>

        <v-col cols="12" sm="3">
          <v-card
          class="rounded-xs"
            height="90"
            width="290"
          >
            <div class="d-flex flex-no-wrap">
              <v-avatar class="ml-5 mt-2" size="65px" color="#aff4c6">
                  <v-icon icon="mdi mdi-check-circle-outline" size="x-large" color="#009951"></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h6 mt-0">
                  completed orders
                </v-card-text>

                <v-card-subtitle class="ml-5">25</v-card-subtitle>
              </div>
             <!-- <v-img src="map.png" class="mr-4 mt-5" absolute></v-img>-->
            </div>
          </v-card>
        </v-col>

        <v-col cols="12" sm="3">
          <v-card
          class="rounded-xs"
            height="90"
            width="290"
          >
            <div class="d-flex flex-no-wrap">
              <v-avatar class="ml-5 mt-2" size="65px" color="#FFB6B8">
                  <v-icon icon="mdi mdi-close-circle-outline" size="x-large" color="#C60030"></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h6 mt-0">
                  cancelled orders
                </v-card-text>

                <v-card-subtitle class="ml-5">4</v-card-subtitle>
              </div>
             <!-- <v-img src="map.png" class="mr-4 mt-5" absolute></v-img>-->
            </div>
          </v-card>
        </v-col>


           </v-card-item>
           

            <v-card-text class="py-0"> </v-card-text>
          </v-card>
        </v-col>



        <v-col cols="12" sm="8" class="mt-2">
          <v-card class="mx-auto" height="130">
            

            
              <v-row class="ml-6 mt-3 ">
        <v-col cols="12" sm="4" class="ml-4">
          <v-card
            class="rounded-xs"
            height="90"
            width="300"
          >
            <div class="d-flex flex-no-wrap ">
              <v-avatar class="ml-5 mt-2" size="70px" color="#B0CC99">
                  <v-icon icon="mdi mdi-form-select" size="x-large" color="#677E52" ></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h5 mt-0">
                  pending request
                </v-card-text>

                <v-card-subtitle>{{ this.info.rec }}</v-card-subtitle>
              </div>
             <!--<v-img src="av.png" class="mr-4 mt-5" absolute></v-img>--> 
            </div>
          </v-card>
        </v-col>

        <v-col cols="12" sm="3" class="ml-16">
          <v-card
            class="rounded-xs"
            height="90"
            width="320"
          >
            <div class="d-flex flex-no-wrap ">
              <v-avatar class="ml-5 mt-2" size="70px" color="#F6E497">
                  <v-icon icon="mdi mdi mdi-briefcase" size="x-large" color="#BD8D46" ></v-icon>
              </v-avatar>
              <div>
                <v-card-text class="text-h5 mt-0">
                  pending demand
                </v-card-text>

                <v-card-subtitle>{{ this.info.conge }}</v-card-subtitle>
              </div>
             <!--<v-img src="av.png" class="mr-4 mt-5" absolute></v-img>--> 
            </div>
          </v-card>
        </v-col>
        
        </v-row>
           
          </v-card>
          
        </v-col>


        <v-col cols="12" sm="4" class="mt-n12">
          <v-card height="180px" class="">
            <v-card-item title="Top users">
              <v-list lines="two">
                    <v-list-item
                      v-for="folder in folders"
                      :key="folder.title"
                      :title="folder.title"
                      :subtitle="folder.subtitle"
                    >
                      <template v-slot:prepend>
                        <v-avatar color="">
                          <v-img :src="folder.img" alt="John"></v-img>
                        </v-avatar>
                      </template>
                      </v-list-item>
                      </v-list>
                      
            </v-card-item>

          </v-card>
        </v-col>
        
      </v-row>
    </v-container>
 



   </v-main>

        
      </v-app>
</template>

<script setup>
import NavBar from "@/components/employe/NavBar.vue";
import SideBar from "@/components/admin/SideBar.vue";
import BarChart from "@/components/admin/BarChart.vue";
import LineChart from "@/components/admin/LineChart.vue";

</script>
<script>


import axios from 'axios';
export default {

  data: () => ({
    info:{
    },
  folders: [
    {
      subtitle: "John Doe",
      title: "john@gmail.com",
      img: "1.jpg",
    },
    {
      subtitle: "Wilian Ava ",
      title: "wiliam@gmail.com",
      img: "2.jpg",
    },
  ],
  
 
 
}),
  created(){
    this.fetchData()
    },

methods: {
  fetchData() {
    axios.get('http://localhost:8000/user/dash')
      .then(response => {
        this.info = response.data;
        console.log('Nombre d\'utilisateurs:', this.info);
      })
      .catch(error => {
        this.info ={equip:0,conge:0,rec:0,user:0}
        console.error('Error fetching data:', error);
      });
  },
},


  




 
 
  components: {
    SideBar,
    NavBar,
    BarChart,
    LineChart,

  },
};
</script>

<style scoped></style>
