<template src="./login.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';
import {utils} from '../../../../helper/function'

export default {
  name: 'login',
  data() {
    return {
        loader: false,
        isDisable: false,
        unverifiedEmail: false,
    };
  },
  mixins: [utils],
  computed: {
    ...mapGetters({
      params: 'Auth/params',
      requestLogin: 'Auth/errorLogin'
    }),
  },
  methods: {
    ...mapActions({
        loginAuth: 'Auth/login'
    }),
    async login() {
        this.loader = true;
        this.isDisable = true;

        await this.loginAuth(this.params)
        .then(result => {
            console.log(result);
            if (result.code == 200) {
                this.$router.push({ name: 'home' });
                this.toastSuccess(result.message);
                window.location.reload();
            }

            this.loader = false;
            this.isDisable = false;
        })
        .catch(error => {
            this.unverifiedEmail = true;
            this.loader = false;
            this.isDisable = false;
            console.log(error.data);
        });
    },
  }
};
</script>
