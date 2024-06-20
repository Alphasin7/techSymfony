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
                  Permission
              </div>
          </v-col>
          <v-col>
             
                  <NavBar />
            
             
          </v-col>
      </v-row>
  
     </v-container>
     <div class="d-flex mt-8">
     
  <v-sheet  class="mx-auto mt-1" :height="200" :width="400">
    

    <v-card-text style="font-weight: bold;">
      Annual Leave
    </v-card-text>
    <v-card-text style="font-weight: bold;">
      Leave Taken
    </v-card-text>
    <v-card-text style="font-weight: bold;">
      Available Leave
    </v-card-text>
    <v-card-text  style="font-weight: bold;">
      Other Absences
    </v-card-text>


</v-sheet>

<v-form @submit.prevent="submit" style="width: 600px;" class="mx-auto">
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
            label="Start date"
            type="date"
            v-model="startdate.value.value"
            :error-messages="startdate.errorMessage.value"
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
        <v-text-field
            variant="outlined"
            label="End date"
            type="date"
            v-model="enddate.value.value"
            :error-messages="enddate.errorMessage.value"
          ></v-text-field>
        </v-col>
        <v-col
          cols="12"
          sm="12"
        >
        <v-textarea
            variant="outlined"
            label="Reason"
            rows="3"
            row-height="15"
            v-model="reason.value.value"
            :error-messages="reason.errorMessage.value"
          ></v-textarea>
        </v-col>
        <v-col
          cols="12"
          sm="12"
        >
        <v-file-input
        multiple
            variant="outlined"
            label="Add file"
            
            
          ></v-file-input>
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
              Demand leave
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

    </div>
  
  
  

  
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
      startdate (value) {
        if (value?.length >= 0) return true

        return 'Start date is a required.'
      },
      enddate (value) {
        if (value?.length >= 0) return true

        return 'End date is a required.'
      },
      reason (value) {
        if (value?.length >= 0) return true

        return 'Please enter a valid reason.'
      },
    },
  })
  const firstname = useField('firstname');
  const lastname = useField('lastname');
  const startdate = useField('startdate');
  const enddate = useField('enddate');
  const reason = useField('reason');


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
  