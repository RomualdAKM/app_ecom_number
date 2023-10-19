import {ref} from "vue";

export default function useCateogiries(){
    const categories = ref([]);
    const categoryProducts = ref([]);
    const errors = ref('')
    const category = ref([])

    //--------------Début: section réservée à la partie Dashboard (administration)-------------
    const createCategory = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/create_category', data)

        } catch (e) {
            const createCategoryErrors = e.response.data.error

            //for (const key in createCategoryErrors){
                errors.value = createCategoryErrors + ' '
            //}
        }
    }

    const getCategory = async (categoryName) => {
        let response = await axios.get('/api/get_category/' + categoryName)
        category.value  = response.data.category
    }

    const updateCategory = async (id) => {
        errors.value = ''
        try {
            const response = await axios.put('/api/update_category/'+id, category.value)
            console.log(category.value.name);
        } catch (e) {
            const updateCategoryErrors = e.response.data.error

            //for (const key in updateCategoryErrors){
            errors.value = updateCategoryErrors + ' '
            //}
        }
    }

    const deleteCategory = async (id) => {
        await axios.delete('/api/delete_category/' +id)
    }

    //--------------Fin: section réservée à la partie Dashboard (administration)-------------
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
        getCategories,

        categoryProducts,
        getCategoryProducts,

        errors,
        createCategory,
        category,
        getCategory,
        updateCategory,
        deleteCategory,
    }
}
