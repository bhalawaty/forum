<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            <span class="fas fa-bell"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div v-for="notification in notifications">
                <a class="dropdown-item"
                   :href="notification.data.link"
                   v-text="notification.data.message"
                   @click="markAsRead(notification)">

                </a>
            </div>

        </div>
    </li>

</template>

<script>

    export default {
        data() {
            return {notifications: false}
        },

        created() {
            axios.get("/profiles/" + window.App.user.name + "/notifications")
                .then(response => this.notifications = response.data);
        },
        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>