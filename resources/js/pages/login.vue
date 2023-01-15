<template>
    <div class="container" >

       <div class="row" >
          <div class="col-md-7 m-auto">
             <h2 class="text-primary text-center">Login</h2>
            <form action="" method="post">
              <div v-if="success" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button"  class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              
                <strong>{{success}} </strong> 
              </div> 
              <div v-if="errors" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              
           <ul>
            <li v-for="error in errors" :key="error">{{error}}</li>
           </ul>
              </div>
            <input type="hidden" name="_token" :value="csrf">  
                  <div class="mb-3">
              <label for="" class="form-label">Email</label>
              <input v-model="email" type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
             
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Password</label>
              <input v-model="password" type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
             
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Please Enter Captcha</label>
              <input v-model="enCaptcha" type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId">
             
            </div>
             <div class="np-captcha-container" onselectstart="return false" onselectend="return false"  onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" >
      <div class="np-captcha"  v-if="captcha && captcha.length">
        <div @click.prevent="createCaptcha" 
          v-for="(c, i) in captcha"
          :key="i"
          :style="{
            fontSize: getFontSize() + 'rem',
            fontWeight: 800,
            transform: 'rotate(' + getRotationAngle() + 'deg)',
          }"
          class="np-captcha-character"
        >
          {{ c }}
        </div>
      </div>
    </div>
    <button @click.prevent="createCaptcha" class="np-button">Generate new</button>
           <div class="row">
            <div class="col-md-6"><button type="reset" class="btn btn-danger">Clear</button>
        <button type="submit" v-on:click.prevent="login" class="btn btn-success">Login</button></div>
           </div>

            
          </form>
          </div>
       
          
       </div>
        </div>
 
</template>
<script>
export default {
    data(){
        return {
            name:"",
            email:'',
            password:"",
           
 captchaLength: 5,
      captcha: [],
      enCaptcha:"",
      success:"",
      errors:"",
      "csrf": this.csrf
    };
  },
  mounted() {
    this.createCaptcha();
     this.csrf = window.Laravel.csrfToken;
  },
  methods: {
    login(){
 axios.post('api/login',{
        
          "email":this.email,
          "password":this.password,
         
          "csrf": this.csrf
        }).then((res) => {
          this.errors='';
          this.success="";
          this.success = res.data.message;
        }).catch((error) => {
            this.errors='';
          this.success="";
          this.errors=error.response.data.message;
          
        })

    },
    createCaptcha() {
      let tempCaptcha = "";
      for (let i = 0; i < this.captchaLength; i++) {
        tempCaptcha += this.getRandomCharacter();
      }
      this.captcha = tempCaptcha.split("");
    },
    getRandomCharacter() {
      const symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      const randomNumber = Math.floor(Math.random() * 36);
      return symbols[randomNumber];
    },
    getFontSize() {
      const fontVariations = [2, 2, 2, 2, 2];
      return fontVariations[Math.floor(Math.random() * 5)];
    },
    getRotationAngle() {
      const rotationVariations = [5, 10, 20, 25, -5, -10, -20, -25];
      return rotationVariations[Math.floor(Math.random() * 8)];
    },
  },
};
</script>

<style scoped>
/* 
.appnp-captcha-container  {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #000000;
  margin-top: 60px;
} */
.np-captcha-container {
  background: #eee;
  width: 300px;
  margin: 0 auto;
  margin-bottom: 20px;
}
.np-captcha {
  font-size: 24px;
}
.np-button {
  padding: 6px 10px;
  background: #fff;
  border: 1px solid #eee;
  border-radius: 6px;
  font-size: 16px;
}
.np-captcha-character {
  display: inline-block;
  letter-spacing: 14px;
}
</style>

