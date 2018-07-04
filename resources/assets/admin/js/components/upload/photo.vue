<template>
    <div class="photo-upload">
        <div class="photo" v-bind:style="{width: size + 'px', height: size + 'px'}" v-for="(item, index) in photos">
            <template>
                <img :src="item">
                <div class="cover">
                    <Icon type="ios-eye-outline" @click.native="handleView(item)"></Icon>
                    <Icon type="ios-trash-outline" @click.native="handleRemove(index)"></Icon>
                </div>
            </template>
        </div>
        <Upload
                :ref="uuid"
                :show-upload-list="false"
                :multiple="multiple"
                :on-success="handleSuccess"
                :format="['jpg','jpeg','png']"
                :max-size="2048"
                :on-format-error="handleFormatError"
                :on-exceeded-size="handleMaxSize"
                :before-upload="handleBeforeUpload"
                :on-progress="handleProgress"
                :on-error="handlError"
                :headers="headers"
                type="drag"
                action="/base/file"
                class="upload"
                v-bind:style="{width: size + 'px', height: size + 'px'}"
                v-if="uploadHide"
        >
            <div class="upload-camera" v-if="percentage === 100">
                <Icon type="camera" size="20"></Icon>
            </div>
            <Progress class="progress" v-else :percent="percentage" :status="progressStatus" hide-info></Progress>
        </Upload>

        <Modal title="View Image" v-model="visible">
            <img :src="viewPhoto" v-if="visible" style="width: 100%">
        </Modal>
    </div>
</template>

<script>
  import uuid from "../../mixins/uuid";

  export default {
    name: "upload-photo",
    mixins: [uuid],
    props: {
      value: {
        type: [String, Array]
      },
      multiple: {
        type: Boolean,
        default: false
      },
      size: {
        type: Number,
        default: 200
      }
    },
    data() {
      return {
        visible: false,
        photos: this.getInitialValue(),
        viewPhoto: '',
        percentage: 100,
        progressStatus: 'active',
      }
    },
    computed: {
      headers() {
        return {
          authorization: 'bearer ' + this.$cache.get('token')
        }
      },
      realValue() {
        if (this.multiple) {
          return this.photos;
        } else {
          return this.photos.length > 0 ? this.photos[0] : '';
        }
      },
      uploadHide() {
        return this.multiple || this.photos.length === 0;
      }
    },
    methods: {
      getInitialValue() {
        const {multiple, value} = this;
        let initialValue = Array.isArray(value) ? value : [value];
        if (!multiple && (typeof initialValue[0] === 'undefined')) initialValue = [];
        return initialValue.filter((item) => {
          return Boolean(item)
        });
      },
      handleFormatError(file, fileList) {
        this.$Notice.warning({
          title: '错误',
          desc: '上传失败,文件格式错误！'
        });
      },
      handleMaxSize(file) {
        this.$Notice.warning({
          title: '错误',
          desc: '上传失败,文件太大了！'
        });
      },
      handleBeforeUpload(file) {
        this.progressStatus = 'active';
        this.percentage = 0
      },
      handlError(error, file, fileList) {
        this.progressStatus = 'wrong'
        this.percentage = 100
        this.$Notice.warning({
          title: '错误',
          desc: '上传失败！'
        });
      },
      handleSuccess(response, file, fileList) {
        this.progressStatus = 'success'
        this.percentage = 100
        this.photos.push(response.data.url)
        this.$emit("input", this.realValue);
        this.$emit("on-upload", response.data.url)
      },
      handleProgress(event, file, fileList) {
        this.progressStatus = 'active';
        this.percentage = 50
      },
      handleView(item) {
        this.viewPhoto = item
        this.visible = true;
      },
      handleRemove(index) {
        this.photos.splice(index, 1)
        this.$emit("input", this.realValue);
      }
    },
    watch: {
      value(value) {
        if (value === '') this.photos = [];
        else
          this.$nextTick(() => this.photos = this.getInitialValue());
      }
    }
  }
</script>

<style lang="less" scoped>
    .photo-upload {
        display: inline-block;
        overflow: hidden;
        height: 100%;
        width: 100%;
        .upload {
            height: 100%;
            width: 100%;
            display: inline-block;
            .upload-camera {
                display: -webkit-box;
                -webkit-box-pack: center;
                box-pack: center;
                -webkit-box-align: center;
                box-align: center;
                height: 100%;
                width: 100%;
            }
            .progress {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
        }
        .photo {
            border: 1px solid transparent;
            border-radius: 4px;
            background: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .2);
            height: 100%;
            width: 100%;
            position: relative;
            display: inline-block;
            vertical-align: top;
            margin-left: 5px;
            img, .cover {
                max-width: 100%;
                max-height: 100%;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
            .cover {
                width: 100%;
                height: 100%;
                display: none;
                background: rgba(0, 0, 0, .6);
            }
        }
        .upload {
            display: inline-block;
            vertical-align: top;
        }
        .photo:hover {
            .cover {
                display: -webkit-box;
                -webkit-box-pack: center;
                box-pack: center;
                -webkit-box-align: center;
                box-align: center;
                i {
                    color: #fff;
                    font-size: 20px;
                    cursor: pointer;
                    margin: 0 2px;
                }
            }
        }
        .photo:first-child {
            margin-left: 0;
        }
    }
</style>

<style>
    .upload .ivu-upload {
        width: 100%;
        height: 100%;
    }

</style>