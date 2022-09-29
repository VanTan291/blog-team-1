<template>
    <div>
        <Sidebar></Sidebar>
        <main class="main-content border-radius-lg">
            <Navbar></Navbar>
            <router-view></router-view>
        </main>
    </div>
  </template>

  <script>
  import Sidebar from './Sidebar.vue';
  import Navbar from './Navbar.vue';
  export default {
    name: 'App',
    components: {
      Sidebar,
      Navbar
    },
  };
  </script>

  <style>

  </style>
