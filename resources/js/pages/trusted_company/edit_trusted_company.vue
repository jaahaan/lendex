<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem to="/trusted_company"
                    >Trusted Companies</BreadcrumbItem
                >
                <BreadcrumbItem>Edit Trusted Company</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Form>
                <Row :gutter="24">
                    <Col span="12">
                        <h4>Image</h4>
                        <div class="demo-upload-list" v-if="formValue.image">
                            <img :src="`${http + formValue.image}`" />
                            <div class="demo-upload-list-cover">
                                <Icon
                                    type="ios-trash-outline"
                                    @click.native="handleRemoveImage"
                                ></Icon>
                            </div>
                        </div>

                        <div class="mt-3 mb-3" v-else-if="!formValue.image">
                            <Upload
                                ref="formValueUploads"
                                type="drag"
                                :headers="crfObj"
                                :on-success="handleSuccessImage"
                                :format="['jpg', 'jpeg', 'png']"
                                :max-size="20048"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/app/upload"
                            >
                                <div class="camera-icon">
                                    <Icon type="ios-camera" size="20"></Icon>
                                    Upload Image
                                </div>
                            </Upload>
                        </div>
                    </Col>
                    <Col span="12">
                        <h4>Hover Image</h4>
                        <div
                            class="demo-upload-list"
                            v-if="formValue.hover_image"
                        >
                            <img :src="`${http + formValue.hover_image}`" />
                            <div class="demo-upload-list-cover">
                                <Icon
                                    type="ios-trash-outline"
                                    @click.native="handleRemovehover_image"
                                ></Icon>
                            </div>
                        </div>

                        <div
                            class="mt-3 mb-3"
                            v-else-if="!formValue.hover_image"
                        >
                            <Upload
                                ref="formValueUploads"
                                type="drag"
                                :headers="crfObj"
                                :on-success="handleSuccesshover_image"
                                :format="['jpg', 'jpeg', 'png']"
                                :max-size="20048"
                                :on-format-error="handleFormatError"
                                :on-exceeded-size="handleMaxSize"
                                action="/app/upload"
                            >
                                <div class="camera-icon">
                                    <Icon type="ios-camera" size="20"></Icon>
                                    Upload Image
                                </div>
                            </Upload>
                        </div>
                    </Col>
                    <Col span="24">
                        <Button
                            type="primary"
                            @click="$router.push('/trusted_company')"
                            >Cancel</Button
                        ><Button type="primary" @click="save">Save</Button>
                    </Col>
                </Row>
            </Form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            sending: false,
            formValue: {
                id: 0,
                image: "",
                hover_image: "",
            },

            http: "http://127.0.0.1:8000/attachments/",
        };
    },
    methods: {
        handleSuccessImage(res, file) {
            res = `${res}`;
            this.formValue.image = res;
        },
        handleSuccesshover_image(res, file) {
            res = `${res}`;
            this.formValue.hover_image = res;
        },
        async handleRemoveImage() {
            let name;
            name = this.formValue.image;
            this.formValue.image = "";

            const res = await this.callApi("post", "/app/delete_image", {
                imageName: name,
            });
        },
        async handleRemovehover_image() {
            let name;
            name = this.formValue.hover_image;
            this.formValue.hover_image = "";

            const res = await this.callApi("post", "/app/delete_image", {
                imageName: name,
            });
        },
        handleError(res, file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc: `${
                    file.errors.file.length
                        ? file.errors.file[0]
                        : "Something went wrong!"
                }`,
            });
        },
        handleFormatError(file) {
            this.$Notice.warning({
                title: "The file format is incorrect",
                desc:
                    "File format of " +
                    file.name +
                    " is incorrect, please select jpg or png.",
            });
        },
        handleMaxSize(file) {
            this.$Notice.warning({
                title: "Exceeding file size limit",
                desc: "File  " + file.name + " is too large, no more than 2M.",
            });
        },

        async save() {
            this.loading = true;
            const res = await this.callApi(
                "put",
                "/app/update_trusted_company",
                this.formValue
            );
            if (res.status === 200 || res.status == 201) {
                this.loading = false;
                this.ss("Updated successfully!");
                this.$router.push("/trusted_company");
            } else if (res.status == 422) {
                for (let x in res.data) {
                    this.e(res.data[x]);
                }
            } else {
                this.loading = false;
                this.swr();
            }
        },
        clearErrorMessages() {
            this.errorMessages = {
                title: "",
                icon: "",
            };
        },
        async getDetail() {
            this.loading = true;
            const response = await this.callApi(
                "get",
                `/app/get_trusted_company/${this.$route.params.id}`
            );
            if (response.status == 200) {
                this.formValue = response.data;
            } else this.swr();
            this.loading = false;
        },
    },
    async created() {
        await this.getDetail();
    },
};
</script>
