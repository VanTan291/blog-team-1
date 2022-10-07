<template src="./setup-profile.html"></template>

<script>
import { mapGetters, mapActions } from 'vuex';
import {utils} from '../../../../helper/function'

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
        requestError: 'Profile/requestError'
        }),
    },
    methods: {
        ...mapActions({
            setupInfoProfile: 'Profile/setupProfile'
        }),
        // onImageChange(e) {
        //     // console.log(this.params.name);
        //     let files = e.target.files || e.dataTransfer.files;
        //     if (!files.length)
        //         return;
        //     this.createImage(files[0]);
        // },
        // createImage(file) {
        //     let reader = new FileReader();
        //     let vm = this;
        //     reader.onload = (e) => {
        //         vm.params.image = e.target.result;
        //     };
        //     reader.readAsDataURL(file);
        // },
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
