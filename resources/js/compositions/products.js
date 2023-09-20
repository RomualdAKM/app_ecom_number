import {ref} from "vue";

export default function useProducts(){
    const products = ref([]);
    const product = ref([]);
    const relatedProducts = ref([]);

    const getProducts = async () =>{
        let response = await axios.get(' /api/get_products')
        products.value = response.data.products;
    }

    const getProduct = async (id) =>{
        let response = await axios.get(' /api/get_product/' + id)
        product.value = response.data.product;
    }

    const getRelatedProducts = async (categoryId, currentProductId) =>{
        let response = await axios.get('/api/get_related_products/'+categoryId+'/'+currentProductId)
        relatedProducts.value = response.data.relatedProducts;
    }

    return {
        products,
        getProducts,

        product,
        getProduct,

        relatedProducts,
        getRelatedProducts
    }
}
