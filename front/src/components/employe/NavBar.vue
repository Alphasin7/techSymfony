<template>




    <v-row>
          <v-col class="d-flex flex-no-wrap justify-space-between">

            <v-text-field
        :loading="loading"
        density="compact"
        variant="solo"
        label="Search Product"
        prepend-inner-icon="mdi mdi-magnify"
        append-inner-icon="mdi mdi-tune"
        single-line
        hide-details
        @click:prepend-inner="onClick"
       style="width: 290px;"
      ></v-text-field>
      <v-spacer></v-spacer>
        
      
            <v-btn icon style="background-color: #E8FCFF;color: #004AAD;">
          <v-icon>mdi mdi-cart</v-icon>
        </v-btn>

        <v-btn icon style="background-color: #E8FCFF;color: #004AAD;">
          <v-icon >mdi mdi-bell-ring</v-icon>
        </v-btn>
        
        <v-btn icon style="background-color: #E8FCFF;color: #004AAD;">
        <v-avatar size="36px">
          <v-img alt="Avatar" src="/4.jpg"></v-img>
        </v-avatar>
    </v-btn>
          </v-col>

          
    </v-row>

   
  
 
  </template>
  
  <script setup>
  
  </script>
  
  
  <style scoped>
  
  </style>