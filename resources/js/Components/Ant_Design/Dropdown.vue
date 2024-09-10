<template>
    <div class="demo-dropdown-wrap">
        <a-dropdown-button @click="handleButtonClick">
            Dropdown
            <template #overlay>
                <a-menu @click="handleMenuClick">
                    <a-menu-item key="1">
                        <UserOutlined />
                        1st menu item
                    </a-menu-item>
                    <a-menu-item key="2">
                        <UserOutlined />
                        2nd menu item
                    </a-menu-item>
                    <a-menu-item key="3">
                        <UserOutlined />
                        3rd item
                    </a-menu-item>
                </a-menu>
            </template>
        </a-dropdown-button>
        <a-dropdown-button>
            Dropdown
            <template #overlay>
                <a-menu @click="handleMenuClick">
                    <a-menu-item key="1">
                        <UserOutlined />
                        1st menu item
                    </a-menu-item>
                    <a-menu-item key="2">
                        <UserOutlined />
                        2nd menu item
                    </a-menu-item>
                    <a-menu-item key="3">
                        <UserOutlined />
                        3rd item
                    </a-menu-item>
                </a-menu>
            </template>
            <template #icon><UserOutlined /></template>
        </a-dropdown-button>
        <a-dropdown-button disabled @click="handleButtonClick">
            Dropdown
            <template #overlay>
                <a-menu @click="handleMenuClick">
                    <a-menu-item key="1">
                        <UserOutlined />
                        1st menu item
                    </a-menu-item>
                    <a-menu-item key="2">
                        <UserOutlined />
                        2nd menu item
                    </a-menu-item>
                    <a-menu-item key="3">
                        <UserOutlined />
                        3rd item
                    </a-menu-item>
                </a-menu>
            </template>
        </a-dropdown-button>
        <a-dropdown>
            <template #overlay>
                <a-menu @click="handleMenuClick">
                    <a-menu-item key="1">
                        <UserOutlined />
                        1st menu item
                    </a-menu-item>
                    <a-menu-item key="2">
                        <UserOutlined />
                        2nd menu item
                    </a-menu-item>
                    <a-menu-item key="3">
                        <UserOutlined />
                        3rd item
                    </a-menu-item>
                </a-menu>
            </template>
            <a-button>
                Button
                <DownOutlined />
            </a-button>
        </a-dropdown>
    </div>
</template>
<script setup>
const handleButtonClick = e => {
    console.log('click left button', e);
};
const handleMenuClick = e => {
    console.log('click', e);
};
export {};
</script>
<style lang="less" scoped>
.demo-dropdown-wrap :deep(.ant-dropdown-button) {
    margin-right: 8px;
    margin-bottom: 8px;
}
</style>


<template>
    <div id="components-dropdown-demo-placement">
        <template v-for="(placement, index) in placements" :key="placement">
            <a-dropdown :placement="placement">
                <a-button>{{ placement }}</a-button>
                <template #overlay>
                    <a-menu>
                        <a-menu-item>
                            <a target="_blank" rel="noopener noreferrer" href="http://www.alipay.com/">
                                1st menu item
                            </a>
                        </a-menu-item>
                        <a-menu-item>
                            <a target="_blank" rel="noopener noreferrer" href="http://www.taobao.com/">
                                2nd menu item
                            </a>
                        </a-menu-item>
                        <a-menu-item>
                            <a target="_blank" rel="noopener noreferrer" href="http://www.tmall.com/">
                                3rd menu item
                            </a>
                        </a-menu-item>
                    </a-menu>
                </template>
            </a-dropdown>
            <br v-if="index === 2" />
        </template>
    </div>
</template>
<script setup>
const placements = ['bottomLeft', 'bottom', 'bottomRight', 'topLeft', 'top', 'topRight'];
export {};
</script>
<style scoped>
#components-dropdown-demo-placement .ant-btn {
    margin-right: 8px;
    margin-bottom: 8px;
}
</style>


<template>
    <a-space style="display: flex; flex-wrap: wrap">
        <template v-for="placement in placements" :key="placement">
            <a-dropdown :placement="placement" arrow>
                <a-button>{{ placement }}</a-button>
                <template #overlay>
                    <a-menu>
                        <a-menu-item>
                            <a href="javascript:;">1st menu item</a>
                        </a-menu-item>
                        <a-menu-item>
                            <a href="javascript:;">2nd menu item</a>
                        </a-menu-item>
                        <a-menu-item>
                            <a href="javascript:;">3rd menu item</a>
                        </a-menu-item>
                    </a-menu>
                </template>
            </a-dropdown>
        </template>
    </a-space>
</template>
<script setup>
const placements = ['topLeft', 'top', 'topRight', 'bottomLeft', 'bottom', 'bottomRight'];
</script>
