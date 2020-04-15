<template>
    <v-card>
        <template v-for="habitat in habitats">
            <v-chip
                    class="ma-2"
                    close
                    color="primary"
                    outlined
                    @click:close="$emit('eliminar', habitat)"
            >
                {{habitat.nom}}
            </v-chip>
        </template>
    </v-card>
</template>
<script>
export default {
    name: 'AppChipsHabitats',
    props: {
        habitats: {
            type: Array,
            required: true
        }
    }
}
</script>