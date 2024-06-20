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
                  Demand
              </div>
          </v-col>
          <v-col>
             
                  <NavBar />
            
             
          </v-col>
      </v-row>
  
     </v-container>

     <v-sheet width="600" height="510" class="mx-auto mt-10" style="border-radius: 20px;box-shadow: 1px 1px 2px 2px #b6b4b4;">
<v-form @submit.prevent="submit" style="width: 600px;" class="mx-auto ">
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
            label="Department"
            prepend-inner-icon="mdi mdi-briefcase-account"
            v-model="department.value.value"
            :error-messages="department.errorMessage.value"
          ></v-text-field>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
        <v-text-field
            variant="outlined"
            label="Position"
            prepend-inner-icon="mdi mdi-briefcase"
            v-model="position.value.value"
            :error-messages="position.errorMessage.value"
          ></v-text-field>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
        <v-select
            variant="outlined"
            label="Problem type"
            :items="['Computer Issues', 'Communication Issues', 'Human Resources and Management Issues', 'Operational Issues<', 'Financial Issues', 'Compliance Issues','other']"
            v-model="select.value.value"
            :error-messages="select.errorMessage.value"
            >
        </v-select>
       
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
        <v-file-input
        multiple
            variant="outlined"
            label="Add file"
            
            
          ></v-file-input>
        </v-col>

        <v-col
          cols="12"
          sm="12"
        >
        <v-textarea
        
            variant="outlined"
            label="Description"
            rows="3"
            row-height="15"
            
          ></v-textarea>
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
              Add Demand
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
              Clear
            </v-btn>
      </v-row>
      </v-container>
      </v-form>
    </v-sheet >
  
  

  
      </v-main>
          
        </v-app>
  </template>
  
  <script setup>
  import NavBar from "@/components/employe/NavBar.vue";
  import SideBare from "@/components/employe/SideBare.vue";
  import { ref } from 'vue'
  import { useField, useForm } from 'vee-validate'

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
      department (value) {
        if (value?.length >= 2) return true

        return 'Department file is a required.'
      },
      position (value) {
        if (value?.length >= 2) return true

        return 'Position file is a required.'
      },
      select (value) {
        if (value) return true

        return 'Select an item.'
      },
      
    },
  })
  const firstname = useField('firstname');
  const lastname = useField('lastname');
  const department = useField('department');
  const position = useField('position');
  const select = useField('select');
  


  const submit = handleSubmit(values => {
    alert(JSON.stringify(values, null, 2))
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
  <style scoped></style>
  