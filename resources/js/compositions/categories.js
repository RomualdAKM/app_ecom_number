import {ref} from "vue";

export default function useCateogiries(){
    const categories = ref([]);
    const categoryProducts = ref([]);

    const getCategories = async () =>{
        let response = await axios.get(' /api/get_categories')
        categories.value = response.data.categories;
    }

    const getCategoryProducts = async (categoryName) =>{
        let response = await axios.get('/api/get_category_products/' + categoryName)
        categoryProducts.value = response.data.categoryProducts.products;
    }

    return {
        categories,
        categoryProducts,
        getCategoryProducts,
        getCategories
    }
}
