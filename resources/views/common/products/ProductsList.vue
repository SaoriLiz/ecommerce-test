<template>
    <v-container fluid>
      <v-row dense>
        <v-col v-for="product in products" :key="product.id">

        <v-card
          class="mx-auto"
          max-width="300"
        >
          <v-img
            src="/images/product.png"
            height="200px"
          ></v-img>

          <v-card-title>
            {{ product.name }}
          </v-card-title>

          <v-card-subtitle>
            {{ product.description }}
          </v-card-subtitle>

          <v-card-actions>
            <v-btn color='primary' v-if="isAdmin" :to="{name: 'productedit', params: {'product_id' : product.id}}">
                <v-icon>mdi-pencil</v-icon> Edit
            </v-btn>

            <v-btn color="error" v-if="isAdmin" @click="tryDeleteProduct(product.id)">
              <v-icon>mdi-trash-can</v-icon> Delete
            </v-btn>

            <v-spacer></v-spacer>

            <v-chip color="success">$ {{product.price}}</v-chip>

            <v-btn v-if="loggedIn && !isAdmin" class="mx-2" fab dark small color="primary" @click="addToCart(product.id)">
              <v-icon>mdi-cart</v-icon>
            </v-btn>

          </v-card-actions>

        </v-card>


        </v-col>


      </v-row>

      <v-row align="center" v-if="!pagination.totalProducts" justify="center">
          <v-col cols="12" sm="12" md="10">
              <v-alert
                   border="right"
                   color="blue-grey"
                   align="center"
                   dark
                 >
                   There are no producs added
             </v-alert>
          </v-col>
      </v-row>

      <v-row>
          <v-pagination
              v-if="pagination.totalProducts"
              v-model="pagination.current"
              :length="pagination.total"
              @input="getAllProducts"
          ></v-pagination>
      </v-row>
    </v-container>
</template>
<script>
    import ProductServices from '../../../services/products'
    import {mapGetters} from 'vuex'

    export default {
        data() {
            return {
                show: false,
                products: {},
                pagination: {
                    current: 1,
                    total: 0,
                    totalProducts: 0
                }
            }
        },
        computed: {
            ...mapGetters('auth', ['loggedIn', 'isAdmin'])
        },
        mounted() {
            this.getAllProducts()
        },
        methods: {
            async getAllProducts() {
                let products = await ProductServices.getProducts(this.pagination.current)
                this.$store.dispatch('products/updateProducts', products.data)
                let response = await this.$store.getters['products/getAllProducts']
                this.products = response.data
                this.pagination.total = response.last_page
                this.pagination.totalProducts = response.total
            },
            tryDeleteProduct(id) {
                this.$swal({title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
              }).then((desicion) => {
                              if (desicion.value) {
                                  this.$swal('Great',
                                            'Product deleted successfully!',
                                            'success').then(() => {
                                                this.deleteProduct(id)
                                  });
                              }
                });
            },
            async deleteProduct(id) {
                await ProductServices.deleteProduct(id)
                .then(response => {
                    this.getAllProducts()
                })
            },
            addToCart(id) {
                const cartItem = this.products.find(item => item.id === id)
                this.$store.dispatch('cart/addToCart', cartItem)
            }
        }
    }
</script>
<style scoped>
    .v-btn--router{
    	text-decoration: none !important;
    }
</style>
