<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="6">
                <v-card>


                    <v-app-bar class="elevation-0">
                        <v-toolbar-title>Edit product</v-toolbar-title>
                    </v-app-bar>

                    <v-card-text>
                        <form>
                            <v-text-field
                            v-model="product.name"
                            :error-messages="errors.name"
                            label="Name"
                            required
                            ></v-text-field>

                            <v-textarea
                            v-model="product.description"
                            :error-messages="errors.description"
                            label="Description"
                            ></v-textarea>

                            <v-text-field
                            v-model="product.price"
                            :error-messages="errors.price"
                            label="Price"
                            required
                            ></v-text-field>

                            <v-btn color="primary" class="mr-4" @click="updateProduct">
                                <v-icon left>mdi-content-save</v-icon> Update product
                            </v-btn>

                            <router-link :to="{name: 'products'}">
                                <v-btn color="warning" align="right" class="mr-4">
                                    <v-icon left>mdi-content-save</v-icon> Cancel
                                </v-btn>
                            </router-link>

                        </form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import ProductServices from '../../../services/products'

    export default {
        data() {
            return {
                errors: {},
                product: {
                    name: '',
                    description: '',
                    price: ''
                }
            }
        },
        mounted() {
            this.getProduct()
        },
        methods: {
            async getProduct() {
                let product_id = this.$route.params.product_id
                await ProductServices.getProduct(product_id)
                .then(response => {
                    this.product = response.data[0]
                })
            },
            async updateProduct() {
                let product_id = this.$route.params.product_id
                await ProductServices.updateProduct(this.product, product_id)
                .then(response => {
                    this.$swal('Great',
                              'Product updated successfully!',
                              'success').then(() => {
                        this.$router.push({ name: 'products'})
                    });
                })
                .catch(errors => {
                    this.errors = errors.response.data.errors
                })
            },
        }
    }
</script>
