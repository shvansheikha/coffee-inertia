<template>
    <Transition name="fade">
        <div>
            <div
                v-if="showing"
                class="fixed inset-0 w-full h-screen flex items-center justify-center bg-semi-75
overflow-x-hidden overflow-y-auto z-50 outline-none focus:outline-none"
                @click.self="close">
                <div class="relative w-auto my-6 mx-auto max-w-6xl">
                    <div class="relative w-full max-w-2xl bg-white shadow-lg rounded-lg p-4">
                        <button
                            aria-label="close"
                            class="absolute top-0 right-0 text-xl text-gray-500 my-2 mx-4"
                            @click.prevent="close">
                            ×
                        </button>
                        <slot/>
                    </div>
                </div>
            </div>
            <div v-if="showing" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
        </div>
    </Transition>
</template>


<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.4s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}
</style>

<script>
export default {
    name: "Modal",
    props: {
        showing: {
            required: true,
            type: Boolean
        }
    },
    watch: {
        showing(value) {
            if (value) {
                return document.querySelector('body').classList.add('overflow-hidden');
            }

            document.querySelector('body').classList.remove('overflow-hidden');
        }
    },
    methods: {
        close() {
            this.$emit('close');
        }
    }
};
</script>

