<template src="./setup-profile.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';
import {utils} from '../../../../helper/function';

export default {
  name: 'setupProfile',
  data(){
        return {
            image: ''
        }
    },
    mixins: [utils],
    computed: {
        ...mapGetters({
            params: 'Profile/params',
            requestError: 'Profile/requestError',
        }),
    },
    mounted() {
        this.getUserProfile();
    },
    methods: {
        ...mapActions({
            setupInfoProfile: 'Profile/setupProfile',
            getUserProfile: 'Profile/getProfile',
        }),
        uploadFile() {
            this.params.avatar = this.$refs.avatar.files[0];
        },
        async setup() {
            await this.setupInfoProfile(this.params)
            .then(result => {
                if (result.code == 200) {
                    this.toastSuccess(result.message);
                    this.$router.push({ name: 'profile' });
                    window.location.reload();
                }
            })
            .catch(error => {
                console.log(error);
            });
        },
    }
};
</script>

<style scoped>
.card-setup-profile {
    position: relative;
    bottom: 200px;
}
</style>
