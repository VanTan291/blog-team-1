<template>
  <div>
    <Navbar></Navbar>
    <Header></Header>
    <div>
      <router-view></router-view>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from './Header.vue';
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';
export default {
  name: 'App',
  components: {
    Header,
    Navbar,
    Footer,
  },
};
</script>

<style>

</style>
