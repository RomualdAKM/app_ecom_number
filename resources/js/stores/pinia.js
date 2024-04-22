import { defineStore } from 'pinia';
import Swal from 'sweetalert2';

export const useShoppingStore = defineStore('shopping', {
    state: () => ({
        cartItems: []
    }),

    getters: {
        countCartItems() {
            return this.cartItems.length;
        },
        getCartItems() {
            return this.cartItems;
        },
        getCartTotal() {
            // Vérifie si le tableau 'cartItems' existe
            if (!Array.isArray(this.cartItems)) return 0;
            // Calcule le total en utilisant la méthode 'reduce'
            const total = this.cartItems.reduce((acc, item) => {
                // Vérifie si 'price' est un nombre
                const price = Number(item.price);
                if (Number.isNaN(price)) return acc;
                return acc + price;
            }, 0);
            // Arrondi le total à 2 décimales
            return total.toFixed(2);
        },
    },

    actions: {
        addToCart(item) {
            // Rechercher le produit dans le panier
            const existingProduct = this.cartItems.find(product => product.id === item.id);

            if (existingProduct) {
                const count = this.cartItems.filter(product => product.id === item.id).length;
                if (count >= 1) {
                    // Si le produit est déjà présent plus de deux fois, afficher un message d'erreur
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Vous ne pouvez pas ajouter plusieurs fois le même produit',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }
            }

            // Ajouter le produit si le nombre est inférieur à deux
            this.cartItems.push(item);

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Produit ajouté au panier avec succès',
                showConfirmButton: false,
                timer: 1500
            });
        },

        removeFromCart(item) {
            this.cartItems = this.cartItems.filter(product => product.id !== item.id);
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Produit supprimé du panier',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
});
