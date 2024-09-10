<template>
    <a-page-header
        style="border: 1px solid rgb(235, 237, 240)"
        title="Title"
        sub-title="This is a subtitle"
        @back="() => null"
    />
</template>

<template>
    <a-page-header
        style="border: 1px solid rgb(235, 237, 240)"
        title="Title"
        :breadcrumb="{ routes }"
        sub-title="This is a subtitle"
    />
</template>
<script setup>
const routes = [
    {
        path: 'index',
        breadcrumbName: 'First-level Menu',
    },
    {
        path: 'first',
        breadcrumbName: 'Second-level Menu',
    },
    {
        path: 'second',
        breadcrumbName: 'Third-level Menu',
    },
];
</script>

<template>
    <div>
        <a-page-header
            class="demo-page-header"
            style="border: 1px solid rgb(235, 237, 240)"
            title="Title"
            sub-title="This is a subtitle"
            @back="() => $router.go(-1)"
        >
            <template #extra>
                <a-button key="3">Operation</a-button>
                <a-button key="2">Operation</a-button>
                <a-button key="1" type="primary">Primary</a-button>
            </template>
            <a-descriptions size="small" :column="3">
                <a-descriptions-item label="Created">Lili Qu</a-descriptions-item>
                <a-descriptions-item label="Association">
                    <a>421421</a>
                </a-descriptions-item>
                <a-descriptions-item label="Creation Time">2017-01-10</a-descriptions-item>
                <a-descriptions-item label="Effective Time">2017-10-10</a-descriptions-item>
                <a-descriptions-item label="Remarks">
                    Gonghu Road, Xihu District, Hangzhou, Zhejiang, China
                </a-descriptions-item>
            </a-descriptions>
        </a-page-header>
        <br />
        <a-page-header title="Title" sub-title="This is a subtitle" @back="() => $router.go(-1)">
            <template #tags>
                <a-tag color="blue">Running</a-tag>
            </template>
            <template #extra>
                <a-button key="3">Operation</a-button>
                <a-button key="2">Operation</a-button>
                <a-button key="1" type="primary">Primary</a-button>
            </template>
            <a-row type="flex">
                <a-statistic title="Status" value="Pending" />
                <a-statistic
                    title="Price"
                    prefix="$"
                    :value="568.08"
                    :style="{
            margin: '0 32px',
          }"
                />
                <a-statistic title="Balance" prefix="$" :value="3345.08" />
            </a-row>
        </a-page-header>
    </div>
</template>

<style scoped>
.demo-page-header :deep(tr:last-child td) {
    padding-bottom: 0;
}
</style>


<template>
    <div class="components-page-header-demo-content">
        <a-page-header
            title="Title"
            class="site-page-header"
            sub-title="This is a subtitle"
            :avatar="{ src: 'https://avatars1.githubusercontent.com/u/8186664?s=460&v=4' }"
            :breadcrumb="{ routes }"
        >
            <template #tags>
                <a-tag color="blue">Running</a-tag>
            </template>
            <template #extra>
                <a-button key="3">Operation</a-button>
                <a-button key="2">Operation</a-button>
                <a-button key="1" type="primary">Primary</a-button>
                <a-dropdown key="more">
                    <a-button :style="{ border: 'none', padding: 0 }">
                        <EllipsisOutlined :style="{ fontSize: '20px', verticalAlign: 'top' }" />
                    </a-button>
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
            </template>
            <a-row class="content">
                <div style="flex: 1">
                    <p>
                        Ant Design interprets the color system into two levels: a system-level color system and
                        a product-level color system.
                    </p>
                    <p>
                        Ant Design&#x27;s design team preferred to design with the HSB color model, which makes
                        it easier for designers to have a clear psychological expectation of color when
                        adjusting colors, as well as facilitate communication in teams.
                    </p>
                    <div>
                        <template v-for="item in iconLinks" :key="item.src">
                            <a class="example-link">
                                <img class="example-link-icon" :src="item.src" :alt="item.text" />
                                {{ item.text }}
                            </a>
                        </template>
                    </div>
                </div>
                <div class="image">
                    <img
                        src="https://gw.alipayobjects.com/zos/antfincdn/K%24NnlsB%26hz/pageHeader.svg"
                        alt="content"
                        style="width: 100%"
                    />
                </div>
            </a-row>
        </a-page-header>
    </div>
</template>
<script setup>
const routes = [
    {
        path: 'index',
        breadcrumbName: 'First-level Menu',
    },
    {
        path: 'first',
        breadcrumbName: 'Second-level Menu',
    },
    {
        path: 'second',
        breadcrumbName: 'Third-level Menu',
    },
];
const iconLinks = [
    {
        src: 'https://gw.alipayobjects.com/zos/rmsportal/MjEImQtenlyueSmVEfUD.svg',
        text: 'Quick Start',
    },
    {
        src: 'https://gw.alipayobjects.com/zos/rmsportal/NbuDUAuBlIApFuDvWiND.svg',
        text: 'Product Info',
    },
    {
        src: 'https://gw.alipayobjects.com/zos/rmsportal/ohOEPSYdDTNnyMbGuyLb.svg',
        text: 'Product Doc',
    },
];
export {};
</script>
<style scoped>
#components-page-header-demo-content .image {
    margin: 0 0 0 60px;
    display: flex;
    align-items: center;
}

#components-page-header-demo-content .ant-page-header-rtl .image {
    margin: 0 60px 0 0;
}

#components-page-header-demo-content .example-link {
    line-height: 24px;
    margin-right: 16px;
}
[data-theme='compact'] #components-page-header-demo-content .example-link {
    line-height: 20px;
}
#components-page-header-demo-content .example-link-icon {
    margin-right: 8px;
}

[data-theme='compact'] #components-page-header-demo-content .example-link-icon {
    width: 20px;
    height: 20px;
}

#components-page-header-demo-content .ant-page-header-rtl .example-link {
    float: right;
    margin-right: 0;
    margin-left: 16px;
}
#components-page-header-demo-content .ant-page-header-rtl .example-link-icon {
    margin-right: 0;
    margin-left: 8px;
}
#components-page-header-demo-content .content p {
    margin-bottom: 1em;
    color: rgba(0, 0, 0, 0.85);
    overflow-wrap: break-word;
}

@media (max-width: 768px) {
    #components-page-header-demo-content .image {
        flex: 100%;
        margin: 24px 0 0;
    }
}
</style>

<template>
    <div class="components-page-header-demo-responsive" style="border: 1px solid rgb(235, 237, 240)">
        <a-page-header title="Title" sub-title="This is a subtitle" @back="() => $router.go(-1)">
            <template #extra>
                <a-button key="3">Operation</a-button>
                <a-button key="2">Operation</a-button>
                <a-button key="1" type="primary">Primary</a-button>
            </template>
            <template #footer>
                <a-tabs>
                    <a-tab-pane key="1" tab="Details" />
                    <a-tab-pane key="2" tab="Rule" />
                </a-tabs>
            </template>
            <div class="content">
                <div class="main">
                    <a-descriptions size="small" :column="2">
                        <a-descriptions-item label="Created">Lili Qu</a-descriptions-item>
                        <a-descriptions-item label="Association">
                            <a>421421</a>
                        </a-descriptions-item>
                        <a-descriptions-item label="Creation Time">2017-01-10</a-descriptions-item>
                        <a-descriptions-item label="Effective Time">2017-10-10</a-descriptions-item>
                        <a-descriptions-item label="Remarks">
                            Gonghu Road, Xihu District, Hangzhou, Zhejiang, China
                        </a-descriptions-item>
                    </a-descriptions>
                </div>
                <div class="extra">
                    <div
                        :style="{
              display: 'flex',
              width: 'max-content',
              justifyContent: 'flex-end',
            }"
                    >
                        <a-statistic
                            title="Status"
                            value="Pending"
                            :style="{
                marginRight: '32px',
              }"
                        />
                        <a-statistic title="Price" prefix="$" :value="568.08" />
                    </div>
                </div>
            </div>
        </a-page-header>
    </div>
</template>

<style scoped>
.components-page-header-demo-responsive {
    padding-bottom: 20px;
}
.components-page-header-demo-responsive tr:last-child td {
    padding-bottom: 0;
}
#components-page-header-demo-responsive .content {
    display: flex;
}
#components-page-header-demo-responsive .ant-statistic-content {
    font-size: 20px;
    line-height: 28px;
}
@media (max-width: 576px) {
    #components-page-header-demo-responsive .content {
        display: block;
    }

    #components-page-header-demo-responsive .main {
        width: 100%;
        margin-bottom: 12px;
    }

    #components-page-header-demo-responsive .extra {
        width: 100%;
        margin-left: 0;
        text-align: left;
    }
}
</style>
