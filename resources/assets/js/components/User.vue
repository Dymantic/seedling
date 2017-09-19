<style></style>

<template>
    <div class="user-component card mv3 flex justify-between items-center">
        <div class="flex flex-column">
            <svg v-show="!superadmin"
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 14 16"
                 height="40px">
                <path fill="none"
                      stroke="#4d4d4e"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2px"
                      d="M11,15a2,2,0,0,0,2-2V12L8.94,10,10,8V4A3,3,0,0,0,4,4V8l1.06,2L1,12v1a2,2,0,0,0,2,2Z"/>
            </svg>
            <svg v-show="superadmin"
                 xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 14 17.63"
                 height="40px">
                <path fill="none"
                      stroke="#4d4d4e"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2px"
                      d="M11,16.63a2,2,0,0,0,2-2v-1l-4.06-2,1.06-2v-4a3,3,0,0,0-6,0v4l1.06,2L1,13.63v1a2,2,0,0,0,2,2Z"/>
                <polyline fill="none"
                          stroke="#4d4d4e"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2px"
                          points="10.98 1 10.98 3.95 3.02 3.95 3.02 1"/>
                <polyline fill="none"
                          stroke="#4d4d4e"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2px"
                          points="3.02 1 4.34 2.42 5.67 1 6.99 2.42 8.32 1 9.65 2.42 10.98 1"/>
            </svg>
            <toggle-switch on-url="/admin/super-admins"
                           :off-url="`/admin/super-admins/${userAttributes.id}`"
                           label-text="Superadmin"
                           :toggle-state="superadmin"
                           :unique="userAttributes.id"
                           :on-payload="{user_id: userAttributes.id}"
                           @toggled-state="updateSuperadmin"
                           class="mt3"
            ></toggle-switch>
        </div>
        <div class="flex flex-column flex-auto pl5">
            <p>{{ name }}</p>
            <p>{{ email }}</p>
        </div>
        <div class="flex flex-column">
            <user-form :url="`/admin/users/${userAttributes.id}`"
                       button-text="Edit"
                       :form-attributes="userAttributes"
                       form-type="update"
                       @user-updated="updateUser"
                       class="mv2"
            ></user-form>
            <delete-modal :item-name="name"
                          :redirect="false"
                          :url="`/admin/users/${userAttributes.id}`"
                          @item-deleted="removeUser"
            ></delete-modal>
        </div>
    </div>
</template>

<script type="text/babel">
    import setsData from "./mixins/SetsDataFromObject";

    export default {

        mixins: [setsData],

        props: ['user-attributes'],

        data() {
            return {
                name: '',
                email: '',
                superadmin: false
            };
        },

        mounted() {
            this.setDataFrom(this.userAttributes);
        },

        methods: {
            updateUser({name, email, superadmin}) {
                this.name = name;
                this.email = email;
            },

            removeUser() {
                this.$emit('user-deleted', this.userAttributes.id);
            },

            updateSuperadmin(state) {
                this.superadmin = state;
            }
        }
    }
</script>