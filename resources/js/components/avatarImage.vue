<template>
    <div class="image-avatar-dummy rounded-circle" :class="size" v-if="avatar === null">
        {{ firstWord() }}
    </div>

    <div class="image-avatar rounded-circle" :class="size" v-if="avatar !== null">
        <img :src="`/storage/media/image/`+avatar" alt="avatar">
    </div>

</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        avatar: {
            type: String
        },
        size: {
            type: String,
            default: 'md'
        }
    },


    data() {
        return {}
    },


    mounted() {
    },

    methods: {
        firstWord() {
            /*Variables*/
            let name = this.name;
            let firstName, lastName, firstWord, lastWord;

            /*Separating first name and last name*/
            const words = name.split(" ")

            /*Assigning first name and last name in variable*/
            firstName = words[0];
            lastName = words[1];

            /*Main loop where taking the first word*/
            for (let i = 0; i < firstName.length; i++) {
                firstWord = firstName.split('')[0]
            }

            /*Main loop where taking the first word*/
            for (let i = 0; i < lastName.length; i++) {
                lastWord = lastName.split('')[0]
            }

            /*Returning first word and last word*/
            return firstWord + lastWord
        }
    }


}
</script>
