<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="12" md="10">
                <v-card class="mx-auto elevation-12" max-width="1200">

                    <v-container fluid>
                        <router-view name="adminContent"/>
                    </v-container>
                    
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {};
</script>
