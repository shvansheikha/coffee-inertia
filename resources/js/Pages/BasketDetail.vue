<template>
    <div class="flex w-full font-mono">
        <div
            class="w-full px-8 pt-6 pb-20 md:px-10 lg:px-20 md:pt-20 flex-grow h-screen flex flex-col shadow-inner overscroll-auto overflow-auto">

            <div class="w-full md:flex justify-between">
                <div
                    class="w-full bg-white cursor-pointer shadow-md rounded px-4 py-2 items-center md:flex justify-between hover:bg-gray-50">
                    <div><span>Card: </span><span> {{ basket.card_title }} </span></div>
                    <div><span>Product: </span><span> {{ basket.products_price }} </span></div>
                    <div><span>Game: </span><span> {{ basket.games_price }} </span></div>
                    <div class="text-blue-500 uppercase font-bold">
                        <span>Total: </span><span> {{ basket.total_price }} </span></div>
                    <div
                        @click="printBasket"
                        class="text-center border border-current hover:border-blue-500 transition-all duration-300 ease-in-out cursor-pointer hover:text-blue-500 rounded px-4 py-1">
                        Print
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div>
                    <BasketProductsTable :products-list="productsList"/>
                </div>
                <div>
                    <BasketGamesTable :games-list="gamesList"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import BasketGamesTable from "../views/Basket/BasketGamesTable.vue";
import BasketProductsTable from "../views/Basket/BaskerProductsTable.vue";

export default {
    name: 'BasketDetail',
    components: {BasketProductsTable, BasketGamesTable},
    props: {basket: Object, gamesList: Array, productsList: Array},
    methods: {
        printBasket() {
            let routeData = this.$router.resolve({name: 'Print', params: {basket: this.basket}});
            window.open(routeData.href, '_blank');
        },
    }
}
</script>
