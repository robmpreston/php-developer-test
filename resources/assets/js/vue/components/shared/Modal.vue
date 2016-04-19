<template>
    <div class="modal-mask" @click="close" v-show="show" transition="modal">
        <div class="modal-container" @click.stop>
            <slot></slot>
        </div>
    </div>
</template>

<script>
module.exports = {
    props: ['show', 'onClose'],
    methods: {
        close: function () {
            this.onClose();
        }
    },
    ready: function () {
        document.addEventListener("keydown", function (e) {
            if (this.show && e.keyCode == 27) {
                this.onClose();
            }
        });
    }
};
</script>
