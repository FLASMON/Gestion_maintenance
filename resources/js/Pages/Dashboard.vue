<template>
    <AuthenticatedLayout title="Dashboard" selected-menu="dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto px-4 sm:px-6 lg:px-0">
                <a-row :gutter="[16,16]">
                    <a-col :xs="24" :sm="12" :md="8" :lg="12" :xl="6">
                        <a-card class="bg-gradient-red-purple text-white relative">
                            <font-awesome-icon icon="fa-solid fa-chart-simple" class="absolute top-2 right-2 !size-20 opacity-10"/>
                            <a-statistic
                                :value="displayedRevenue"
                                suffix="%"
                                :value-style="{ color: '#fff', fontWeight: '600' }"
                                style="margin-right: 50px"
                            >
                                <template #title>
                                    <span class="text-white text-base font-semibold">Mes Taches</span>
                                </template>
                                <template #prefix>
                                    <font-awesome-icon icon="fa-solid fa-chart-line"
                                                       class="!me-0 pr-2 !size-6 text-white"/>
                                </template>
                            </a-statistic>
                            <a-progress
                                :percent="displayedRevenue"
                                :stroke-color="'#ffffff'"
                                :trail-color="'rgba(255, 255, 255, 0.2)'"
                                :stroke-width="6"
                                class="mt-0.5"
                            />

                        </a-card>
                    </a-col>

                    <a-col :xs="24" :sm="12" :md="8" :lg="12" :xl="6">
                        <a-card class="bg-gradient-purple-pink text-white">
                            <font-awesome-icon icon="fa-solid fa-chart-simple" class="absolute top-2 right-2 !size-20 opacity-10"/>
                            <a-statistic
                                :value="displayedPageViews"
                                suffix="%"
                                :value-style="{ color: '#fff', fontWeight: '600' }"
                                style="margin-right: 50px"
                            >
                                <template #title>
                                    <span class="text-white text-base font-semibold">Repares</span>
                                </template>
                                <template #prefix>
                                    <font-awesome-icon icon="fa-solid fa-chart-area" class="!me-0 pr-2 !size-6"/>
                                </template>
                            </a-statistic>
                            <a-progress
                                :percent="displayedPageViews"
                                :stroke-color="'#ffffff'"
                                :trail-color="'rgba(255, 255, 255, 0.2)'"
                                :stroke-width="6"
                                class="mt-0.5"
                            />
                        </a-card>
                    </a-col>

                    <a-col :xs="24" :sm="12" :md="8" :lg="12" :xl="6">
                        <a-card class="bg-gradient-blue-purple text-white">
                            <font-awesome-icon icon="fa-solid fa-chart-simple" class="absolute top-2 right-2 !size-20 opacity-10"/>
                            <a-statistic
                                :value="displayedBounceRate"
                                :precision="2"
                                suffix="%"
                                :value-style="{ color: '#fff', fontWeight: '600' }"
                                style="margin-right: 50px"
                            >
                                <template #title>
                                    <span class="text-white text-base font-semibold">Nom-Repares</span>
                                </template>
                                <template #prefix>
                                    <font-awesome-icon icon="fa-solid fa-chart-bar" class="!me-0 pr-2 !size-6"/>
                                </template>
                            </a-statistic>
                            <a-progress
                                :percent="displayedBounceRate"
                                :stroke-color="'#ffffff'"
                                :trail-color="'rgba(255, 255, 255, 0.2)'"
                                :stroke-width="6"
                                class="mt-0.5"
                            />
                        </a-card>
                    </a-col>

                    <a-col :xs="24" :sm="12" :md="8" :lg="12" :xl="6">
                        <a-card class="bg-gradient-orange-yellow text-white">
                            <font-awesome-icon icon="fa-solid fa-chart-simple" class="absolute top-2 right-2 !size-20 opacity-10"/>
                            <a-statistic
                                :value="displayedTestimonial"
                                suffix="%"
                                :value-style="{ color: '#fff', fontWeight: '600' }"
                                style="margin-right: 50px"
                            >
                                <template #title>
                                    <span class="text-white text-base font-semibold">Endommages</span>
                                </template>
                                <template #prefix>
                                    <font-awesome-icon icon="fa-solid fa-chart-simple" class="!me-0  pr-2 !size-6"/>
                                </template>
                            </a-statistic>
                            <a-progress
                                :percent="displayedTestimonial"
                                :stroke-color="'#ffffff'"
                                :trail-color="'rgba(255, 255, 255, 0.2)'"
                                :stroke-width="6"
                                class="mt-0.5"
                            />
                        </a-card>
                    </a-col>
                </a-row>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {ref, onMounted} from 'vue';
import {FontAwesomeIcon} from '@fortawesome/vue-fontawesome';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Valeurs finales
const revenue = 43.2;
const pageViews = 50;
const bounceRate = 43.2;
const testimonial = 80;

// Valeurs affichées pour l'animation
const displayedRevenue = ref(0);
const displayedPageViews = ref(0);
const displayedBounceRate = ref(0);
const displayedTestimonial = ref(0);

// Fonction pour animer les valeurs
const animateCounter = (refValue, finalValue) => {
    let start = 0;
    const duration = 2000;
    const stepTime = 10;
    const totalSteps = duration / stepTime;
    const stepValue = (finalValue - start) / totalSteps;

    const interval = setInterval(() => {
        start += stepValue;
        if (start >= finalValue) {
            refValue.value = finalValue;
            clearInterval(interval);
        } else {
            refValue.value = Math.round(start);
        }
    }, stepTime);
};

// Démarrer les animations lorsque le composant est monté
onMounted(() => {
    animateCounter(displayedRevenue, revenue);
    animateCounter(displayedPageViews, pageViews);
    animateCounter(displayedBounceRate, bounceRate);
    animateCounter(displayedTestimonial, testimonial);
});
</script>

<style scoped>

</style>
