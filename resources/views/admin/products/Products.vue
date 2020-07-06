<template>
    <v-container fluid>
        <v-row cols="12">
            <v-col sm="10">
                <span class="title">Products</span>
            </v-col>
            <v-col sm="2" align="right">
                <router-link :to="{ name: 'products'}">
                    <v-btn class="mx-2" fab dark color="primary">
                        <v-icon dark>mdi-format-list-text</v-icon>
                    </v-btn>
                </router-link>
                <router-link :to="{ name: 'productadd'}">
                    <v-btn class="mx-2" fab dark color="primary">
                        <v-icon dark>mdi-plus</v-icon>
                    </v-btn>
                </router-link>
            </v-col>
        </v-row>
        <v-row>
            <v-divider
                class="mx-2"
                ></v-divider>
        </v-row>
        <v-row>
            <router-view name="productsContent"/>
        </v-row>
    </v-container>
</template>
<script>
    export default {
        data() {
            return {

                }
            }
        }
</script>
