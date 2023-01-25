<template>
    <select class="select" v-model="getGroup"
            @change="changeGroupMixed"
    >
        <option v-for="group in groups"
                :key="group.key"
                :selected="getGroup === group.key"
                :value="group.key"
        >
            {{ group.title }}
        </option>
    </select>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { buildFormData } from '@/core/utils/utils'
import axios from 'axios'

export default {
    props: {
        group: {
            type: String,
            default: 'cashless'
        },
        groupMixed: {
            type: String,
            default: 'cashless'
        }
    },
    data() {
        return {
            groups: [
                {
                    key: 'cash',
                    title: 'Наличные'
                },
                {
                    key: 'cashless',
                    title: 'Безналичные'
                }
            ]
        }
    },
    mounted() {
        this.setUserGroup(this.group)
        this.setUserGroupMixed(this.groupMixed)
    },
    computed: {
        ...mapGetters({
            userGroup: 'user/group',
            userGroupMixed: 'user/groupMixed'
        }),
        getGroup: {
            get() {
                if (this.userGroup === 'mixed') {
                    return this.userGroupMixed
                }

                return this.userGroup
            },
            set(value) {
                this.setUserGroupMixed(value)
            }
        }
    },
    methods: {
        ...mapActions({
            setUserGroup: 'user/setGroup',
            setUserGroupMixed: 'user/setGroupMixed'
        }),
        changeGroupMixed() {
            const data = {
                action: 'save_group_mixed',
                value: this.getGroup
            }
            const form = new FormData()

            buildFormData(form, data)

            return axios({
                method: 'post',
                url: '/wp-admin/admin-ajax.php',
                data: form
            })
        }
    }
}


</script>
