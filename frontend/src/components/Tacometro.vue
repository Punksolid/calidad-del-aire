<template>
<div>
    <h1>Tacometro</h1> 
    <v-chart :options="polar"/>   
</div>
 
</template>

<script>


export default {
    name: 'Tacometro',
    components: {
    },
    data() {
        return {
            tachometer: []
        }
    },
}
</script>

<style>

</style>
