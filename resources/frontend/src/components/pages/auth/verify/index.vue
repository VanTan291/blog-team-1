<template src="./verify.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';
import {utils} from '../../../../helper/function'

export default {
  name: 'verify',
  mixins: [utils],
  data() {
    return {
        loader: false,
        isDisable: false,
    };
  },
  mounted() {
  },
  computed: {
    ...mapGetters({
      params: 'Auth/params',
      errorRequest: 'Auth/errorRequest',
    }),
  },
  methods: {
    ...mapActions({
        verifyEmailCode: 'Auth/verify',
        reSendVerifyEmailCode: 'Auth/reSendVerifyEmail'
    }),

    async verifyEmail() {
        this.loader = true;
        this.isDisable = true;

        await this.verifyEmailCode(this.params)
        .then(result => {
            if (result.code == 200) {
                this.toastSuccess(result.message);
                this.$router.push({ name: 'home' })
                window.location.reload();
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

    async reSendEmailVerify() {
        this.loader = true;
        this.isDisable = true;

        await this.reSendVerifyEmailCode(this.params)
        .then(result => {
            this.loader = false;
            this.isDisable = false;

            if (result.code == 200) {
                this.toastSuccess(result.message);
            }
        })
        .catch(error => {
            this.loader = false;
            this.isDisable = false;
            console.log(error.data);
        });
    }
  },
};
</script>
