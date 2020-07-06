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
                              v-model="name"
                              label="Name"
                              :error-messages="errors.name"
                              required
                            ></v-text-field>

                            <v-text-field
                              v-model="email"
                              label="Email"
                              :error-messages="errors.email"
                              required
                            ></v-text-field>

                            <v-text-field
                              v-model="username"
                              label="Username"
                              :error-messages="errors.username"
                              required
                            ></v-text-field>

                            <v-text-field
                              v-model="password"
                              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="show1 ? 'text' : 'password'"
                              label="Password"
                              :error-messages="errors.password"
                              required
                               @click:append="show1 = !show1"
                            ></v-text-field>

                            <v-text-field
                              v-model="password_confirmation"
                              :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                              :type="show1 ? 'text' : 'password'"
                              label="Password"
                              :error-messages="errors.password_confirmation"
                              required
                               @click:append="show1 = !show1"
                            ></v-text-field>

                            <v-btn color="primary" class="mr-4" @click="register">
                                <v-icon left>mdi-account-edit</v-icon> Add user
                            </v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>
    import AuthService from '../../../services/auth'

    export default {
      data() {
        return {
            show1: false,
            name: null,
            email: null,
            username: null,
            password: null,
            password_confirmation: null,
            errors: {}
        };
      },
      methods: {
          register() {
              AuthService.register({
                name: this.name,
                email: this.email,
                username: this.username,
                password: this.password,
                password_confirmation: this.password_confirmation,
              })
              .then(token => {
                  this.$swal('Great',
                            'User added successfully!',
                            'success').then(() => {
                      this.$router.push({ name: 'users'})
                  });
              })
              .catch(error => {
                  this.errors = error.response.data.errors
              });
        }
      }
    }
</script>
