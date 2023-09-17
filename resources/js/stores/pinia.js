import { defineStore } from 'pinia'
import { ref } from 'vue'


export const useCategories = defineStore('categorie', {
    state: () => {
        return {

          categories: ref([]),
        }
     },
  })
