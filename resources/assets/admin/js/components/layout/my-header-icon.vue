<template>
    <div class="layout-header-right-icon">
        <div @click="handleFullscreen" v-if="showFullScreenBtn" class="layout-header-right-icon-item">
            <Tooltip :content="fullScreen ? '退出全屏' : '全屏'" placement="bottom">
                <Icon :type="fullScreen ? 'arrow-shrink' : 'arrow-expand'" :size="23"></Icon>
            </Tooltip>
        </div>

        <div class="layout-header-right-icon-item" @click="handleLockedscreen">
            <Tooltip placement="bottom" content="锁定">
                <Icon type="locked" size="20"></Icon>
            </Tooltip>
        </div>

        <div class="layout-header-right-icon-item"  @click="handleMessage">
            <Tooltip placement="bottom" :content="`有 ${messageTotal} 条消息未读`">
                <Badge dot :count="messageTotal">
                    <Icon type="ios-bell" size="22"></Icon>
                </Badge>
            </Tooltip>
        </div>
    </div>
</template>

<script>
    export default {
        name: "my-header-icon",
        data () {
            return {
                fullScreen: false
            }
        },
        computed: {
            showFullScreenBtn () {
                return window.navigator.userAgent.indexOf('MSIE') < 0
            },
            messageTotal(){
              return this.$store.state.Messages.total
            }
        },
        methods: {
            handleFullscreen () {
                let main = document.body
                if (this.fullScreen) {
                    if (document.exitFullscreen) {
                        document.exitFullscreen()
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen()
                    } else if (document.webkitCancelFullScreen) {
                        document.webkitCancelFullScreen()
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen()
                    }
                } else {
                    if (main.requestFullscreen) {
                        main.requestFullscreen()
                    } else if (main.mozRequestFullScreen) {
                        main.mozRequestFullScreen()
                    } else if (main.webkitRequestFullScreen) {
                        main.webkitRequestFullScreen()
                    } else if (main.msRequestFullscreen) {
                        main.msRequestFullscreen()
                    }
                }
                this.fullScreen = !this.fullScreen
            },
            handleLockedscreen () {
                this.$cache.set('locking', 1)
                this.$router.push({
                    name: 'common.lock'
                })
            },
            handleMessage(){
              this.$router.push({
                name: 'common.message'
              })
            }
        },
        created () {
            let isFullscreen = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement || document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen
            isFullscreen = !!isFullscreen
            document.addEventListener('fullscreenchange', () => {
                this.$emit('input', !this.fullScreen)
                this.$emit('on-change', !this.fullScreen)
            })
            document.addEventListener('mozfullscreenchange', () => {
                this.$emit('input', !this.fullScreen)
                this.$emit('on-change', !this.fullScreen)
            })
            document.addEventListener('webkitfullscreenchange', () => {
                this.$emit('input', !this.fullScreen)
                this.$emit('on-change', !this.fullScreen)
            })
            document.addEventListener('msfullscreenchange', () => {
                this.$emit('input', !this.fullScreen)
                this.$emit('on-change', !this.fullScreen)
            })
            this.$emit('input', isFullscreen)
            this.$store.dispatch('getMessageNotReadTotal')
        },
        components: {}
    }
</script>

<style lang="scss">
.layout-header-right-icon {
    display: inline-block;
    text-align: center;
    cursor: pointer;
    width: 100px;
    color: #fff;
    &-item {
        width: 30px;
        display: inline-block;
    }
    .ivu-tooltip {
        width: 30px;
        i {
            vertical-align: middle;
        }
    }
}

</style>