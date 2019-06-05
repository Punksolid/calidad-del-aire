<template>
<div class="p-2 bg-grey-200 border rounded">
    <h1><b>Tacometro</b></h1>
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
};
</script>
