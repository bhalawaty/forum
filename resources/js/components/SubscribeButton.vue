<template>
    <button :class="classes" @click="subscribe">subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-dark'];
            }
        },
        methods: {
            subscribe() {
                let requestType = this.active ? 'delete' : 'post';
                axios[requestType](location.pathname + '/subscriptions');
                this.active = !this.active;
                flash('subscribed');
            }
        }
    }
</script>