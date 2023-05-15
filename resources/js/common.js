import { directive as onClickaway } from "vue-clickaway";
import { mapGetters } from "vuex";

export default {
    directives: {
        onClickaway: onClickaway,
    },
    data() {
        return {
            crfObj: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        };
    },

    methods: {
        //  A COMMON WAY TO CALL THE APIS USING ASYNC AWAIT
        async callApi(method, url, dataObj) {
            try {
                let data = await axios({
                    method: method,
                    url: url,
                    data: dataObj,
                });
                return data;
            } catch (e) {
                // console.log(e)
                // console.log ('i am from eeee',e.response.status)
                if (e.response.status == 401) {
                    this.i("Session Expired!");
                    setTimeout(() => {
                        window.location = "/login";
                    }, 2000);
                }

                return e.response;
            }
        },
        async extendAuthLifeSpan() {
            var currentdate = new Date().toLocaleString().replace(",", "");
            let authLifeSpan = {
                id: Date.now(),
                time: currentdate,
            };
            this.$ls.set("authLifeSpan", JSON.stringify(authLifeSpan));
        },

        ls() {
            this.$Loading.start();
        },
        lf() {
            this.$Loading.finish();
        },
        le() {
            this.$Loading.error();
        },
        i(t, m) {
            this.$Notice.info({
                title: t,
                desc: m,
            });
        },
        e(t, m) {
            this.$Notice.error({
                title: t,
                desc: m,
            });
        },
        s(t, m) {
            this.$Notice.success({
                title: t,
                desc: m,
            });
        },
        w(t, m) {
            this.$Notice.warning({
                title: t,
                desc: m,
            });
        },
        swr(m) {
            this.$Notice.error({
                title: "Oops",
                desc: `Something went wrong with ${m}`,
            });
        },
        ss(m, t = "Great!") {
            this.$Notice.success({
                title: t,
                desc: m,
            });
        },
    },
    computed: {
        ...mapGetters({
            authUser: "loggedInUser",
            headerName: "getHeader",
            currencyList: "currencyList",
            invoiceModal: "getinVoiceModal",
            allStores: "getAllStores",
            // authStores:'authStores',
            companyInfo: "getCompanyInfo",
            allAccounts: "getAllAccounts",
        }),
        // authStores () {
        //     if(this.authUser.store_id == 0) return this.$store.state.authStores;
        //     let stores = [];
        //     for(let d in this.$store.state.allStores) {
        //         if(d.id == this.authUser.store_id ){
        //             stores.push(d);
        //         }
        //     }
        //     return stores
        // }
    },
    filters: {
        dateFixed(cd) {
            let d = new Date(cd);
            let monthNumber = d.getMonth() + 1;
            monthNumber = ("0" + monthNumber).slice(-2);
            let dayNumber = d.getDate();
            dayNumber = ("0" + dayNumber).slice(-2);
            let today = `${dayNumber}-${monthNumber}-${d.getFullYear()}`;
            return today;
        },
        variationFormat(variation) {
            let index = 0;
            let str = "";
            for (let d in variation) {
                if (index == 0) str = str + variation[d];
                else str = str + " | " + variation[d];

                index++;
            }
            return str;
        },
        variationFormatInvoice(variation) {
            let index = 0;
            let str = "";
            for (let d in variation) {
                if (index == 0) str = str + variation[d];
                else str = str + " " + variation[d];

                index++;
            }
            return str;
        },
        fixedPaymentType(value) {
            if (value == "sslcommerz") return "SSL Commerz Secure Payment";
            else return value;
        },
        sellTime(item) {
            const start = new Date(item);
            var hours = start.getHours();
            var minutes = start.getMinutes();
            var ampm = hours >= 12 ? "PM" : "AM";
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? "0" + minutes : minutes;
            var time = hours + ":" + minutes + " " + ampm;
            return time;
        },
        changeInoiveDate(item) {
            const start = new Date(item);
            var hours = start.getHours();
            var minutes = start.getMinutes();
            var ampm = hours >= 12 ? "PM" : "AM";
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? "0" + minutes : minutes;
            var time = hours + ":" + minutes + " " + ampm;
            return (
                " " +
                start.getDate() +
                "-" +
                (start.getMonth() + 1) +
                "-" +
                start.getFullYear() +
                " " +
                time
            );
        },
    },
};
