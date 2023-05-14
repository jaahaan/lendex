<template>
    <div class="_content">
        <div>
            <Breadcrumb>
                <BreadcrumbItem to="/">Dashboard</BreadcrumbItem>
                <BreadcrumbItem to="/projects">Projects</BreadcrumbItem>
                <BreadcrumbItem>Edit Project</BreadcrumbItem>
            </Breadcrumb>
        </div>
        <div class="common-page-card">
            <Form>
                <Row :gutter="24">
                    <Col span="24">
                        <div class="demo-upload-list" v-if="formValue.image">
                            <img :src="`${http + formValue.image}`" />
                            <div class="demo-upload-list-cover">
                                <Icon
                                    type="ios-trash-outline"
                                    @click.native="handleRemove"
                                ></Icon>
                            </div>
                        </div>

                        <div class="mt-3 mb-3" v-else-if="!formValue.image">
                            <Upload
                                ref="formValueUploads"
                                type="drag"
                                :headers="crfObj"
                                :on-success="handleSuccess"
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
                        <FormItem
                            label="Title"
                            :error="errorMessages.title"
                            :required="true"
                        >
                            <Input
                                type="text"
                                placeholder="Title"
                                v-model="formValue.title"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem
                            label="Subtitle"
                            :error="errorMessages.subtitle"
                            :required="true"
                        >
                            <Input
                                type="text"
                                placeholder="Subtitle"
                                v-model="formValue.subtitle"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem
                            label="Project Name"
                            :error="errorMessages.projectName"
                            :required="true"
                        >
                            <Input
                                type="text"
                                placeholder="Project Name"
                                v-model="formValue.projectName"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem label="Clients">
                            <Input
                                type="text"
                                placeholder="clients"
                                v-model="formValue.clients"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="24">
                        <h4 style="margin-bottom: 10px">Description</h4>
                    </Col>
                    <Col span="24">
                        <div class="quil-editor" style="min-height: 150px">
                            <quill-editor
                                ref="myQuillEditor"
                                v-model="formValue.description"
                                :autosize="{ minRows: 15, maxRows: 20 }"
                                :options="editorOption"
                                @change="onEditorChange($event)"
                            ></quill-editor>
                        </div>
                    </Col>

                    <Col span="12">
                        <FormItem label="Budget">
                            <Input
                                type="text"
                                placeholder="Budget"
                                v-model="formValue.budget"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem label="Duration">
                            <Input
                                type="text"
                                placeholder="Duration"
                                v-model="formValue.duration"
                            ></Input>
                        </FormItem>
                    </Col>
                    <Col span="12">
                        <FormItem label="Date">
                            <DatePicker
                                type="date"
                                v-model="formValue.date"
                                placeholder="Date"
                                class="d-block"
                            ></DatePicker>
                        </FormItem>
                    </Col>
                    <Col span="24">
                        <Button
                            type="primary"
                            @click="$router.push('/projects')"
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
                title: "",
                subtitle: "",
                description: "",
                projectName: "",
                clients: "",
                budget: "",
                duration: "",
                date: "",
            },
            errorMessages: {
                title: "",
                subtitle: "",
                projectName: "",
            },
            editorOption: {},
            http: "http://127.0.0.1:8000/attachments/",
        };
    },
    methods: {
        handleSuccess(res, file) {
            res = `${res}`;
            this.formValue.image = res;
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
        async handleRemove() {
            let name;
            name = this.formValue.image;
            this.formValue.image = "";

            const res = await this.callApi("post", "/app/delete_image", {
                imageName: name,
            });
        },
        onEditorChange({ quill, html, text }) {
            this.formValue.description = html;
        },
        async save() {
            let validation = true;

            this.clearErrorMessages();

            if (this.formValue.title.trim() == "") {
                this.errorMessages.title = "Title is required!";
                validation = false;
            }
            if (this.formValue.subtitle.trim() == "") {
                this.errorMessages.subtitle = "Subtitle is required!";
                validation = false;
            }
            if (this.formValue.projectName.trim() == "") {
                this.errorMessages.projectName = "Project Name is required!";
                validation = false;
            }
            if (validation == false)
                return this.$Message.error("Validation Fail!");

            this.loading = true;
            const res = await this.callApi(
                "put",
                "/app/update_project",
                this.formValue
            );
            if (res.status === 200 || res.status == 201) {
                this.loading = false;
                this.ss("Updated successfully!");
                this.$router.push("/projects");
            } else if (this.status == 422) {
                for (let x in response.data) {
                    this.e(response.data[x]);
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
                `/app/get_project/${this.$route.params.id}`
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
