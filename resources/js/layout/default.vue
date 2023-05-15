<template>
    <div class="layout">
        <Layout>
            <Sider
                width="250"
                ref="side1"
                hide-trigger
                collapsible
                :collapsed-width="78"
                v-model="isCollapsed"
            >
                <Sidebar :isCollapsed="isCollapsed" />
            </Sider>
            <Layout>
                <Header
                    :style="{ padding: 0 }"
                    class="layout-header-bar header-bar"
                >
                    <div class="_header_main">
                        <div class="_1header_title _flex_space">
                            <span
                                @click="collapsedSider"
                                :class="rotateIcon"
                                type="navicon-round"
                                ><i class="fas fa-bars"></i
                            ></span>
                            <p class="title-sett">
                                {{
                                    $route.meta.pageTitle
                                        ? $route.meta.pageTitle
                                        : "No Page Title"
                                }}
                            </p>
                        </div>

                        <Navbar />
                    </div>
                </Header>
                <Content :style="{ minHeight: '220px' }">
                    <div class="dream-input">
                        <transition name="component-fade" mode="out-in">
                            <router-view></router-view>
                        </transition>
                    </div>
                </Content>
            </Layout>
        </Layout>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import Sidebar from "../components/sidebar";
import Navbar from "../components/navbar";

export default {
    components: {
        Sidebar,
        Navbar,
    },
    data() {
        // const { width, height } = useWindowSize();
        return {
            isCollapsed: false,
            newOrdertotal: 0,
            isNotiOptionMenuIndex: -1,
            isNotiOptionMenu: false,
            windowxWidth: 0,
            windowyHeight: 0,
        };
    },
    computed: {
        ...mapGetters({
            allNotiFalg: "allNotiFalg",
            oneNotiFalg: "oneNotiFalg",
        }),
        rotateIcon() {
            return ["menu-icon", this.isCollapsed ? "rotate-icon" : ""];
        },

        menuitemClasses() {
            return ["menu-item", this.isCollapsed ? "collapsed-menu" : ""];
        },
    },
    methods: {
        collapsedSider() {
            this.$refs.side1.toggleCollapse();
        },
        goToLink(url) {
            console.log(url);
            this.$router.push(url);
        },
        handleGoToMenu(d) {
            return d;
        },
        async myFunction() {
            const res = await this.callApi("get", `/app/countUnseenNotis`);
            if (res.status == 200) {
                this.total = res.data.notis.totalUnseen;
                this.$store.commit("newOrdersCount", res.data.new_orders);
            }
        },

        checkAuthLifeSpan() {
            var spans = this.$ls.get("authLifeSpan");
            if (!spans) return;
            // if(!spans) return window.location='/logout'
            let authLifeSpan = JSON.parse(spans);
            let inactiveTime = this.companyInfo.inactiveTime;
            var timeNow = new Date();

            var lastLodingTime = new Date(authLifeSpan.id);
            var diffMs = timeNow - lastLodingTime; // milliseconds between now & Christmas
            var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
            console.log(diffMins + " minutes spent since last login");
            if (diffMins > inactiveTime) {
                window.location = "/logout";
            }
        },
    },
    watch: {
        allNotiFalg(newVal, oldVal) {
            this.total = 0;
        },
        oneNotiFalg(newVal, oldVal) {
            if (this.total > 0) this.total--;
        },
        "$route.name": function (newVal, oldVal) {
            this.extendAuthLifeSpan();
        },
    },
    async created() {},
};
</script>
