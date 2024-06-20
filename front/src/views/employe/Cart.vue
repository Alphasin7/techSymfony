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
                  Cart
              </div>
          </v-col>
          <v-col>
             
                  <NavBar />
            
             
          </v-col>
      </v-row>
  
     </v-container>
     <v-container
     
     >
    
        <v-card  
        v-for="(item, i) in this.cart"
        :key="i"
        class="mx-auto mt-4" width="720"  style="display: flex;">
        <v-img  :src="`http://localhost:8000/images/${item.image}`" height="90px" width="90px"  ></v-img>
        <v-card-text style="text-align: center;padding-top: 40PX;font-weight: bold;font-size: medium;">
          {{item.label}}
        </v-card-text>
        <v-card-text class="d-flex ml-14 mt-n2" style="padding-top: 45PX;">
                  <v-icon class="mr-2" size="28px" small @click="increaseQuantity">mdi mdi-plus-circle-outline</v-icon>
                  <p style="font-size: 20px;padding-top: 4px;" >{{ quantity }}</p>
                  <v-icon class="ml-1" size="28px" small @click="decreaseQuantity">mdi mdi-minus-circle-outline</v-icon>
        </v-card-text>
        <v-icon @click="deleteItem(i)" size="35px" color="red" style="padding-top: 45PX;margin-right: 30px;">mdi mdi-delete</v-icon>
        
      </v-card>

     
     
      
        

      <div class="mt-5 " style="text-align: center;">
        <v-btn
              class="text-none text-subtitle-1 mx-auto"
              color="#0082E0"
              size="x-large"
              variant="flat"
              rounded="lg"
              width="150px"
              density="compact"
            >
            Confirm order 
            </v-btn>

            <v-btn
              class="text-none text-subtitle-1 mx-auto ml-4"
              color="#0082E0"
              size="x-large"
              variant="flat"
              rounded="lg"
              width="150px"
              density="compact"
            >
            Cancel order
            </v-btn>


      </div>

    
      

      

     

     

     
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
        cart:[],
        quantity: 1 // Quantité initiale
      };
    },
    created(){
      const storedCart = localStorage.getItem('cart');
    this.cart = storedCart ? JSON.parse(storedCart) : [];
    },
    methods: {
      increaseQuantity() {
        this.quantity++;
      },
      decreaseQuantity() {
        if (this.quantity > 1) {
          this.quantity--;
        }
      },
      deleteItem(index){
        this.cart.splice(index,1)
        localStorage.setItem('cart', JSON.stringify(this.cart));
      }
    },
   
   
    components: {
      SideBare,
      NavBar,
  
    },
  };
  </script>
  
  <style scoped></style>
  