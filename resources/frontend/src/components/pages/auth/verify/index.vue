<template src="./verify.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'verify',
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
            //alert('ss');
            // if (result.code == 200) {
            //     this.$router.push({ name: 'verify' })
            // }

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
                this.$notify({
                    group: 'auth',
                    type: 'success',
                    title: 'Thông báo',
                    text: result.message,
                    duration: 3000,
                    speed: 300
                });
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
