import { defineStore } from 'pinia';
import axios from 'axios';

export const useCounterStore = defineStore('counter', {
    state() {
        return {
            user: null,
            role: null,
            products: [],
        };
    },
    actions: {
        async fetchUser() {
            try {
                const response = await axios.get('/user-role');
                this.user = response.data.user.name;
                this.role = response.data.roles;
            } catch (error) {
                console.error('Error fetching user:', error);
            }
        },
        async fetchProducts() {
            try {
                const response = await axios.get('api/products');
                this.products = response.data;
            } catch (error) {
                let errorMessage = "An unexpected error occurred.";

                if (error.response && error.response.data) {
                    const errorData = error.response.data;
                    errorMessage = errorData.message || errorMessage;
                }

                console.error("Error fetching products:", errorMessage);
                alert(errorMessage);
            }
        },

        async addproduct(product) {
            try {
                const response = await axios.post('api/create-product', product);
                this.message = response.success;
                this.error = response.error;

                alert("Your product has been saved successfully!");
                return response;
            } catch (error) {
                let errorMessage = "An unexpected error occurred.";

                if (error.response && error.response.data) {
                    const errorData = error.response.data;
                    errorMessage = errorData.message || errorMessage;
                }

                console.error("Error adding product:", errorMessage);
                alert(errorMessage);
                throw error;
            }
        },

        async editproduct(productId, product) {
            try {
                const response = await axios.post(`api/edit-product/${productId}`, product);
                this.message = response;
                return response;
            } catch (error) {
                let errorMessage = "An unexpected error occurred.";

                if (error.response && error.response.data) {
                    const errorData = error.response.data;
                    errorMessage = errorData.message || errorMessage;
                }

                console.error("Error editing product:", errorMessage);
                alert(errorMessage);
                throw error;
            }
        },

    async removeproduct(productId) {
        try {
            const response = await axios.delete(`api/delete-product/${productId}`);
            this.message = response;

            alert("Your product has been removed successfully!");
            return response;
        } catch (error) {
            let errorMessage = "An unexpected error occurred.";

            if (error.response && error.response.data) {
                const errorData = error.response.data;
                errorMessage = errorData.message || errorMessage;
            }

            console.error("Error removing product:", errorMessage);
            alert(errorMessage);
            throw error;
        }
    },
}

});
