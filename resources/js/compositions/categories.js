import {ref} from "vue";

export default function useCateogiries(){
    const categories = ref([]);
    const categoryProducts = ref([]);
    const errors = ref('')
    const category = ref([])

    //--------------Début : section réservée à la partie Dashboard (administration)-------------


    const getCategory = async (categoryName) => {
        let response = await axios.get('/api/get_category/' + categoryName)
        category.value  = response.data.category
    }
    //--------------Fin : section réservée à la partie Dashboard (administration)-------------

    const getCategories = async () =>{
        let response = await axios.get('/api/get_categories')
        categories.value = response.data.categories;
    }

    const getCategoryProducts = async (categoryName) =>{
        let response = await axios.get('/api/get_category_products/' + categoryName)
        categoryProducts.value = response.data.categoryProducts.products;
    }

    return {
        categories,
        getCategories,

        categoryProducts,
        getCategoryProducts,

        errors,
        category,
        getCategory,
    }
}
