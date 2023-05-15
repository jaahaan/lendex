<template>
    <div>
        <ul class="header_left_connt">
            <!-- <div class="link">
                <li style="cursor: pointer" @click="openSearchModal">Search</li>
            </div> -->
            <li class="header_left_connt_time">
                <h2>{{ time }}</h2>
                <p>{{ date }}</p>
            </li>

            <li class="header_left_connt_user">
                <div style="margin-left: 20px; cursor: pointer">
                    <Dropdown>
                        <Icon class="user_icon" type="md-person" />
                        <DropdownMenu slot="list">
                            <DropdownItem
                                ><router-link to="/my_details"
                                    >Account</router-link
                                ></DropdownItem
                            >
                            <DropdownItem
                                ><a href="/logout">Logout</a></DropdownItem
                            >
                        </DropdownMenu>
                    </Dropdown>
                </div>
                <div>
                    <h3>{{ authUser.name }}</h3>
                    <p>{{ authUser.userType }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
    data() {
        return {
            date: "",
            time: "",
        };
    },
};
</script>

<style scoped>
.central-search .ivu-form-item {
    margin-bottom: 0px;
}
.central-search .ivu-divider-horizontal {
    margin: 5px 0;
}

#lblCartCount {
    font-size: 12px;
    background: #000000;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -10px;
}
.badge {
    padding-left: 9px;
    padding-right: 9px;
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
    background-color: #c67605;
}
</style>
