<template>
    <span class="dropdown-component"
          @click="show">
        <span class="flex items-center">{{ name }}
        <svg fill="#FFFFFF"
                     height="24"
                     viewBox="0 0 24 24"
                     width="24"
                     xmlns="http://www.w3.org/2000/svg">
            <path d="M7 10l5 5 5-5z"/>
            <path d="M0 0h24v24H0z"
                  fill="none"/>
        </svg>
        </span>
        <div :class="{'open': open}"
             class="dropdown-container">
            <slot name="dropdown"></slot>
        </div>
    </span>
</template>

<script type="text/babel">
    export default {

        props: ['name'],

        data() {
            return {
                open: false
            };
        },

        methods: {
            show() {
                this.open = true;
                window.setTimeout(() => {
                    window.document.body.addEventListener('click', this.clickClose);
                }, 10)
            },

            clickClose(ev) {
//                console.log(this.$el.contains(ev.target));
                if (ev.target != this.$el && !this.$el.contains(ev.target)) {
                    this.open = false;
                }
            }
        }
    }
</script>

<style scoped
       lang="scss"
       type="text/scss">

    @import "~@/_variables.scss";

    .dropdown-component {
        position: relative;
        height: 100%;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        color: $white;

        .dropdown-container {
            position: absolute;
            right: 0;
            top: 100%;
            padding: 15px;
            background: $body-bg;
            display: none;
            box-shadow: 0 0 8px rgba(0, 0, 0, .2);

            &.open {
                display: block;
            }

            & > *:first-child {
                display: flex;
                flex-direction: column;

            }
        }
    }
</style>