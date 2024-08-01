<template>
    <section>
        <!-- List of Users -->
        <div class="max-w-7xl pt-6 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Clan Admins</h3>
                    <table class="min-w-full bg-white dark:bg-gray-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Username</th>
                                <th class="px-4 py-2 text-left">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in users" :key="user?.id" :class="{ 'bg-gray-100 dark:bg-gray-900': user?.id === authUserId }">
                                <td class="px-4 py-2">{{ user?.id }}</td>
                                <td class="px-4 py-2">{{ user?.username }}</td>
                                <td class="px-4 py-2 text-right">
                                    <button v-if="user?.id !== authUserId" @click="removeUser(user?.id)" class="text-red-600 hover:text-red-900">
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
        </div>

        <!-- Add User to Clan -->
        <div class="max-w-7xl pt-6 pb-6 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold">Add Admin to Clan</h3>
                    <form @submit.prevent="addUser">
                        <div>
                            <label for="discord_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Discord ID</label>
                            <input v-model="newUser.discord_id" type="text" id="discord_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

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

