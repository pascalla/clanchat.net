<template>
    <section>
        <!-- List of Users -->
        <header class="max-w-7xl pt-6 mx-auto sm:px-6 lg:px-8">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Clan Admins
            </h2>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">The admins currently in this clan</h3>
        </header>

        <div class="max-w-7xl pt-6 mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Username</th>
                            <th scope="col" class="px-6 py-3"><span class="sr-only">Options</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user?.id" :class="{ 'bg-gray-100 dark:bg-gray-900': user?.id === authUserId }" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ user?.id }}</th>
                            <td class="px-6 py-4">{{ user?.username }}</td>
                            <td class="px-6 py-4 text-right">
                                <button v-if="user?.id !== authUserId" @click="removeUser(user?.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add User to Clan -->
        <div class="max-w-7xl pt-6 pb-6 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add Admin to Clan</h3>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-6">Add a new admin by their Discord ID</h4>
                    <form @submit.prevent="addUser">
                        <div class="mt-6 mb-6">
                            <label for="discord_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Discord ID</label>
                            <input v-model="newUser.discord_id" type="text" id="discord_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            users: [], // Array of users
            authUserId: null, // ID of the authenticated user
            newUser: {
                discord_id: ''
            }
        };
    },
    methods: {
        removeUser(userId) {
            // Implement the logic to remove a user from the clan
        },
        addUser() {
            // Implement the logic to add a new user to the clan
        }
    },
    created() {
        // Fetch users and set authUserId here
    }
};
</script>

<style scoped>
/* Add any scoped CSS here */
</style>


<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    props: {
        clanId: {
            type: Number,
            required: true
        },
        initialUsers: {
            type: Array,
            required: true
        },
        authUserId: {
            type: Number,
            required: true
        }
    },
    setup(props) {
        const users = ref(props.initialUsers);
        const newUser = ref({
            discord_id: ''
        });



        const addUser = async () => {
            try {
                const response = await axios.post(`/api/clan/${props.clanId}/add-user`, newUser.value);
                users.value.push(response.data.user);
                newUser.value.discord_id = '';
                console.log(response.data);
                if (response.data.success) {
                    window.location.href = `/clan/${props.clanId}`;
                }
            } catch (error) {
                console.error(error);
            }
        };

        const removeUser = async (userId) => {
            if (confirm('Are you sure you want to remove this user?')) {
                try {
                    const response = await axios.delete(`/api/clan/${props.clanId}/remove-user/${userId}`);


                    const userIdToRemove = response.data.user.id;
                    users.value = users.value.filter(user => user.id !== userIdToRemove);


                    if (response.data.success) {
                        window.location.href = `/clan/${props.clanId}`;
                    }



                } catch (error) {
                    console.error(error);
                }
            }
        };

        return {
            users,
            newUser,
            addUser,
            removeUser
        };
    }
};
</script>

