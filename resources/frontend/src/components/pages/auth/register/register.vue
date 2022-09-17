<template>
    <div class="min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
        <div class="row">
        <div class="col-md-6 mt-5 mx-auto form-register">
                <div v-for="(error, index) in errors" :key="index">
                    <span class="text-danger">{{ error[0] }} </span>
                </div>

            <form v-on:submit.prevent="register">
                <h1 class="h3 mb-3 font-weight-normal text-center">Register</h1>

                <div class="form-group pb-2">
                    <label for="first_name">Name</label>
                    <input type="text" v-model="name" class="form-control border px-2" name="name" placeholder="name">
                </div>

                <div class="form-group  pb-2">
                    <label for="first_name">Phone</label>
                    <input type="text" v-model="phone" class="form-control border px-2" name="phone" placeholder="phone">
                </div>

                <div class="form-group  pb-2">
                    <label for="email">Email</label>
                    <input type="email" v-model="email" class="form-control border px-2" name="email" placeholder="Email Address">
                </div>

                <div class="form-group  pb-2">
                    <label for="password">Password</label>
                    <input type="password" v-model="password" class="form-control border px-2" name="password" placeholder="Password">
                </div>

                <div class="form-group  pb-2">
                    <label for="password">Confirm password</label>
                    <input type="password" v-model="confirmPassword" class="form-control border px-2" name="c_password" placeholder="Confirm password">
                </div>
                <div class="form-group  pb-2">
                    <label for="password">Birthday</label>
                    <input type="date" v-model="birthday" class="form-control border px-2" name="birthday" placeholder="Birthday">
                </div>

                <button class="btn btn-lg btn-primary btn-block">Register</button>
            </form>
        </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import router from '../../../../router';

export default{
    data(){
        return {
            name: '',
            email: '',
            password: '',
            phone: '',
            confirmPassword: '',
            birthday: '',
            errors: '',
        }
    },
    methods:{
        register() {
            axios.post('/api/register',
                {
                    name:this.name,
                    email:this.email,
                    password:this.password,
                    confirmPassword: this.confirmPassword,
                    birthday:this.birthday,
                })
                .then((res) => {
                    console.log(res)
                    router.push({name: 'profile'})
                })
                .catch((err) => {
                    console.log(err)
                    if(err.response.status === 401) {
                        this.errors = err.response.data.error || {};
                        console.log(this.errors);
                    }
                })
        },


    }
}
</script>

<style scoped>
    .form-register {
        background-color: #ffffff;
        border-radius: 10px;
        padding: 20px;
    }
</style>
