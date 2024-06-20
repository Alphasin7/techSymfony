<template  >
    <v-navigation-drawer style="border-radius: 20px;height: 750px;"  class="mx-4 mt-6"  color="#FFFFFF" >
      <div  >
          <v-img src="/logo1.jpg" height="190px" width="233px"  ></v-img>
        </div>
  
      <v-list>
      
        <v-list-item
          v-for="(item, i) in links"
          :key="i"
          :value="item"
          active-class="border"
          :to="item.link"
          router
        >
          <template v-slot:prepend>
            <v-icon :icon="item.icon" color="#5C5C5C"></v-icon>
          </template>
  
          <v-list-item-title v-text="item.text" color="#5C5C5C"></v-list-item-title>
        </v-list-item>
        <v-list-item
        key="15"
        :value="logout"
        active-class="border"
        :to="logout.link"
        @click="logOut"
        >
        <template v-slot:prepend>
            <v-icon :icon="logout.icon" color="#5C5C5C"></v-icon>
          </template>
          <v-list-item-title v-text="logout.text" color="#5C5C5C"></v-list-item-title>
      </v-list-item>
      </v-list>
      <div
        style="position: relative;" 
      >
        <v-img src="/Group74.png" contain height="190px" width="239px"></v-img>
        <div 
          style="position: absolute;top: 12px;left: 105px;"
          >
          <v-btn density="compact" color="#004AAD"  size="large" icon="mdi mdi-plus"></v-btn>
         
        </div>
        <div
         style="position: absolute;top: 150px;left: 45px;background-color:#D9F4FF ;"
        >
          <v-btn  color="#004AAD"  size="small">Customer service</v-btn>
        </div>
        
      </div>
    </v-navigation-drawer>
  </template>
  
  <script setup>
  import { ref } from "vue";
  const links = [
  { text: "Dashboard", icon: "mdi mdi-view-dashboard",link:"/dashboard" },
    { text: "Orders", icon: "mdi mdi-cart",link:"/dashboard/orders" },
    { text: "Equipment", icon: "mdi mdi-laptop",link:"/dashboard/equipments" },
    { text: "Demands", icon: "mdi mdi-briefcase",link:"/dashboard/demands" },
    { text: "users", icon: "mdi mdi-account-box",link:"/dashboard/users" },
    { text: "Requests", icon: "mdi mdi-form-select",link:"/dashboard/requests" },
  ];
  const logout =  { text: "Logout", icon: "mdi mdi-logout",link:"/" }
  
  /*
  
  
  
  const hoveredIndex = ref(null);
  
  
  
  const setHovered = (index, isHovered) => {
    hoveredIndex.value = isHovered ? index : null;
  
  };  */
  </script>
  
  <script>
  export default {
    data: () => ({
      cards: ["Today", "Yesterday"],
      drawer: null,
    }),
    methods:{
    logOut(){
      localStorage.clear()
      window.location.reload()
    }
  }
  };
  </script>
  <style >
  /*
  .hovered {
    background-color:#5e0a2b; 
  }*/
  </style>
  
  