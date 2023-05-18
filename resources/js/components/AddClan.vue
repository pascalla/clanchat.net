<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Create Clan
            </h2>

            <form @submit.prevent="add()">
                <div class="mt-6 mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Clan Name</label>
                    <input type="text" id="name" v-model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="My Clan" required>
                </div>
                <button :disabled="isCreating" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
            </form>

        </header>
    </section>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
    data() {
        return {
            isCreating: false,
            name: ''
        }
    },
    setup() {
        const toast = useToast();
        return { toast }
    },
    methods: {
        add: function() {
            this.isCreating = true;

            axios.post('/api/clan', {
                name: this.name
            })
            .then((response) => {
                this.toast.success(response.data.data, {
                    timeout: 2000
                });

                this.emitter.emit("added-clan", true);
                this.name = '';
            })
            .catch((error) => {
                this.toast.error(error.response.data)
            })
            .finally(() => {
                this.isCreating = false;
            })
        }
    }
}
</script>

