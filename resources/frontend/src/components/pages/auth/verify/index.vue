<template src="./verify.html"></template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'verify',
  data() {
    return {
    };
  },
  mounted() {
  },
  computed: {
    ...mapGetters({
      params: 'Auth/params',
    }),
  },
  methods: {

  },
};
</script>
