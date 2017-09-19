<template>
    <span class="user-form-component">
        <button @click="modalOpen = true"
                class="btn"
        >{{ buttonText }}</button>
        <modal :show="modalOpen"
               class="form-modal">
            <div slot="header">
                <h3>{{ formType === 'create' ? 'Add a New User' : 'Edit this User' }}</h3>
            </div>
            <div slot="body">
                <p class="f4 col-r"
                   v-show="mainError">{{ mainError }}</p>
                <form action=""
                      class=""
                      @submit.stop.prevent="submit">
                    <div class="form-group mv3"
                         :class="{'has-error': form.errors.name}">
                        <label class="f6 ttu col-p"
                               for="name">Name</label>
                        <span class="f6 col-r"
                              v-show="form.errors.name">{{ form.errors.name }}</span>
                        <input type="text"
                               name="name"
                               v-model="form.data.name"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="form-group mv3"
                         :class="{'has-error': form.errors.email}">
                        <label class="f6 ttu col-p"
                               for="email">Email</label>
                        <span class="f6 col-r"
                              v-show="form.errors.email">{{ form.errors.email }}</span>
                        <input type="text"
                               name="email"
                               v-model="form.data.email"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="form-group mv3"
                         v-if="formType === 'create'"
                         :class="{'has-error': form.errors.password}">
                        <label class="f6 ttu col-p"
                               for="password">Password</label>
                        <span class="f6 col-r"
                              v-show="form.errors.password">{{ form.errors.password }}</span>
                        <input type="password"
                               name="password"
                               v-model="form.data.password"
                               placeholder="Must be at least 8 characters"
                               class="w-100 input h2 pl2">
                    </div>
                    <div class="form-group mv3"
                         v-if="formType === 'create'"
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
                    <div class="form-group mv3"
                         v-if="formType === 'create'"
                    >
                        <label for="superadmin">Super Admin User: </label>
                        <span class="f6 col-r"
                              v-show="form.errors.superadmin">{{ form.errors.superadmin }}</span>
                        <input type="checkbox"
                               id="superadmin"
                               name="superadmin"
                               v-model="form.data.superadmin">
                    </div>
                    <div class="modal-form-button-bar w-100 flex justify-end">
                        <button class="btn btn-grey"
                                type="button"
                                @click="modalOpen = false">Cancel</button>
                        <button class="btn"
                                type="submit"
                                :disabled="waiting">
                            <span v-show="!waiting">{{ formType === 'create' ? 'Add User' : 'Save Changes' }}</span>
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
                    name: this.formAttributes.name || '',
                    email: this.formAttributes.email || '',
                    password: this.formAttributes.password || '',
                    password_confirmation: this.formAttributes.password_confirmation || '',
                    superadmin: this.formAttributes.superadmin || ''
                })
            };
        },

        mounted() {

        },

        methods: {
            canSubmit() {
                return true;
            },

            getUpdatedDataFromResponseData(updated_data) {
                return {
                    name: updated_data.name,
                    email: updated_data.email
                };
            },

            getStoreActionEventName() {
                return 'user-created';
            },

            getUpdateActionEventName() {
                return 'user-updated';
            }
        }
    }
</script>