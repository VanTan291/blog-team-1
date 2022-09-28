<template>
    <div>
        <Sidebar></Sidebar>
        <router-view></router-view>
    </div>
  </template>

  <script>
  import Sidebar from './Sidebar.vue';
  export default {
    name: 'App',
    components: {
      Sidebar,
    },
  };
  </script>

  <style>

  </style>
