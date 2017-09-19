<style></style>

<template>
    <span class="reset-password-form-component">
        <a @click="modalOpen = true"
                class="link col-p"
        >Reset Password</a>
        <modal :show="modalOpen"
               class="form-modal">
            <div slot="header">
                <h3>Forgot Your Password?</h3>
            </div>
            <div slot="body">
                <p>Simply fill send us the email you use to log in, and we'll send you link to reset your password.</p>
                <p class="lead text-danger"
                   v-show="mainError">{{ mainError }}</p>
                <form action=""
                      class=""
                      @submit.stop.prevent="submit">
                    <div class="form-group mv3"
                         :class="{'has-error': form.errors.email}">
                        <label class="f6 ttu col-p"
                               for="email">Email</label>
                        <span class="f6 col-r"
                              v-show="form.errors.email">{{ form.errors.email }}</span>
                        <input type="email"
                               name="email"
                               v-model="form.data.email"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="modal-form-button-bar w-100 flex justify-end">
                        <button class="btn btn-grey"
                                type="button"
                                @click="modalOpen = false">Cancel</button>
                        <button class="btn"
                                type="submit"
                                :disabled="waiting">
                            <span v-show="!waiting">Send Reset Email</span>
                            <div class="spinner"
                                 v-show="waiting">
                                <div class="bounce1"></div>
                                <div class="bounce2"></div>
                                <div class="bounce3"></div>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
            <div slot="footer"></div>
        </modal>
    </span>
</template>

<script type="text/babel">

    import Form from "./Form";
    import formMixin from "./mixins/formMixin";

    export default {
        mixins: [formMixin],

        data() {
            return {
                form: new Form({
                    email: '',
                })
            };
        },

        mounted() {
            eventHub.$on('password-email-sent', () => {
                eventHub.$emit('user-alert', {
                    title: 'Check your inbox',
                    type: 'success',
                    text: 'Follow the instructions in the email we just sent to reset your password.',
                    confirm: 'Got it'
                })
            })
        },

        methods: {
            canSubmit() {
                return true;
            },

            getUpdatedDataFromResponseData(updated_data) {

            },

            getStoreActionEventName() {
                return 'password-email-sent';
            },

            getUpdateActionEventName() {
                return 'password-email-sent';
            }
        }
    }
</script>