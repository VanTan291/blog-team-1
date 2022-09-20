<template src="./register.html"></template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: "register",
  data() {
    return {
        loader: false,
        isDisable: false,
    };
  },
  computed: {
    ...mapGetters({
      params: 'Auth/params',
      errorRequest: 'Auth/errorRequest',
    }),
  },
  methods: {
    async register() {
        this.loader = true;
        this.isDisable = true;

        await this.$store.dispatch('Auth/register', this.params)
        .then(result => {
            if (result.code == 200) {
                this.$router.push({ name: 'verify' })
            }

            this.loader = false;
            this.isDisable = false;
        })
        .catch(error => {
            this.loader = false;
            this.isDisable = false;
            console.log(error.data);
        });
    },
  },
};
</script>
