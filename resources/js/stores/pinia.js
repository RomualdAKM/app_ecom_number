import { defineStore } from 'pinia'
import Swal from 'sweetalert2'



export const useShoppingStore = defineStore('shopping', {
    state: () => {
        return {

          cartItems : []
        }
     },

     getters: {
      countCartItems(){
          return this.cartItems.length;
      },
      getCartItems(){
          return this.cartItems;
      }
  },

    actions: {

      addToCart(item) {
      
       
          this.cartItems.push(item);
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Produit ajouter au panier avec succé',
            showConfirmButton: false,
            timer: 1500
          });
       
    },
    removeFromCart(item) {
      this.cartItems = this.cartItems.filter(product => product.id !== item.id);
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your item has been removed',
        showConfirmButton: false,
        timer: 1500
      });
  }
    }
  })
