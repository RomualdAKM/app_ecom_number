import { defineStore } from 'pinia'
import axios from 'axios'
import router from '../router/index.js'


export const useAuthStore = defineStore('auth', {
    state: () => ({
        authToken: null,
        authUser: null,
        isAuthenticated: false,
    }),
    actions: {

        // Déconnecter l'user
        async logout() {
            this.clearAuthTokens()
            await router.push("/login");
        },

        /*
        * Réinitialiser les données de connexion
        * */
        clearAuthTokens() {
            this.$state.authToken = null
            this.$state.authUser = null
            this.$state.isAuthenticated = false

            sessionStorage.removeItem('token')
            sessionStorage.removeItem('user')
        },
    }
})
