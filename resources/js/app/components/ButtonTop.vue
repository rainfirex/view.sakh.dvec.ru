<template>
    <div>
        <a href="#" class="top"
           id="linkTop"
           title="Вернуться к началу страницы"
           @click.prevent="goUp">Вверх</a>
    </div>
</template>

<script>
    export default {
        name: "ButtonTop",
        data() {
            return {
                timeOut: null
            }
        },
        created() {
            window.onscroll = function() {
                let scrollElem = document.getElementById("linkTop");

                if ((window.scrollY >= 500)) {
                    scrollElem.classList.add('visible');
                } else {
                    scrollElem.classList.remove('visible');
                }
            }
        },
        methods: {
            goUp() {
                const top = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
                if (top > 0) {
                    window.scrollBy(0, -100);
                    this.timeOut = setTimeout(this.goUp(), 1);
                } else clearTimeout(this.timeOut);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .top {
        background: #e24545;
        color: #cec9c9;
        text-decoration: none;
        border-radius: 10px;
        padding: 15px;
        position: fixed;
        right: -145px;
        bottom: 45px;
        z-index: 3;
        opacity: 0;
        box-shadow: 1px 1px 10px #332f2f;

        &:hover{
            background: #ec0707;
            color: #ffffff !important;
        }
    }
    .visible{
        opacity: 1 !important;
        right: 45px;
    }
</style>
