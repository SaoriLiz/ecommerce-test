<template>
    <v-container fluid>
        <v-row align="center" justify="center">
            <v-col cols="12" sm="12" md="10">
              <v-data-table
                :headers="headers"
                :items="items"
                class="elevation-1"
              >
                <template v-slot:item.quantity="{ item }">
                    <v-input-number :min="1" @input="changeQuantity(item)" v-model="item.quantity"></v-input-number>
                </template>

                <template v-slot:item.action="{ item }">
                  <v-icon
                    small
                    @click="deleteItem(item)"
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
    import {mapGetters} from 'vuex'
    //localStorage.clear();
  export default {
        computed: {
          ...mapGetters({
              items: 'cart/getAllItems'
          })
        },
        data: () => ({
            headers: [
                {
                  text: 'Product',
                  align: 'left',
                  sortable: false,
                  value: 'item.name',
                },
                { text: 'Description', value: 'item.description' },
                { text: 'price', value: 'item.price' },
                { text: 'Quantity', value: 'quantity', width: "15%" },
                { text: 'Actions', value: 'action', sortable: false },
            ]
        }),

    methods: {
        deleteItem(item) {
            this.$store.dispatch('cart/removeItem', item.item.id)
        },
        changeQuantity(item) {
            this.$store.dispatch('cart/saveCart')
        }
    }
  }
</script>
