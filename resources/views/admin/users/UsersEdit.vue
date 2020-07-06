<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="8" md="6">
                <v-card>
                    <v-app-bar class="elevation-0">
                        <v-toolbar-title>New product</v-toolbar-title>
                    </v-app-bar>

                    <v-card-text>
                        <v-form>
                            <v-text-field
                              v-model="user.name"
                              label="Name"
                              :error-messages="errors.name"
                              required
                            ></v-text-field>

                            <v-text-field
                              v-model="user.email"
                              label="Email"
                              :error-messages="errors.email"
                              required
                            ></v-text-field>

                            <v-text-field
                              v-model="user.username"
                              label="Username"
                              :error-messages="errors.username"
                              required
                            ></v-text-field>

                            <v-checkbox
                                v-model="change_password"
                                label="Change password?"
                            ></v-checkbox>

                            <v-text-field
                                v-if="change_password"
                              v-model="user.password"
                              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="show1 ? 'text' : 'password'"
                              label="Password"
                              :error-messages="errors.password"
                              required
                               @click:append="show1 = !show1"
                            ></v-text-field>

                            <v-text-field
                                v-if="change_password"
                              v-model="user.password_confirmation"
                              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="show1 ? 'text' : 'password'"
                              label="Password"
                              :error-messages="errors.password_confirmation"
                              required
                               @click:append="show1 = !show1"
                            ></v-text-field>

                            <v-btn color="primary" class="mr-4" @click="updateProduct">
                                <v-icon left>mdi-account-edit</v-icon> Update user
                            </v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import UserService from '../../../services/users'

    export default {
      data() {
        return {
            show1: false,
            change_password: false,
            user: {
                name: null,
                email: null,
                username: null,
                password: null,
                password_confirmation: null,
            },
            errors: {}
        };
      },
      mounted(){
          this.getUser()
      },
      methods: {
          async getUser() {
              let user_id = this.$route.params.user_id
              await UserService.getUser(user_id)
              .then(response => {
                  console.log(response.data)
                  this.user = response.data.data
              })
          },

          async updateProduct() {
              let user_id = this.$route.params.user_id
              await UserService.updateUser(this.user, user_id)
              .then(response => {
                  this.$swal('Great',
                            'User updated successfully!',
                            'success').then(() => {
                      this.$router.push({ name: 'users'})
                  });
              })
              .catch(errors => {
                  this.errors = errors.response.data.errors
              })
          }
      }
    }
</script>
