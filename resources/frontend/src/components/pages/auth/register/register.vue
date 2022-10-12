<template src="./register.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';
import {utils} from '../../../../helper/function'

export default {
  name: "register",
  data() {
    return {
        loader: false,
        isDisable: false,
    };
  },
  mixins: [utils],
  computed: {
    ...mapGetters({
      params: 'Auth/params',
      errorRequest: 'Auth/errorRequest',
    }),
  },
  methods: {
    ...mapActions({
        registerAccount: 'Auth/register'
    }),
    async register() {
        this.loader = true;
        this.isDisable = true;

        await this.registerAccount(this.params)
        .then(result => {
            if (result.code == 200) {
                this.toastSuccess(result.message);
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
