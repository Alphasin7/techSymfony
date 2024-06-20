

<template>
    <div class="flex-auto flex flex-col items-center justify-center w-[40%] bg-gradient-to-t from-[#004aad] to-[#4fcddc] rounded-r-lg  ">
        <div class=" text-white text-[36px] font-semibold pb-5 ">Welcome back!</div>
        <div class=" text-white text-lg  ">To keep connected with us please</div>
        <div class=" text-white text-lg  "> login with your personal info</div>
        <div>
            <router-link :to="'register'">
            <button  class="bg-transparent text-white text-lg py-2 px-10 border border-white mt-5 rounded-3xl">
                SIGN UP
            </button>
        </router-link>
        </div>
    </div>
</template>