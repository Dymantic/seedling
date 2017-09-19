<style></style>

<template>
    <span class="reset-password-form-component">
        <button @click="modalOpen = true"
                class="link col-p bn col-bg-trans pa0 sans nowrap ph4 pv2 hv-bg-grey">Reset Password</button>
        <modal :show="modalOpen"
               class="form-modal">
            <div slot="header">
                <h3>Reset Your Password</h3>
            </div>
            <div slot="body">
                <p class="lead text-danger"
                   v-show="mainError">{{ mainError }}</p>
                <form action=""
                      class=""
                      @submit.stop.prevent="submit">
                    <div class="form-group mv3"
                         :class="{'has-error': form.errors.current_password}">
                        <label class="f6 ttu col-p"
                               for="current_password">Current password</label>
                        <span class="f6 col-r"
                              v-show="form.errors.current_password">{{ form.errors.current_password }}</span>
                        <input type="password"
                               name="current_password"
                               v-model="form.data.current_password"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="form-group mv3"
                         :class="{'has-error': form.errors.password}">
                        <label class="f6 ttu col-p"
                               for="password">New Password</label>
                        <span class="f6 col-r"
                              v-show="form.errors.password">{{ form.errors.password }}</span>
                        <input type="password"
                               name="password"
                               v-model="form.data.password"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="form-group mv3"
                         :class="{'has-error': form.errors.password_confirmation}">
                        <label class="f6 ttu col-p"
                               for="password_confirmation">Confirm Password</label>
                        <span class="f6 col-r"
                              v-show="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</span>
                        <input type="password"
                               name="password_confirmation"
                               v-model="form.data.password_confirmation"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="modal-form-button-bar w-100 flex justify-end">
                        <button class="btn btn-grey"
                                type="button"
                                @click="modalOpen = false">Cancel</button>
                        <button class="btn"
                                type="submit"
                                :disabled="waiting">
                            <span v-show="!waiting">Reset Password</span>
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
                    current_password: '',
                    password: '',
                    password_confirmation: ''
                })
            };
        },

        mounted() {
          eventHub.$on('password-reset', () => {
              console.log('weeee');
              eventHub.$emit('user-alert', {
                  title: 'Success',
                  type: 'success',
                  text: 'Your password has been reset!',
                  confirm: false
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
                return 'password-reset';
            },

            getUpdateActionEventName() {
                return 'password-reset';
            }
        }
    }
</script>