
<template>


<div class="login_page">

    <div class="container po">

        <div class="row justify-content-center">

            <div class="col-12 col-md-6 col-lg-5 login_page_main_all">
                <div class="login_page_main">
                    <div class="login_logo" v-if="site_name == 'DG'">
                         <img src="/img/dg_login.png" alt="">
                    </div>
                    <div class="login_logo" v-else-if="site_name == 'FINESSE'">
                         <img src="/img/finesse_login.png" alt="">
                    </div>
                    <div style="tex-align:center" v-else>
                        <h2 style="color: white; font-weight: bold;">Login</h2>
                    </div>
                    <div class="card-body">
                        <form v-on:submit.prevent>
                            <div class="form-group input_group">
                                <div class="input_group_input">
                                    <input type="text" placeholder="Username" :class="errorMessage.username != '' ? 'form-control is-invalid' : 'form-control'"  v-model="formValue.username" required>
                                    <span v-if="errorMessage.username != ''" class="invalid-feedback" role="alert">
                                        <strong>{{ errorMessage.username }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group input_group">
                                <div class="input_group_input">
                                    <input type="password" placeholder="Password" :class="errorMessage.password != '' ? 'form-control is-invalid' : 'form-control'"  v-model="formValue.password" required>
                                    <span v-if="errorMessage.password != ''" class="invalid-feedback" role="alert">
                                        <strong>{{ errorMessage.password }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="_remenbr_me">
                                <input type="checkbox"><span>Remember me</span>
                            </div>


                            <div class="form-group">
                                <div class="text_center log_button">
                                    <button type="submit" class="btn btn-primary" @click="login" :disabled="sending" >
                                        {{ sending? 'Please wait...' : 'Login'}}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="_pass_frgt">
                            <a href="/forgot-password">Forgot your password?</a>
                            <!-- <a href="">Create Account</a> -->
                        </div>
                    </div>
                </div>
            </div>

           <!--  <p class="copy_right">COPYRIGHTS DREAMS GALLERY</p> -->
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            sending:false,
            site_name:window.site_name,

            errorMessage:{
                username:'',
                password:'',
            },
            formValue:{
                username:'',
                password:''
            },

        }
    },
    methods:{

        async login(){
            let validation = true;
            this.errorMessage = {
                username:'',
                password:''
            }

            if(this.formValue.username.trim() == ''){
                this.errorMessage.username = 'Username is required!'
                validation = false
            }
            if(this.formValue.password.trim() == ''){
                this.errorMessage.password = 'Password is required!'
                validation = false
            }

            if(validation == false) return;

            this.sending= true

            const response = await this.callApi('post','/app/login',this.formValue);
            if(response.status == 200){
                var currentdate = new Date().toLocaleString().replace(',','')
                let authLifeSpan = {
                    id:Date.now(),
                    time:currentdate
                };
                this.$ls.set('authLifeSpan', JSON.stringify(authLifeSpan))

                window.location='/'

            }
            else if (response.status ==422){
                if(response.data.username){
                    this.errorMessage.username = response.data.username[0]
                }
                if(response.data.password){
                    this.errorMessage.password = response.data.password[0]
                }
            }
            else if (response.status ==402){
                this.errorMessage.password = response.data.message
            }
            else if (response.status ==419){
                location.reload();
                // this.errorMessage.password = response.data.message
            }
            else this.swr();
            this.sending = false;
        }
    },
    created(){

    }

}
</script>
