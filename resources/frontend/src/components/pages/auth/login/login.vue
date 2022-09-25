<template src="./login.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'login',
  components: {
    ...mapGetters({
      params: 'Auth/params',
    }),
  }
};
</script>
