<template>
    <div class="profile__inner">
        <div class="profile__logo">
            {{ initials }}
            <span>Gold</span>
        </div>
        <form action="#" class="form" @submit.prevent="submit" method="POST">
            <div class="form__title">
                <p>Добрый день, <span>{{ fullname }}</span>
                </p>
                <p>В этом разделе вы можете изменить или дополнить информацию о своем профиле.</p>
            </div>
            <div class="form__block">
                <div class="form__group form__group_fl form__group_inp">
                    <label>Юр. ЛИЦО? <span class="js-info"
                                           data-toggle="tooltip"
                                           data-placement="left"
                                           title="Вы можете заказать товар только в количестве, кратном указанном"></span>
                    </label>
                    <div class="switch-wrap form__switch form__switch_mg">
                        <label class="switch" id="switch">
                            <input type="checkbox" v-model="form.isLegal">
                            <span class="switch__btn"></span>
                        </label>
                    </div>
                </div>
                <div class="form__group form__group_inp" v-if="form.isLegal">
                    <label>Название Юр. Лица</label>
                    <div class="form__group__field" :class="{'error': (errors.legalEntity)}">
                        <input type="text" v-model="form.legalEntity"/>
                        <ErrorResponse :message="errors.legalEntity" @close="errors.legalEntity = null"/>
                    </div>
                </div>

                <div class="form__group form__group_inp" v-if="form.group === 'mixed'">
                    <label>Тип цен</label>
                    <div class="form__group__field" :class="{'error': (errors.group)}">
                        <GroupSelector :group="form.group" :group-mixed="form.groupMixed"/>
                        <ErrorResponse :message="errors.userGroup" @close="errors.group = null"/>
                    </div>
                </div>
            </div><!-- /form__block -->
            <div class="form__block">
                <div class="form__group form__group_inp">
                    <label>Имя</label>
                    <div class="form__group__field js-form__group__field" :class="{'error': (errors.lastname)}">
                        <input type="text" v-model="form.firstname" placeholder="Имя" class="js-validate"/>
                        <ErrorResponse :message="errors.firstname" @close="errors.firstname = null"/>
                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label>Фамилия</label>
                    <div class="form__group__field js-form__group__field" :class="{'error': (errors.lastname)}">
                        <input type="text" class="js-validate" v-model="form.lastname" placeholder="Фамилия"/>
                        <ErrorResponse :message="errors.lastname" @close="errors.lastname = null"/>
                    </div>
                </div>
            </div>
            <div class="form__block">
                <div class="form__group form__group_inp">
                    <label>Еmail</label>
                    <div class="form__group__field js-form__group__field" :class="{'error': (errors.email)}">
                        <input type="text" v-model="form.email" placeholder="Email" class="js-validate"/>
                        <ErrorResponse :message="errors.email" @close="errors.email = null"/>
                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label>Телефон</label>
                    <div class="form__group__field js-form__group__field" :class="{'error': (errors.phone)}">
                        <input type="text" v-model="form.phone" class="js-validate" placeholder="Телефон"/>
                        <ErrorResponse :message="errors.phone" @close="errors.phone = null"/>
                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label>Адрес</label>
                    <div class="form__group__field js-form__group__field" :class="{'error': (errors.address)}">
                        <input type="text" class="js-validate" v-model="form.address" placeholder="Адрес"/>
                        <ErrorResponse :message="errors.address" @close="errors.address = null"/>
                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label>УНП</label>
                    <div class="form__group__field">
                        <input type="text" v-model="form.taxId" placeholder="необязательно"/>

                    </div>
                </div>
                <div class="form__group form__group_inp">
                    <label>IBAN</label>
                    <div class="form__group__field">
                        <input type="text" v-model="form.iban" placeholder="необязательно"/>

                    </div>
                </div>
            </div><!-- /form__block -->
            <div class="form__block form__block_password">
                <div class="form__group form__group_fl form__group_inp">
                    <label>Сменить пароль?</label>
                    <div class="switch-wrap form__switch form__switch_mg">
                        <label class="switch">
                            <input type="checkbox" v-model="form.changePassword">
                            <span class="switch__btn"></span>
                        </label>
                    </div>
                </div>
                <template v-if="form.changePassword">
                    <div class="form__group form__group_inp">
                        <label>Новый пароль</label>
                        <div class="form__group__field js-form__group__field" :class="{'error': (errors.newPassword)}">
                            <input type="password" class="js-validate" v-model="form.newPassword"/>
                            <ErrorResponse :message="errors.newPassword" @close="errors.newPassword = null"/>
                        </div>
                    </div>
                    <div class="form__group form__group_inp">
                        <label>Повторите пароль</label>
                        <div class="form__group__field js-form__group__field"
                             :class="{'error': (errors.repeatPassword)}">
                            <input type="password" class="js-validate" v-model="form.repeatPassword"/>
                            <ErrorResponse :message="errors.repeatPassword" @close="errors.repeatPassword = null"/>
                        </div>
                    </div>
                </template>
                <input type="submit" class="form__btn form__btn_pad" :value="buttonText" :disabled="isLoaded">
            </div>
        </form>
    </div>
</template>

<script>
import ErrorResponse from '@/modules/user/components/ErrorResponse.vue'
import { buildFormData } from '@/core/utils/utils'
import axios from 'axios'
import GroupSelector from './GroupSelector.vue'

export default {
    components: {
        GroupSelector,
        ErrorResponse
    },
    props: {
        user: {
            type: Object
        }
    },
    data() {
        return {
            isLoaded: false,
            buttonText: 'Сохранить',
            form: {
                isLegal: this.user.isLegal,
                legalEntity: this.user.legalEntity,
                group: this.user.group,
                groupMixed: this.user.groupMixed,
                firstname: this.user.firstname,
                lastname: this.user.lastname,
                email: this.user.email,
                phone: this.user.phone,
                address: this.user.address,
                taxId: this.user.taxId,
                iban: this.user.iban,
                changePassword: null,
                newPassword: null,
                repeatPassword: null
            },
            errors: {}
        }
    },
    computed: {
        initials() {
            let name = this.fullname
            let rgx = new RegExp(/(\p{L}{1})\p{L}+/, 'gu')

            let initials = [...name.matchAll(rgx)] || []

            initials = (
                (initials.shift()?.[1] || '') + (initials.pop()?.[1] || '')
            ).toUpperCase()

            return initials
        },
        fullname() {
            return this.form.firstname + ' ' + this.form.lastname
        },
        isLegal() {
            return this.form.isLegal
        }
    },
    methods: {
        submit() {
            const data = {
                action: 'save_profile',
                form: this.form
            }
            const form = new FormData()

            buildFormData(form, data)

            this.buttonText = 'Сохранение...'
            this.isLoaded = true

            axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form
            }).then(() => {
                this.buttonText = 'Сохранено!'

                setTimeout(() => {
                    this.buttonText = 'Сохранить'
                    this.isLoaded = false
                }, 3000)
            }).catch(error => {
                this.errors = error.response.data.data.errors
                this.buttonText = 'Сохранить'
                this.isLoaded = false
            })
        }
    },
    watch: {
        fullname(val) {
            document.querySelector('.dropdown__header_autor p').innerText = val
        }
    }
}
</script>
