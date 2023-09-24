<script setup>
import { reactive, ref, onMounted } from "vue";
import router from "./../../../../router/index.js"

let form = reactive({
    name: "",
    email: "",
    password: "",
    c_password: "",
    sex: "",
    number: "",
});

let errors = ref([]);


const register = async () => {
    await axios.post("/api/register", form).then((response) => {
        if (response.data.success) {
            localStorage.setItem("token", response.data.data.token);
             router.push("/login");
            toast.fire({
            icon: "success",
            title: "Compte créé avec succé",
        });
        } else {
          console.log('error',response.data.message)
           toast.fire({
            icon: "error",
            title: "!!!! Remplissez tout les champs et assurez vous que les passwords correspondent",
        });
        }
    });
};


</script>

<template>
    <!-- form wrapper -->
    <div class="container py-16">
        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">
            <h2 class="text-2xl uppercase font-medium mb-1">
                Create an Account
            </h2>
            <p class="text-gray-600 mb-6 text-sm">
                Register here if you don't have an account
            </p>
            <form @submit.prevent="register()">
                <div class="space-y-4">
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Full Name <span class="text-primary">*</span>
                        </label>
                        <input type="text" class="input-box" v-model="form.name" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">
                            Email Address <span class="text-primary">*</span>
                        </label>
                        <input type="email" v-model="form.email" class="input-box" placeholder="example@mail.com">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">Password <span class="text-primary">*</span></label>
                        <input type="password" v-model="form.password" class="input-box" placeholder="Type password">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">Confirm Password 
                            <span class="text-primary">*</span>
                        </label>
                        <input type="password" v-model="form.c_password" class="input-box" placeholder="Confirm your password">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">Phone Number <span class="text-primary">*</span></label>
                        <input type="tel" class="input-box" v-model="form.number" placeholder="+229XXXXXXXXXX">
                    </div>
                    <div>
                        <label class="text-gray-600 mb-2 block">Sex <span class="text-primary">*</span></label>
                        <select class="input-box" v-model="form.sex">
                            
                            <option value="0">Feminin</option>
                            <option value="1">Masculin</option>
                        </select>
                    </div>
                </div>
               
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-dark bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        Create Account
                    </button>
                </div>
            </form>
           
            <p class="mt-4 text-gray-600 text-center">
                Already have an account? <router-link to="/login" class="text-primary">Login Now</router-link>
            </p>
        </div>
    </div>
    <!-- form wrapper end -->
</template>
