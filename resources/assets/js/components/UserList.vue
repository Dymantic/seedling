<style></style>

<template>
    <div class="users-list-component">
        <user-item v-for="user in users"
                   :key="user.id"
                   :user-attributes="user"
                   @user-deleted="removeUser"
        >
        </user-item>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['initial-list'],

        data() {
            return {
                users: []
            };
        },

        mounted() {
            this.users = this.initialList || [];
            eventHub.$on('user-created', this.fetchUsers);
        },

        methods: {
            fetchUsers() {
                axios.get('/admin/services/users')
                    .then(({data}) => this.users = data)
                    .catch(err => console.log(err));
            },

            removeUser(user_id) {
                const user = this.users.find(user => user.id === user_id);
                this.users.splice(this.users.indexOf(user), 1);
            }
        }
    }
</script>