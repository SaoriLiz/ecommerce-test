<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="12" md="10">

                <v-data-table
                  :headers="headers"
                  :items="users"
                  class="elevation-1"
                >

                  <template v-slot:item.action="{ item }">
                      <router-link :to="{name: 'useredit', params: {'user_id': item.id}}">
                        <v-icon
                          small
                          >
                        mdi-pencil
                        </v-icon>
                    </router-link>
                        <v-icon
                          small
                          @click="tryDeleteUser(item.id)"
                        >
                        mdi-trash-can
                        </v-icon>
                  </template>
                </v-data-table>

            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import UserServices from '../../../services/users'

    export default {
        data() {
            return {
                show: false,
                users: [],
                pagination: {
                    current: 1,
                    total: 0
                },
                headers: [
                    {
                      text: 'Name',
                      align: 'left',
                      sortable: false,
                      value: 'name',
                    },
                    { text: 'Email', value: 'email' },
                    { text: 'Username', value: 'username' },
                    { text: 'Actions', value: 'action' }
                ]
            }
        },
        mounted() {
            this.getAllUsers()
        },
        methods: {
            async getAllUsers() {
                let users = await UserServices.getUsers()
                this.users = users.data
            },
            tryDeleteUser(id) {

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
                                                this.deleteUser(id)
                                  });
                              }
                });
            },
            async deleteUser(id) {
                await UserServices.deleteUser(id)
                .then(response => {
                    this.getAllUsers()
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
